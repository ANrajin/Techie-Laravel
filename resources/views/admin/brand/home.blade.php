@extends('admin.layouts.app')

{{-- Active page --}}
@section('ActivePage')
    Manage Product Brands
@endsection

{{-- Add active class --}}
@section('attributes')
    active show-sub
@endsection

{{-- Add active class --}}
@section('brands')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h6>Add New Brand</h6>
            <div class="card p-2">
                <form action="{{route('brands.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <label class="col-sm-4 form-control-label">Brand: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control  @error('brand') is-invalid @enderror" 
                            name="brand" placeholder="Enter Brand Name">
                            @error('brand')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div><!-- row -->
                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Details: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <textarea rows="3" class="form-control" placeholder="Brand Details" name="details"></textarea>
                        </div>
                    </div>
                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Picture: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <label class="custom-file">
                                <input type="file" name="pic" class="custom-file-input" required>
                                <span class="custom-file-control"></span>
                            </label>
                        </div>
                    </div>
                    <div class="mg-t-30 d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-outline-info">Add Brand</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <h6>Brands</h6>
            <div class="card p-2">
                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Action</th>
                            <th>Brand</th>
                            <th>Details</th>
                            <th>Image</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach ($brands as $data)
                            <tr>
                                <td>{{$i}}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info brand"
                                    data-toggle="modal"
                                    data-id="{{$data->id}}"
                                    >
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a href="" 
                                        class="btn btn-sm btn-outline-danger br_delete"  
                                        data-id="{{$data->id}}"
                                        >
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->details}}</td>
                                <td>
                                    <img src="{{asset('storage/brands/'.$data->image)}}" alt="{{$data->name}}" style="width:30px;">
                                </td>
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
    
    @include('admin.brand.edit')
@endsection