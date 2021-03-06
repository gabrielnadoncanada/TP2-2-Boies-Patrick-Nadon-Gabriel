<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['string', 'min:3', 'max:255', 'unique:users'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'password' => ['string', 'min:6', 'confirmed'],
        ]);

        if ($request->email) {
            $user->update([
                'email' => $request->email,

            ]);
        }
        if ($request->name) {
            $user->update([
                'name' => $request->name,

            ]);
        }
        if ($request->password) {
            $user->update([
                'password' =>  bcrypt($request->password)

            ]);
        }
        return back()->with('status', __('Votre profil a bien été mis à jour'));
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
            if($user->role == 'admin'){
                return back()->with('status', __('Vous ne pouvez pas supprimer un profil administrateur'));
            }
            if($user->delete())
            {
                $user->delete();
                return redirect()->route('login')->with('status', __('Le profil a été détruit'));
            }
           
        } else {
            return back();
        }
    }
}
