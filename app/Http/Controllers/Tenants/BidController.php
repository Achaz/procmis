<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Bids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Traits\Upload; //import the trait

class BidController extends Controller
{
    use Upload;//add this trait

    public function index(Request $request)
    {
        return view('tenants.bids.index', [
            'bids' => $request->user()->bids()->paginate()
        ]);
       
    }

    public function create(Request $request)
    {
        return view('tenants.bids.create');
    }
    
    public function store(Request $request)
    {

        $user = $request->user();

        if ($request->hasFile('file')) {

            $path = $this->UploadFile($request->file('file'), 'Bids');//use the method in the trait
 
        try {

            DB::beginTransaction();

            $user->bids()->create([
                'procurementplan' => $request->input('procurementplan'),
                'procurementsubject' => $request->input('subject'),
                'referenceNumber' => $request->input('ReferenceNumber'),
                'procurementtype' => $request->input('ProcurementType'),
                'summary' => $request->input('summary'),
                'submissiondeadline' => $request->input('submissiondeadline'),
                'documents' => $path,
                'displayperiod' => $request->input('displayperiod'),
                'status' => $request->input('status')              
            ]);
              
            DB::commit();

        } catch (\Throwable $th) {

            DB::rollBack();
 
            return back()->with('error', $th->getMessage());
        }
        return redirect()
          ->route('tenants.bids.index', tenant('id'))
          ->with('success','Bid created successfully');

      }
      return redirect()
          ->route('tenants.bids.create', tenant('id'))
          ->with('error','Please upload a bids document file');

    }

    public function edit(Bids $bid)
    {
        return view('tenants.bids.edit', [
            'bid' => $bid
        ]);
    }

    public function destroy(Bids $bid)
    {

        

    }

    public function update(Request $request, Bids $bid)
    {
    
        $file_id = $bid->id;

        $file = Bids::where('id', $file_id)->first();

        //check if the existing file is present and delete it from the storage
        if (File::exists(storage_path('app/public/'.$file->documents))) {

            File::delete(storage_path('app/public/'.$file->documents));

        }

        //upload the new file
        $path = $this->UploadFile($request->file('file'), 'Bids');

        if ($request->hasFile('file')) {
 
            try {

                DB::beginTransaction();

                $file->update([
                    'procurementplan' => $request->input('procurementplan'),
                    'procurementsubject' => $request->input('subject'),
                    'referenceNumber' => $request->input('ReferenceNumber'),
                    'procurementtype' => $request->input('ProcurementType'),
                    'summary' => $request->input('summary'),
                    'submissiondeadline' => $request->input('submissiondeadline'),
                    'documents' => $path,
                    'displayperiod' => $request->input('displayperiod'),
                    'status' => $request->input('status')      
                ]);   

                DB::commit();

            } catch (\Throwable $th) {

                DB::rollBack();
    
                return back()->with('error', $th->getMessage());
            }
            return redirect()
            ->route('tenants.bids.index', tenant('id'))
            ->with('success','Bid updated successfully');
        }
        return redirect()
          ->route('tenants.bids.edit', tenant('id'))
          ->with('error','bid documents file missing');
    }

    public function downloadFile($id){

        $path = Bids::where("id", $id)->value("documents");

        return response()->download(storage_path('app/public/'.$path));

    }
}
