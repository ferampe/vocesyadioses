<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Victim;
use Illuminate\Support\Facades\Validator;
use App\Department;
use Illuminate\Validation\Rule;
use \FileUploader;
use App\User;


class VictimController extends Controller
{
    

    public function show($id)
    {
        $user = User::with('files')->find($id);

        // dd($user);

        return view('front/front', compact('user'));
    }

    
}
