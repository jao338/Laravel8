{{-- Extende um modelo blade --}}
@extends('admin/layouts/app')

{{-- Define o titulo com a section 'title' --}}
@section('title','Criar novo post')

{{-- Define o conteudo da section 'content' --}}
@section('content')
    <h1>Cadastrar novo post</h1>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">

        @include('admin/posts/_partials/form')  {{-- Inclui um formulário padrão --}}
        
    </form>
@endsection