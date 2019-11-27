<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;


use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status'    =>  true,
            'data'      =>  Product::all()
        ], 200);
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
        $validator = Validator::make($request->all(), [
            'name' => 'string|required|max:255',
            'description' => 'string',
            'price' =>  'numeric|required',
            'stock'  =>  'numeric|required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  $validator->errors()
            ], 500);
        }

        $model = new Product;
        $model->name = $request->input('name');
        $model->description = $request->input('description');
        $model->price = $request->input('price');
        $model->stock = $request->input('stock');
        $model->save();

        return response()->json([
            'status'    =>  true,
            'data'      =>  $model
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Product::find($id);

        if($data) {
            return response()->json([
                'status'    =>  true,
                'data'      =>  $data
            ], 200);
        }
        
        return response()->json([
            'status'    =>  false,
            'message'   =>  'data not found'
        ], 404);
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
        $model = Product::find($id);

        if($model) {
            $validator = Validator::make($request->all(), [
                'name' => 'string|required|max:255',
                'description' => 'string',
                'price' =>  'numeric|required',
                'stock'  =>  'numeric|required'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  $validator->errors()
                ], 500);
            }
            
            $model->name = $request->input('name');
            $model->description = $request->input('description');
            $model->price = $request->input('price');
            $model->stock = $request->input('stock');
            $model->save();

            return response()->json([
                'status'    =>  true,
                'data'      =>  $model
            ], 200);
        }

        return response()->json([
            'status'    =>  false,
            'message'   =>  'data not found'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::find($id);

        if($data) {
            $data->delete();
            return response()->json([
                'status'    =>  true,
                'message'   =>  'data deleted successfully'
            ], 200);
        }
        
        return response()->json([
            'status'    =>  false,
            'message'   =>  'data not found'
        ], 404);
    }
}
