<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Business;
use App\Models\BranchImage;
use App\Models\BranchTime;

class BranchController extends Controller
{
    //
    public function create()
    {
        $business = Business::all();
        $weekDay = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
        return view('branch.create', compact('business', 'weekDay'));
    }
    public function view()
    {
        $branch = Branch::with('business')->get();
        return view('branch.view', compact('branch'));
    }

    public function viewBranchDetail($id)
    {
        $branch = Branch::with('business', 'branchtime', 'branchimage')->find($id);
        return view('branch.branchDetail', compact('branch'));
    }

    public function edit($id){
        $branch = Branch::with('business', 'branchtime', 'branchimage')->find($id);
        $business = Business::all();
        return view('branch.edit', compact('branch','business'));


    }


    public function store(Request $request)
    {

       // echo "<pre>";print_r($request->all());exit;
        request()->validate([
            'name' => 'required',
            'business'=>'required',
            'datefilter'=>'required'
        ]);

        $branchId = Branch::create([
            'name' => $request->name,
            'business_id' => $request->business,

        ])->id;
        ;

        $fileName = '';
        if ($request->hasFile('bimage')) {
            $bimage = $request->file('bimage');
            if (count($bimage) > 0) {
                foreach ($bimage as $key => $value) {
                    $fileName = $value->getClientOriginalName();
                    $value->move(public_path('uploads'), $fileName);
                    // branchId

                    BranchImage::create([
                        'branch_id' => $branchId,
                        'image' => $fileName,

                    ]);
                }
            }
        }

        $startDate = explode(",",$request->startDate);
        $endDate = explode(",",$request->endDate);

        if (count($startDate)) {
            foreach ($startDate as $key => $value) {

                $startTime = explode(" ",$value);
                $endTime = explode(" ",$endDate[$key]);
                BranchTime::create([
                    'startDate' =>$startTime[0],
                    'endDate' => $endTime[0],
                    'branch_id' => $branchId,
                    'startTime'=>isset($request->closed) ? null : $startTime[1]." ".$startTime[2],
                    'endTime'=>isset($request->closed) ? null : $endTime[1]." ".$endTime[2],
                    'closed'=>isset($request->closed) ? 1 : 0
                ]);

           }
        }

        return redirect()->route('branch');
    }

    public function update(){
        return redirect()->route('branch');

    }

    public function delete($id)
    {
        $business = Branch::find($id);
        Branch::where('id', $business->id)->delete();
        return redirect()->back()->with('message1', 'Branch Data deleted successfully.');

    }


}
