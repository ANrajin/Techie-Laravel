<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Product;
use App\Model\ProductImages;
use App\Model\Category;
use App\Model\Brand;
use DB;
use Throwable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        $productImages = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->get();
        $categories = Category::all();
        $brands = Brand::all();
        return view("admin.products.home", compact('categories', 'brands', 'products', 'productImages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $temp_slug = preg_split("/[\s,-,\/]+/", $request->pName);
        $slug = implode("-", $temp_slug);

        //check if directory exist or not
        if (!Storage::exists("public/products")) {
            Storage::makeDirectory("public/products");
        }

        $pic1 = $request->file('pic1');
        $pic11 = rand(99, 1000) . '.' . $pic1->getClientOriginalExtension();

        $data = [
            'product_name' => $request->pName,
            'product_sku' => $request->sku,
            'category_id' => $request->pCat,
            'brand_id' => $request->pBrand,
            'quantity' => $request->pQty,
            'price' => $request->pPrice,
            'slug' => $slug,
            'is_featured' => $request->featured,
            'status' => $request->status,
            'details' => $request->summernote,
            'main_thumbnail' => $pic11
        ];

        $product = Product::create($data);
        //store image into storage directory
        Storage::putFileAs('public/products', $pic1, $pic11);

        if ($request->has('pic') && $product->id) {

            if (count($request->pic) < "5") {
                $files = $request->file('pic');

                foreach ($files as $file) {
                    $allowedfileExtension = ['jpeg', 'jpg', 'png', 'docx'];
                    $extension = $file->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension);

                    if ($check) {
                        $filename = rand(99, 1000) . '.' . $file->getClientOriginalExtension();

                        $pdata = [
                            'product_id' => $product->id,
                            'images' => $filename
                        ];

                        ProductImages::create($pdata);

                        //check if directory exist or not
                        if (!Storage::exists("public/products")) {
                            Storage::makeDirectory("public/products");
                        }

                        //store image into storage directory
                        Storage::putFileAs('public/products', $file, $filename);
                    };
                }
            } else {
                $notification = [
                    'message'   =>  'Maximum four image allowed',
                    'alert-type'    =>  'warning'
                ];
                return redirect()->back()->with($notification);
            }
        }

        $notification = [
            'message'   =>  'Data successfully added',
            'alert-type'    =>  'success'
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return json_encode($product);
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
        $temp_slug = preg_split("/[\s,-,\/]+/", $request->Edit_pName);
        $slug = implode("-", $temp_slug);

        if (!empty($request->Edit_pic1)) {
            $pic1 = $request->file('Edit_pic1');
            $pic11 = rand(99, 1000) . '.' . $pic1->getClientOriginalExtension();
        }

        $data = [
            'product_name' => $request->Edit_pName,
            'product_sku' => $request->Edit_sku,
            'category_id' => $request->Edit_pCat,
            'brand_id' => $request->Edit_pBrand,
            'quantity' => $request->Edit_pQty,
            'price' => $request->Edit_pPrice,
            'slug' => $slug,
            'is_featured' => $request->Edit_featured,
            'status' => $request->Edit_status,
            'details' => $request->Edit_summernote
        ];

        try {
            Product::where('id', $request->id)->update($data);

            $notification = [
                'message'   =>  'Data successfully updated',
                'alert-type'    =>  'success'
            ];

            return redirect()->back()->with($notification);
        } catch (Throwable $e) {
            $notification = [
                'message'   =>  $e->getMessage(),
                'alert-type'    =>  'warning'
            ];

            return redirect()->back()->with($notification);
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
        $product_img = ProductImages::where('product_id', $id)->get();

        foreach ($product_img as $img) {
            Storage::delete('public/products/' . $img->images);
        }

        Product::where('id', $id)->delete();
        $notification = [
            'message'   =>  'Data successfully deleted',
            'alert-type'    =>  'success'
        ];

        return redirect()->back()->with($notification);
    }
}
