@extends('layouts.app')

@section('titulo')
    Regístrate en RADAR IPN
@endsection

@section('contenido')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <div id="register">

        <div>
            <img src="{{ asset('img/ipn.jpg') }}" alt="Imagen registro de usuarios" >
        </div>

        <div>
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div>
                    <label for="name">
                           Nombre
                    </label>
                    <input 
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Tu Nombre"
                        value="{{ old('name') }}"
                    />

                    @error('name')
                        <p class="form-error" role="alert">{{ $message }} </p>
                    @enderror
                </div>

                <div>
                    <label for="username">
                        Username
                    </label>
                    <input 
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Tu Nombre de Usuario"
                        value="{{ old('username') }}"
                    />

                    @error('username')
                        <p class="form-error" role="alert">{{ $message }} </p>
                    @enderror
                </div>

                <div>
                    <label for="escuela">
                        Unidades Académica
                    </label>
                    <select id="escuela" name="escuela">
                        <option value="">Selecciona tu escuela</option>
                        <option value="ESCOM" {{ old('escuela') == 'ESCOM' ? 'selected' : '' }}>ESCOM</option>
                        <option value="ESIME" {{ old('escuela') == 'ESIME' ? 'selected' : '' }}>ESIME</option>
                        <option value="ESIT" {{ old('escuela') == 'ESIT' ? 'selected' : '' }}>ESIT</option>
                        <option value="ESIQIE" {{ old('escuela') == 'ESIQIE' ? 'selected' : '' }}>ESIQIE</option>
                        <option value="UPIICSA" {{ old('escuela') == 'UPIICSA' ? 'selected' : '' }}>UPIICSA</option>
                        <option value="UPIITA" {{ old('escuela') == 'UPIITA' ? 'selected' : '' }}>UPIITA</option>
                        <option value="ESFM" {{ old('escuela') == 'ESFM' ? 'selected' : '' }}>ESFM</option>
                        <option value="ESCA" {{ old('escuela') == 'ESCA' ? 'selected' : '' }}>ESCA</option>
                        <option value="Otra" {{ old('escuela') == 'Otra' ? 'selected' : '' }}>Otra</option>
                    </select>
                    @error('escuela')
                        <p class="form-error" role="alert">{{ $message }}</p>
                    @enderror
                </div>


                
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

                <div>
                    <label for="password_confirmation">
                        Repetir Password
                    </label>
                    <input 
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        placeholder="Repite tu Password"
                    />
                </div>

                <input
                    type="submit"
                    value="Crear Cuenta"
                />

            </form>
        </div>
    </div>

@endsection