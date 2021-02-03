<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Voces y Adioses</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css')}}"> --}}
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
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
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

<div class="container mx-auto">

    <nav class="flex justify-between items-start mt-2 w-full">
        
        <div id="title" class="py-2 text-4xl"> <a href="{{ url("/") }}"> Voces y Adioses <small class="text-lg font-light block">Ensayando despedidas en tiempos de COVID</small></a></div>

        <div class="flex flex-no-shrink items-stretch h-12 ">
          <button id="boton" class="block lg:hidden cursor-pointer ml-auto relative w-12 h-12 p-2">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
          </button>
        </div>

        <div id="menu" class="lg:flex lg:items-stretch lg:flex-no-shrink lg:flex-grow hidden">
          <div class="lg:flex lg:items-stretch lg:justify-end ml-auto">
            <a href="{{ url('info') }}" class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal no-underline flex items-center hover:bg-grey-dark"> ¿qué es?</a>
            <a href="{{ url('mapa') }}" class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal no-underline flex items-center hover:bg-grey-dark">mapa</a>
            <a href="{{ route('register') }}" class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal no-underline flex items-center hover:bg-grey-dark">participar</a>
            

            

          </div>
        </div>
    </nav>

    @php
        $menu = new App\Helper\IndiceHelper;
        $items = $menu->build();
    @endphp
    <ul class="flex justify-start w-full mt-5 mb-5 indice uppercase">
        {!! $items !!}
    </ul>


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