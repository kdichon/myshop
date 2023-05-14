<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id = 0)
    {
        //
        if ($id != 0) {
            # code...
            $products = Product::where('category_id', $id)->orderBy('created_at', 'desc')->paginate(10);
        } else {
            # code...
            $products = Product::orderBy('created_at', 'desc')->paginate(10);
        }

        $categories = Category::orderBy('name', 'asc')->get();;

        return view('home', compact('products', 'categories'));
    }

    // Permet afficher le dtail du produit mais aussi les produits similiaires
    public function detail(Product $product)
    {
        # code...
        // $produit = Product::findorfail($product->product_id)->first();

        $products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(4)->get();

        // dd($products);
        return view('detail', compact('product', 'products'));
    }

    /****
     * Ajouter au caddie, Contrôler l'existence du produit, Mettre à jour les quantités
     */
    public function addToCart(Product $product)
    {
        # code...
        // On vérifie l'existence du produit dans le panier
        // Selectionner le produit $id qui appartient au user_id de la base Cart
        /****
         * 
        select * from Cart where user_id= ? and product_id = $product->product_id limit 0, 1
         */

        $cart = Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $product->product_id)
            ->first();

        if (isset($cart)) {
            dd($cart);

            // Update Cart SET quantity=$cart->quantity++ WHERE id = $cart->id
            Cart::where('id', $cart->id)->update([
                'quantity' => $cart->quantity++,
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
