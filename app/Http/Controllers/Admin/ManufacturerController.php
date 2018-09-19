<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SubCategory;
use App\Manufacturer;
use App\SubcategoryManufacturer;
use DB;

class ManufacturerController extends Controller
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
        return view('admin.manufacturer.createManufacturer');
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
            'manufacturerName'=>'required|unique:manufacturers',
            'publicationStatus' => 'required|not_in:2',
        ]);
        
        $manufacturer = new Manufacturer();
        
        $manufacturer->manufacturerName = $request->manufacturerName;
        $manufacturer->publicationStatus = $request->publicationStatus;
        $manufacturer->save();
        
        return redirect('admin/manufacturer-add')->with('message', 'Manufacturer info save successfully!');
        
    }
    
    public function manageManufacturer() {
        $manufacturers = DB::table('manufacturers')
                            ->select('manufacturers.id','manufacturers.manufacturerName','manufacturers.publicationStatus')
                            ->paginate(10);
        
        return view('admin.manufacturer.manageManufacturer',['manufacturers'=>$manufacturers]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function subCategories($id)
    {
        $manufacturerName = Manufacturer::where('id', $id)->first();
        
        $subCategories = DB::table('subcategory_manufacturers')
                                    ->join('sub_categories', 'subcategory_manufacturers.subcategory_id', '=', 'sub_categories.id')
                                    ->select('sub_categories.id','sub_categories.subCategoryName')
                                    ->where('subcategory_manufacturers.manufacturer_id', '=', $id)
                                    ->paginate(10);
        
        return view('admin.manufacturer.showSubcategories',['subCategories'=>$subCategories, 'manufacturerName' => $manufacturerName]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manufacturerById = Manufacturer::where('id',$id)->first();
        return view('admin.manufacturer.editManufacturer')
                ->with('manufacturerById', $manufacturerById);
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
            'manufacturerName'=>'required',
            'publicationStatus' => 'required|not_in:2',
        ]);
        
        $manufacturer = Manufacturer::find($request->manufacturerId);
        
        $manufacturer->manufacturerName = $request->manufacturerName;
        $manufacturer->publicationStatus = $request->publicationStatus;
        $manufacturer->save();
        
        return redirect('admin/manufacturer-manage')->with('message', 'Manufacturer info Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manufacturer = Manufacturer::find($id);
        $manufacturer->delete();
        return redirect('admin/manufacturer-manage')->with('message', 'Manufacturer info deleted successfully!');
    }
}
