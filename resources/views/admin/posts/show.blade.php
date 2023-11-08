@extends('admin/layouts/app')

@section('title', 'Detalhes do Post')

@section('content')
    <h1>Detalhes do post {{ $post->title }}</h1>

    <ul>
        <li><img src="{{ url("storage/{$post->image}") }}" style="max-width:100px;" alt="Not found"></li>
        <li>{{ $post->title }}</li>
        <li>{{ $post->content }}</li>
    </ul>

    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit">Deletar o post {{ $post->title }}</button>
    </form>
@endsection