<?php

namespace App\Http\Controllers;




use App\Company;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{

    public function index()
    {
        $companies = Company::all();

        return response()->json(['status' => 'success', 'companies' => $companies], 200);
    }

    public function create(CompanyRequest $request)
    {
       $company = new Company();
        $this->save($company, $request);

        return response()->json(['status' => 'success', 'company' => $company], 200);
    }

    public function findCompany($id)
    {
        $company = Company::find($id)->projects;

        return response()->json(['status' => 'success', 'company' => $company], 200);
    }

    public function updateCompany(CompanyRequest $request, $id)
    {
        $company = Company::find($id);

        $this->save($company, $request);

        return response()->json(['status' => 'success', 'companies' => $company], 200);
    }
    public function deleteCompany($id)
    {
        $company = Company::find($id);

        $company->delete();

        return response()->json(['status' => 'success', 'companies' => $company], 200);
    }
    private function save(Company $company, CompanyRequest $request)
    {
        $company->name = $request->name;
        $company->ceoname = $request->ceoname;
        $company->size = $request->size;
        $company->industry = $request->industry;

        $company->save();
    }
}
