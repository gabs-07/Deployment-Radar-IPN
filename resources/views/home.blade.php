@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush


@section('contenido')
    Poli Publicaciones

    @if($posts->count())

        <div class="posts-grid">
            @foreach ($posts as $post)
                <div class="post-item">
                    <a href="{{ route('posts.index', $post->user) }}" class="username-link user-profile-link">
                        {{-- <img 
                            src="{{ $post->user->imagen ? asset('perfiles/' . $post->user->imagen) : asset('img/usuario.svg') }}" 
                            alt="Foto de perfil de {{ $post->user->username }}"
                            class="mini-profile-img"
                        > --}}
                        <span>{{ $post->user->username }}</span>
                    </a>
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{$post->titulo}}">
                    </a>
                </div>
            @endforeach
        </div>
        @else
        <p>No hay Poli Post aun</p>
        @endif

    
@endsection