@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-yellow-400 text-center mb-6">📢 Publicaciones de los Usuarios</h1>

        <div class="text-center mb-6">
            <a href="{{ route('publicaciones.create') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-5 py-2 rounded-md shadow transition duration-200">
                ➕ Crear una Publicación
            </a>

            @if (session('success'))
            <div id="success-message" class="bg-green-500 text-white font-semibold px-4 py-2 rounded-md shadow mt-4">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div id="error-message" class="bg-red-500 text-white font-semibold px-4 py-2 rounded-md shadow mt-4">
                {{ session('error') }}
            </div>
            @endif
        </div>

        @if ($publicaciones && $publicaciones->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($publicaciones as $publicacion)
            <div class="bg-gray-800 text-white rounded-lg shadow-lg p-5 border border-gray-700 flex flex-col justify-between">
                <div>
                    <div class="mb-2 text-sm text-gray-400">
                        <span class="font-semibold text-white">{{ $publicacion->user->name }}</span> publicó:
                    </div>

                    <h5 class="text-xl font-semibold text-yellow-400 mb-2">
                        {{ $publicacion->titulo }}
                    </h5>

                    <p class="text-gray-300 mb-4">{{ $publicacion->contenido }}</p>

                    <div class="text-sm text-gray-500 mb-4">
                        🕒 {{ $publicacion->created_at->format('d M Y - H:i') }}
                    </div>
                </div>

                <!-- Botones al fondo -->
                <div class="flex justify-center gap-4 mt-4">
                    <a href="{{ route('publicaciones.show', $publicacion->id_publicacion) }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-4 py-2 rounded-md shadow transition duration-200">
                        📄 Detalles
                    </a>
                    @if ($publicacion->id_usuario == Auth::id())


                    <a href="{{ route('publicaciones.edit', $publicacion->id_publicacion) }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-4 py-2 rounded-md shadow transition duration-200">
                        🖋️ Editar
                    </a>
                    <form action="{{ route('publicaciones.destroy', $publicacion->id_publicacion) }}" method="POST" onsubmit="return confirm('¿Estas Seguro?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-4 py-2 rounded-md shadow transition duration-200">
                            🗑️ Borrar
                        </button>
                    </form>
                    @endif

                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center mt-10">
            <div class="bg-gray-700 text-white px-6 py-4 rounded-lg shadow inline-block">
                <p class="mb-0">😕 No hay publicaciones disponibles</p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/Duracion_mensaje.js')
@endpush
