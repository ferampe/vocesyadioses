@extends('front.layout')


@section('content')

<div>
    <div class="text-4xl">{{ $user->name }}</div>

    <div id="containment-wrapper">
        
        @if($user->files)

            @foreach($user->files as $file)

                @if($file->mimetype == "image/png" || $file->mimetype == "image/jpg" || $file->mimetype == "image/jpeg")
                    <div style="position:relative;" class="draggable" data-type="imagen">
                        <img src="{{asset($file->url)}}" style="position: relative;" class="border-2 border-black">
                    </div>
                @endif

                @if($file->mimetype == 'audio/mpeg')
                    <div style="position:relative; padding:5px; background-color: black; width: 400px" class="draggable" data-type="audio" >
                        <audio controls style="position: relative;" class="text-center">
                            <source src="{{$file->url}}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                @endif

                @if($file->mimetype == 'video/mp4')

                    <div style="padding:5px; background-color: black" class="draggable border-3 border-black" data-type="video" >
                        <video controls style="position: relative;" >
                            <source src="{{$file->url}}" type="video/mp4">
                            
                            Your browser does not support the video tag.
                        </video>
                    </div>
 
                @endif

            @endforeach
        @endif
    </div>
</div>


@endsection

@section('js')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $( function() {
        $( ".draggable" ).draggable({ containment: "#containment-wrapper", scroll: true });
    } );
</script>

<script>

    $(document).ready(function(){
        
        $("#containment-wrapper > div").mousedown(function() {
            $("#containment-wrapper > div").not(this).css("z-index", 0);
            $(this).css("z-index", 100);
        });

  
        $('#containment-wrapper > div').each(function() {

            // console.log($(this).data('type'));
            if($(this).data('type') == 'imagen' || $(this).data('type') == 'video')
            {
                width = Math.floor((Math.random() * 20) + 25).toString();
                $(this).width(width + '%');

                $holder    = $(this).parent();
                $divWidth  = $holder.width();
                $divHeight = $holder.height();

                $(this).css({
                    'left': Math.floor( Math.random() * Number( $divWidth ) ),
                    'top' : Math.floor( Math.random() * 10 ) + 25
                });       
            }
             

        })




        // $("#containment-wrapper > img").each((index, element) => {
        //     console.log(element);


        //     width = Math.floor((Math.random() * 50) + 25).toString();
        //     $(element).width(width + '%');

        //     var docHeight = $("#containment-wrapper").height(),
        //         docWidth = $("#containment-wrapper").width(),
        //         $div = $(element),
        //         divWidth = $div.width(),
        //         divHeight = $div.height(),
        //         heightMax = docHeight - divHeight,
        //             widthMax = docWidth - divWidth;

        //         console.log(heightMax);
            
        //         $div.css({
        //             left: Math.floor( Math.random() * widthMax ),
        //             top: Math.floor( Math.random() * heightMax )
        //         });
        // })
    });


</script>
@endsection