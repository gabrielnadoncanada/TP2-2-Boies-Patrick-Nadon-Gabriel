<?php

namespace App\Http\Controllers;

use App\Repositories\ImageRepository;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;
use App\Models\Location;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function user()
    {   
        $users = User::withCount('images')->get();
        return view('admin.user', compact('users'));
    }

    public function locations()
    {
        $locations = Location::all();
        return view('admin.location', compact('locations'));
    }

    public function reported(ImageRepository $repository)
    {
        $images = $repository->getAllImages();
        $images = $this->getReportedImage($images)->where('approved', 0);
        return view('admin.reported', compact('images'));
    }

    public function getReportedImage($images)
    {
        $images->transform(function ($image) {
            $number = $image->users->where('pivot.alert', 1)->count();
            $image->approved = ($number >= 2) ? 0 : 1;
            return $image;
        });
        return $images;
    }

    public function undo($user, $image)
    {
        $image->users()->updateExistingPivot ($user->id, ['rating' => 0]);
    }
}
