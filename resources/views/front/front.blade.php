@extends('front.layout')


@section('content')

<div>
    <div class="text-4xl">{{ $user->name }}</div>

    <div id="containment-wrapper">
        
        @if($user->files)

            @foreach($user->files as $file)

                @if($file->mimetype == "image/png" || $file->mimetype == "image/jpg" || $file->mimetype == "image/jpeg")
                    <img src="{{asset($file->url)}}" class="draggable">
                @endif

                @if($file->mimetype == 'audio/mpeg')
                    <div>
                        <audio controls>
                            <source src="{{$file->url}}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                @endif

                @if($file->mimetype == 'video/mp4')

                    <figure class="figure">
                        <video controls>
                            <source src="{{$file->url}}" type="video/mp4">
                            
                            Your browser does not support the video tag.
                        </video>
                    </figure>
 
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


            width = Math.floor((Math.random() * 50) + 25).toString();
            $(element).width(width + '%');

            var docHeight = $("#containment-wrapper").height(),
                docWidth = $("#containment-wrapper").width(),
                $div = $(element),
                divWidth = $div.width(),
                divHeight = $div.height(),
                heightMax = docHeight - divHeight,
                    widthMax = docWidth - divWidth;

          

                console.log(heightMax);
            
                $div.css({
                    left: Math.floor( Math.random() * widthMax ),
                    top: Math.floor( Math.random() * heightMax )
                });


        })



    });



    // window.onLoad = Prep();
            
    // function Prep(){
    //     window_Height = $("#containment-wrapper").height();
    //     window_Width = $("#containment-wrapper").width();
        
    //     image_Element = document.getElementById("image");
    //     image_Height = image_Element.clientHeight;
    //     image_Width = image_Element.clientWidth;
        
    //     availSpace_V = window_Height - image_Height;
    //     availSpace_H = window_Width - image_Width;
        
    //     var randNum_V = Math.round(Math.random() * availSpace_V);
    //     var randNum_H = Math.round(Math.random() * availSpace_H);
        
    //     image_Element.style.top = randNum_V + "px";
    //     image_Element.style.left = randNum_H + "px";
    // }
    
    // function moveImage(){
    //     var randNum_V = Math.round(Math.random() * availSpace_V);
    //     var randNum_H = Math.round(Math.random() * availSpace_H);
        
    //     image_Element.style.top = randNum_V + "px";
    //     image_Element.style.left = randNum_H + "px";
    // }

</script>
@endsection