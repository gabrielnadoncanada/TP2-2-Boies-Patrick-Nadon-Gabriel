<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
        
    // public function __construct()
    // {
    //     $this->middleware('ajax')->only('destroy');
    // }

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
        return view ('profiles.edit', compact ('user'));
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

        if($request->email){
            $user->update ([
                'email' => $request->email,
                
            ]);
           
        }
        if($request->name){
            $user->update ([
                'name' => $request->name,
                
            ]);
            
        }
        if($request->password){
            $user->update ([
                'password' =>  bcrypt($request->password)
                
            ]);
            
        }
        return back ()->with ('status', __ ('Votre profil a bien été mis à jour'));
    }
    // return redirect('/')->with('status', __
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if($id != Auth::user()->id){
        //      Notification::container()->error('You are not allowed to delete that user. WTF.');
        //                  return Redirect::route('/');
                       
        // }
        if(User::find($id)){
            $user = User::find($id);
            $user->delete();
            // Notification::container()->success('Your account has been permanently removed from the system. Sorry to see you go!');
            return redirect('/')->with ('status', __ ('Votre profil a été détruit'));
        } else {
            
            return redirect('/');
        }
    }
}
