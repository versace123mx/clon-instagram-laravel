<!DOCTYPE html>
<html lang="{{str_replace('-', '-', app()->getLocale())}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{asset('js/app.js')}}" defer></script>
    <title>DevStagram - @yield('titulo')</title>
    @stack('styles')
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-gray-100">

    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center ">
            <h1 class="text-3xl font-black">
                <a href="{{route('home')}}">DevStagram</a>
            </h1>
            <nav class="flex gap-2 items-center">
                @if (!Auth::user())
                    <a class="font-bold uppercase text-gray-600 text-sm " href="{{route('index_login')}}">Login</a>                          
                    <a class="font-bold uppercase text-gray-600 text-sm " href="{{route('crearcuenta_index')}}">
                        Crear Cuenta
                    </a>
                    @else
                        <a class=" flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer" href="{{route('create_post_muro')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            Crear
                        </a>
                        <a href="{{route('index_muro',Auth::user()->username)}}" class="font-bold text-gray-600 text-sm">
                            Hola: <span class="font-normal"> {{Auth::user()->username}} </span> 
                        </a>
                        <form action="{{route('store_logout')}}" method="POST">
                            @csrf
                            <button 
                                type="submit"
                                class="font-bold uppercase text-gray-600 text-sm "
                                >
                                Cerrar Sesion
                            </button>
                        </form>
                    @endif
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('titulo')
        </h2>
        @yield('contenido')
    </main>

    <footer class=" mt-10 text-center p-5 text-gray-500 font-bold uppercase">
        Devstagram - Todos los derechos Reservados {{date('Y')}}
    </footer>
</body>

</html>