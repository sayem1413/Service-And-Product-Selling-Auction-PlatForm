<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Division;
use App\District;
use App\Upazila;
use DB;

class DistrictController extends Controller
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
        $divisions = Division::all();
        
        return view('admin.district.createDistrict', ['divisions' => $divisions]);
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
            'division_id' => 'required|not_in:0',
            'districtName'=>'required',
            'banglaName' => 'required',
            // 'website'=>'required',
        ]);
        
        $district = new District();
        $district->division_id = $request->division_id;
        $district->districtName = $request->districtName;
        $district->banglaName = $request->banglaName;
        $district->website = $request->website;
        $district->save();
        
        return redirect('admin/district-add')->with('message', 'District Info Save Successfully!');
    }
    
    public function manageDistricts() {
        $districts = DB::table('districts')
                        ->join('divisions', 'districts.division_id', '=', 'divisions.id')
                        ->select('districts.id', 'divisions.divisionName', 'districts.districtName', 'districts.banglaName')
                        ->paginate(10);
        
        return view('admin.district.manageDistrict', ['districts' => $districts]);
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
        $divisions = Division::all();
        $districtById = District::where('id',$id)->first();
        
        return view('admin.district.editDistrict')
                ->with('divisions', $divisions)
                ->with('districtById', $districtById);
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
            'division_id' => 'required|not_in:0',
            'districtName'=>'required',
            'banglaName' => 'required',
            // 'website'=>'required',
        ]);
        
        $district = District::find($request->districtId);
        $district->division_id = $request->division_id;
        $district->districtName = $request->districtName;
        $district->banglaName = $request->banglaName;
        $district->website = $request->website;
        $district->save();
        
        return redirect('admin/district-manage')->with('message', 'District Info updated Successfully!');
    }
    
    public function districtWiseUpazilas($id) {
        
        $district = District::where('id', $id)->first();
        
        $upazilas = Upazila::where('district_id', $id)->paginate(10);
        
        return view('admin.district.showUpazilas', ['district' => $district, 'upazilas' => $upazilas]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $district = District::find($id);
        $district->delete();
        return redirect('admin/district-manage')->with('message', 'District info deleted successfully!');
    }
}
