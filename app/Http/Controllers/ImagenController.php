<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\Request;

class ImagenController extends Controller
{
    public function store(Request $request)
    {

        //obtenemos el archivo temporal
        $imagen = $request->file('file');

        //le cambiamos el nombre con Str::uuid()  y le agregamos la extension que trae $imagen->extension()
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //Comenzamos a realizar ajustes a la imagen
        $manager = new ImageManager(new Driver());

        $imagenServidor = $manager::imagick()->read($imagen);
        $imagenServidor->cover(1000, 1000);

        // Ruta donde se guardará la imagen
        $directorio = public_path('uploads');

        // Crear la carpeta si no existe
        if (!file_exists($directorio)) {
            mkdir($directorio, 0755, true);
        }

        //movemos la imagen a public_path: Get the path to the public folder
        $imagenesPath = $directorio . '/' . $nombreImagen;

        //imagenServidor tiene la imagen ya ajustada, imagenesPath tiene el nombre y la extension, y con save le dice esta imagen, guarda aqui con este nombre, como un mv en linux
        $imagenServidor->save($imagenesPath);

        return response()->json([
            'imagen' => $nombreImagen,
        ]);
    }
}
