<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\Interfaces\FormRequest;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController implements FormRequest
{

    protected array $params;
    public Request $request;

    /**
     * Controller constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->params = $request->all();
        $this->request = $request;
    }

    /**
     * @return Request
     */
    public function getParams(): Request
    {
        return $this->request->replace($this->params);
    }
}
