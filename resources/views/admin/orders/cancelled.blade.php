@extends('admin.layouts.app')

{{-- Active page --}}
@section('ActivePage')
    Confirmed Orders
@endsection

{{-- Add active class --}}
@section('orders')
    active show-sub
@endsection

{{-- Add active class --}}
@section('cancelled_orders')
    active
@endsection

@section('content')
        <div class="d-flex justify-content-between">
        <h6>Cancelled Orders</h6>
        {{-- <button class="btn btn-sm btn-outline-primary" style="cursor: pointer;" data-toggle="modal" data-target="#AddProduct">Add New Product</button> --}}
    </div>

    <div class="card p-2 my-2">
        <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Action</th>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Payment Method</th>
                    <th>Transection ID</th>
                    <th>Status</th>
                    <th>Order at</th>
                    <th>Confirmed at</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($orders as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary view_order rounded-circle" 
                                style="cursor:pointer;" 
                                data-id="{{$item->id}}"
                                >
                                    <i class="fa fa-eye"></i>
                                </button>
                            </td>
                            <td>
                                {{$item->order_id}}
                            </td>
                            <td>{{$item->user->name}}</td>
                            <td>{{$item->payment_method}}</td>
                            <td>{{$item->charge_id}}</td>
                            <td>
                                <span class = "square-8 mg-r-5 rounded-circle badge-danger">
                                </span>
                                cancelled
                            </td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>

    @include('admin.orders.view')
@endsection