<?php

namespace App\Http\Controllers;

use App\Repositories\ImageRepository;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ImageRepository $repository, Request $request)
    {
        $images = $repository->getAllImages();
        $images = $this->getReportedImage($images)->where('approved', 1);

        // récupère le numéro de page dans l'url
        $pageStart = request()->get('page', 1);

        // Défini le nombre d'image par page
        $perPage = 6;

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
        return view('home', compact('images'));
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
}
