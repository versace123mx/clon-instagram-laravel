<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index(User $user)
    {

        $posts = Post::whereUserId($user->id)->latest()->paginate(5);

        //User $user estamos traiendo los datos del user que se le esta pasando por la url, para construir la ruta nombrada
        return view('layouts.dashboard', compact('user', 'posts'));
    }

    public function create()
    {

        return view('post.create');
    }

    public function store(Request $request)
    {

        $validate = $request->validate([
            'titulo' => 'required|min:1|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);


        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('index_muro', Auth::user());
    }

    public function show(User $user, Post $post)
    {

        return view('post.show', compact('post', 'user'));
    }

    public function destroy(Post $post)
    {

        Gate::allows('delete', $post);
        $post->delete();

        //Eliminar imagen
        $imagenPath = public_path('uploads/'.$post->imagen);
        if(File::exists($imagenPath)){
            unlink($imagenPath);
        }
        return redirect()->route('index_muro', Auth::user());

    }
}
