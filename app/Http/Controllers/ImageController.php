<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Image;
use App\Repositories\ImageRepository;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $repository;

    public function __construct(ImageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $images = Image::inRandomOrder()->paginate(6);
        return View('/', compact('images'));
    }


    /**
     * Display current user uploaded images
     *
     * @return \Illuminate\Http\Response
     */
    public function user_images($id){ 
        $images = Image::where('user_id', $id)->orderBy('created_at', 'DESC')->get();
        return View('profiles.image', compact('images'));
    }

    
    public function searchResult(Request $request)
    {
        if ($request->post('location') == ""){
            return redirect('/')->with('status', __("Aucune valeur n'a été entrée dans le champs de recherche"));
        }

        $location = Location::where('name', $request->location)->first();

        if (!isset($location)){
            return redirect('/')->with('status', __("Aucun résultat n'a été trouvé lors de votre recherche."));
            }
          
          else{
                $images = Image::where('location_id', $location->id)->orderBy('created_at', 'DESC')->get();
                $images = $this->getReportedImage($images)->where('approved', 1);

                $pageStart = request()->get('page', 1); // récupère le numéro de page dans l'url
                $perPage = 6; // Défini le nombre d'image par page
                
                // Défini le décalage, si on est sur la 1ere page, $offset = 0
                //si on est sur la 2eme page, $offset = 6
                $offset = ($pageStart * $perPage) - $perPage; 
                
                // Instancie la class Paginator
                $images = new Paginator(
                    array_slice($images->all(), $offset,  $perPage, true),
                    $images->count(),
                    $perPage,
                    null, 
                    [
                        'path'  => $request->url(),
                        'query' => $request->query(),
        ]
    );
     
    // Ajoute à l'objet $images le contenu de la recherche 
    // si on est sur une page de résultats de recherche
    $images->appends(['search' => $request->post('search')]);
            }

        return View('searchResult', compact('images'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::pluck('name', 'id');
        return view('images.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'image' => 'required|image|max:2000',
            'location_id' => 'required|exists:locations,id',
        ]);

        $this->repository->store($request);
        
        return back()->with('ok', __("L'image a bien été enregistrée"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return View('images.show', compact('images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return View('images.edit', compact('images'));
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
        $images->update(request()->all());

        return redirect ('/images');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $image = Image::destroy($id);
        return redirect('/');
    }

    public function flag(Image $image, Request $request, $id)
    {
       
        $images = Image::find($id);

        $user = $request->user()->id;

        $images->users()->syncWithoutDetaching([$user => ['alert' =>1]]);
        return response()->json(['id' => $image->id, 'message' => 'L\'image a bien ete reportée'], 200);
        
      
    }

    public function getReportedImage($images)
    {
        $images->transform(function($image) {
            $number = $image->users->where('pivot.alert', 1)->count();
            $image->approved = ($number >= 2) ? 0 : 1;
            return $image;
        });
        return $images;
    }
}
