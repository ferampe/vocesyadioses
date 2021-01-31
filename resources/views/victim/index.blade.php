@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('victim.create') }}" class="btn btn-success">Crear Victima</a>
                </div>

                <div class="card-body">
                    
                    @foreach($victims as $victim)
                        
                        <div class="alert alert-dark d-flex justify-content-between" role="alert">
                            {{ $victim->name }}
                            <div>
                                <a href="{{ route('victim.edit', [$victim->id]) }}" >Editar</a>
                                <a href="">Eliminar</a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
