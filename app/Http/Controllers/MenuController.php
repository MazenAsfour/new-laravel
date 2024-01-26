<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Response;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        // Load products for the first category by default
        $selectedCategoryId = $categories->first()->id;
        $selectedCategoryProducts = Product::where('category_id', $selectedCategoryId)->get();

        return view('menu', compact('categories', 'selectedCategoryProducts'));
    }

    public function showMenu()
    {
        $categories = Category::all();
    
        // Load products for the first category by default
        $selectedCategoryId = $categories->first()->id;
        $selectedCategoryProducts = Product::where('category_id', $selectedCategoryId)->get();
    
        return view('menu', compact('categories', 'selectedCategoryProducts'));
    }

    public function getProducts(Category $category)
    {
    $products = Product::where('category_id', $category->id)->get();

    return Response::json($products);
    
     }

}