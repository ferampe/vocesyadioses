@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('victim.update', [$victim->id]) }}" method="post">
                @csrf
                @method('put')
                <input type="hidden" value="{{ $victim->id }}">
                <div class="card">
                    <div class="card-header">
                        <h3>Editar Victima</h3>
                    </div>

                    <div class="card-body">
                        
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" class="form-control" autocomplete="off" value="{{ old('name', $victim->name)}}">
                                <small id="emailHelp" class="form-text text-muted">Ingrese el nombre de la victima.</small>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="age">Edad</label>
                                <input type="number" name="age" class="form-control" autocomplete="off" maxlength="2" value="{{ old('age', $victim->age)}}">
                            </div>

                            <div class="form-group">
                                <label for="department_id">Departamento</label>
                                <select name="department_id" id="department_id" class="form-control">
                                    <option value="">Seleccione un departamento</option>

                                    @foreach($departments as $department)
                                        <?php $select = old('department_id', $victim->department_id) == $department->id ? 'selected="selected"' : ''; ?>
                                        <option value="{{ $department->id}}" {{ $select }}>{{$department->name}}</option>
                                    @endforeach

                                </select>

                                @if ($errors->has('department_id'))
                                    <span class="text-danger">{{ $errors->first('department_id') }}</span>
                                @endif
                            </div>

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
