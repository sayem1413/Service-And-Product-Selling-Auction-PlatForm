<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Category;
use App\SubCategory;
use App\Division;
use App\District;
use App\Upazila;
use DB;

class DropDownTestController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }
    
     public function dropDownShow(){
      $divisions = Division::all();
      $categories = Category::all();
         
      return view('admin.dropDownTest.dropDownJson', ['divisions' => $divisions, 'categories' => $categories]);
    }
    
    public function subcategories(){
      $category_id = Input::get('category_id');
      $subcategories = SubCategory::where('category_id', '=', $category_id)->get();
      return response()->json($subcategories);
    }
    
    public function districts(){
      $division_id = Input::get('division_id');
      $districts = District::where('division_id', '=', $division_id)->get();
      return response()->json($districts);
    }

    public function upazilas(){
      $district_id = Input::get('district_id');
      $upazilas = Upazila::where('district_id', '=', $district_id)->get();
      return response()->json($upazilas);
    }
}
