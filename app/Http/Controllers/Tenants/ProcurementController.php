<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\ProcurementPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Traits\Upload; //import the trait

class ProcurementController extends Controller
{
    use Upload;//add this trait

    public function index(Request $request)
    {
        return view('tenants.procurement.index', [
            'procurementplans' => $request->user()->procurement_plan()->paginate()
        ]);
    }

    public function create()
    {
        return view('tenants.procurement.create');
    }

    public function store(Request $request, ProcurementPlan $procurementPlan)
    {
        $user = $request->user();
 
        if ($request->hasFile('file')) {

            $path = $this->UploadFile($request->file('file'), 'ProcurementPlan');//use the method in the trait

        try {

            DB::beginTransaction();

            $user->procurement_plan()->create([
                'title' => $request->input('title'),
                'financialperiod'=> $request->input('financialperiod'),
                'details' => $path,
                'status' => $request->input('status'),
            ]);
               
            DB::commit();

        } catch (\Throwable $th) {

            DB::rollBack();
 
            return back()->with('error', $th->getMessage());
        }
        return redirect()
          ->route('tenants.procurement.index', tenant('id'))
          ->with('success','Procurement plan created successfully');

      }
      return redirect()
          ->route('tenants.procurement.create', tenant('id'))
          ->with('error','Please upload a detials file');
    }

    public function edit(ProcurementPlan $procurementplan)
    {
        return view('tenants.procurement.edit', [
            'procurementplan' => $procurementplan
        ]);
    }

    public function update(Request $request, ProcurementPlan $procurementplan)
    {
       
        $file_id = $procurementplan->id;

        $file = ProcurementPlan::where('id', $file_id)->first();

        //check if the existing file is present and delete it from the storage
        if (File::exists(storage_path('app/public/'.$file->details))) {

            File::delete(storage_path('app/public/'.$file->details));

        }

        //upload the new file
        $path = $this->UploadFile($request->file('file'), 'ProcurementPlan');

        if ($request->hasFile('file')) {  
 
            try {

                DB::beginTransaction();

                $file->update([
                    'title' => $request->input('title'),
                    'financialperiod' => $request->input('financialperiod'),
                    'details' => $path,
                    'status' => $request->input('status'),
                ]);
                       
                DB::commit();

            } catch (\Throwable $th) {
                DB::rollBack();
    
                return back()->with('error', $th->getMessage());
            }
            return redirect()
            ->route('tenants.procurement.index', tenant('id'))
            ->with('success','Procurement plan updated successfully');
       }
       return redirect()
          ->route('tenants.procurement.edit', tenant('id'))
          ->with('error','procurement plan details file missing');
    }

    public function downloadFile($id){

        $path = ProcurementPlan::where("id", $id)->value("details");

        return response()->download(storage_path('app/public/'.$path));

    }

}
