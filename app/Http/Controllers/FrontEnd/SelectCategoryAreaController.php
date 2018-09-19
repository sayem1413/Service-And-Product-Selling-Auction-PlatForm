<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Category;
use App\SubCategory;
use App\Manufacturer;
use App\SubcategoryManufacturer;
use App\Division;
use App\District;
use App\Upazila;
use App\Color;
use App\User;
use DB;

class SelectCategoryAreaController extends Controller
{
    
    public function categorySelect() {
        $categories = Category::all();
        $divisions = Division::all();
        return view('frontEnd.postAd.categorySelect', ['categories' => $categories, 'divisions' => $divisions]);
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
