<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Order;
use Throwable;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where("status", "due")->get();
        return view('admin.orders.home', compact('orders'));
    }

    public function confirmed(){
        $orders = Order::where("status", "confirmed")->get();
        return view('admin.orders.confirmed', compact('orders'));
    }

    public function cancelled(){
        $orders = Order::where("status", "cancelled")->get();
        return view('admin.orders.cancelled', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $get_order = Order::find($id);
        $shipping_details = unserialize($get_order->shipping_details);
        $cart_details = unserialize($get_order->cart_details);

?>
        <div class="row">
            <input type="hidden" name="id" value="<?php echo $get_order->id; ?>">
            <div class="col-md-5">
                <div class="card">
                    <div class="card bd-0">
                        <div class="card-header card-header-default bg-warning">
                            <strong>Shipping Details</strong>
                        </div><!-- card-header -->
                        <div class="card-body bd bd-t-0">
                            <!-- Section one -->
                            <div class="row">
                                <div class="col-5">
                                    <div class="row">
                                        <div class="col-6">
                                            <strong>Order_ID</strong>
                                        </div>
                                        <div class="col-6">
                                            <p>
                                                <?php
                                                    echo $get_order->order_id;
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="row">
                                        <div class="col-5 text-right">
                                            <strong>Order Date/Time</strong>
                                        </div>
                                        <div class="col-7">
                                            <p>
                                                <?php
                                                    echo $get_order->created_at;
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- section two -->
                            <div class="row">
                                <div class="col-3">
                                    <strong>Customer Name</strong>
                                </div>
                                <div class="col-9">
                                    <p>
                                        <?php
                                            echo $shipping_details['first_name']."&nbsp;".$shipping_details['last_name'];
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <strong>Phone Number</strong>
                                </div>
                                <div class="col-9">
                                    <p>
                                        <?php
                                            echo $shipping_details['phone'];
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <strong>Email</strong>
                                </div>
                                <div class="col-9">
                                    <p>
                                        <?php
                                            echo $shipping_details['email'];
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <strong>Company Name</strong>
                                </div>
                                <div class="col-9">
                                    <p>
                                        <?php
                                            echo $shipping_details['company_name'];
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <strong>Address</strong>
                                </div>
                                <div class="col-9">
                                    <p>
                                        <?php
                                            echo (
                                                $shipping_details['house'].",".
                                                $shipping_details['street'].",".
                                                $shipping_details['city'].",".
                                                $shipping_details['state'].",".
                                                $shipping_details['country']
                                            );
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <strong>Post Code</strong>
                                </div>
                                <div class="col-9">
                                    <p>
                                        <?php
                                            echo $shipping_details['postcode'];
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <strong>Shipping Address</strong>
                                </div>
                                <div class="col-9">
                                    <p>
                                        <?php
                                            echo $shipping_details['shipping_address'];
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <strong>Order Notes</strong>
                                </div>
                                <div class="col-9">
                                    <p>
                                        <?php
                                            echo $shipping_details['notes'];
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div><!-- card-body -->
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="card bd-0">
                            <div class="card-header card-header-default bg-teal">
                                <strong>Cart Summery</strong>
                            </div><!-- card-header -->
                            <div class="card-body bd bd-t-0">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Product Image</th>
                                            <th class="text-center">Product Name</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Unit Price</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            foreach($cart_details->items as $item){
                                                ?>
                                                <tr class="text-center">
                                                    <td><?php echo $i++; ?></td>
                                                    <td>
                                                        <img src="<?php echo url('/storage/products/'.$item['item']['main_thumbnail']); ?>" 
                                                        alt="product_image" 
                                                        style="width:30px;"
                                                        >
                                                    </td>
                                                    <td class="text-left">
                                                        <?php
                                                            echo mb_strimwidth($item['item']['product_name'], "0", "30", "...");
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            echo $item['qty'];
                                                        ?>
                                                    </td>
                                                    <td>$
                                                        <?php
                                                            echo $item['item']['price'];
                                                        ?>
                                                    </td>
                                                    <td>$
                                                        <?php
                                                            echo $item['price'];
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <th colspan="5" class="text-center">Total</th>
                                        <th class="text-center">$
                                            <?php
                                                echo $cart_details->totalPrice;
                                            ?>
                                        </th>
                                    </tfoot>
                                </table>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="card bd-0">
                            <div class="card-header card-header-default bg-info">
                                <strong>Payment Summery</strong>
                            </div><!-- card-header -->
                            <div class="card-body bd bd-t-0">
                                <?php
                                    if($get_order->payment_method == "Stripe"){
                                ?>
                                    <div class="row">
                                        <div class="col-3">
                                            <p>
                                                <strong>Payment Method:</strong>&nbsp;
                                            </p>
                                        </div>
                                        <div class="col-9">
                                            <p>
                                                <?php echo $get_order->payment_method; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <p>
                                                <strong>Transection ID:</strong>&nbsp;
                                            </p>
                                        </div>
                                        <div class="col-9">
                                            <?php echo $get_order->charge_id; ?>
                                        </div>
                                    </div>
                                <?php
                                    }else{
                                ?>
                                    <div class="row">
                                         <div class="col-3">
                                            <p>
                                                <strong>Payment Method:</strong>&nbsp;
                                            </p>
                                        </div>
                                        <div class="col-9">
                                            Cash on delivery
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="col-3">
                                            <p>
                                                <strong>Delivery Charge:</strong>&nbsp;
                                            </p>
                                        </div>
                                        <div class="col-9">
                                            <p>$2</p>
                                        </div>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div>
                </div>
            </div>
        </div>
<?php
        if($get_order->status == "due"){
?>
        <div class="modal-footer px-0">
            <button type="submit" class="btn btn-teal" name="confirm" value="confirmed">
                <i class="fa fa-check-circle"></i>&nbsp;Confirm This Order
            </button>
            <button type="submit" class="btn btn-warning" name="cancel" value="cancelled">
                <i class="fa fa-times-circle"></i>&nbsp;Cancel This Order
            </button>
        </div>
<?php
        }
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
        $order_id = $request->id;


        if($request->confirm == "confirmed"){
            $data = [
                'status' => $request->confirm
            ];

            try{
                Order::where("id", $order_id)->update($data);

                $notification=[
                    'message'   =>  "Order has been confirmed",
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
        }elseif($request->cancel == "cancelled"){
            $data = [
                'status' => $request->cancel
            ];

            try{
                Order::where("id", $order_id)->update($data);

                $notification=[
                    'message'   =>  "Order has been cancelled",
                    'alert-type'    =>  'warning'
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
        //
    }
}
