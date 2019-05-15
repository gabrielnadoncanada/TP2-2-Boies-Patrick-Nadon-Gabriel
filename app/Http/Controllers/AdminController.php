<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function locations()
    {
        $locations = Location::all();
        return view('admin.location', compact('locations'));
    }
}
