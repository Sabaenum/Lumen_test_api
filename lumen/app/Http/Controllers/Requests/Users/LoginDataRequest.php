<?php


namespace App\Http\Controllers\Requests\Users;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginDataRequest extends Controller
{
    /**
     * @throws ValidationException
     */
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'email' => 'required',
                'password' => 'required|min:5'
            ]
        );

        parent::__construct($request);
    }

}
