@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="max-w-2xl mx-auto bg-gray-800 text-white rounded-lg shadow-lg p-6 border border-gray-700">
        <div class="mb-4 border-b border-gray-600 pb-2">
            <h2 class="text-2xl font-bold text-yellow-400">📝 Crear Nueva Publicación</h2>
            <p class="text-sm text-gray-400">Comparte algo con la comunidad</p>
        </div>

        <form action="{{ route('publicaciones.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="titulo" class="block text-sm font-medium text-gray-300">Título</label>
                <input type="text" id="titulo" name="titulo" class="mt-1 block w-full px-4 py-2 bg-gray-900 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="Escribe el título de la publicación" required>
            </div>

            <div class="mb-4">
                <label for="contenido" class="block text-sm font-medium text-gray-300">Contenido</label>
                <textarea id="contenido" name="contenido" rows="6" class="mt-1 block w-full px-4 py-2 bg-gray-900 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="Escribe el contenido de la publicación" required></textarea>
            </div>

            <div class="mt-6 flex justify-between">
                <a href="{{ route('publicaciones.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-4 py-2 rounded-md shadow transition duration-200">
                    ⬅️ Volver
                </a>

                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-5 py-2 rounded-md transition duration-200 shadow">
                    Crear Publicación
                </button>
            </div>

            
        </form>
    </div>
</div>
@endsection