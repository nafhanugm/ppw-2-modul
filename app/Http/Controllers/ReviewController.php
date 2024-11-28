<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Review;
use App\Models\Tag;
use App\Models\TagReview;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $selectedReviewer = request("reviewer");
        // $reviews = Review::with(["book", "user", "reviewTags.tag"])->get();
        $reviews = Review::with(["book", "user", "reviewTags.tag"])
            ->when($selectedReviewer, function ($query) use (
                $selectedReviewer
            ) {
                return $query->where("user_id", "=", $selectedReviewer);
            })
            ->get();
        $reviewers = User::where("role", "=", "internal_reviewer")->get();
        return view(
            "review.index",
            compact(["reviews", "reviewers", "selectedReviewer"])
        );
    }

    public function indexTag()
    {
        $selectedTags = request("tag")
            ? array_map("intval", explode(",", request("tag")))
            : [];

        $query = Review::with(["book", "user", "reviewTags.tag"]);

        if (!empty($selectedTags)) {
            $query->whereHas("reviewTags", function ($q) use ($selectedTags) {
                $q->whereIn("tag_id", $selectedTags);
            });
        }

        $reviews = $query->get();
        $tags = Tag::all();

        return view(
            "review.indexTag",
            compact(["reviews", "tags", "selectedTags"])
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bukus = Buku::all();
        $tags = Tag::all();
        return view("review.create", compact(["bukus", "tags"]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "buku_id" => "required",
            "review" => "required",
            "tags" => "required",
        ]);

        $id_buku = $request->buku_id;

        $review = Review::create([
            "book_id" => $id_buku,
            "user_id" => auth()->id(),
            "review" => $request->review,
        ]);

        foreach ($request->tags as $tag) {
            $findTag = Tag::where("tag_name", "=", $tag)->firstOr(
                function () use ($tag) {
                    return Tag::create([
                        "tag_name" => $tag,
                    ]);
                }
            );

            $review->reviewTags()->create([
                "tag_id" => $findTag->id,
            ]);
        }

        return redirect()->route("review.create");
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
