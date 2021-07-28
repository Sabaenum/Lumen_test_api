<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\Users\LoginDataRequest;
use App\Http\Controllers\Requests\Users\RecoverPasswordRequest;
use App\Http\Controllers\Requests\Users\RegistrationDataRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    private string $salt;

    public function __construct()
    {
        $this->salt = "userloginregister";
    }

    /**
     * @param LoginDataRequest $request
     * @return string
     */
    public function login(LoginDataRequest $request)
    {
        $data = $request->getParams();
        $user = User:: where("email", "=", $data->email)
            ->where("password", "=", sha1($this->salt . $data->password))
            ->first();

        if ($user) {
            $token = Str::random(60);
            $user->api_token = $token;
            $user->save();
            return $user->api_token;
        } else {
            return "The username or password is incorrect, login failed!";
        }
    }


    /**
     * @param RegistrationDataRequest $request
     * @return string
     */
    public function register(RegistrationDataRequest $request): string
    {
        $user = new User;
        $data = $request->getParams();
        $user->username = $data->username;
        $user->password = sha1($this->salt . $data->password);
        $user->email = $data->email;
        $user->api_token = Str::random(60);
        if ($user->save()) {
            return "User registration is successful!";
        } else {
            return "User registration failed!";
        }

    }

    public function info(){
        return Auth::user();
    }

    /**
     * @param RecoverPasswordRequest $request
     * @return string
     */
    public function recover_password(RecoverPasswordRequest $request): string
    {
        $data = $request->getParams();
        $new_password =  Str::random(10);
        $user = User::where("email", "=", $data->email)
            ->first();
        $user->password = sha1($this->salt.$new_password);
//        Mail::send('email.credentials', $user->toArray(), function($message,$new_password)
//        {
//            $message->to($message->email, $message->username)->subject('New password: '.$new_password);
//        });
        if ($user->save()) {
            return "Password Updated To ".$new_password;
        }
    }
}
