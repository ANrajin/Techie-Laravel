@extends('front.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card my-5">
                    <div class="p-4">
                        <p class="text-center text-success" style="font-size: 4rem;">
                            <i class="fas fa-check-circle"></i>
                        </p>
                        
                        <h6 class="text-center">
                            Your order has been placed successfully!!!
                        </h6>

                        <h1 class="text-center">
                            Thanks For <br> Shopping With Us.
                        </h1>

                        <div class="d-flex justify-content-center py-3">
                            <a href="{{URL::to('/')}}" class="btn btn-primary">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection