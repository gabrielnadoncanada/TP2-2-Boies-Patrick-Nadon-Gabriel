<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display current user profil
     *
     * @return \Illuminate\Http\Response
     */
    public function profil(){
        return View('user.profil');
    }
}
