<?php

namespace App\Http\Controllers;

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

    public function index()
    {   
        // $images = Image::select(['id', 'user_id'])->withCount('user')->get();
        // dd($images);
        $users = User::withCount('images')->get();
        
        return view('admin.index', compact('users'));
    }

    public function locations()
    {
        $locations = Location::all();
      
        return view('admin.location', compact('locations'));
    }



    
}
