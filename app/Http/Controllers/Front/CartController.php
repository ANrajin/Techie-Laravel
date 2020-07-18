<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Product;
use App\Model\Cart;
use Session;

class CartController extends Controller
{
    /**
     * view products of cart
     */
    public function cart(){
        if(Session::has('cart')){
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);

            $products = $cart->items;
            $totalPrice = $cart->totalPrice;

            return view("front.pages.cart", compact('products'));
        }else{
            return view("front.pages.cart");
        }
    }


    /**
     * add items to the cart
     */
        public function addToCart(Request $request, $id){
        $product = Product::find($id);

        //if cart already exist
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);
        $cart->addItem($product, $product->id);
        $request->session()->put('cart', $cart);

        return redirect()->back();
    }


    /**
     * update whole cart
     */
    public function updateQty(Request $request){
        //remove cart from session
        if(Session::has('cart')){
            Session::forget('cart');
        }
        
        $id = $request->item_id;
        $qty = $request->qty;
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        for ($i=0; $i <count($id) ; $i++) {
            $product = Product::find($id[$i]); 
            $cart->update($id[$i], $product, $qty[$i]);
        }

        Session::put('cart', $cart);
        return redirect()->back();
    }


    /**
     * destroy single item from cart
     */
    public function destroy($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);
        $cart->remove($id);

        if($cart->totalQty <= 0){
            session()->forget('cart');
        }else{
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }


    /**
     * destroy the whole shopping cart
     */
    public function cart_destroy(){
        if(Session::has('cart')){
            Session::forget('cart');
        }
        return redirect()->back();
    }

}
