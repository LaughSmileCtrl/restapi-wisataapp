<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\PlaceGallery;
use App\Models\TourismPlace;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PlaceGalleryController extends Controller
{

    public function store($id ,FileRequest $request)
    {
        $path = $request->file('file')->store('public/images');

        $url = URL::to('/').Storage::url($path);

        $placeGallery = new PlaceGallery([
                'url' => $url,
            ]);

        TourismPlace::find($id)
            ->placeGalleries()
            ->save($placeGallery);

        return response()->json([
            'status' => 'success',
        ]);
    }

    
    public function destroy($id, PlaceGallery $placeGallery)
    {
    
        if ($placeGallery->tourism_place_id == $id) {
            $path = Str::remove(URL::to('/').'/storage', $placeGallery->url);
            $path = 'public'.$path;

            Storage::delete($path);
            $placeGallery->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'gallery '.$path.' on place '.$id.' deleted',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'place '.$id.' not found!!',
        ]);
    }
}
