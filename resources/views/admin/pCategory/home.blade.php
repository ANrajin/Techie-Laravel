@extends('admin.layouts.app')

{{-- Active page --}}
@section('ActivePage')
    Manage Product Categories
@endsection

{{-- Add active class --}}
@section('categories')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h6>Add New Category</h6>
            <div class="card p-2">
                <form action="{{route('categories.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <label class="col-sm-4 form-control-label">Category: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control  @error('cName') is-invalid @enderror" 
                            name="cName" placeholder="Enter Category Name">
                            @error('cName')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                      </div><!-- row -->
                      <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Parent: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <select class="form-control select2 @error('pCategory') is-invalid @enderror" 
                            name="pCategory" data-placeholder="Choose Parent Category">
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}"
                                        @if ($item->id == "1")
                                            selected
                                        @endif>
                                        {{$item->name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('pCategory')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Status: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0 @error('status') is-invalid @enderror">
                            <select class="form-control select2" name="status" data-placeholder="Choose Parent Category">
                                <option value="1" selected>Active</option>
                                <option value="0">in-active</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="mg-t-30 d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-outline-info">Add Category</button>
                      </div>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <h6>Categories</h6>
            <div class="card p-2">
                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Action</th>
                            <th>Category</th>
                            <th>Parent</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach ($categories as $data)
                            @if ($data->parent_id > 0)
                            <tr>
                                <td>{{$i}}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info category"
                                    data-toggle="modal"
                                    data-id="{{$data->id}}"
                                    >
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a href="{{route('categories.destroy', $data->id)}}" 
                                        class="btn btn-sm btn-outline-danger cat_delete" 
                                        data-parentId="{{$data->parent_id}}" 
                                        data-id="{{$data->id}}"
                                        >
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->parent->name}}</td>
                                <td>
                                    <span class="badge 
                                    @if($data->status)
                                    {{"badge-success"}}
                                    @else
                                    {{"badge-danger"}}
                                    @endif">
                                        @if ($data->status)
                                           {{"active"}} 
                                        @else
                                            {{"inactive"}}
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                            @endif
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.pCategory.edit')
@endsection
