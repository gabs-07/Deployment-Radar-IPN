<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() 
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    if (!str_ends_with($value, '@alumno.ipn.mx')) {
                        $fail('El correo debe ser del dominio @alumno.ipn.mx');
                    }
                }
            ],
            'password' => 'required'
        ]);

        if(!auth()->attempt($request->only('email', 'password'), $request->remember ) ) {
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        return redirect()->route('posts.index', auth()->user()->username );
    }
}
