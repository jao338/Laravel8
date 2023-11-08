@extends('admin/layouts/app')   {{-- Define qual template será utilizado --}}

@section('title', 'Listagem dos posts')

{{-- Atribui esse conteúdo onde houver 'content' --}}
@section('content')
    <a href="{{ route('posts.create') }}">Novo post</a> 
    {{-- <a href="/routes/create">Novo post</a> --}}

    <h1>Posts</h1>

    @if (session('message'))
        {{-- Caso exista alguma coisa na session 'message', o seu conteúdo é exibido --}}
        <div>
            {{ session('message') }}
        </div>
    @endif

    <form action="{{ route('posts.search') }}" method="post">
        @csrf
        <input type="text" name="search" id="" placeholder="Filtrar">
        <button type="submit">Filtrar</button>
    </form>

    @foreach ($posts as $post)
        <p>
            {{ $post->title }} 
            
                [ 
                    <a href="{{ route('posts.show', $post->id) }}">Ver</a>
                    <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                ]
        </p>
        {{-- Caso seja necessário passar mais de um parametro para a rota, use um array da seguinte forma: {{ route('posts.show', ['id' => $post->id, 'title' -> $post->title]) }} --}}
    @endforeach

    <hr>

    @if (isset($filters))

        {{ $posts->appends($filters)->links() }}

    @else
        
        {{ $posts->links() }}

    @endif

@endsection
