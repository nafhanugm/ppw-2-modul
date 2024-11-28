<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", function () {
    return view("welcome");
});

Route::get("/dashboard", function () {
    return view("dashboard");
})
    ->middleware(["auth", "verified"])
    ->name("dashboard");

Route::get("/send-email", [SendEmailController::class, "index"]);

Route::get("/bukuReview", [ReviewController::class, "index"]);
Route::get("/bukuTag", [ReviewController::class, "indexTag"]);

Route::middleware(["auth"])->group(function () {
    Route::middleware(["admin"])->group(function () {
        Route::resource("users", UserController::class);
    });
    Route::middleware(["role.review"])->group(function () {
        Route::resource("review", ReviewController::class);
    });
    Route::resource("buku", BukuController::class);
    Route::get("/about", [PortfolioController::class, "about"])->name("about");
    Route::get("/project", [PortfolioController::class, "project"])->name(
        "project"
    );
    Route::get("/certificate", [
        PortfolioController::class,
        "certificate",
    ])->name("certificate");
    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit"
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update"
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy"
    );
});

require __DIR__ . "/auth.php";
