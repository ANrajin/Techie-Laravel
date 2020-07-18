<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use DB;

class ShowProductController extends Controller
{
    public function index($id){
        $product = Product::find($id);
?>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Details</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!-- ################################## -->
                <!-- Product details Tab -->
                <!-- ################################## -->
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row py-3">
                        <div class="col-md-5">
                            <img style="width: 300px;" src="<?php echo url('/storage/products/'.$product->main_thumbnail); ?>" alt="image">
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Product SKU:</strong> &nbsp;
                                </div>
                                <div class="col-md-8">
                                    <p><?php echo $product->product_sku; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Product Name:</strong> &nbsp;
                                </div>
                                <div class="col-md-8">
                                    <p><?php echo $product->product_name; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Product Category:</strong> &nbsp;
                                </div>
                                <div class="col-md-8">
                                    <p><?php echo $product->category->name; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Product Brand:</strong> &nbsp;
                                </div>
                                <div class="col-md-8">
                                    <p><?php echo ($product->brand_id)? $product->brand->name : 'undefined'; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Selling Price:</strong> &nbsp;
                                </div>
                                <div class="col-md-8">
                                    <p>$<?php echo $product->price; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Stock:</strong> &nbsp;
                                </div>
                                <div class="col-md-8">
                                    <p class="<?php echo ($product->status)? "text-success" : "text-danger"; ?>">
                                        <?php echo ($product->status)? $product->quantity : "Out of Stock"; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <?php 
                            $data = DB::table('product_images')->where('product_id', $product->id)->get();
                            foreach($data as $image){
                        ?>
                                <div class="col-md-4">
                                    <img style="width: 150px;" src="<?php echo url('/storage/products/'.$image->images); ?>" alt="image">
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <!-- ################################## -->
                <!-- Product Description Tab -->
                <!-- ################################## -->
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row py-3">
                        <div class="col-md-12">
                            <?php echo $product->details; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    }
}
