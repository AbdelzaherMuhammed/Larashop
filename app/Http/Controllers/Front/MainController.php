<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{

    public function index()
    {
        return view('front.index');
    }


    public function products()
    {
        $records = Product::all();
        return view('front.products', [
            'records' => $records,
            'cat' => 'All Products',
        ]);
    }

    public function sortProduct(Request $request)
    {
        $cat = $request->category_id;
        $records = Category::join('products', 'categories.id', 'products.category_id')
            ->where('categories.category_name', $cat)->get();

        return view('front.products', [
            'records' => $records,
            'cat' => $cat,
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->searchData;

        $records = Product::where('products.product_name', 'like', '%' . $search . '%')
            ->join('categories', 'categories.id', 'products.category_id')
            ->get();
        return view('front.products', [
            'records' => $records,
            'cat' => $search
        ]);
    }

    public function productCat(Request $request)
    {
        $category_id = $request->cat_id;
        $price = '';
        if ($category_id != "" && !empty($request->price)) {
//            echo "both are selected";
            $price = explode('-', $request->price);
            $start = $price[0];
            $end = $price[1];
            $records = Product::join('categories', 'categories.id', 'products.category_id')
                ->where('products.category_id', $category_id)
                ->where('products.product_price', '>=', $start)
                ->where('products.product_price', '<=', $end)
                ->get();

        } elseif (!empty($request->price)) {
//            echo "price is selected";
            $price = explode('-', $request->price);
            $start = $price[0];
            $end = $price[1];
            $records = Product::join('categories', 'categories.id', 'products.category_id')
////                  ->where('products.category_id' , $category_id)
                ->where('products.product_price', '>=', $start)
                ->where('products.product_price', '<=', $end)
                ->get();
        } elseif ($category_id != "") {
//            echo "category is selected";
            $records = Product::join('categories', 'categories.id', 'products.category_id')
                ->where('products.category_id', $category_id)
////                  ->where('products.product_price' , '>=' , $start)
////                  ->where('products.product_price' , '<=' , $end)
                ->get();
        } else {
             return "<h1 align='center'> Please select at least one filter from drop down </h1>";
        }
        if (count($records) == 0) {
            return "<h1 align='center'> No products found under this <b style='color: #ff0000'>" . $start . '-' . $end . "</b> price range</h1>";
        } else {
            return view('front.productsFilter', [
                'records' => $records,
                'cat' => $records[0]->category_name
            ]);
        }

    }

    public function details($id){
        $records = product::find($id);
        if(!empty($records) ){
            return view('front.details', compact('records'));
        }

        else{
            return view('front.products',[
                'records' => product::all(),
                'cat' => 'Product not found',
            ]);
        }
    }

    public function thankYou()
    {
        return view('front.thankyou');
    }


}
