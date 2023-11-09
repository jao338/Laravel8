<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller{
    
    public function index(){

        $posts = Post::orderBy('id', 'ASC')->paginate();  //  Exibe a paginação de 15 registros ordenado pelo id, do menor para o maior

        $posts = Post::latest()->paginate();    //  Exibe a paginação de 15 registros ordenado pelo mais recente

        return view('admin/posts/index', compact('posts')); // É passado como parametro para a view um objeto 'Post' convertido em array
    }

    public function create(){
        return view('admin/posts/create');  // Retorna a view create
    }

    public function store(StoreUpdatePost $request){

        $data = $request->all();    //  A função 'all()' retorna todos os valores dos inputs de um request

        if($request->image->isValid()){

            $nameFile = Str::of($request->title)->slug('-').'.'.$request->image->getClientOriginalExtension();    //  Define um novo nome para a imagem com base no título, excluindo caracteres especias, removendo espaços e deixando em minúsculo. Bem como adiciona a extensão original do arquivo

            $image = $request->image->storeAs('posts', $nameFile);   //  É feito o upload da imagem para o storage, que possui um link simbólico que aponta a para pasta 'public'
            $data['image'] = $image;    //  É passado a imagem para o array a imagem

        }

        Post::create($data);  // É passado um array contendo os valores do formulário.

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post criado com sucesso');    // Redireciona para a index e exibe uma mensagem com uma session flash
    }

    public function show($id){

        // $post = Post::where('id', $id)->first(); Retorna o primeiro registro de um array
        if(!$post = Post::find($id)){
            return redirect()->route('posts.index');    //  Caso não encontre nenhum registro, redireciona para a index
        }
        
        return view('admin/posts/show', compact('post'));   //  Retorna a view 'show.blade.php' e passa o array 'post'
    }

    public function destroy($id){
        if(!$post = Post::find($id)){
            return redirect()->route('posts.index');    //  Caso não encontre nenhum registro, redireciona para a index
        }

        //  Ao apagar um registro, verifica se existe uma imagem salva no storage, caso ela exista ela também é apagada
        if (Storage::exists($post->image)) {
            Storage::delete($post->image);
        }

        $post->delete();    //  Caso encontre o registro, apaga o resgistro
        
        // 'with' cria uma session flash
        return redirect()->route('posts.index')->with('message', 'Post deletado com sucesso');  //  Redireciona para a index e exibe uma mensagem com uma session flash
    }

    public function edit($id){

        if(!$post = Post::find($id)){
            return redirect()->back();  //  Caso não encontre o registro, redireciona de volta para a página anterior
        }
        
        return view('admin/posts/edit', compact('post'));   //  Caso contrário, redireciona para a view 'edit.blade.php' passando o array 'post'
    }

    public function update(StoreUpdatePost $request, $id){

        if(!$post = Post::find($id)){
            return redirect()->back();  //  Caso não encontre nenhum registro, redireciona de volta para a página anterior
        }

        $data = $request->all();    //  A função 'all()' retorna todos os valores dos inputs de um request

        if($request->image && $request->image->isValid()){

            //  Ao atualizar um registro, verifica se existe já existe uma imagem salva no storage, caso ela exista ela é apagada
            if (Storage::exists($post->image)) {
                Storage::delete($post->image);
            }

            $nameFile = Str::of($request->title)->slug('-').'.'.$request->image->getClientOriginalExtension();    //  Define um novo nome para a imagem com base no título, excluindo caracteres especias, removendo espaços e deixando em minúsculo. Bem como adiciona a extensão original do arquivo

            $image = $request->image->storeAs('posts', $nameFile);   //  É feito o upload da imagem para o storage, que possui um link simbólico que aponta a para pasta 'public'
            $data['image'] = $image;    //  É passado a imagem para o array a imagem

        }
        
        $post->update($data); //  Atualiza o registo no bando de dados. 

        return redirect()   //  Redireciona para a index e exibe uma mensagem com uma session flash
            ->route('posts.index')
            ->with('message', 'Post atualizado com sucesso');

    }

    public function search(Request $request){

        $filters = $request->except('_token');  //  Define um array com todos os valore dos campos, exceto o token. Não fazer isso, gera uma exception
        
        $posts = Post::where('title', 'LIKE', "%{$request->search}%")   //  Realiza um SELECT pelo título e outro pelo conteúdo
                            ->orWhere('content', 'LIKE', "%{$request->search}%")
                            ->paginate();

        return view('admin/posts/index', compact('posts', 'filters'));  //  Retorna a view index, passando 'posts' e 'filters'

    }

}
