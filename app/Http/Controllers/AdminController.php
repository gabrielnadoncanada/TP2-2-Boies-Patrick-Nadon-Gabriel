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

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (User::find($id)) {
            $user = User::find($id);
            $user = $user->role;
            dd($user);
            $user->delete();
            return redirect('/')->with('status', __('Votre profil a été détruit'));
        } else {
            return redirect('/');
        }
    }
}
