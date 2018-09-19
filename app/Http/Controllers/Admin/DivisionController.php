<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Division;
use App\District;
use DB;

class DivisionController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.division.createDivision');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'divisionName'=>'required',
            'banglaName' => 'required',
        ]);
        
        $division = new Division();
        $division->divisionName = $request->divisionName;
        $division->banglaName = $request->banglaName;
        $division->save();
        
        return redirect('admin/division-add')->with('message', 'Division Save Successfully');
        
    }
    
    public function manageDivisions() {
        $divisions = DB::table('divisions')
                        ->select('divisions.id', 'divisions.divisionName', 'divisions.banglaName')
                        ->get();
        
        return view('admin.division.manageDivisions', ['divisions' => $divisions]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $divisionById = Division::where('id',$id)->first();
        return view('admin.division.editDivision')
                ->with('divisionById', $divisionById);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'divisionName'=>'required',
            'banglaName' => 'required',
        ]);
        
        $division = Division::find($request->divisionId);
        $division->divisionName = $request->divisionName;
        $division->banglaName = $request->banglaName;
        $division->save();
        
        return redirect('admin/division-manage')->with('message', 'Division Update Successfully');
    }
    
    public function divisionWiseDistricts($id) {
        
        $division = Division::where('id', $id)->first();
        
        $districts = District::where('division_id', $id)->get();
        
        return view('admin.division.showDistricts', ['division' => $division, 'districts' => $districts]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $division = Division::find($id);
        $division->delete();
        return redirect('admin/division-manage')->with('message', 'Division deleted successfully!');
    }
}
