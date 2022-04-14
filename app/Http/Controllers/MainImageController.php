<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\PlaceGallery;
use App\Models\TourismPlace;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class MainImageController extends Controller
{

    public function update($id ,FileRequest $request)
    {
        $this->destroy($id);

        $path = $request->file('file')->store('public/images');

        $url = URL::to('/').Storage::url($path);

        TourismPlace::find($id)->update([
            'mainImage' => $url,
        ]);


        return response()->json([
            'status' => 'success',
        ]);
    }

    
    public function destroy($id)
    {
        $tourismPlace = TourismPlace::find($id);

        $path = Str::remove(URL::to('/').'/storage', $tourismPlace->mainImage);
        $path = 'public'.$path;

        Storage::delete($path);
        $tourismPlace->update(['mainImage' => '']);

        return response()->json([
            'status' => 'success',
            'message' => 'main image place '.$id.' deleted',
        ]);
    }
}
