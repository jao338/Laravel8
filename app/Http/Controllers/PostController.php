<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller{
    
    public function index(){

        $posts = Post::get();

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

        return redirect()->route('posts.index');    // Redireciona para a index
    }

    public function show($id){

        // $post = Post::where('id', $id)->first(); Retorna o primeiro registro de um array
        if(!$post = Post::find($id)){
            return redirect()->route('posts.indeex');
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

}
