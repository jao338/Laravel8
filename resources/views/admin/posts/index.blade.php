<a href="{{ route('posts.create') }}">Novo post</a> 
{{-- <a href="/routes/create">Novo post</a> --}}

<h1>Posts</h1>

@foreach ($posts as $post)
    <p>{{ $post->title }}</p>    
@endforeach