@extends('layouts.app')

@section('titulo')
    Crea una nueva Publicación
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endpush

@section('contenido')
<div class="create-container">
    <div>
        <!-- Dropzone -->
        <form action="{{ route('imagenes.store') }}" id="dropzone" class="dropzone" enctype="multipart/form-data">
            @csrf
        </form>

        <!-- Preview (opcional) -->
        <div id="preview-image" style="margin-top:1rem;"></div>
    </div>

    <div class="create-form-section">
        <form action="{{ route('posts.store') }}" method="POST" novalidate class="create-form">
            @csrf

            <label for="titulo">Titulo</label>
            <input
                id="titulo"
                name="titulo"
                type="text"
                placeholder="Tu titulo"
                value="{{ old('titulo') }}"
            />
            @error('titulo')
                <p class="form-error" role="alert">{{ $message }}</p>
            @enderror

            <label for="descripcion">Descripción</label>
            <textarea
                id="descripcion"
                name="descripcion"
                placeholder="Descripción de la publicación"
            >{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <p class="form-error" role="alert">{{ $message }}</p>
            @enderror

            <!-- Input oculto -->
            <input
                type="hidden"
                name="imagen"
                id="imagen"
                value="{{ old('imagen') }}"
            />
            @error('imagen')
                <p class="form-error" role="alert">{{ $message }}</p>
            @enderror

            <input type="submit" value="Publicar Post" />
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
Dropzone.autoDiscover = false;

document.addEventListener('DOMContentLoaded', function () {
    const dropzoneElement = document.querySelector('#dropzone');
    if (!dropzoneElement) return;

    const imagenInput = document.querySelector('[name="imagen"]');

    const dropzone = new Dropzone(dropzoneElement, {
        url: "/imagenes",
        dictDefaultMessage: "Sube aquí tu imagen",
        acceptedFiles: ".png,.jpg,.jpeg,.gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar Archivo",
        maxFiles: 1,
        uploadMultiple: false,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        paramName: 'file', // Importante para que el backend lo reciba como 'file'
        init: function () {
            // Si ya hay una imagen (por ejemplo, al editar)
            if (imagenInput.value) {
                const mockFile = { name: imagenInput.value, size: 123456 };
                this.emit("addedfile", mockFile);
                this.emit("thumbnail", mockFile, `/uploads/${imagenInput.value}`);
                this.emit("complete", mockFile);
                this.files.push(mockFile);
            }
        }
    });

    dropzone.on("success", function (file, response) {
        // Si response.imagen es una ruta, extrae solo el nombre
        let filename = response.imagen;
        if (filename && filename.includes('/')) {
            filename = filename.split('/').pop();
        }
        imagenInput.value = filename;
    });

    dropzone.on("removedfile", function () {
        imagenInput.value = "";
    });

    // Validación extra frontend
    document.querySelector('.create-form').addEventListener('submit', function(e) {
        if(!imagenInput.value) {
            e.preventDefault();
            alert('Debes subir una imagen antes de publicar el post.');
        }
    });
});
</script>
@endpush
