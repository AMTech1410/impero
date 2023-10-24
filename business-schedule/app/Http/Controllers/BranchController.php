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


    public function store(Request $request)
    {

        request()->validate([
            'name' => 'required',
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

        $startDate = $request->startDate;
        $endDate = $request->endDate;

        if (count($request->startDate)) {
            foreach ($request->startDate as $key => $value) {
                BranchTime::create([
                    'startDate' => $value,
                    'endDate' => $request->endDate[$key],
                    'weekdays' => $request->weekday,
                    'branch_id' => $branchId,

                ]);

            }
        }

        return redirect()->route('branch');
    }

    public function delete($id)
    {
        $business = Branch::find($id);
        Branch::where('id', $business->id)->delete();
        return redirect()->back()->with('message1', 'Branch Data deleted successfully.');

    }


}
