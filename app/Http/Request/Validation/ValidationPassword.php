<?php

namespace App\Http\Request\Validation;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ValidationPassword implements Rule
{
    // private $username;
    public function __construct($username)
	{

	    $this->username = $username;
	    $this->user = User::where('username',$this->username)->first();
       
	}

    public function passes($attribute, $value)
    {
        
        return $this->user->password;
     
    }


    public function message()
    {
        return 'Password tidak valid';
    }

}	