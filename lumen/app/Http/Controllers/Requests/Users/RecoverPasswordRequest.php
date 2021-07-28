<?php


namespace App\Http\Controllers\Requests\Users;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RecoverPasswordRequest extends Controller
{
    /**
     * @throws ValidationException
     */
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'email' => 'required|email|exists:users',
            ]
        );
        parent::__construct($request);
    }
}
