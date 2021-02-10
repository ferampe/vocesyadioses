<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;


use App\Department;
use App\Message;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'name_victim' => ['required', 'string', 'max:255'],
            'last_name_victim' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'department_id' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function edit(Request $request, $user_id)
    {
        
        $user = User::find($user_id);
        $departments = Department::all();

        // dd($user);

        return view('edit', compact('user', 'departments'));


    }

    public function update(Request $request, $user_id)
    {

        // dd($request->all());

        $validator =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'name_victim' => ['required', 'string', 'max:255'],
            'last_name_victim' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->id],
            'department_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();;
        }

        

        $user = User::find($user_id);
        $user->name = $request->name;
        $user->department_id = $request->department_id;
        $user->name_victim = $request->name_victim;
        $user->last_name_victim = $request->last_name_victim;

        if($request->password)
        {
            $user->password = Hash::make($request->password);
        }
        

        $user->save();

        return redirect('register/edit/'.$user->id)->with('success', 'datos actualizados');   ;


    }

    public function showRegistrationForm()
    {
        $departments = Department::all();
        // return view('auth.register', compact('departments'));
        return view('front.register', compact('departments'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        // dd($data);

        $user =  User::create([
            'name' => $data['name'],
            'name_victim' => $data['name_victim'],
            'last_name_victim' => $data['last_name_victim'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'department_id'=> $data['department_id']
        ]);

        $message1 = new Message;
        $message1->user_id = $user->id;
        $message1->content = null;
        $message1->save();

        $message2 = new Message;
        $message2->user_id = $user->id;
        $message2->content = null;
        $message2->save();

        $message3 = new Message;
        $message3->user_id = $user->id;
        $message3->content = null;
        $message3->save();


        return $user;

    }
}
