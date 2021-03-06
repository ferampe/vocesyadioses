@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header">Información de Usuario</div>

                <div class="card-body">
                    
                    
                    <h2>{{ Auth::user()->name_victim }} {{ Auth::user()->last_name_victim }} <br> <small>Departamento: {{ Auth::user()->department->name }}</small></h2>
                    Email : {{ Auth::user()->email }} <br>
                    
                </div>

                <div class="card-footer">
                    <a href="{{ url('register/edit/' . Auth::user()->id ) }}" class="btn btn-primary">Editar</a>
                </div>
            </div>

        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form action="{{ route('file_store' )}}" method="post" enctype="multipart/form-data" id="form-file">
                @csrf
            <div class="card">
                <div class="card-header">Agregar Archivos de Audio o video</div>

                <div class="card-body">

                    <div class="alert alert-info" role="alert">
                        <p>Solo agregar: </p>
                        <ul>
                            <li>3 imágenes </li>
                            <li>1 video</li>
                            <li>1 audio</li>
                        </ul>
                        




                    </div>

                    <input type="file" name="file" accept="file_extension|audio/*|video/*|image/*|media_type">
                    @error('file')
                    <small class="text-danger">{{ $message}}</small>
                    @enderror
                    <br>
                    <button class="btn btn-primary mt-2" id="button-file">
                        <span class="spinner-border spinner-border-sm" id="loading-file" role="status" aria-hidden="true"></span>
                        Subir
                    </button>
                    <hr>

                    <div class="row">
                        <div class="col">
                            @if (Session::has('has_video'))
                                <div class="alert alert-danger" role="alert">
                                    {!! Session::get('has_video') !!}
                                </div>
                            @endif

                            @if (Session::has('has_audio'))
                                <div class="alert alert-danger" role="alert">
                                    {!! Session::get('has_audio') !!}
                                </div>
                            @endif

                            @if (Session::has('has_3_images'))

                                <div class="alert alert-danger" role="alert">
                                    {!! Session::get('has_3_images') !!}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-5">
                        @foreach ($files as $file)
                            @if($file->mimetype == 'image/png' || $file->mimetype == 'image/jpg' || $file->mimetype == 'image/jpeg')
                                
                                <figure class="figure">
                                    <img src="{{$file->thumbnail}}" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                                    <figcaption class="figure-caption text-center"><a href="{{ route('file_delete', [$file->id])}}">Eliminar</a></figcaption>
                                </figure>

                            @endif

                            @if($file->mimetype == 'audio/mpeg')

                            <figure class="figure">
                                <audio controls>
                                    <source src="{{$file->url}}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                                <figcaption class="figure-caption text-center"><a href="{{ route('file_delete', [$file->id])}}">Eliminar</a></figcaption>
                            </figure>

                                
                            @endif


                            @if($file->mimetype == 'video/mp4' || $file->mimetype == 'video/quicktime')

                            <figure class="figure">
                                <video width="200" height="" controls>
                                    <source src="{{$file->url}}" type="video/mp4">
                                    
                                    Your browser does not support the video tag.
                                </video>
                                <figcaption class="figure-caption text-center"><a href="{{ route('file_delete', [$file->id])}}">Eliminar</a></figcaption>
                            </figure>

                                
                            @endif
                            
                        @endforeach
                    </div>
                </div>

                <div class="card-footer">
                    
                </div>
            
            </div>
            </form>
        </div>
    </div>


    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form action="{{ route('save_messages' )}}" method="post">
                @csrf
            <div class="card">
                <div class="card-header">Agregar mensajes</div>

                <div class="card-body">
                    
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                        {{Session::get('message')}}
                      </div>
                    @endif

                    @foreach($messages as $message)
                        <div class="form-group">
                            <label for="">Mensaje # 1</label>
                            <textarea name="messages[]" id="" cols="30" rows="6" class="form-control">{{ $message->content }}</textarea>
                        </div>
                    @endforeach
                    
                </div>

                <div class="card-footer">
                    <button class="btn btn-primary">Actualizar</button>

                    

                </div>
            
            </div>
            </form>
        </div>
    </div>
</div>
@endsection


@push('js')

<script>

    $(document).ready(function(){
        $('#loading-file').hide();

        $('#form-file').submit(function(){
            // alert('submit')
            $('#loading-file').show();
            $('#button-file').disable()
        })

       
        
    });


</script>
@endpush