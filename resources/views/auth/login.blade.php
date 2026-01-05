@extends('layouts.app')

@section('titulo')
    Inicia Sesion en RADAR IPN
@endsection

@section('contenido')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <div id="register">

        <div>
            <img src="{{ asset('img/ipn.jpg') }}" alt="Imagen registro de usuarios" >
        </div>

        <div>
            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf
                
                            @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ session('mensaje') }} 
                    </p>
                @endif
                
                <div>
                    <label for="email">
                        Email
                    </label>
                    <input 
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Tu Email de Registro"
                        value="{{ old('email') }}"
                    />
                    @error('email')
                        <p class="form-error" role="alert">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password">
                        Password
                    </label>
                    <input 
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Password de Registro"
                    />
                    @error('password')
                        <p class="form-error" role="alert">{{ $message }} </p>
                    @enderror
                </div>

     <div class="mb-5">
                    <input type="checkbox" name="remember"> <label class="text-gray-500 text-sm">Mantener mi sesión abierta</label>
                </div>


                <input
                    type="submit"
                    value="Incio de Sesion"
                />

            </form>
        </div>
    </div>

@endsection