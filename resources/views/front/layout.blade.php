<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Voces y Adioses</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css')}}"> --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,600;0,800;1,700&display=swap" rel="stylesheet">


    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    

    <style>
    /* Style The Dropdown Button */
    .dropbtn {
        background-color: #4CAF50;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #E6E3E1;
        min-width: 160px;
        max-height: 300px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        overflow: auto;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        padding: 5px 5px;
        text-decoration: none;
        display: block;
    }

    /* Change color of dropdown links on hover */
    /* .dropdown-content a:hover {background-color: #f1f1f1} */

    /* Show the dropdown menu on hover */
    /* .dropdown:hover .dropdown-content {
    display: block;
    } */

    /* Change the background color of the dropdown button when the dropdown content is shown */
    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
    }

    .menu{
        font-size: 1.5em;
    }

    .menu > a{
        color: black
    }
    </style>

    @yield('css')
</head>
<body>

<div class="container mx-auto flex flex-col">

    <nav class="flex justify-between items-start mt-2 w-full">
        
        <div id="title" class="py-5  text-4xl font-semibold">
            <a href="{{ url("/") }}" class="uppercase"> Voces y adioses 
                <small class="text-lg font-semibold mt-2 block lowercase">Ensayando despedidas en tiempos de <span class="uppercase">COVID</span></small>
            </a>
        </div>

        <div class="flex flex-no-shrink items-stretch h-12 ">
          <button id="boton" class="block lg:hidden cursor-pointer ml-auto relative w-12 h-12 p-2">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
          </button>
        </div>

        <div id="menu" class="lg:flex lg:items-stretch lg:flex-no-shrink lg:flex-grow hidden">
          <div class="lg:flex lg:items-stretch lg:justify-end ml-auto">
            <a href="{{ url('info') }}" class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal  flex items-center hover:bg-grey-dark {{ (request()->is('info')) ? 'underline' : '' }}">¿qué es?</a>
            <a href="{{ url('mapa') }}" class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal  flex items-center hover:bg-grey-dark {{ (request()->is('mapa')) ? 'underline' : '' }}">mapa</a>
            <a href="{{ route('register') }}" class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal  flex items-center hover:bg-grey-dark {{ (request()->is('register')) ? 'underline' : '' }}">participar</a>
            <a href="{{ route('login') }}" class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal  flex items-center hover:bg-grey-dark {{ (request()->is('login')) ? 'underline' : '' }}">ingresar</a>
            @if(isset($user))
                @if(isset(Auth::user()->admin ))
                    @if(Auth::user()->admin == 1)
                    <a href="{{ route('delete', [$user->id]) }}" class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal  flex items-center hover:bg-grey-dark bg-red-300 text-red-800">ELIMINAR</a>
                    @endif
                @endif
            @endif

          </div>
        </div>
    </nav>

    @php
        $menu = new App\Helper\IndiceHelper;
        $items = $menu->build();
    @endphp

    {{-- <ul class="flex w-full mt-5 mb-5 uppercase"> --}}
    <div class="my-2">
        {!! $items !!}
    </div>
    {{-- </ul> --}}

    @yield('content')
    

    

</div>





    

<script src="{{ asset('js/app.js') }}"></script>

<script>
    const boton = document.querySelector('#boton');
    const menu = document.querySelector('#menu');

    boton.addEventListener('click', () => {
        
        menu.classList.toggle('hidden')

    });

</script>


<script>
    $( document ).ready(function() {
        
        $(".menu-item").click(function(event){
            $(".dropdown-content").hide();
            $(this).children(".dropdown-content").toggle()
        });

        $(document).mouseup(function(e) 
        {
            var container = $('.menu-item');

            // Si el elemento cliqueado no pertenece al contenedor padre
            if (!container.is(e.target) && container.has(e.target).length === 0) 
            {
                $(".dropdown-content").hide();
            }
        });


    });
</script>

@yield('js')

</body>
</html>