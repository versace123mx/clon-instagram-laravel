@extends('layouts.app')

@section('titulo')
    Inicia Session en Devstagram
@endsection

@section('contenido')

    <div class=" md:flex md:justify-center rounded-lg shadow-xl md:gap-10 md:items-center p-5">
        <div class=" md:w-6/12">
            <img src="{{asset('img/login.jpg')}}" alt="Imagen Login de usuarios">
        </div>
        <div class=" md:w-4/12 bg-white p-6 rounded-lg shadow-xl">

            @include('../components.messages')

            <form action="{{route('store_login')}}" method="POST">
                @csrf


                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" id="email" name="email" placeholder="Ingresa tu email"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500  @enderror"
                        value="{{old('email')}}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu password"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500  @enderror">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember"> 
                    <label class=" text-sm text-gray-500">
                        Mantener session abierta
                    </label>
                </div>

                <input type="submit" value="Iniciar Session"
                    class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

            </form>
        </div>
    </div>
@endsection