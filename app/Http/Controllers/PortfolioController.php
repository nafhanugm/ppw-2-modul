<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function about()
    {
        return view('portfolio.about');
    }

    public function project()
    {
        return view('portfolio.project');
    }

    public function certificate()
    {
        return view('portfolio.certificate');
    }

}
