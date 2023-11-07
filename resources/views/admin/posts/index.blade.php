<a href="{{ route('posts.create') }}">Novo post</a> 
{{-- <a href="/routes/create">Novo post</a> --}}

<h1>Posts</h1>

@if (session('message'))
    {{-- Caso exista alguma coisa na session 'message', o seu conteúdo é exibido --}}
    <div>
        {{ session('message') }}
    </div>
@endif

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