<?php

namespace App\Http\Controllers;

use App\Films;
use Illuminate\Http\Request;
Use Image;

class FilmsController extends Controller
{
    public function addProduct(Request $request){

        if($request->has('image')){


            $files = $request->file('image');
            $ImageUpload = Image::make($files);
            $originalPath = public_path('uploads/');
            $time = time();

            $ImageUpload->save($originalPath.$time.$files->getClientOriginalName());
            $image = $time.$files->getClientOriginalName();

        }
        $product = new Films();
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->image = (isset($image)) ? $image : $product->image;
        $product->store_id = $request->store_id;
        $product->on_discount = ($request->on_discount == 1 ) ? 1 : 0 ;


        $product->save();
        return response()->json(['status' => 'success','msg' => 'Product Added Successfully']);
    }
}
