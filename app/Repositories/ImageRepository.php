<?php
namespace App\Repositories;

use App\Models\Image;
use App\Models\Location;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;

class ImageRepository
{

        public function store($request)
    {

        if ($request->image){
            $path = basename ($request->image->store('images'));

            // Save thumb
            $image = InterventionImage::make ($request->image)->widen (500)->encode ();
            Storage::put ('thumbs/' . $path, $image);
        }
        
        Image::create([
            'location_id' => request('location_id'),
            'user_id' => auth()->id(),
            'name' => $path    
        ]);
    
    }

        public function getAllImages()
    {
        return Image::inRandomOrder()->paginate (3);
    }
}
