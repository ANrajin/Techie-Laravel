@extends('front.layouts.app')

@section('content')
<script src="https://js.stripe.com/v3/"></script>
    <style>
            /**
        * The CSS shown here will not be introduced in the Quickstart guide, but shows
        * how you can use CSS to style your Element's container.
        */
        .StripeElement {
        box-sizing: border-box;

        height: 40px;

        padding: 10px 12px;

        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;

        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
        width: 100%;
        }

        .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
        border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
        }
    </style>

    <div class="container">
        <h2 class="text-center pt-5">Pay Through Stripe</h2>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card mx-auto my-5">
                    <div class="card-header">
                        <i class="fab fa-cc-stripe"></i>
                        <span class="text-primary">Credit or debit card</span>
                    </div>
                    <div class="p-5">
                        <form action="{{route('stripe')}}" method="post" id="payment-form">
                            @csrf
                            <div class="form-row">
                                <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                                </div>

                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="btn btn-primary">
                                    Pay ${{Session::get('cart')->totalPrice}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Create a Stripe client.
        var stripe = Stripe('pk_test_51Gtc5dAA7ioGcAgnkULyFd5E7iW95KRPrIKVferjuJyf8FUaF9kTvOBQTZcx3Wnk9MQXHhwHLGKivfnDs9pcvCti00R0YITEf1');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
            color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
            }
        });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
        }
    </script>
@endsection