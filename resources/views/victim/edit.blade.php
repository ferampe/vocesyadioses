@extends('layouts.app')

@section('content')
<div class="container">

    @if (Session::has('success'))

    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex">
          <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
          <div>
            <p class="text-sm">{!! Session::get('success') !!}</p>
          </div>
        </div>
      </div>
    @endif

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
