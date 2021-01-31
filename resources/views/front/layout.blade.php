<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Voces y Adioses</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
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

<div class="container">

    <div class="row d-flex mt-3">

      

        <div class="col-lg-5 align-top">
            <h1 class="font-weight-bold m-0 ">voces-y-adioses <br> <small class="subtitle">Aprendiendo a despedirnos, cuidamos la vida</small></h1>
        </div>
        
        <div class="col-lg-5 align-top">
            <ul class="text-uppercase indice d-flex p-0 dropdown">

                <li class="dropdown menu-item">
                    <span>a</span>
                    <div class="dropdown-content">
                        <a href="{{ url('/')}}">Alberto Quispe</a>
                        <a href="{{ url('/')}}">Ampar Jimenez</a>
                        <a href="{{ url('/')}}">Ana Carrillo</a>
                    </div>

                </li>
                <li class="dropdown menu-item">
                    <span>b</span>
                    <div class="dropdown-content">
                        <a href="{{ url('/')}}">Beatriz Quispe</a>
                        <a href="{{ url('/')}}">Berta Jimenez</a>
                        <a href="{{ url('/')}}">Barbara Carrillo</a>
                    </div>

                </li>
                <li class="dropdown menu-item">
                    <span>c</span>
                    <div class="dropdown-content">
                        <a href="{{ url('/')}}">Carlos Quispe</a>
                        <a href="{{ url('/')}}">Cinthia Jimenez</a>
                        <a href="{{ url('/')}}">Camila Carrillo</a>
                    </div>

                </li>
                <li>d</li>
                <li>e</li>
                <li>f</li>
                <li>g</li>
                <li>h</li>
                <li>i</li>
                <li>j</li>
                <li>k</li>
                <li>m</li>
                <li>n</li>
                <li>l</li>
                <li>o</li>
                <li>p</li>
                <li>q</li>
                <li>r</li>
                <li>s</li>
                <li>t</li>
                <li>u</li>
                <li>v</li>
                <li>w</li>
                <li>x</li>
                <li>y</li>
                <li>z</li>
            </ul>
        </div>

        <div class="col-lg-2">
            <div class="text-right menu">
                <a href="{{ url('info') }}"> ¿que es? </a><br>
                <a href="{{ url('mapa') }}"> mapa </a> <br>
                <a href="{{ url('info') }}"> registrar </a>
            </div>
            
        </div>
    </div>

    @yield('content')

</div>
    

<script src="{{ asset('js/app.js') }}"></script>


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