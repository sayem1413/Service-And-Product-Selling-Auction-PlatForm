<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\SubCategory;
use DB;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller {

    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.category.createCategory');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->validate($request, [
            'categoryName' => 'required',
            'categoryDescription' => 'required',
            'publicationStatus' => 'required|not_in:2',
        ]);

        if ($request->hasFile('categoryImage')) {
            $categoryImage = $request->file('categoryImage');
            $imageName = time().'.'. $categoryImage->getClientOriginalName();
            $uploadPath = 'public/images/categoryImage/';
            Image::make($categoryImage)->resize(90,90);
            $categoryImage->move($uploadPath, $imageName);
            $imageUrl = $uploadPath . $imageName;
            $this->saveCategoryInfoWithImage($request, $imageUrl);
        }
        else
        {
            $this->saveCategoryInfoWithOutImage($request);
        }
        
        return redirect('admin/category-add')->with('message', 'Category info save successfully!');
    }

    public function saveCategoryInfoWithImage($request, $imageUrl) {
        $category = new Category();
        $category->categoryName = $request->categoryName;
        $category->categoryDescription = $request->categoryDescription;
        $category->categoryImage = $imageUrl;
        $category->publicationStatus = $request->publicationStatus;
        $category->save();
    }
    
    public function saveCategoryInfoWithOutImage($request) {
        $category = new Category();
        $category->categoryName = $request->categoryName;
        $category->categoryDescription = $request->categoryDescription;
        $category->publicationStatus = $request->publicationStatus;
        $category->save();
    }

    public function manageCategory() {
        $categories = Category::all();
        return view('admin.category.manageCategory', ['categories' => $categories]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }
    
    
    public function categoryWiseSubCategories($id) {
        
        $category = Category::where('id', $id)->first();
        
        $subCategories = SubCategory::where('category_id', $id)->get();
        
        return view('admin.category.showSubCategories', ['category' => $category, 'subCategories' => $subCategories]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $categoryById = Category::where('id', $id)->first();
        return view('admin.category.editCategory', ['categoryById' => $categoryById]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $this->validate($request, [
            'categoryName' => 'required',
            'categoryDescription' => 'required',
            'publicationStatus' => 'required|not_in:2',
        ]);
        
        if ($request->hasFile('categoryImage')) {
            
            $imageUrl = $this->imageExistStatus($request);
            $this->updateCategoryInfoWithImage($request, $imageUrl);
        }
        else
        {
            $this->updateCategoryInfoWithOutImage($request);
        }

        return redirect('admin/category-manage')->with('message', 'Category info updated successfully!');
    }

    public function imageExistStatus($request) {
        $categoryById = Category::where('id', $request->categoryId)->first();
        $categoryImage = $request->file('categoryImage');
        $oldImage = $categoryById->categoryImage;
        if ($categoryImage) {
            if($oldImage){
                unlink($oldImage);
            }
            $imageName = time().'.'. $categoryImage->getClientOriginalName();
            $uploadPath = 'public/images/categoryImage/';
            Image::make($categoryImage)->resize(90,90);
            $categoryImage->move($uploadPath, $imageName);
            $imageUrl = $uploadPath . $imageName;
        } else {
            $imageUrl = $categoryById->categoryImage;
        }
        return $imageUrl;
    }

    public function updateCategoryInfoWithImage($request, $imageUrl) {
        $category = Category::find($request->categoryId);
        $category->categoryName = $request->categoryName;
        $category->categoryDescription = $request->categoryDescription;
        $category->categoryImage = $imageUrl;
        $category->publicationStatus = $request->publicationStatus;
        $category->save();
    }
    
    public function updateCategoryInfoWithOutImage($request) {
        $category = Category::find($request->categoryId);
        $category->categoryName = $request->categoryName;
        $category->categoryDescription = $request->categoryDescription;
        $category->publicationStatus = $request->publicationStatus;
        $category->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $category = Category::find($id);
        unlink($category->categoryImage);
        $category->delete();
        return redirect('admin/category-manage')->with('message', 'Category info deleted successfully!');
    }

}
