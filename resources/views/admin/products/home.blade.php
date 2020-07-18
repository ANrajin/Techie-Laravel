@extends('admin.layouts.app')

{{-- Active page --}}
@section('ActivePage')
    Manage Products
@endsection

{{-- Add active class --}}
@section('products')
    active
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <h6>Manage Store Products</h6>
        <button class="btn btn-sm btn-outline-primary" style="cursor: pointer;" data-toggle="modal" data-target="#AddProduct">Add New Product</button>
    </div>

    <div class="card p-2 my-2">
        <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Action</th>
                    <th>Image</th>
                    <th>SKU</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Created_at</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($products as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary view rounded-circle" style="cursor:pointer;" data-id="{{$item->id}}">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info edit_product rounded-circle" style="cursor:pointer;" data-id="{{$item->id}}">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <a class="btn btn-sm btn-outline-danger p_delete rounded-circle" 
                                href="{{route('product.delete', $item->id)}}">
                                        <i class="fa fa-trash"></i>
                                </a>
                            </td>
                            <td>
                                <img src="{{asset('storage/products/'.$item->main_thumbnail)}}" alt="" style="width: 30px;">
                            </td>
                            <td>{{$item->product_sku}}</td>
                            <td>{{mb_strimwidth($item->product_name, 0, 20, "...")}}</td>
                            <td>{{$item->category->name}}</td>
                            <td>{{($item->brand_id)? $item->brand->name : 'undefined'}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->price}}</td>
                            <td>
                                <span class="badge {{($item->status)?"badge-success":"badge-danger"}}">
                                    {{($item->status)?"in-stock":"out-of-stock"}}
                                </span>
                            </td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>

    {{-- add product modal --}}
    @include('admin.products.add')
    @include('admin.products.edit')
    @include('admin.products.view')
@endsection
