<h1>Editar o post <strong> {{ $post->title}} </strong></h1>


<form action="{{ route('posts.update', $post->id) }}" method="POST">

    @method('put')
    @include('admin/posts/_partials/form')    
    
</form>