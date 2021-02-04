@extends('front.layout')


@section('content')

@if($user)
<div>
    <div class="text-4xl">{{ $user->name_victim }} {{ $user->last_name_victim}}</div>


    @if($user->messages)
            @foreach($user->messages as $message)
                @if($message->content != "")
                    

                    <div id="message-{{$message->id}}" class="modal">
                        <div class="mb-10">
                            @php
                            $lines = explode("\n", $message->content); // or use PHP PHP_EOL constant
                            if ( !empty($lines) ) {
                                
                                foreach ( $lines as $line ) {
                                    echo trim( $line ) .'<br>';
                                }
                            }
                            @endphp
                        </div>
                        <a href="#" rel="modal:close" class="mt-10 border p-2 bg-black text-white">Cerrar</a>
                    </div>
                @endif
            @endforeach
        @endif

    <div id="containment-wrapper">

        @if($user->messages)
            @foreach($user->messages as $message)
                @if($message->content != "")
                    <div style="position:absolute; width: 100px" class="draggable">
                        <a href="#message-{{$message->id}}" rel="modal:open"><img src="{{asset('imagenes/texto2.png')}}" style="position: relative;" ></a>
                    </div>

                    
                @endif
            @endforeach
        @endif
        
        @if($user->files)

            @foreach($user->files as $file)

            @if($file->mimetype == 'video/mp4')

                    <div style="position:absolute; padding:5px; background-color: black" class="draggable border-3 border-black" data-type="video" >
                        <video controls >
                            <source src="{{$file->url}}" type="video/mp4">
                            
                            Your browser does not support the video tag.
                        </video>
                    </div>
 
                @endif

                @if($file->mimetype == "image/png" || $file->mimetype == "image/jpg" || $file->mimetype == "image/jpeg")
                    <div style="position:absolute;" class="draggable" data-type="imagen">
                        <img src="{{asset($file->url)}}" style="position: relative;" class="border-2 border-black">
                    </div>
                @endif

                @if($file->mimetype == 'audio/mpeg')
                    <div style="position:absolute; padding:5px; background-color: black; width: 400px" class="draggable" data-type="audio" >
                        <audio controls style="position: relative;" class="text-center">
                            <source src="{{$file->url}}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                @endif

                

            @endforeach
        @endif

        {{-- <div class="draggable">hola</div> --}}
    </div>
</div>
@endif

@endsection

@section('css')

<style>
    .blocker{
        z-index: 100 !important;
    }
</style>
@endsection



@section('js')

{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}



    {{-- // $( function() {
    //     // $( ".draggable" ).draggable({ containment: "#containment-wrapper"});
    // } ); --}}

    <script src="https://unpkg.com/interactjs/dist/interact.min.js"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />


    <script>
        $( document ).ready(function() {

            interact('.draggable').draggable({
                // enable inertial throwing
                inertia: true,
                // keep the element within the area of it's parent
                restrict: {
                restriction: "parent",
                endOnly: true,
                elementRect: { top: 0, left: 0, bottom: 1, right: 1 }
                },
                // enable autoScroll
                autoScroll: true,

                // call this function on every dragmove event
                onmove: dragMoveListener,
                // call this function on every dragend event
                onend: function (event) {
                var textEl = event.target.querySelector('p');

                textEl && (textEl.textContent =
                    'moved a distance of '
                    + (Math.sqrt(event.dx * event.dx +
                                event.dy * event.dy)|0) + 'px');
                }
            });

            function dragMoveListener (event) {
                var target = event.target,
                    // keep the dragged position in the data-x/data-y attributes
                    x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx,
                    y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                // translate the element
                target.style.webkitTransform =
                target.style.transform =
                'translate(' + x + 'px, ' + y + 'px)';

                // update the posiion attributes
                target.setAttribute('data-x', x);
                target.setAttribute('data-y', y);
            }
  });




        $(document).ready(function(){

            
            $("#containment-wrapper > div").mousedown(function() {
                $("#containment-wrapper > div").not(this).css("z-index", 0);
                $(this).css("z-index", 4);
            });

    
            $('#containment-wrapper > div').each(function() {

                if($(this).data('type') == 'imagen' || $(this).data('type') == 'video')
                {
                    width = Math.floor((Math.random() * 40) + 40).toString();
                    $(this).width(width + '%');
                }

                $holder    = $(this).parent();
                $divWidth  = $holder.width();
                $divHeight = $holder.height();

                $(this).css({
                    'left' : Math.floor(Math.random()*(500-10) + 10),
                    'top' : Math.floor( Math.random()*(20-10) + 10)
                });    
                

            })
        });


    </script>
@endsection