@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
@endpush



@section('contenido')
    <div class="perfil-container">
        <div class="perfil-form-wrapper">
            <form class="perfil-form" method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data" >
                @csrf
                <div class="perfil-field mb-5">
                    <label class="perfil-label" for="username">
                           Username
                    </label>
                    <input 
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Tu Nombre de Usuario"
                        class="perfil-input @error('username') error-input @enderror"
                        value="{{ auth()->user()->username }}"
                    />

                    @error('username')
                        <p class="error-message">{{ $message }} </p>
                    @enderror
                </div>

                <div class="perfil-field mb-5">
                    <label class="perfil-label" for="imagen" >
                           Imagen Perfil
                    </label>
                    <input 
                        id="imagen"
                        name="imagen"
                        type="file"
                        class="perfil-input"
                        value=""
                        accept=".jpg, .jpeg, .png"
                    />
                </div>

                <input
                    type="submit"
                    class="perfil-submit"
                    value="Guardar Cambios"
                />
            </form>
        </div>
    </div>
@endsection