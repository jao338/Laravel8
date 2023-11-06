<h1>Novo post</h1>

<form action="{{ route('posts.store') }}" method="POST">

    {{-- <input type="text" name="_token" value="{{ csrf_token() }}"> --}}
    @csrf
    <input type="text" name="title" id="title" placeholder="Título">
    <textarea name="content" id="content" cols="30" rows="4" placeholder="Conteúdo"></textarea>
    <button type="submit">Enviar</button>

</form>