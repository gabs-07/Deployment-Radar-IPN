<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,gif|max:4096'
        ]);

        $imagen = $request->file('file');
        $nombreImagen = Str::uuid() . '.' . $imagen->extension();

        $manager = new ImageManager(new Driver());
        $imagenServidor = $manager->read($imagen->getPathname());
        $imagenServidor->cover(1000, 1000);

        // Asegura que la carpeta exista
        $uploadsPath = public_path('uploads');
        if (!file_exists($uploadsPath)) {
            mkdir($uploadsPath, 0777, true);
        }

        $imagenPath = $uploadsPath . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json([
            'imagen' => $nombreImagen
        ]);
    }
}
