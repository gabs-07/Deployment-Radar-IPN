<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function __invoke()
    {
        // Obtener todos los posts excepto los del usuario autenticado
        $posts = Post::when(auth()->check(), function($query) {
                $query->where('user_id', '!=', auth()->id());
            })
            ->latest()
            ->paginate(20);

        return view('home', [
            'posts' => $posts
        ] );
    }
}
