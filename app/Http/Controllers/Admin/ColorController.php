<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Color;
use DB;

class ColorController extends Controller
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
        return view('admin.color.createColor');
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
            'colorName'=>'required',
            'publicationStatus' => 'required|not_in:2',
        ]);
        
        $color = new Color();
        $color->colorName = $request->colorName;
        $color->publicationStatus = $request->publicationStatus;
        $color->save();
        return redirect('admin/color-add')->with('message', 'Color save successfully!');
    }
    
    public function manageColor() {
        $colors = DB::table('colors')
                    ->select('colors.id', 'colors.colorName', 'colors.publicationStatus')
                    ->paginate(10);
        
        return view('admin.color.manageColor',['colors'=>$colors]);
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
        $colorById = Color::where('id',$id)->first();
        return view('admin.color.editColor')
                ->with('colorById', $colorById);
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
            'colorName'=>'required',
            'publicationStatus' => 'required|not_in:2',
        ]);
        
        $color = Color::find($request->colorId);
        $color->colorName = $request->colorName;
        $color->publicationStatus = $request->publicationStatus;
        $color->save();
        return redirect('admin/color-manage')->with('message', 'Color updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color = Color::find($id);
        $color->delete();
        return redirect('admin/color-manage')->with('message', 'color deleted successfully!');
    }
}
