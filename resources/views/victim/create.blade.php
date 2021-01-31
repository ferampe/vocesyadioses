@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('victim.store') }}" method="post" id="myform">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3>Crear Victima</h3>
                    </div>

                    <div class="card-body">
                        
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" class="form-control" autocomplete="off" value="{{ old('name') }}">
                                <small id="emailHelp" class="form-text text-muted">Ingrese el nombre de la victima.</small>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="age">Edad</label>
                                <input type="number" name="age" class="form-control" autocomplete="off" maxlength="2" value="{{ old('age')}}">
                            </div>

                            <div class="form-group">
                                <label for="department_id">Departamento</label>
                                <select name="department_id" id="department_id" class="form-control">
                                    <option value="">Seleccione un departamento</option>

                                    @foreach($departments as $department)
                                        <?php $select = old('department_id') == $department->id ? 'selected="selected"' : ''; ?>
                                        <option value="{{ $department->id}}" {{ $select }}>{{$department->name}}</option>
                                    @endforeach

                                </select>

                                @if ($errors->has('department_id'))
                                    <span class="text-danger">{{ $errors->first('department_id') }}</span>
                                @endif
                            </div>

                            {{-- <file-upload></file-upload> --}}
                            <label for="">Archivos de audio o Video</label>
                            <div class="d-flex justify-content-center">
                                <input type="file" name="files">
                                <div class="form-status"></div>
                            </div>

                            {{ print_r(old('files'))}}
                            

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('css')
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<link href="{{ asset('fileuploader/font/font-fileuploader.css') }}" rel="stylesheet">

    <!-- styles -->
    <link href="{{ asset('fileuploader/jquery.fileuploader.min.css') }}" media="all" rel="stylesheet">
    <link href="{{ asset('fileuploader/jquery.fileuploader-theme-dragdrop.css')}}" media="all" rel="stylesheet">

    <style>
        .fileuploader {
                /* max-width: 560px; */
            }
    </style>
@endpush

@push('js')	
    <!-- js -->
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('fileuploader/jquery.fileuploader.min.js') }}" type="text/javascript" defer></script>
    {{-- <script src="{{ asset('fileuploader/custom.js')}}" type="text/javascript" defer></script> --}}

    <script>

window.addEventListener("DOMContentLoaded", function(){
    $(document).ready(function() {
	
	// enable fileuploader plugin
	$('input[name="files"]').fileuploader({
        changeInput: '<div class="fileuploader-input">' +
					      '<div class="fileuploader-input-inner">' +
						      '<div class="fileuploader-icon-main"></div>' +
							  '<h3 class="fileuploader-input-caption"><span>${captions.feedback}</span></h3>' +
							  '<p>${captions.or}</p>' +
							  '<button type="button" class="fileuploader-input-button"><span>${captions.button}</span></button>' +
						  '</div>' +
					  '</div>',
        theme: 'dragdrop',
		upload: {
            url: '{{ route("upload") }}',
            data: { "_token": "{{ csrf_token() }}"},
            type: 'POST',
            enctype: 'multipart/form-data',
            start: true,
            synchron: true,
            beforeSend: null,
            onSuccess: function(result, item) {
                var data = {};
				
                // get data
				if (result && result.files)
                    {data = result;}
                else{
					data.hasWarnings = true;}
                
                    console.log(data);
				// if success
                if (data.isSuccess && data.files[0]) {
                    item.name = data.files[0].name;
                    item.html.find('.column-title > div:first-child').text(data.files[0].name).attr('title', data.files[0].name);
                    $('#myform').append('<input type="hidden" name="files[]" id="'+ data.files[0].name +'" value="' + data.files[0].name + "|" + data.files[0].type + '">');
                }
				
				// if warnings
				if (data.hasWarnings) {
					for (var warning in data.warnings) {
						alert(data.warnings[warning]);
					}
					
					item.html.removeClass('upload-successful').addClass('upload-failed');
					// go out from success function by calling onError function
					// in this case we have a animation there
					// you can also response in PHP with 404
					return this.onError ? this.onError(item) : null;
				}
                
                item.html.find('.fileuploader-action-remove').addClass('fileuploader-action-success');
                setTimeout(function() {
                    item.html.find('.progress-bar2').fadeOut(400);
                }, 400);
            },
            onError: function(item) {
				var progressBar = item.html.find('.progress-bar2');
				
				if(progressBar.length) {
					progressBar.find('span').html(0 + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(0 + "%");
					item.html.find('.progress-bar2').fadeOut(400);
				}
                
                item.upload.status != 'cancelled' && item.html.find('.fileuploader-action-retry').length == 0 ? item.html.find('.column-actions').prepend(
                    '<button type="button" class="fileuploader-action fileuploader-action-retry" title="Retry"><i class="fileuploader-icon-retry"></i></button>'
                ) : null;
            },
            onProgress: function(data, item) {
                var progressBar = item.html.find('.progress-bar2');
				
                if(progressBar.length > 0) {
                    progressBar.show();
                    progressBar.find('span').html(data.percentage + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                }
            },
            onComplete: null,
        },
		onRemove: function(item) {
			// $.post('{{ route("remove")}}', {
			// 	file: item.name
            // });

            
            $.ajax({
                url: '{{ route('remove') }}',
                type: 'post',
                data: {
                    "file": item.name,
                    "_token": "{{ csrf_token() }}",
                },

                // dataType: 'json',
                success: function (data){
                    var element = document.getElementById(item.name);
                    element.parentNode.removeChild(element);
                    console.log(data);
                    alert("Elemento eliminado");
                },
                error: function (data){
                    alert("Problema al eliminar");
                }

            });

		},
		captions: $.extend(true, {}, $.fn.fileuploader.languages['en'], {
            feedback: 'Drag and drop files here',
            feedback2: 'Drag and drop files here',
            drop: 'Drag and drop files here',
            or: 'or',
            button: 'Browse files',
        }),
	});
	
});



});
    </script>

@endpush