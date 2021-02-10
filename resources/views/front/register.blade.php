@extends('front.layout')

@section('content')


<div class="font-sans antialiased bg-grey-lightest flex-grow">

    
    
    <!-- Content -->
    <div class="w-full bg-grey-lightest" >
      <div class="container mx-auto py-8">
        <div class="w-5/6 lg:w-1/2 mx-auto bg-white rounded shadow">
              <div class="py-4 px-8 text-black text-xl border-b border-grey-lighter">Participar</div>

              <div class="p-5 text-justify">
                <p>Aquí puedes crear un usuario con el cual subir imágenes, textos, audio y video para conmemorar a un ser querido fallecido por Covid-19 en el Perú.</p> 
                <p>Por favor, sigue las indicaciones de uso para garantizar el buen funcionamiento de la página y asegúrate de compartir material respetuoso y acorde al delicado período que vivimos. </p>
                <p>Si se trata de una familia o varios amigos recordando juntos a alguien, por favor háganlo colectivamente mediante un solo usuario, para dejar espacio a otras personas que quieran hacer uso de la plataforma. Una vez subidos, los contenidos pueden ser cambiados cuantas veces se desee con el usuario creado.</p>
            </div>

                <div class="py-4 px-8">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-4 w-full">
                                <label class="block text-grey-darker text-sm  mb-1" for="first_name">Nombre de usuario</label>
                                <input class="appearance-none border border-gray-300 rounded w-full py-1 px-3 text-grey-darker" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Nombre completo">
                            
                        </div>

                        <div class="mb-4 w-full">
                                <label class="block text-grey-darker text-sm  mb-1" for="email">Email</label>
                                <input class="appearance-none border border-gray-300 rounded w-full py-1 px-3 text-grey-darker" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Su email">

                                @error('email')
                                    <span class="text-red-500 text-sm">
                                        {{ $message }}
                                    </span>
                                @enderror
                        </div>

                        <div class="flex justify-between ">
                            <div class="mb-4">
                                <label class="block text-grey-darker text-sm  mb-1" for="password">Password</label>
                                <input id="password" type="password" class="appearance-none border border-gray-300 rounded w-full py-1 px-3 text-grey-darker" name="password" required autocomplete="new-password">
                                
                                @error('password')
                                    <span class="text-red-500 text-sm">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
    
                            <div class="mb-4">
                                <label for="password-confirm" class="block text-grey-darker text-sm  mb-1">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="appearance-none border border-gray-300 rounded w-full py-1 px-3 text-grey-darker" name="password_confirmation" required autocomplete="new-password">
    
                            </div>
                        </div>
                        

                        <hr class="mb-4">

                        <div class="text-lg mb-4">Datos de la persona a quien dedicamos la despedida</div>

                        <div class="mb-4">
                            <label class="block text-grey-darker text-sm  mb-1" for="name_victim">Nombre</label>
                            <input class="appearance-none border border-gray-300 rounded w-full py-1 px-3 text-grey-darker" id="name_victim" name="name_victim" type="text" value="{{ old('name_victim') }}" placeholder="Nombres">
                        
                        </div>

                        <div class="mb-4">
                            <label class="block text-grey-darker text-sm  mb-1" for="last_name_victim">Apellidos</label>
                            <input class="appearance-none border border-gray-300 rounded w-full py-1 px-3 text-grey-darker" id="last_name_victim" name="last_name_victim" type="text" value="{{ old('last_name_victim') }}" placeholder="Apellidos">
                        
                        </div>

                        <div class="mb-4">
                                <label class="block text-grey-darker text-sm  mb-1" for="department_id">Lugar del deceso:</label>
                                <select name="department_id" id="department_id" class="appearance-none border border-gray-300 rounded w-full py-1 px-3 text-grey-darker">
                                    <option value="">Seleccione un departamento</option>

                                    @foreach($departments as $department)
                                        <?php $select = old('department_id') == $department->id ? 'selected="selected"' : ''; ?>
                                        <option value="{{ $department->id}}" {{ $select }}>{{$department->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('department_id'))
                                    <span class="text-red-500 text-sm">
                                        {{ $errors->first('department_id') }}
                                    </span>
                                @endif
                        </div>

                        

                        <div class="mb-4">
                            {{-- hover:bg-blue-dark text-white font-bold py-2 px-4 rounded-full --}}
                            <button class="bg-black text-white p-3" type="submit">
                                Registrar
                            </button>
                        </div>

                        

                </form>
                </div>
          </div>
         
      </div>
    </div>
    
  </div>














{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="department_id" class="col-md-4 col-form-label text-md-right">Departamento</label>

                            <div class="col-md-6">
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
                            
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
