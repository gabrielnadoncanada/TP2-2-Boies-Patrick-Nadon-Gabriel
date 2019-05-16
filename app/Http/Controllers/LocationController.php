<?php


namespace App\Http\Controllers;

use App\Models\Location;
use App\Http\Requests\LocationRequest;
use App\Repositories\LocationRepository;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $locations = Location::orderBy('id')->paginate();
        // return View('images.create', compact('location'));
        return view('images.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::pluck('name', 'id');
        return view('location.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request, LocationRepository $repository)
    {
        $repository->store($request->all());
        return back()->with('ok', __("Le lieu a bien été enregistrée"));
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->name) {
            $location = Location::find($id);
            $location->update([
                'name' => $request->name,
            ]);
            return back()->with('status', __('Le lieux a bien été mis à jour'));
        }
        return back()->with('status', __('Veuillez inscrire un lieux'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::withCount('images')->where('id', $id)->get();
        if ($location[0]->images_count > 0) {
            return back()->with('status', __("Vous ne pouvez pas supprimer un lieux qui est présentement en cours d'utilisation"));
        } else {
            $location[0]->delete();
            return back()->with('status', __('Le lieux a été détruit'));
        }
    }
}
