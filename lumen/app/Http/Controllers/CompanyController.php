<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Requests\Company\AddCompanyRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    /**
     * @return array
     */
    public function get(): array
    {
        $result = [];
        $user = Auth::user();
        $data = User::where("id", "=", $user['id'])
            ->first();
        foreach ($data->companies as $company){
            $result[] = [
                'title' => $company->title,
                'description' => $company->description,
                'phone' => $company->phone
            ];
        }
        return $result;
    }

    /**
     * @param AddCompanyRequest $request
     * @return string
     */
    public function add(AddCompanyRequest $request): string
    {
        $data = $request->getParams();
        $user = Auth::user();
        $company = new Company();
        $company->user_id = $user['id'];
        $company->title = $data->title;
        $company->phone = $data->phone;
        $company->description = $data->description;
        if($company->save()){
            return 'Company Saved';
        }
        return 'Something Went Wrong';
    }
}
