@extends('layouts.app')

@section('titulo')
    Editar perfil: {{Auth::user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 md:mt-0">
            <form action="{{route('perfil_store',auth()->user())}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input type="text" id="username" name="username" placeholder="Tu username" 
                        value="{{auth()->user()->username}}"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500  @enderror">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">imagen perfil</label>
                    <input type="file" id="imagen" name="imagen"
                        value=""
                        class="border p-3 w-full rounded-lg"
                        accept=".jpg, .jpeg, .png"/>
                </div>
                <input type="submit" value="Actualizar"
                    class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection()