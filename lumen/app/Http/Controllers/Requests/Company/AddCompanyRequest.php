<?php


namespace App\Http\Controllers\Requests\Company;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AddCompanyRequest extends Controller
{

    /**
     * @throws ValidationException
     */
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'title' => 'required',
                'phone' => 'required|min:5',
                'description' => 'required|min:5'
            ]
        );
        parent::__construct($request);
    }

}
