<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Category;
use App\Product;
use App\products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Product::all();
        return view('admin.products.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'product_name' => 'required',
            'product_code' => 'required',
            'product_info' => 'required',
            'product_price' => 'required|numeric',
            'category_id' => 'required',
        ];

        $this->validate($request , $rules );

        $records = Product::create($request->all());
        //photo by default will be img
        $records->product_image = "img.jpg";
        $records->save();

        if ($records){
            echo "done";
        }else{
            echo "error";
        }


    }

    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show()
    {
        $records = Product::with('category')->get();
        return view('admin.products.show',compact('records'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {

        $records = Product::findOrFail($id);
        return view('admin.products.edit', compact('records'));
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
        $rules = [
            'product_name' => 'required',
            'product_code' => 'required',
            'product_info' => 'required',
            'product_price' => 'required|numeric',
            'product_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required',
        ];

        $this->validate($request , $rules );

        $records = Product::findOrFail($id);
        $records->update($request->all());
        if ($records){
            echo "done";
        }else{
            echo "error";
        }
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

    public function changeImage()
    {
        return view('admin.products.change-image');
    }


    public function uploadImage(Request $request )
    {
        $rules = [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        $this->validate($request , $rules );

        $pic = $request->file('image');
        $fileName = time(). '' .rand().$pic->getClientOriginalName();
        $path = 'images';
        $pic->move($path , $fileName);
        $id = $request->id;
        $record = Product::whereId($id)->update(['product_image' => $fileName]);

        if($record){
           return redirect(route('products.edit' , $id));
        }else{
            echo "error";
        }

    }

    public function sortProduct(Request $request , $id)
    {
        $cat = $request->category_id;
        return Product::join('categories' , 'categories.id' , 'products.category_id')
            ->where('categories.category_name' , $cat)->get();

    }

}
