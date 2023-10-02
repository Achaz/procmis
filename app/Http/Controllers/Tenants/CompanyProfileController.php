<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyProfileController extends Controller
{
    public function index(Request $request)
    {
        $company = $request->user()->company;

        if (!$company) {
            return redirect()->route('tenants.profile.create', tenant('id'))->with('status', 'Please create your company profile');
        }

        return view('company.view', [
            'company' => $company
        ]);
    }

    public function create()
    {
        return view('company.create');
    }

    public function show(Request $request)
    {
        $company = $request->user()->company;

        if (!$company) {
            return redirect()->route('tenants.profile.create', tenant('id'))->with('status', 'Please create your company profile');
        }

        return view('company.view', [
            'company' => $company
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
 
        try {
            DB::beginTransaction();

            $user->company()->create([
                'organisationName' => $request->input('organisationName'),
                'procurementCategory' => $request->input('category'),
                'briefDescription' => $request->input('briefDescription'),
                'companyPhoneNumber' => $request->input('phonenumber'),
                'country' => $request->input('country'),
                'registrationNumber' => $request->input('registrationnumber'),
                'taxId' => $request->input('taxid'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'region' => $request->input('region'),
                'zip_code' => $request->input('zipcode')
            ]);
    
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
 
            return back()->with('error', $th->getMessage());
        }
        return redirect()
          ->route('tenants.profile.index', tenant('id'))
          ->with('success','Company profile created successfully');
    }

    public function edit(Company $profile)
    {
        return view('company.edit', [
            'company' => $profile
        ]);
    }

    public function update(Request $request, Company $profile)
    {
        $user = $request->user();
 
        try {
            DB::beginTransaction();

            $user->company()->update([
                'organisationName' => $request->input('organisationName'),
                'procurementCategory' => $request->input('category'),
                'briefDescription' => $request->input('briefDescription'),
                'companyPhoneNumber' => $request->input('phonenumber'),
                'country' => $request->input('country'),
                'registrationNumber' => $request->input('registrationnumber'),
                'taxId' => $request->input('taxid'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'region' => $request->input('region'),
                'zip_code' => $request->input('zipcode')
            ]);
    
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
 
            return back()->with('error', $th->getMessage());
        }
        return redirect()
          ->route('tenants.profile.index', tenant('id'))
          ->with('success','Company profile updated successfully');
    }
}
