<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\District;
use App\Upazila;
use DB;

class UpazilaController extends Controller
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
        $districts = District::all();
        return view('admin.upazila.createUpazila', ['districts' => $districts]);
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
            'district_id' => 'required|not_in:0',
            'upazilaName'=>'required',
        ]);
        
        $upazila = new Upazila();
        $upazila->district_id = $request->district_id;
        $upazila->upazilaName = $request->upazilaName;
        $upazila->save();
        
        return redirect('admin/upazila-add')->with('message', 'Upazila Info Save Successfully!');
    }
    
    public function manageUpazilas() {
        $upazilas = DB::table('upazilas')
                        ->join('districts', 'upazilas.district_id', '=', 'districts.id')
                        ->select('upazilas.id', 'districts.districtName', 'upazilas.upazilaName', 'upazilas.banglaName')
                        ->paginate(10);
        
        return view('admin.upazila.manageUpazila', ['upazilas' => $upazilas]);
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
        $districts = District::all();
        $upazilaById = Upazila::where('id',$id)->first();
        
        return view('admin.upazila.editUpazila')
                ->with('districts', $districts)
                ->with('upazilaById', $upazilaById);
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
            'district_id' => 'required|not_in:0',
            'upazilaName'=>'required',
        ]);
        
        $upazila = Upazila::find($request->upazilaId);
        $upazila->district_id = $request->district_id;
        $upazila->upazilaName = $request->upazilaName;
        $upazila->save();
        
        return redirect('admin/upazila-manage')->with('message', 'Upazila Info updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $upazila = Upazila::find($id);
        $upazila->delete();
        return redirect('admin/upazila-manage')->with('message', 'Upazila info deleted successfully!');
    }
}
