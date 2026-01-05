@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container">
        <div class="left-panel">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">

            <div class="likes-section">
                @auth
                    <livewire:like-post :post="$post"  />
                @endauth
                <div class="like-count" style="display:flex;align-items:center;gap:6px;margin-left:8px;">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="var(--ipn-guinda)" style="vertical-align:middle;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.318 6.318a4.5 4.5 0 016.364 0l.318.318.318-.318a4.5 4.5 0 116.364 6.364L12 20.364l-6.682-7.682a4.5 4.5 0 010-6.364z"/>
                    </svg>
                    <span style="font-weight:600;color:var(--ipn-guinda);font-size:1.08rem;">
                        {{ $post->likes->count() ?? 0 }}
                    </span>
                </div>
            </div>

            <div class="user-info">
                <a href="{{ route('posts.index', $post->user) }}" class="font-bold">
                    {{ $post->user->username }}
                </a>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
            </div>

            <p class="mt-5">
                {{ $post->descripcion }}
            </p>

            @auth
                @if($post->user_id === auth()->user()->id )
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @method('DELETE')
                        @csrf
                        <input 
                            type="submit"
                            value="Eliminar Publicación"
                            class="bg-red-500 hover:bg-red-600"
                        />
                    </form>
                @endif
            @endauth
        </div>

        <div class="right-panel">
            <div class="shadow bg-white mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>

                    @if(session('mensaje'))
                        <div class="bg-green-500 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{session('mensaje')}}
                        </div>
                    @endif

                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user ] ) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                                Añade un Comentario
                            </label>
                            <textarea 
                                id="comentario"
                                name="comentario"
                                placeholder="Agrega un Comentario"
                                class="@error('name') border-red-500 @enderror"
                            ></textarea>
        
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm text-center">{{ $message }} </p>
                            @enderror
                        </div>

                        <input
                            type="submit"
                            value="Comentar"
                            class="bg-sky-600 hover:bg-sky-700 w-full"
                        />
                    </form>
                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->count())
                        @foreach ( $post->comentarios as $comentario )
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index', $comentario->user ) }} " class="font-bold">
                                    {{$comentario->user->username}}
                                </a>
                                <p>{{ $comentario->comentario }}
                                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No Hay Comentarios Aún</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection