<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Catagory;

use App\Models\Product;

class AdminController extends Controller
{
    public function view_catagory()

    {
         $data= Catagory::all();

          return view('admin.catagory', compact('data'));
    }

    public function add_catagory(Request $request)

    {

         $data = new catagory;

         $data->catagory_name=$request->catagory;

         $data->save();


         return redirect()->back()->with('message', 'Catagory Added Successfuly');

    }

    public function delete_catagor($id)
    {

        $data=Catagory::find($id);
        $data->delete();

        return redirect()->back()->with('message', 'Catagory deleted Successfuly');

    }

    public function view_product()

    {
        $catacory=Catagory::all();
        return view('admin.product',compact('catacory'));
    }

    public function add_product(Request $request)

    {
        $product= new Product;
        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->discount_price;
        $product->catagory=$request->catagory;

        $image=$request->image;
        $imagename= time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);

        $product->image=$imagename;


        $product->save();

        return redirect()->back()->with('message', 'Product Added Successfully');

    }


    public function show_product()

    {
        $product=product::all();
        return view('admin.show_product', compact('product'));
    }


    public function delete_product($id)

    {

              $product=product::find($id);

              $product->delete();


              return redirect()->back()->with('message', 'product Deleted successfully');



    }

    public function update_product($id)




    {
        $product=Product::find($id);

        $catacory=Catagory::all();

        return view('admin.update_product', compact('product', 'catacory'));
    }

    public function update_product_confirm(Request $request, $id)

    {

        $product=Product::find($id);

        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->discount_price;
        $product->catagory=$request->catagory;


        $image=$request->image;

        if($image)
        {
            $imagename= time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);

        $product->image=$imagename;
        }


        $product->save();

        return redirect()->back()->with('message', 'Product Updated Successfully');


    }

}
