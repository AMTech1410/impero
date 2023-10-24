<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;


class BusinessController extends Controller
{
    //
    public function create()
    {
        return view('business.create');
    }

    public function view()
    {
        $business = Business::all();
        return view('business.view', compact('business'));

    }

    public function delete($id)
    {
        $business = Business::find($id);
        Business::where('id', $business->id)->delete();
        return redirect()->back()->with('message1', 'Business Data deleted successfully.');

    }

    public function store(Request $request)
    {

        // Validate the uploaded file
        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'logo' => 'required'
        ]);


        $fileName = '';
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = public_path('temp');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
        }

        Business::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'logo' => $fileName,
        ]);

        return redirect()->route('business');
    }
}
