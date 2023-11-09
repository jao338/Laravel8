{{-- Extende um modelo blade --}}
@extends('admin/layouts/app')

{{-- Define o titulo com a section 'title' --}}
@section('title', "Editar o Post {$post->title}")

{{-- Define o conteudo da section 'content' --}}
@section('content')
    <h1>Editar o post <strong> {{ $post->title}} </strong></h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">

        @method('put')  {{-- Campo oculto que define o metodo de envio --}}
        @include('admin/posts/_partials/form')  {{-- Inclui um formulario padrão --}}
        
    </form>
@endsection