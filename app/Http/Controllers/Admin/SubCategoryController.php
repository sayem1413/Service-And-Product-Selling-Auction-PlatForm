<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\SubCategory;
use App\Manufacturer;
use App\SubcategoryManufacturer;
use DB;

class SubCategoryController extends Controller
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
        $categories = Category::where('publicationStatus', 1)->get();
        
        return view('admin.subCategory.createSubCategory', ['categories' => $categories]);
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
            'subCategoryName'=>'required',
            'categoryId'=>'required|not_in:0',
            'publicationStatus' => 'required|not_in:2',
        ]);
        $subCategory = new SubCategory();
        $subCategory->subCategoryName = $request->subCategoryName;
        $subCategory->category_id = $request->categoryId;
        $subCategory->publicationStatus = $request->publicationStatus;
        $subCategory->save();
        
        return redirect('admin/sub-category-add')->with('message', 'Sub-Category info save successfully!');
    }
    
    public function manageSubCategory() {
        $subCategories = DB::table('sub_categories')
                            ->join('categories', 'sub_categories.category_id', '=' ,'categories.id')
                            ->select('sub_categories.id','sub_categories.subCategoryName','categories.categoryName','sub_categories.publicationStatus')
                            ->paginate(10);
        
        return view('admin.subCategory.manageSubCategory',['subCategories'=>$subCategories]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manufacturers($id)
    {
        $subCategoryName = SubCategory::where('id', $id)->first();
        
        $manfacturers = DB::table('subcategory_manufacturers')
                                    ->join('manufacturers', 'subcategory_manufacturers.manufacturer_id', '=', 'manufacturers.id')
                                    ->select('manufacturers.id','manufacturers.manufacturerName')
                                    ->where('subcategory_manufacturers.subcategory_id', '=', $id)
                                    ->paginate(10);
        
        return view('admin.subCategory.showManufacturers',['manfacturers'=>$manfacturers, 'subCategoryName' => $subCategoryName]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::where('publicationStatus', 1)->get();
        $subCategoryById = SubCategory::where('id',$id)->first();
        return view('admin.subCategory.editSubCategory')
                ->with('subCategoryById', $subCategoryById)
                ->with('categories', $categories);
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
            'subCategoryName'=>'required',
            'categoryId'=>'required|not_in:0',
            'publicationStatus' => 'required|not_in:2',
        ]);
        $subCategory = SubCategory::find($request->subCategoryId);
        $subCategory->subCategoryName = $request->subCategoryName;
        $subCategory->category_id = $request->categoryId;
        $subCategory->publicationStatus = $request->publicationStatus;
        $subCategory->save();
        
        return redirect('admin/sub-category-manage')->with('message', 'Sub-Category info update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subCategory = SubCategory::find($id);
        $subCategory->delete();
        return redirect('admin/sub-category-manage')->with('message', 'Sub-Category info deleted successfully!');
    }
}
