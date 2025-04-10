<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request){
        
        //aqui con validate solo valida que email es requerido y es de tipo email y que password es requerido
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //aqui validamos las credenciales que sean correctas, laravel se encarga con Auth::attempt, nosotros sole le pasamos los campos necesarios
        //el [Auth::user()->username] que se le pasa en el redirect, es por que la url ahora se creo con el nombre de usuario,
        //en base a la url mostrara los datos
        /**
         * Nota: la primera vez que te logueas el nombre se le pasa como parametro al router [Auth::user()] ya que es la url del usuario y el usuario logueado
         */
        if (Auth::attempt($credentials, $request->remember)) {
            
            return redirect()->route('index_muro',[Auth::user()]);
        }

        return back()->withErrors('Las crendenciales no son validas');
        
    }

}
