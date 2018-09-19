<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SubCategory;
use App\Manufacturer;
use App\SubcategoryManufacturer;
use DB;

class SubcategoryManufacturerController extends Controller
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
        $subCategories = SubCategory::where('publicationStatus', 1)->get();
        $manufacturers = Manufacturer::where('publicationStatus', 1)->get();
        return view('admin.subCategoryManufacturer.createSubCategoryManufacturer', ['subCategories' => $subCategories, 'manufacturers' => $manufacturers]);
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
            'subcategory_id'=>'required|not_in:0',
            'manufacturer_id'=>'required|not_in:0',
        ]);
        
        $subCategoriyManufacturer = new SubcategoryManufacturer();
        $subCategoriyManufacturer->subcategory_id = $request->subcategory_id;
        $subCategoriyManufacturer->manufacturer_id = $request->manufacturer_id;
        $subCategoriyManufacturer->save();
        
        return redirect('admin/subcategorymanufacturer-add')->with('message','Sub-Category wise manufacturer info save successfully!');
    }
    
    public function manageSubCategoryAndManufacturer() {
        $subCategoryManfacturers = DB::table('subcategory_manufacturers')
                                    ->join('sub_categories', 'subcategory_manufacturers.subcategory_id', '=', 'sub_categories.id')
                                    ->join('manufacturers', 'subcategory_manufacturers.manufacturer_id', '=', 'manufacturers.id')
                                    ->select('subcategory_manufacturers.id','sub_categories.subCategoryName','manufacturers.manufacturerName')
                                    ->paginate(10);
        
        return view('admin.subCategoryManufacturer.manageSubCategoryManufacturer',['subCategoryManfacturers'=>$subCategoryManfacturers]);
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
        $subCategories = SubCategory::where('publicationStatus', 1)->get();
        $manufacturers = Manufacturer::where('publicationStatus', 1)->get();
        $subCategoryManufacturerById = SubcategoryManufacturer::where('id', $id)->first();
        return view('admin.subCategoryManufacturer.editSubCategoryManufacturer', ['subCategories' => $subCategories, 'manufacturers' => $manufacturers, 'subCategoryManufacturerById' => $subCategoryManufacturerById]);
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
            'subcategory_id'=>'required|not_in:0',
            'manufacturer_id'=>'required|not_in:0',
        ]);
        
        $subCategoriyManufacturer = SubcategoryManufacturer::find($request->subCategoryManufacturerId);
        $subCategoriyManufacturer->subcategory_id = $request->subcategory_id;
        $subCategoriyManufacturer->manufacturer_id = $request->manufacturer_id;
        $subCategoriyManufacturer->save();
        
        return redirect('admin/subcategorymanufacturer-manage')->with('message','Sub-Category wise manufacturer info updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subCategoryManfacturer = SubcategoryManufacturer::find($id);
        $subCategoryManfacturer->delete();
        return redirect('admin/subcategorymanufacturer-manage')->with('message', 'Relatonal information deleted successfully!');
    }
}
