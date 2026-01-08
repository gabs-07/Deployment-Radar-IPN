@extends('layouts.app')

@section('titulo')
Perfil {{ $user->username }}
@endsection

@section('contenido')

<h1 style="display:none;">Perfil de: {{ $user->username }}</h1>


    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/publicaciones.css') }}">

    <div class="dashboard-container">
        <div class="dashboard-card">
            <div>
                <img class="dashboard-avatar"
                    src="{{ $user->imagen ? asset('perfiles/' . $user->imagen) : asset('img/usuario.svg') }}" 
                    alt="imagen usuario" 
                />
            </div>

            <div class="dashboard-info">
               
                <div>

                     <p class="dashboard-username">{{ $user->username }}</p>


                 @auth
                    @if($user->id === auth()->user()->id)
                    <a class="dashboard-editar" href="{{route('perfil.index')}}" 
                        style="display: inline-flex; align-items: center; gap: 6px; background: #f5f5f5; border-radius: 6px; padding: 6px 12px; color: #333; font-weight: 500; text-decoration: none; border: 1px solid #ddd; transition: background 0.2s, box-shadow 0.2s;"
                        onmouseover="this.style.background='#e0e7ff'; this.style.boxShadow='0 2px 8px #c7d2fe';"
                        onmouseout="this.style.background='#f5f5f5'; this.style.boxShadow='none';"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" style="width: 20px; height: 20px;">
  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
</svg>
                        <span>Editar perfil</span>
                    </a>

                    <p><strong> {{ $user->escuela }}</strong></p>

                    <p><strong>Correo de contacto {{ $user->email }}</strong></p>

                    @endif
                @endauth
                </div>

                {{-- <div class="dashboard-stats">
                    <div class="dashboard-stat">
                        <div class="dashboard-stat-number">0</div>
                        <div class="dashboard-stat-label">Seguidores</div>
                    </div>
                    <div class="dashboard-stat">
                        <div class="dashboard-stat-number">0</div>
                        <div class="dashboard-stat-label">Siguiendo</div>
                    </div>  --}}
                    <div class="dashboard-stat">
                        <div class="dashboard-stat-number">{{$user->posts->count()}}</div>
                        
                        <div class="dashboard-stat-label">Posts</div>
                    </div>


                    {{-- @auth

                    @if($user->id !==auth()->user()->id)
                        <form action="{{route('users.follow', $user)}}" method="POST">

                        @csrf
                            <input type="sumit" value="Seguir" name="" id="">
                    </form>

                    <form action="" method="POST">

                        @csrf
                            <input type="sumit" value="Dejar de sequir" name="" id="">
                    </form>

                    @endif
                    @endauth
                     --}}
                </div>
            </div>
        </div>
    </div>



    <section>
        <h2>Publicaciones</h2>

        @if($posts->count())
            <div class="publicaciones-grid">
                @foreach ($posts as $post)
                <div class="publicacion-item">
                    <a href="{{ route('posts.show', ['user' => $user, 'post' => $post]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{$post->titulo}}">
                    </a>
                </div>
                @endforeach
            </div>
            

        @else
            
            <h1>No hay Poli publicaciones</h1>
            
        @endif
        
    </section>
@endsection