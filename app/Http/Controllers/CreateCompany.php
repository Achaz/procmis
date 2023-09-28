<?php

namespace App\Http\Controllers;

use App\Events\CompanyCreatedEvent;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Response;

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
        return redirect('/companies')->with('success', "Company successfully registered");
    }

    public function show(Request $request)
    {
        $companies = $request->user()->companies()->paginate(10);

        return view('company.view', compact('companies'));
    }
    public function manageUser(Request $request, $id)
    {

        $company = Company::find($id);
        $company_users = $company->users;

        $users = $request->user()->users;
        
        return view('company.adduser', compact('users', 'company_users', 'company'));
    }

    public function userSync(Request $request, Company $company): RedirectResponse
    {
        $input = $request->validate(["user_ids" => ["required"]]);
        $user = $request->user();
        $company_admins = $company->users()->whereStatus(5)->get();

        try {

            throw_unless(in_array($user->id, $company_admins->pluck('id')->all()), "User not permitted to add other users");

            $users =array_reduce($input["user_ids"], function ($c, $i) {
                    $c[$i] =  ["status" => 2];
                    return $c;
                }, []);

            ($company->users()->sync($users, false));

        } catch (\Throwable $th) {
        
            return redirect()->back()->with(["status" => "Failed sync"]);
        }

        return redirect()->back()->with(["status" => "Succussful sync"]);
    }

    public function roleSync(Request $request, Company $company): RedirectResponse
    {
        //dd($request->all());
        $input = $request->validate(["role_ids" => ["required"]]);
        //dd($input);
        $userId = $request->user_id;
        // Find the user model from the DB
        $user = User::find($userId);
        
        if (! $user) {
            // Redirect back
        }
        // Assign the roles to the user
        $user->syncRoles($input['role_ids']);
        // Find the company that the user belongs to and update the status
        // $company->users()->syncWithPivotValues($userId, ['status' => $input['role_ids']]);
        // DB::table('company_users')
        //     ->where('company_id', $company->id)
        //     ->where('user_id', $userId)
        //     ->update([
        //         'company_id' => $company->id, 
        //         'user_id' => $userId, 'status' => $input['role_id']
        //     ]);
        //dd($user);
        return redirect()->back()->with(["status" => "Succussful sync"]);
    }
}
