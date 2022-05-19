<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $categories = Category::where(function($qry) use($data){
            if($data['is_active']==1)
                $qry->where('is_active',1);
        })->paginate(10);
        
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $data['password']= "abcd";

        if(Category::create($data))
            return response(['status'=>"OK", "response"=>"Category created successfully"]);
        return response(['status'=>"ERROR", "response"=>"NO DATA FOUND"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { $category = Category::find($id);
        if(empty($category))
            return response(['status'=>"ERROR", "response"=>"NO DATA FOUND"]); 
        return response(['status'=>"OK", "category"=>new CategoryResource($category)]);
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
       
        $category = Category::find($id);
        if(empty($category))
            return response(['status'=>"ERROR", "response"=>"NO DATA FOUND"]); 
        $data = $request->all();
        if($category->update($data))
            return response(['status'=>"OK", "response"=>"Category updated successfully"]);
        return response(['status'=>"ERROR", "response"=>"NO DATA FOUND"]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if(empty($category))
            return response(['status'=>"ERROR", "response"=>"NO DATA FOUND"]); 
        if($category->delete())
            return response(['status'=>"OK", "response"=>"Category deleted successfully"]);
        return response(['status'=>"ERROR", "response"=>"NO DATA FOUND"]); 
    }

}
