@extends('layouts.app')

@section('titulo')
    Cambiar Contraseña
@endsection

@section('contenido')
<div class="md:flex md:justify-center">
    <div class="md:w-1/2 bg-white p-6 rounded-lg shadow-xl">
        <form method="POST" action="{{ route('password.change') }}" class="mt-10 md:mt-0">
            @csrf
            <div class="mb-5">
                <label for="password_actual" class="mb-2 block uppercase text-gray-500 font-bold">
                    Contraseña Actual
                </label>
                <input 
                type="password" 
                class="border p-3 w-full rounded-lg
                @error('password_actual') border-red-500 @enderror" 
                id="password_actual" 
                name="password_actual">
                @error('password_actual')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="new_password" class="mb-2 block uppercase text-gray-500 font-bold">
                    Nueva Contraseña
                </label>
                <input 
                type="password" 
                class="border p-3 w-full rounded-lg
                @error('new_password') border-red-500 @enderror" 
                id="new_password" 
                name="new_password">
                @error('new_password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="new_password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                    Confirmar Nueva Contraseña
                </label>
                <input 
                type="password" 
                class="border p-3 w-full rounded-lg
                @error('new_password_confirmation') border-red-500 @enderror" 
                id="new_password_confirmation" 
                name="new_password_confirmation">
                @error('new_password_confirmation')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>
            <input 
            type="submit"
            value="Cambiar Contraseña"
            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </input>
        </form>
    </div>
</div>
@endsection

