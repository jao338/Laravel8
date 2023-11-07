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

}
