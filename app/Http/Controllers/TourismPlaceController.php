<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourismPlaceRequest;
use App\Models\TourismPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class TourismPlaceController extends Controller
{

    public function index()
    {
        $tourismPlaces = TourismPlace::with('placeGalleries')->get();

        return response()->json([
            'data' => $tourismPlaces,
            'totalResult' => count($tourismPlaces),
        ]);
    }


    public function store(TourismPlaceRequest $request)
    {
        $tourismPlace = TourismPlace::create($request->validated());

        return $tourismPlace;
    }

    
    public function show(TourismPlace $tourismPlace)
    {
        $tourismPlace->load('placeGalleries');
        return $tourismPlace;
    }

   
    public function update(TourismPlaceRequest $request, TourismPlace $tourismPlace)
    {
        $tourismPlace->update($request->validated());

        return $tourismPlace;
    }


    public function destroy(TourismPlace $tourismPlace)
    {
        
        $path = Str::remove(URL::to('/').'/storage', $tourismPlace->mainImage);
        $path = 'public'.$path;

        Storage::delete($path);

        foreach ($tourismPlace-> placeGalleries as $placeGallery) {
            $path = Str::remove(URL::to('/').'/storage', $placeGallery->url);
            $path = 'public'.$path;

            Storage::delete($path);
        }

        $tourismPlace->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'place '.$tourismPlace->id.' deleted',
        ]);
    }
}
