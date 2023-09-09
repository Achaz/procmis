<?php

namespace App\Http\Controllers;

use App\Events\CompanyCreatedEvent;
use App\Models\Company;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class CreateCompany extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('user');
    }

    public function index()
    {
        return view('company.create');
    }

    public function store(Request $request)
    {
        $user = $request->user();
      

        $organisationName = $request->input('organisationName');
        $category = $request->input('category');
        $briefDescription = $request->input('briefDescription');
        $phonenumber = $request->input('phonenumber');
        $country = $request->input('country');
        $registrationnumber = $request->input('registrationnumber');
        $taxid = $request->input('taxid');
        $address = $request->input('address');
        $city = $request->input('city');
        $region = $request->input('region');
        $zipcode = $request->input('zipcode');
        try {
            DB::beginTransaction();
            $company =   Company::create([
                'organisationName' => $organisationName,
                'procurementCategory' => $category,
                'briefDescription' => $briefDescription,
                'companyPhoneNumber' => $phonenumber,
                'country' => $country,
                'registrationNumber' => $registrationnumber,
                'taxId' => $taxid,
                'address' => $address,
                'city' => $city,
                'region' => $region,
                'zip_code' => $zipcode
            ]);
            CompanyCreatedEvent::dispatch($request->user(),  $company);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect('/createCompany')->with('success', "Company successfully registered");
    }
}
