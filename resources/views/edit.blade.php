@extends('front.layout')

@section('content')


<div class="font-sans antialiased bg-grey-lightest">
    
    <!-- Content -->
    <div class="w-full bg-grey-lightest" >
      <div class="container mx-auto py-8">
        <div class="w-5/6 lg:w-1/2 mx-auto bg-white rounded shadow">
              <div class="py-4 px-8 text-black text-xl border-b border-grey-lighter">Registro</div>
                <div class="py-4 px-8">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-4 w-full">
                                <label class="block text-grey-darker text-sm  mb-1" for="first_name">Nombre de usuario</label>
                                <input class="appearance-none border border-gray-300 rounded w-full py-1 px-3 text-grey-darker" id="name" name="name" type="text" value="{{ old('name', $user->name) }}" placeholder="Nombre completo">
                            
                        </div>

                        <div class="mb-4 w-full">
                                <label class="block text-grey-darker text-sm  mb-1" for="email">Email</label>
                                <input class="appearance-none border border-gray-300 rounded w-full py-1 px-3 text-grey-darker" id="email" name="email" type="email" value="{{ old('email', $user->email) }}" placeholder="Su email">

                                @error('email')
                                    <span class="text-red-500 text-sm">
                                        {{ $message }}
                                    </span>
                                @enderror
                        </div>

                        {{-- <div class="flex justify-between ">
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
                        </div> --}}
                        

                        <hr class="mb-4">

                        <div class="text-lg mb-4">Datos de la persona a quien dedicamos la despedida</div>

                        <div class="mb-4">
                            <label class="block text-grey-darker text-sm  mb-1" for="name_victim">Nombre</label>
                            <input class="appearance-none border border-gray-300 rounded w-full py-1 px-3 text-grey-darker" id="name_victim" name="name_victim" type="text" value="{{ old('name_victim', $user->name_victim) }}" placeholder="Nombres">
                        
                        </div>

                        <div class="mb-4">
                            <label class="block text-grey-darker text-sm  mb-1" for="last_name_victim">Apellidos</label>
                            <input class="appearance-none border border-gray-300 rounded w-full py-1 px-3 text-grey-darker" id="last_name_victim" name="last_name_victim" type="text" value="{{ old('last_name_victim', $user->last_name_victim) }}" placeholder="Apellidos">
                        
                        </div>

                        <div class="mb-4">
                                <label class="block text-grey-darker text-sm  mb-1" for="department_id">Departamento de la persona fallecida</label>
                                <select name="department_id" id="department_id" class="appearance-none border border-gray-300 rounded w-full py-1 px-3 text-grey-darker">
                                    <option value="">Seleccione un departamento</option>

                                    @foreach($departments as $department)
                                        <?php $select = old('department_id', $user->department_id) == $department->id ? 'selected="selected"' : ''; ?>
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
@endsection
