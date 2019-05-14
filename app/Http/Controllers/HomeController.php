<?php

namespace App\Http\Controllers;

use App\Repositories\ImageRepository;
use App\Models\Image;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ImageRepository $repository)
    {
        $images = $repository->getAllImages ();
        // $images = $this->getReportedImage($images)->where('approved', 1);
        return view ('home', compact ('images'));

    }

    // public function getReportedImage($images)
    // {
    //     $images->transform(function($image) {
    //         $number = $image->users->where('pivot.alert', 1)->count();
    //         $image->approved = ($number >= 2) ? 0 : 1;
    //         return $image;
    //     });
    //     return $images;
    // }
    
}
