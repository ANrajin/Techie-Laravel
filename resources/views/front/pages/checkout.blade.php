@extends('front.layouts.app')

@section('content')
    <div class="site__body">
        <div class="page-header">
          <div class="page-header__container container">
            <div class="page-header__breadcrumb">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="{{URL::to('/')}}">Home</a>
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
                    Checkout
                  </li>
                </ol>
              </nav>
            </div>
            <div class="page-header__title"><h1>Checkout</h1></div>
          </div>
        </div>
        <div class="checkout block">
          <div class="container">
            <form action="{{route('checkout')}}" method="post" id="checkout_form">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-6 col-xl-7">
                        <div class="card mb-lg-0">
                            <div class="card-body">
                                <h3 class="card-title">Billing details</h3>
                                <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="checkout-first-name">First Name</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="checkout-first-name"
                                    placeholder="First Name"
                                    name="first_name"
                                    required
                                    autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="checkout-last-name">Last Name</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="checkout-last-name"
                                    placeholder="Last Name"
                                    name="last_name"
                                    required
                                    autocomplete="off"
                                    />
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="checkout-company-name"
                                    >Company Name
                                    <span class="text-muted">(Optional)</span></label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="checkout-company-name"
                                    placeholder="Company Name"
                                    name="company_name"
                                />
                                </div>
                                <div class="form-group">
                                <label for="checkout-country">Country</label>
                                <select id="checkout-country" class="form-control" name="country" required
                                    ><option>Select a country...</option
                                    ><option>United States</option
                                    ><option>Russia</option
                                    ><option>Italy</option
                                    ><option>France</option
                                    ><option>Ukraine</option
                                    ><option>Germany</option
                                    ><option>Australia</option></select
                                >
                                </div>
                                <div class="form-group">
                                <label for="checkout-state">State / City</label>
                                <select id="checkout-country" class="form-control" name="state" required
                                    ><option>Select a State / City...</option
                                    ><option>United States</option
                                    ><option>Russia</option
                                    ><option>Italy</option
                                    ><option>France</option
                                    ><option>Ukraine</option
                                    ><option>Germany</option
                                    ><option>Australia</option></select
                                >
                                </div>
                                <div class="form-group">
                                <label for="checkout-city">Town / City</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="checkout-city"
                                    placeholder="Town / City Address"
                                    name="city"
                                    required
                                    autocomplete="off"
                                />
                                </div>
                                <div class="form-group">
                                <label for="checkout-street-address"
                                    >Street Address</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="checkout-street-address"
                                    placeholder="Street Address"
                                    name="street"
                                />
                                </div>
                                <div class="form-group">
                                <label for="checkout-address"
                                    >Apartment, suite, unit etc.
                                    <span class="text-muted">(Optional)</span></label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="checkout-address"
                                    name="house"
                                />
                                </div>
                                <div class="form-group">
                                <label for="checkout-postcode">Postcode / ZIP</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="checkout-postcode"
                                    name="postcode"
                                    required
                                    autocomplete="off"
                                />
                                </div>
                                <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="checkout-email">Email address</label>
                                    <input
                                    type="email"
                                    class="form-control"
                                    id="checkout-email"
                                    placeholder="Email address"
                                    name="email"
                                    autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="checkout-phone">Phone</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="checkout-phone"
                                    placeholder="Phone"
                                    name="phone"
                                    required
                                    autocomplete="off"
                                    />
                                </div>
                                </div>
                            </div>
                            <div class="card-divider"></div>
                            <div class="card-body">
                                <h3 class="card-title">Shipping Details</h3>
                                <div class="form-group">
                                    <div class="form-group">
                                    <label for="checkout-postcode">Shipping Address</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="checkout-postcode"
                                        name="shipping_address"
                                        required
                                        autocomplete="off"
                                    />
                                    </div>
                                </div>
                                <div class="form-group">
                                <label for="checkout-comment"
                                    >Order notes
                                    <span class="text-muted">(Optional)</span></label
                                >
                                <textarea
                                    id="checkout-comment"
                                    class="form-control"
                                    rows="4"
                                    name="notes"
                                ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-5 mt-4 mt-lg-0">
                        <div class="card mb-0">
                        <div class="card-body">
                            <h3 class="card-title">Your Order</h3>
                            <table class="checkout__totals">
                            <thead class="checkout__totals-header">
                                <tr>
                                <th>Product</th>
                                <th></th>
                                <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="checkout__totals-products">
                                @if (Session::has('cart'))
                                    @foreach (Session::get('cart')->items as $item)
                                        <tr>
                                            <td>
                                                {{mb_strimwidth($item["item"]["product_name"], 0, 20, "...")}} 
                                            </td>
                                            <td>
                                                × {{$item['qty']}}
                                            </td>
                                            <td>${{($item['item']['price']) * ($item['qty'])}}</td>
                                        </tr> 
                                    @endforeach
                                @endif
                            </tbody>
                            <tbody class="checkout__totals-subtotals">
                                <tr>
                                <th>Subtotal</th>
                                <td></td>
                                <td>${{Session::get('cart')->totalPrice}}</td>
                                </tr>
                                {{-- <tr>
                                <th>Store Credit</th>
                                <td>$-20.00</td>
                                </tr>
                                <tr>
                                <th>Shipping</th>
                                <td>$25.00</td>
                                </tr> --}}
                            </tbody>
                            <tfoot class="checkout__totals-footer">
                                <tr>
                                <th>Total</th>
                                <td></td>
                                <td>${{Session::get('cart')->totalPrice}}</td>
                                </tr>
                            </tfoot>
                            </table>
                            <div class="payment-methods">
                            <ul class="payment-methods__list">
                                <li class="payment-methods__item payment-methods__item--active">
                                <label class="payment-methods__item-header"
                                    ><span
                                    class="payment-methods__item-radio input-radio"
                                    ><span class="input-radio__body"
                                        ><input
                                        class="input-radio__input"
                                        name="checkout_payment_method"
                                        type="radio"
                                        checked="checked"
                                        value="stripe"
                                        />
                                        <span
                                        class="input-radio__circle"
                                        ></span> </span></span
                                    ><span class="payment-methods__item-title"
                                    >Stripe</span
                                    ></label
                                >
                                <div class="payment-methods__item-container">
                                    <div
                                    class="payment-methods__item-description text-muted"
                                    >
                                    Pay via Stripe; you can make payment on delivery
                                    if you don’t have a Stripe account.
                                    </div>
                                </div>
                                </li>
                                <li class="payment-methods__item">
                                <label class="payment-methods__item-header"
                                    ><span
                                    class="payment-methods__item-radio input-radio"
                                    ><span class="input-radio__body"
                                        ><input
                                        class="input-radio__input"
                                        name="checkout_payment_method"
                                        type="radio"
                                        value="cash_on_delivery"
                                        />
                                        <span
                                        class="input-radio__circle"
                                        ></span> </span></span
                                    ><span class="payment-methods__item-title"
                                    >Cash on delivery</span
                                    ></label
                                >
                                <div class="payment-methods__item-container">
                                    <div
                                    class="payment-methods__item-description text-muted"
                                    >
                                    Pay with cash upon delivery.
                                    </div>
                                </div>
                                </li>
                            </ul>
                            </div>
                            <div class="checkout__agree form-group">
                            <div class="form-check">
                                <span class="form-check-input input-check"
                                ><span class="input-check__body"
                                    ><input
                                    class="input-check__input"
                                    type="checkbox"
                                    id="checkout-terms"
                                    />
                                    <span class="input-check__box"></span>
                                    <svg
                                    class="input-check__icon"
                                    width="9px"
                                    height="7px"
                                    >
                                    <use
                                        xlink:href="images/sprite.svg#check-9x7"
                                    ></use>
                                    </svg> </span></span
                                ><label class="form-check-label" for="checkout-terms"
                                >I have read and agree to the website
                                <a target="_blank" href="terms-and-conditions.html"
                                    >terms and conditions</a
                                >*</label
                                >
                            </div>
                            </div>
                            <button
                            type="submit"
                            class="btn btn-primary btn-xl btn-block"
                            >
                            Place Order
                            </button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
@endsection