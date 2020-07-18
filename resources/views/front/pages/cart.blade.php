@extends('front.layouts.app')

@section('content')
    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="">Home</a>
                    <svg class="breadcrumb-arrow" width="6px" height="9px">
                        <use
                        xlink:href="images/sprite.svg#arrow-rounded-right-6x9"
                        ></use>
                    </svg>
                    </li>
                    <li class="breadcrumb-item">
                    <a href="#">Breadcrumb</a>
                    <svg class="breadcrumb-arrow" width="6px" height="9px">
                        <use
                        xlink:href="images/sprite.svg#arrow-rounded-right-6x9"
                        ></use>
                    </svg>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                    Shopping Cart
                    </li>
                </ol>
                </nav>
            </div>
        </div>
    </div>
    @if (!Session::has('cart'))
        <div class="py-5">
            <h1 class="text-center">
                Your cart is currently empty!!!
            </h1>
            <div class="d-flex justify-content-center">
              <a href="{{URL::to('/')}}" class="btn btn-primary my-3">Back To The Shop</a>
            </div>
        </div>
    @else
        <div class="page-header__container container">
            <div class="page-header__title"><h1>Shopping Cart</h1></div>
        </div>
        <div class="cart block">
          <div class="container">
            <table class="cart__table cart-table">
              <thead class="cart-table__head">
                <tr class="cart-table__row">
                  <th class="cart-table__column cart-table__column--image">
                    Image
                  </th>
                  <th class="cart-table__column cart-table__column--product">
                    Product
                  </th>
                  <th class="cart-table__column cart-table__column--price">
                    Price
                  </th>
                  <th class="cart-table__column cart-table__column--quantity">
                    Quantity
                  </th>
                  <th class="cart-table__column cart-table__column--total">
                    Total
                  </th>
                  <th
                    class="cart-table__column cart-table__column--remove"
                  ></th>
                </tr>
              </thead>
              <tbody class="cart-table__body">
                <form action="{{route('qty.update')}}" method="post" id="updateCart">
                  @csrf
                    @foreach ($products as $product)
                      <tr class="cart-table__row">
                        <td class="cart-table__column cart-table__column--image">
                            <a href="#"
                            ><img src="{{asset('storage/products/'.$product['item']['main_thumbnail'])}}" alt=""
                            /></a>
                        </td>
                        <td class="cart-table__column cart-table__column--product">
                            <a href="#" class="cart-table__product-name">
                                {{$product['item']['product_name']}}
                            </a>
                        </td>
                        <td
                            class="cart-table__column cart-table__column--price"
                            data-title="Price"
                        >
                            ${{$product['item']['price']}}
                        </td>
                        <td
                            class="cart-table__column cart-table__column--quantity"
                            data-title="Quantity"
                        >
                            <div class="input-number">
                                <input
                                    class="form-control input-number__input"
                                    type="number"
                                    min="1"
                                    value="{{$product['qty']}}"
                                    max="5"
                                    name="qty[]"
                                />
                                <div class="input-number__add"></div>
                                <div class="input-number__sub"></div>

                                <input type="hidden" name="item_id[]" value="{{$product['item']['id']}}">
                            </div>
                        </td>
                        <td
                            class="cart-table__column cart-table__column--total"
                            data-title="Total"
                        >
                            ${{($product['item']['price']) * ($product['qty'])}}
                        </td>
                        <td class="cart-table__column cart-table__column--remove">
                            <button
                            type="button"
                            class="btn btn-light btn-sm item_delete"
                            data-id="{{$product['item']['id']}}"
                            >
                            <i class="fa fa-trash"></i>
                            </button>
                        </td>
                      </tr>
                    @endforeach
                </form>
              </tbody>
            </table>
            <div class="cart__actions">
              <form class="cart__coupon-form">
                <label for="input-coupon-code" class="sr-only">Password</label>
                <input
                  type="text"
                  class="form-control"
                  id="input-coupon-code"
                  placeholder="Coupon Code"
                />
                <button type="submit" class="btn btn-primary">
                  Apply Coupon
                </button>
              </form>
              <div class="cart__buttons">
                <a href="{{URL::to('/')}}" class="btn btn-light">Continue Shopping</a>
                <button class="btn btn-primary cart__update-button"
                onclick="event.preventDefault(); document.getElementById('updateCart').submit();"
                >
                  Update Cart
                </button>
                <button class="btn btn-danger cart__update-button"
                onclick="event.preventDefault(); document.getElementById('clearCart').submit();"
                >
                  Clear Cart
                </button>
                <form action="{{route("cart.destroy")}}" method="post" id="clearCart">@csrf @method('delete')</form>
              </div>
            </div>
            <div class="row justify-content-end pt-5">
              <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Cart Totals</h3>
                    <table class="cart__totals">
                      <thead class="cart__totals-header">
                        <tr>
                          <th>Subtotal</th>
                          <td>${{Session::get('cart')->totalPrice}}</td>
                        </tr>
                      </thead>
                      {{-- <tbody class="cart__totals-body">
                        <tr>
                          <th>Shipping</th>
                          <td>
                            $25.00
                            <div class="cart__calc-shipping">
                              <a href="#">Calculate Shipping</a>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <th>Tax</th>
                          <td>$0.00</td>
                        </tr>
                      </tbody> --}}
                      <tfoot class="cart__totals-footer">
                        <tr>
                          <th>Total</th>
                          <td>${{Session::get('cart')->totalPrice}}</td>
                        </tr>
                      </tfoot>
                    </table>
                    <a
                      class="btn btn-primary btn-xl btn-block cart__checkout-button"
                      href="{{route('checkout')}}"
                      >Proceed to checkout</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    @endif
@endsection