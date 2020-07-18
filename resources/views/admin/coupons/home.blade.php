@extends('admin.layouts.app')

{{-- Active page --}}
@section('ActivePage')
    Manage Coupons
@endsection

{{-- Add active class --}}
@section('attributes')
    active show-sub
@endsection

{{-- Add active class --}}
@section('coupons')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h6>Add New Coupon</h6>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('coupons.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <label class="col-sm-4 form-control-label">Coupon Name: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control  @error('coupon_name') is-invalid @enderror" 
                                name="coupon_name" placeholder="Enter Coupon Name">
                                @error('coupon_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Coupon Code: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control  @error('coupon_code') is-invalid @enderror" 
                                name="coupon_code" placeholder="Enter Coupon Code">
                                @error('coupon_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Discount: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control  @error('discount') is-invalid @enderror" 
                                name="discount" placeholder="Enter discount to apply">
                                @error('discount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Details: <span class="tx-danger">*</span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <textarea rows="3" class="form-control" placeholder="Coupon Details" name="details"></textarea>
                            </div>
                        </div>

                        <div class="mg-t-30 d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-outline-info">Save Coupon</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <h6>Coupons</h6>
            <div class="card">
                <div class="card-body">
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Action</th>
                                <th>Coupon Name</th>
                                <th>Coupon Code</th>
                                <th>Discount</th>
                                <th>Details</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($coupons as $data)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-info coupon"
                                        data-toggle="modal"
                                        data-id="{{$data->id}}"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <a href="" 
                                            class="btn btn-sm btn-outline-danger delete_coupon"  
                                            data-id="{{$data->id}}"
                                            >
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <td>{{$data->coupon_name}}</td>
                                    <td>{{$data->coupon_code}}</td>
                                    <td>{{$data->discount}}%</td>
                                    <td>{{$data->details}}</td>
                                    <td>{{$data->created_at}}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.coupons.edit')
    </div>
    <script>
        //fetch selected coupon's data
        $(".coupon").on("click", function() {
            var id = $(this).attr("data-id");
            $.ajax({
                url: "coupons/" + id,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    for(var index in data){
                        $("#id").val(data[index]['id']);
                        $("#coupon_name").val(data[index]['coupon_name']);
                        $("#coupon_code").val(data[index]['coupon_code']);
                        $("#discount").val(data[index]['discount']);
                        $("#details").val(data[index]['details']);
                    }
                    $("#coupon").modal("show");
                }
            });
        });


        //delete coupon via bootbox
        $(".delete_coupon").on("click", function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");

            bootbox.confirm("Are your sure to delete?", function(confirmed) {
                if (confirmed) {
                    $.ajax({
                        url: "coupons/" + id,
                        method: "DELETE",
                        data: {
                            //set csrf token in meta tag for resource route
                            _token: $('meta[name="csrf-token"]').attr("content")
                        },
                        success: function(data) {
                            location.reload(true);
                        }
                    });
                }
            });
        });
    </script>
@endsection