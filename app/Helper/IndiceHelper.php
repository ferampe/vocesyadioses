<?php

namespace App\Helper;
use Illuminate\Support\Facades\View;


class IndiceHelper{

    public function build()
    {
        
        $letters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'm', 'n', 'l', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
        $html = null;
        foreach($letters as $letter)
        {
            $users = \App\User::where('name', 'LIKE', $letter.'%')->orderBy('name', 'ASC')->get();

            if($users)
            {                
                $html .= view('front.menu-item', compact('users', 'letter'))->render();

            }
        }

        return $html;
    }

}