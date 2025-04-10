@extends('layouts.app')

@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{$user->imagen ? asset('perfiles/' . $user->imagen) : asset('img/usuario.svg')}}" alt="usuario">
            </div>
            <div
                class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">

                <div class=" flex justify-between items-center gap-2">
                    <p>{{$user->username}}</p>

                    @auth
                        @if ($user->id === Auth::user()->id)
                            <a href="{{route('perfil_index', $user)}}" class=" text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    {{$user->followers->count()}} <span class="font-normal"> @choice('Sguidor|Seguidores',$user->followers->count())</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$user->followings->count()}} <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$user->posts->count()}} <span class="font-normal"> Post</span>
                </p>
                @auth
                    @if($user->id !== Auth::user()->id)
                        @if(!$user->siguiendo(Auth::user()))
                            <form action="{{route('follow_store', $user)}}" method="POST">
                                @csrf
                                <input type="submit"
                                    class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                    value="Seguir">
                            </form>
                        @else
                            <form action="{{route('unfollow_destroy', $user)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit"
                                    class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                    value="Dejar de Seguir">
                            </form>
                        @endif
                    @endif



                @endauth
            </div>
        </div>
    </div>

    <section class="container mx-auto my-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        @if ($posts->count())
            <div class=" grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div class="">
                        <a href="{{route('show_post', [$post->user->username, $post])}}">
                            <img src="{{asset('uploads/' . $post->imagen)}}" alt="{{'Imagen del post' . $post->titulo}}">
                        </a>
                    </div>
                @endforeach
            </div>

            <div class=" my-10 ">
                {{$posts->links('pagination::tailwind')}}
            </div>

        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">
                No hay post
            </p>
        @endif


    </section>
@endsection