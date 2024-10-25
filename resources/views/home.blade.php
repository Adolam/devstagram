@extends('layouts.app')

@section('titulo')
Portada
@endsection

@section('contenido')
    <x-listar-post :posts="$posts"/>
@endsection
