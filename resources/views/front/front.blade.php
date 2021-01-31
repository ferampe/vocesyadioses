@extends('front.layout')


@section('content')
<div class="row mt-3">
    <div class="col">
        <h2>Nombre de la victima</h2>
    </div>
</div>

<div class="row">
    <div class="col" id="containment-wrapper" style="max-height: 100vh, position: absolute">

        {{-- <div class="item"> --}}
            <img src="{{asset('imagenes/men-2425121_1280.jpg')}}" class="draggable" width="500" alt="">
        {{-- </div> --}}

        {{-- <div class="item"> --}}
            <img src="{{asset('imagenes/model-2303361_640.jpg')}}" class="draggable" alt="">
        {{-- </div> --}}

        {{-- <div class="item"> --}}
            <img src="{{asset('imagenes/texto.png')}}" class="draggable" width="200px">
        {{-- </div> --}}
        

    </div>
</div>
@endsection

@section('js')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $( function() {
        $( ".draggable" ).draggable({ containment: "#containment-wrapper", scroll: false });

    } );
</script>

<script>

    $(document).ready(function(){
        
        $("#containment-wrapper > img").mousedown(function() {
            $("#containment-wrapper img").not(this).css("z-index", 0);
            $(this).css("z-index", 100);
        });


        $("#containment-wrapper > img").each((index, element) => {
            console.log(element);
            var docHeight = $("#containment-wrapper").height(),
                docWidth = $("#containment-wrapper").width(),
                $div = $(element),
                divWidth = $div.width(),
                divHeight = $div.height(),
                heightMax = docHeight - divHeight,
                widthMax = docWidth - divWidth;
            
            console.log(docHeight);    
            
            $div.css({
                left: Math.floor( Math.random() * widthMax ),
                top: Math.floor( Math.random() * heightMax )
            });


        })
        // $('#test').click(function() {
        //     var docHeight = $(document).height(),
        //         docWidth = $(document).width(),
        //         $div = $('#test'),
        //         divWidth = $div.width(),
        //         divHeight = $div.height(),
        //         heightMax = docHeight - divHeight,
        //         widthMax = docWidth - divWidth;
            
        //     $div.css({
        //         left: Math.floor( Math.random() * widthMax ),
        //         top: Math.floor( Math.random() * heightMax )
        //     });
        // });


    });

</script>
@endsection