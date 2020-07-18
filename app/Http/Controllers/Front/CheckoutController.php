<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Cart;
use Session;
use Auth;
use App\Model\Order;
use App\Model\UniqueId;
use Throwable;

class CheckoutController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        if(!Session::has('cart')){
            return redirect()->back();
        }else{
            return view('front.pages.checkout');
        }
    }

    public function checkout(Request $request){
        if(!Session::has('cart')){
            return redirect()->back();
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $shipping_details = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'street' => $request->street,
            'house' => $request->house,
            'postcode' => $request->postcode,
            'email' => $request->email,
            'phone' => $request->phone,
            'shipping_address' => $request->shipping_address,
            'notes' => $request->notes
        ];

        $data = [
            'order_id' => UniqueId::AlphaNumeric(6),
            'customer_id' => Auth::user()->id,
            'shipping_details' => serialize($shipping_details),
            'cart_details' => serialize($cart),
            'payment_method' => $request->checkout_payment_method   
        ];

        if($request->checkout_payment_method == "stripe"){
            Session::put('shipping_details', $shipping_details);
            return view("front.pages.stripe");
        }else{
            if(Order::create($data)){
                Session::forget('cart');
                return view('front.pages.success');
            }
        }
    }

    public function stripe(Request $request){
        if(Session::has('shipping_details')){
            try{
                // Set your secret key. Remember to switch to your live secret key in production!
                // See your keys here: https://dashboard.stripe.com/account/apikeys
                \Stripe\Stripe::setApiKey('sk_test_51Gtc5dAA7ioGcAgnf3ZW8rH9oUGh7YA6R9ZIliootAHGQkwlAj7BQOOLxTbRctfmFA1DSdUVlW0r7NsWmA8BLAdC00GjqOkzxk');

                // Token is created using Stripe Checkout or Elements!
                // Get the payment token ID submitted by the form:
                $token = $request->stripeToken;
                $charge = \Stripe\Charge::create([
                    'amount' => Session::get('cart')->totalPrice * 100,
                    'currency' => 'usd',
                    'description' => 'Example charge',
                    'source' => $token,
                ]);

                if($charge->status == "succeeded"){
                    if(!Session::has('cart')){
                        return redirect()->back();
                    }

                    $oldCart = Session::get('cart');
                    $cart = new Cart($oldCart);

                    $customer_data = Session::get('shipping_details');
                    $shipping_details = [
                        'first_name' => $customer_data['first_name'],
                        'last_name' => $customer_data['last_name'],
                        'company_name' => $customer_data['company_name'],
                        'country' => $customer_data['country'],
                        'state' => $customer_data['state'],
                        'city' => $customer_data['city'],
                        'street' => $customer_data['street'],
                        'house' => $customer_data['house'],
                        'postcode' => $customer_data['postcode'],
                        'email' => $customer_data['email'],
                        'phone' => $customer_data['phone'],
                        'shipping_address' => $customer_data['shipping_address'],
                        'notes' => $customer_data['notes']
                    ];

                    $data = [
                        'order_id' => UniqueId::AlphaNumeric(6),
                        'customer_id' => Auth::user()->id,
                        'shipping_details' => serialize($shipping_details),
                        'cart_details' => serialize($cart),
                        'payment_method' => 'Stripe',
                        'charge_id' => $charge->id
                    ];

                    if(Order::create($data)){
                        Session::forget('shipping_details');
                        Session::forget('cart');
                        return view('front.pages.success');
                    }else{
                        $notification=[
                            'message'   =>  'Somthing went wrong. Please try again!!!',
                            'alert-type'    =>  'warning'
                        ];

                        return route('shopping.cart')->with($notification);
                    }
                }else{
                    $notification=[
                        'message'   =>  'Your payment was not succeeded! Please check your Stripe account',
                        'alert-type'    =>  'warning'
                    ];

                    return redirect()->back()->with($notification);
                }
            }catch(Throwable $e){
                return redirect()->route('checkout')->with('error', $e->getMessage());
            }
        }else{
            $notification=[
                'message'   =>  'Somthing went wrong. Please try again!!!',
                'alert-type'    =>  'warning'
            ];

            return route('shopping.cart')->with($notification);
        }
    }
}
