<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Model\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->get();
        return view('admin.brand.home', compact('brands'));
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
            'brand' => 'required|max:50'
        ];

        $messages = [
            'brand.required' => 'Please insert a brand name',
            'brand.max' => 'Cannot insert more than 50 characters'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $image = $request->file('pic');
            $newName = rand(99,1000) . '.' . $image->getClientOriginalExtension();
            $data = [
                'name' => ucfirst($request->brand),
                'details' => $request->details,
                'image' => $newName
            ];


            try {
                Brand::create($data);
                //store image into storage directory
                Storage::putFileAs('public/brands', $image, $newName);
    
                $notification=[
                    'message'   =>  'Data successfully added',
                    'alert-type'    =>  'success'
                ];
            } catch (Exception $e) {
                $notification=[
                    'message'   =>  'Something wrong happend',
                    'alert-type'    =>  'error'
                ]; 
            }
    
            return redirect()->back()->with($notification);
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
        $brand = Brand::find($id);
        return json_encode($brand);
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
        $brand = Brand::find($request->bId);
        $image = $request->file('picEdit');

        if($image){
            $newName = rand(99,1000) . '.' . $image->getClientOriginalExtension();

            $data = [
                'name' => $request->brandEdit,
                'details' => $request->detailsEdit,
                'image' => $newName
            ];
            
            try {
                Brand::where("id", $request->bId)->update($data);
                if(Storage::delete('public/brands/'.$brand->image) && Storage::putFileAs('public/brands', $image, $newName)){
                    $notification=[
                        'message'   =>  'Data successfully updated',
                        'alert-type'    =>  'success'
                    ];
                }
            } catch (Exception $e) {
                $notification=[
                    'message'   =>  'Something wrong happend',
                    'alert-type'    =>  'error'
                ]; 
            }
        }else{
            $data = [
                'name' => $request->brandEdit,
                'details' => $request->detailsEdit,
            ];

            Brand::where("id", $request->bId)->update($data);
            $notification=[
                'message'   =>  'Data successfully updated',
                'alert-type'    =>  'success'
            ];
        }
        
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);

        if(Storage::delete('public/brands/'.$brand->image) && Brand::where('id', $id)->delete()){
            return "Deleted";
        }else{
            return "Error happened";
        }
    }
}
