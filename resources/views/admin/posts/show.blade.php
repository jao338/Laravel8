{{-- Extende um modelo blade --}}
@extends('admin/layouts/app')

{{-- Define o titulo com a section 'title' --}}
@section('title', 'Detalhes do Post')

{{-- Define o conteudo da section 'content' --}}
@section('content')
    <h1>Detalhes do post {{ $post->title }}</h1>

    <ul>
        <li><img src="{{ url("storage/{$post->image}") }}" style="max-width:100px;" alt="Not found"></li>
        <li>{{ $post->title }}</li>
        <li>{{ $post->content }}</li>
    </ul>

    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
        @csrf   {{-- Diretiva do token --}}
        <input type="hidden" name="_method" value="DELETE"> {{-- Campo oculto que define o metodo de envio --}}
        <button type="submit">Deletar o post {{ $post->title }}</button>
    </form>
@endsection