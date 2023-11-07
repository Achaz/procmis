<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('tenants.suppliers.index', [
            'suppliers' => \App\Models\Supplier::paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tenants.suppliers.create');
    }

    public function invite()
    {
      return view('invitations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSupplierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierRequest $request)
    {
            $this->validate($request, [
                'password' => 'required|same:confirm-password',
                'email' => 'required|email|unique:invitations',
                'suppliername' => 'required|string',
                'supplierphone'  => 'required|string',
                'supplieraddress' => 'nullable',
                'suppliercity'  => 'required|string',
                'supplierstate'  => 'nullable',
                'supplierzip'  => 'nullable',
                'suppliercountry'  => 'required|string'             
            ]);

            $user = User::create([
                'name' => $request->suppliername,
                'username' => $request->suppliername,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'type' => 'Supplier'
            ]);
        
            $user->suppliers()->create([
                'name' => $request->suppliername,
                'email'=> $request->email,
                'phone' => $request->supplierphone,
                'address' => $request->supplieraddress,
                'city' =>$request->suppliercity,
                'state' => $request->supplierstate,
                'zipcode' => $request->supplierzip,
                'country' => $request->suppliercountry
            ]);

        return redirect()->route('tenants.login',tenant('id'))
            ->with('success', 'Your supplier account was registered successfully, please login');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('tenants.suppliers.edit', [
            'supplier' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupplierRequest  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier_id = $supplier->id;
    
        $supplyer = Supplier::where('id', $supplier_id)->first();
        //dd($supplyer);
        try{

            DB::transaction(function () use ($supplyer, $request) {
                $supplyer->update([
                    'name' => $request->suppliername,
                    'email'=> $request->email,
                    'phone' => $request->supplierphone,
                    'address' => $request->supplieraddress,
                    'city' =>$request->suppliercity,
                    'state' => $request->supplierstate,
                    'zipcode' => $request->supplierzip,
                    'country' => $request->suppliercountry
                ]);
            });

        }catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        return redirect()->route('tenants.suppliers.index',tenant('id'))
            ->with('success', 'Supplier updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $user = $supplier->user;
        $user->delete();
        $supplier->delete();
  
        return redirect()->route('tenants.suppliers.index', tenant('id'))
        ->with('success', 'Supplier deleted successfully');
    }
}
