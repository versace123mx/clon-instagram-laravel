@extends('layouts.app')

@section('titulo')
    Pagina Principal
@endsection

@section('contenido')
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
        <p class="text-center">No hay Posts</p>

    @endif
@endsection()