@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="max-w-3xl mx-auto bg-gray-800 text-white rounded-lg shadow-lg p-6 border border-gray-700">
        <h1 class="text-3xl font-bold text-yellow-400 mb-4">{{ $publicacion->titulo }}</h1>

        <div class="mb-2 text-sm text-gray-400">
            Publicado por <span class="font-semibold text-white">{{ $publicacion->user->name }}</span>
            🕒 {{ $publicacion->created_at->format('d M Y - H:i') }}
        </div>

        <p class="text-gray-300 leading-relaxed mt-4">
            {{ $publicacion->contenido }}
        </p>

        <div class="mt-6">
            <a href="{{ route('publicaciones.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-4 py-2 rounded-md shadow transition duration-200">
                ⬅️ Volver
            </a>
        </div>
    </div>
</div>
@endsection
