<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Exception;
use Log;

class ImageController extends Controller
{
    public function actionUpload(Request $request)
    {
        $year = year();
        $month = month();
        $day = day();

        $paths = [];
        $ids = [];
        foreach ($request->pictures as $file) {
            try {
                $path = "images/$year/$month/$day";
                $name = $file->getClientOriginalName();

                $file->move(public_path($path), $name);

                $id = Image::create([
                    'path'          => $this->filePath($path, $name),
                    'original_name' => $file->getClientOriginalName(),
                ])->id;

                $ids[] = $id;
                $paths[] = $this->filePath($path, $name);
            } catch (Exception $exception) {
                Log::error($exception->getMessage());
            }
        }

        return response()->json([
            'count'   => count($paths),
            'content' => view('tools.parts.image-list', ['images' => $paths])->render(),
            'path'    => $paths,
            'id'      => $ids
        ]);
    }

    private function filePath($path, $file)
    {
        $path = trim($path, '/');
        $file = trim($file, '/');

        return "/$path/$file";
    }

    public function actionGetGallery()
    {
        $images = Image::latest()->paginate(8);

        return view('tools.parts.image-gallery', compact('images'));
    }
}
