<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function store(Request $request,User $user, Post $post){

        /**
         * En este caso como la url tiene '/{user:username}/post/{post}' entonces con User $user podemos acceder a los objetos del usuario dueño del post
         * con Post $post podemos acceder al post al que queremos agregarle el comentario y el post trae todos los objetos del post acutal
         * con el id del post Actual sabemos a que post queremos agregarle un comentario
         * NOta: yo no sabia que se podia acceder de una forma muy facil con laravel a todos estos post
         * La verdad es que laravel es muy facil para hacer sistemas administrativos y funcionales, soloq ue siempre recarga la pagina
         * Lo que si hay que entender bien es la parte de las relaciones cuando se creen modelos, migraciones ya que ahi es donde tengo mas detalle
         * y no por que no sepa como funcionan las relaciones si no por que estoy acostumbrado hacerlo a manita que con codigo
         * 
         * con Auth::id() accedemos al id del usuario logueado en la session
         */
        $validate = $request->validate([
            'comentario' => 'required|min:10|max:254'
        ]);


        Comentario::create([
            'comentario'=> $request->comentario,
            'user_id' => Auth::id(),
            'post_id' => $post->id
        ]);

        return redirect()->route('show_post',compact('post','user'))->with('message','Comentario Agregado');

    }
}
