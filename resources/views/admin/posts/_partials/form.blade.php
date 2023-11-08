@if ($errors->any())
    
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

@endif

{{-- <input type="text" name="_token" value="{{ csrf_token() }}"> --}}
    {{-- O helper 'old()' cria uma session temporária flash quando o formulário é submetido. Com ele podemos resgatar os valores enviados pelo formulário. --}}

@csrf
<input type="file" name="image" id="image">
<input type="text" name="title" id="title" placeholder="Título" value="{{ $post->title ?? old('title')}}"> 
<textarea name="content" id="content" cols="30" rows="4" placeholder="Conteúdo">{{ $post->content ?? old('content') }}</textarea>
<button type="submit">Enviar</button>