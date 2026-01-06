@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection



@push('styles')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endpush

@section('contenido')
    <div class="show-post-container">
        <div class="post-panel">
            <div class="post-card">
                <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}" class="post-image">

                {{-- <div class="likes-section">
                    @auth
                        <livewire:like-post :post="$post"  />
                    @endauth
                    <div class="like-count">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="var(--ipn-guinda)">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.318 6.318a4.5 4.5 0 016.364 0l.318.318.318-.318a4.5 4.5 0 116.364 6.364L12 20.364l-6.682-7.682a4.5 4.5 0 010-6.364z"/>
                        </svg>
                        <span>
                            {{ $post->likes->count() ?? 0 }}
                        </span>
                    </div>
                </div> --}}

                <div class="user-info">
                    <a href="{{ route('posts.index', $post->user) }}" class="post-username">
                        {{ $post->user->username }}
                    </a>
                    <p class="post-date">
                        {{ $post->created_at->diffForHumans() }}
                    </p>
                </div>

                <div class="post-description">
                    {{ $post->descripcion }}
                </div>
                
                @auth
                    @if($post->user_id === auth()->user()->id )
                        <form method="POST" action="{{ route('posts.destroy', $post) }}">
                            @method('DELETE')
                            @csrf
                            <input 
                                type="submit"
                                value="Eliminar Publicación"
                                class="post-delete-btn"
                            />
                        </form>
                    @endif
                @endauth
            </div>
        </div>

        <div class="comments-panel">
            <div class="comments-card">
                @auth
                    <p class="comments-title">Agrega un Nuevo Comentario</p>
                    @if(session('mensaje'))
                        <div class="comments-success">
                            {{session('mensaje')}}
                        </div>
                    @endif
                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user ] ) }}" method="POST">
                        @csrf
                        <div class="comments-form-group">
                            <label for="comentario" class="comments-label">
                                Añade un Comentario
                            </label>
                            <textarea 
                                id="comentario"
                                name="comentario"
                                placeholder="Agrega un Comentario"
                                class="comments-textarea"
                                maxlength="255"
                                rows="5"
                                style="resize: none;"
                            ></textarea>
                            @error('comentario')
                                <p class="comments-error">{{ $message }} </p>
                            @enderror
                        </div>
                        <input
                            type="submit"
                            value="Comentar"
                            class="comments-btn"
                        />
                    </form>
                @endauth

                <div class="comments-list">
                    @if ($post->comentarios->count())
                        @foreach ( $post->comentarios as $comentario )
                            <div class="comment-item">
                                <a href="{{ route('posts.index', $comentario->user ) }}" class="comment-username">
                                    {{$comentario->user->username}}
                                </a>
                                <p class="comment-text">{{ $comentario->comentario }}</p>
                                <p class="comment-date">{{ $comentario->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="no-comments">No Hay Comentarios Aún</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection