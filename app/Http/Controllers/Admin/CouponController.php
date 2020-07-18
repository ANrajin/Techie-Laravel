<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;
use DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = DB::table('coupon')->get();
        return view('admin.coupons.home', compact('coupons'));
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
            'coupon_name' => 'required|max:50',
            'coupon_code' => 'required|max:50',
            'discount' => 'required'
        ];

        $messages = [
            'coupon_name.required' => 'Please insert a coupon name',
            'coupon_name.max' => 'Cannot insert more than 50 characters'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $data=[
                'coupon_name' => $request->coupon_name,
                'coupon_code' => $request->coupon_code,
                'discount' => $request->discount,
                'details' => $request->details
            ];

            try{
                DB::table('coupon')->insert($data);

                $notification=[
                    'message'   =>  "New Coupon added successfully",
                    'alert-type'    =>  'success'
                ];

                return redirect()->back()->with($notification);

            }catch(Throwable $e){
                $notification=[
                    'message'   =>  $e->getMessage(),
                    'alert-type'    =>  'warning'
                ];

                return redirect()->back()->with($notification);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coupon = DB::table('coupon')->where('id', '=', $id)->get();

        return json_encode($coupon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'coupon_name' => 'required|max:50',
            'coupon_code' => 'required|max:50',
            'discount' => 'required'
        ];

        $messages = [
            'coupon_name.required' => 'Please insert a coupon name',
            'coupon_name.max' => 'Cannot insert more than 50 characters'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $data=[
                'coupon_name' => $request->coupon_name,
                'coupon_code' => $request->coupon_code,
                'discount' => $request->discount,
                'details' => $request->details
            ];

            try{
                DB::table('coupon')->where('id', $request->id)->update($data);

                $notification=[
                    'message'   =>  "Coupon updated successfully",
                    'alert-type'    =>  'success'
                ];

                return redirect()->back()->with($notification);

            }catch(Throwable $e){
                $notification=[
                    'message'   =>  $e->getMessage(),
                    'alert-type'    =>  'warning'
                ];

                return redirect()->back()->with($notification);
            }
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
        if(DB::table('coupon')->where('id', $id)->delete()){
            echo "DELETED";
        };
    }
}
