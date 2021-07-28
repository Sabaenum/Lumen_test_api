<?php
namespace App\Http\Controllers\Requests\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class RegistrationDataRequest extends Controller
{
    /**
     * @throws ValidationException
     */
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'username' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:5'
            ]
        );

        parent::__construct($request);
    }
}
