{{-- Extende um modelo blade --}}
@extends('admin/layouts/app')

{{-- Define o titulo com a section 'title' --}}
@section('title', 'Listagem dos posts')

{{-- Define o conteudo da section 'content' --}}
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
        @csrf   {{-- Diretiva do token --}}
        <input type="text" name="search" id="" placeholder="Filtrar">
        <button type="submit">Filtrar</button>
    </form>

    {{-- Loop nos $posts --}}
    @foreach ($posts as $post)
        <p>
            <img src="{{ url("storage/{$post->image}") }}" alt="{{ $post->title }}" style="max-width: 100px;">

            {{-- Exibe o título e dois links, um para ver mais detalhes e outro para editar o registro --}}
            {{ $post->title }} 
            
                [ 
                    <a href="{{ route('posts.show', $post->id) }}">Ver</a>
                    <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                ]
        </p>
        {{-- Caso seja necessário passar mais de um parametro para a rota, use um array da seguinte forma: {{ route('posts.show', ['id' => $post->id, 'title' -> $post->title]) }} --}}
    @endforeach

    <hr>

    {{-- Caso exista $filters --}}
    @if (isset($filters))

        {{-- 'links()' renderiza um link adequado para cada consulta --}}
        {{ $posts->appends($filters)->links() }}

    @else

        {{-- 'links()' renderiza um link adequado para cada consulta --}}
        {{ $posts->links() }}

    @endif

@endsection
