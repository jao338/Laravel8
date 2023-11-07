<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller{
    
    public function index(){

        $posts = Post::orderBy('id', 'ASC')->paginate();  //  Exibe a paginação de 15 registros ordenado pelo id, do menor para o maior

        $posts = Post::latest()->paginate(1);    //  Exibe a paginação de 15 registros ordenado pelo mais recente

        return view('admin/posts/index', compact('posts')); // É passado como parametro para a view um objeto 'Post' convertido em array
    }

    public function create(){
        return view('admin/posts/create');  // Retorna a view create
    }

    public function store(StoreUpdatePost $request){

        // Post::create([
        //     'title' => $request->title,
        //     'content' => $request->content
        // ]);

        Post::create($request->all());  // É passado um array contendo os valores do formulário. A função 'all()' retorna todos os valores dos inputs de um request

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post criado com sucesso');    // Redireciona para a index e exibe uma mensagem com uma session flash
    }

    public function show($id){

        // $post = Post::where('id', $id)->first(); Retorna o primeiro registro de um array
        if(!$post = Post::find($id)){
            return redirect()->route('posts.index');
        }
        
        return view('admin/posts/show', compact('post'));
    }

    public function destroy($id){
        if(!$post = Post::find($id)){
            return redirect()->route('posts.index');
        }

        $post->delete();
        
        // 'with' cria uma session flash
        return redirect()->route('posts.index')->with('message', 'Post deletado com sucesso');
    }

    public function edit($id){

        if(!$post = Post::find($id)){
            return redirect()->back();
        }
        
        return view('admin/posts/edit', compact('post'));
    }

    public function update(StoreUpdatePost $request, $id){

        if(!$post = Post::find($id)){
            return redirect()->back();
        }
        
        $post->update($request->all());

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post atualizado com sucesso');

    }

    public function search(Request $request){

        $filters = $request->except('_token');
        
        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
                            ->orWhere('content', 'LIKE', "%{$request->search}%")
                            ->paginate(1);

        return view('admin/posts/index', compact('posts', 'filters'));

    }

}
