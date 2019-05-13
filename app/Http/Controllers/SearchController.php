<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LocationRepository;
use App\Models\Location;


class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('searchResult');
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        $search = $request->get('term');
      
          $result = Location::where('name', 'LIKE', '%'. $search. '%')->get();
 
          return response()->json($result);

        //   else
        // return view ( 'home' )->withMessage ( 'No Details found. Try to search again !' );
            
    } 
}

