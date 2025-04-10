<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index(){

        return view('auth.register');
    }

    public function store(Request $request){
        
        //validacion de los campos que el usuario envia desde el formulario
        $validate = $request->validate([
            'name' => 'required|min:3|max:80',
            'username' => 'required|unique:users|min:3|max:30|alpha_dash',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|min:8|confirmed',
        ]);

        /*
            de esta forma funciona pero hay que agregar el campo username al modelo en fillable
            por que laravel entiende que el campo username no pertenece a users y para que reconosca este
            campo entonces hayq ue colocarlo ahi, para que sepa que ahora ese campo tambien pertenece
            al modelo de User
        */
        
        User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'username' => Str::lower($request->username),
            'password' => $request->password
        ]);

        /*
        Otra forma de insertar datos sin modificar el Modelo y no colocarle el campo en $fillable
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->save();*/


        //Autenticar usuario de esta forma)
        /*
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

            y en el if(Auth::attempt($credentials)
        */
        

        //Autenticar al usuario de forma mas corta;
        //aqui se esta creando la cuenta y la autenticacion por que asi lo definio juan pablo
        //el [Auth::user()->username] que se le pasa en el redirect, es por que la url ahora se creo con el nombre de usuario,
        //en base a la url mostrara los datos
        /**
         * Nota: la primera vez que te logueas el nombre se le pasa como parametro al router [Auth::user()] ya que es la url del usuario y el usuario logueado
         */
        if(Auth::attempt($request->only('email','password'))){
            return redirect()->route('index_muro',[Auth::user()]);
        }

        return back()->withErrors([
            'email' => 'Crendenciales erroneas'
        ]);
    }
}
