@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection


@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads/' . $post->imagen)}}" alt="Imagen del post {{ $post->titulo}}">
            
            <div class="p-3">
                @auth
                    @if ($post->checkLike(auth()->user()))
                    <form method="POST" action="{{ route('posts.likes.destroy', ['post' => $post]) }}">
                        @method('DELETE')
                        @csrf
                    <div class="my-4">
                        <button type="submit" class="items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="red" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                              </svg>
                        </button>     
                    </div>
                    </form>
                    @else
                    <form method="POST" action="{{ route('posts.likes.store', ['post' => $post]) }}">
                        @csrf
                    <div class="my-4">
                        <button type="submit" class="items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                              </svg>
                        </button>     
                    </div>
                    </form>
                @endif
                @endauth
                <p class="text-sm text-gray-500"> {{ $post->likes->count() }} Me gusta</p>
            </div>

            <div class="font-bold">
                <p>{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">
                    {{$post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                   {{$post->descripcion}} 
                </p>
            </div>

            @auth
                @if ($post->user_id === auth()->user()->id)
                <form action="{{ route('post.destroy', ['post'=> $post]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input 
                        type="submit"
                        value="Eliminar Publicación"
                        class="bg-red-500 hover:bg-red-600 rounded cursor-pointer 
                        font-bold p-2 text-white mt-4">
                    </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>

                    @if(session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bolt">
                            {{session('mensaje')}}
                        </div>
                    @endif

                    <form action="{{ route('comentario.store', ['user'=> $user, 'post'=> $post]) }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                            Añade un comentario
                        </label>
                        <textarea
                            id="comentario"
                            name="comentario"
                            placeholder="Agrega un comentario"
                            class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"></textarea>
                        @error('comentario')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <input 
                    type="submit"
                    value="Comentar"
                    class="bg-sky-600 hover:bg-sky-500 transition-colors cursor-pointer 
                    uppercase font-bold w-full p-3 text-white rounded-lg">
                    </form>
                @endauth

                <div class="bg-white mb-5 shadow max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->isNotEmpty())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('post.index', $comentario->user) }}" class="font-bold">
                                    {{ $comentario->user->username }}
                                </a>
                                <p>{{ $comentario->comentario }}</p>
                                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios aún.</p>
                    @endif
                </div>
            </div>
        </div>

    </div>

@endsection