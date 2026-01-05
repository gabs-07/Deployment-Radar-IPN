<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        // Normalizar username
        $request->request->add([
            'username' => Str::slug($request->username)
        ]);

        // Validación
        $request->validate([
            'username' => [
                'required',
                'unique:users,username,' . auth()->user()->id,
                'min:3',
                'max:20',
                'not_in:twitter,editar-perfil'
            ],
            'imagen' => 'nullable|image'
        ]);

        // Procesar imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();

            $manager = new ImageManager(new Driver());
            $imagenServidor = $manager->read($imagen->getPathname());

            // Recortar y redimensionar
            $imagenServidor->cover(1000, 1000);

            // Guardar imagen
            $imagenPath = public_path('perfiles/' . $nombreImagen);
            $imagenServidor->save($imagenPath);
        }

        // Guardar usuario
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? $usuario->imagen;
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}
