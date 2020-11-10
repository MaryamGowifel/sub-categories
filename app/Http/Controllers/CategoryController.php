<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('category')->where('parent_id','=', 0)->get();
        return view('welcome', ['categories' => $categories]);
       
    }

    public function show($id)
    {
        echo json_encode(DB::table('category')->where('parent_id', $id)->get());
    }

    public function showCategoryPage(){
        // $catNum=$_GET['category'];
        // $category = DB::table('category')->where('id','=', $catNum)->get('category_name');
        return view('done', ['category' => $category]);
    }

    public function back($id){
       $parent= DB::table('category')->where('id', $id)->get('parent_id')->pluck('parent_id');
       $gparent= DB::table('category')->where('parent_id',$parent)
                     ->get();
                    return $gparent;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,$name)
    {
         //validation
        //  $this->validate($name,[
        //     'category_name'=>'required'
        // ]);
            $arr=[$id,$name];
            $insert= DB::table('category')->insert([
            'category_name'=>$name,
            'parent_id'=>$id
        ]);
        return $arr;
    }
    public function newSubCategory($id,$name){
        $arr=[$id,$name];
        $insert= DB::table('category')->insert([
        'category_name'=>$name,
        'parent_id'=>$id
        ]);
        return $arr;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
