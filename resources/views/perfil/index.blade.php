@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{auth()->user()->username}}
@endsection


@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white p-6 rounded-lg shadow-xl">
            <form method="POST" action="{{ route('perfil.store') }}"  class="mt-10 md:mt-0" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    placeholder="Tu nombre de usuario" 
                    class="border p-3 w-full rounded-lg 
                    @error('username') border-red-500 @enderror" 
                    value="{{ auth()->user()->username }}">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen Perfil
                    </label>
                    <input 
                    type="file" 
                    id="imagen" 
                    name="imagen" 
                    class="border p-3 w-full rounded-lg"
                    value=""
                    accept=".jpg, .jpeg, .png">   
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input 
                    type="text" 
                    id="username" 
                    name="email" 
                    placeholder="Tu email" 
                    class="border p-3 w-full rounded-lg 
                    @error('email') border-red-500 @enderror" 
                    value="{{ auth()->user()->email }}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <input 
                type="submit"
                value="Guardar cambios"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                >
            </form>
            <!-- Enlace para cambiar la contraseña -->
            <div class="mt-5">
                <a href="{{ route('password.change.form') }}" class="text-sky-600 hover:text-sky-800 transition-colors font-bold">
                    Cambiar Contraseña
                </a>
            </div>
        </div>
    </div>
@endsection
