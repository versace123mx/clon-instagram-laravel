<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PerfilController extends Controller
{
    public function index()
    {

        return view('perfil.index');
    }

    public function store(Request $request)
    {

        //validacion de los campos que el usuario envia desde el formulario
        $validate = $request->validate([
            'username' => 'required|' . Rule::unique('users', 'username')->ignore(auth()->user()) . '|min:3|max:30|alpha_dash|not_in:twitter,editar-perfil,puto,puta,pene,chiche,culo,ass,fuck,fucker,mother,mother-fuck,fuck-mother,pendejo,pendeja,sirviente,sirvienta,escalvo,esclava,sexo',
        ]);

        if ($request->imagen) {

            //obtenemos el archivo temporal
            $imagen = $request->file('imagen');

            //le cambiamos el nombre con Str::uuid()  y le agregamos la extension que trae $imagen->extension()
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            //Comenzamos a realizar ajustes a la imagen
            $manager = new ImageManager(new Driver());

            $imagenServidor = $manager::imagick()->read($imagen);
            $imagenServidor->cover(1000, 1000);

            // Ruta donde se guardará la imagen
            $directorio = public_path('perfiles');

            // Crear la carpeta si no existe
            if (!file_exists($directorio)) {
                mkdir($directorio, 0755, true);
            }

            //movemos la imagen a public_path: Get the path to the public folder
            $imagenesPath = $directorio . '/' . $nombreImagen;

            //imagenServidor tiene la imagen ya ajustada, imagenesPath tiene el nombre y la extension, y con save le dice esta imagen, guarda aqui con este nombre, como un mv en linux
            $imagenServidor->save($imagenesPath);
        }

        $usuario = User::find(Auth::user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? Auth::user()->image ?? null;
        $usuario->save();

        return redirect()->route('index_muro', $usuario->username);
    }
}
