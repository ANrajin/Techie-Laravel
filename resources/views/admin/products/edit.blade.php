<div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered w-100 modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('product.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="id">
                <div class="row">
                  <div class="col-md-6">
                      <div class="row form-group">
                          <label for="" class="col-md-4">Product SKU</label>
                          <div class="col-md-8">
                              <input type="text" name="Edit_sku" class="form-control" value="SKU-" required>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="row form-group">
                          <label for="" class="col-md-4">Product Name</label>
                          <div class="col-md-8">
                              <input type="text" name="Edit_pName" class="form-control" required>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="row form-group">
                          <label for="" class="col-md-4">Category</label>
                          <div class="col-md-8">
                              <select name="Edit_pCat" id="Edit_pCat" class="form-control" data-placeholder="Select Brand" required>
                                  @foreach ($categories as $item)
                                    @if ($item->parent_id > 0)
                                        <option value="{{$item->id}}">{{$item->name}}</option>                                        
                                    @endif
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="row form-group">
                          <label for="" class="col-md-4">Brand</label>
                          <div class="col-md-8">
                              <select name="Edit_pBrand" id="Edit_pBrand" class="form-control" data-placeholder="Select Brand" required>
                                  @foreach ($brands as $bitem)
                                    <option value="{{$bitem->id}}">{{$bitem->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="row form-group">
                          <label for="" class="col-md-4">Quantity</label>
                          <div class="col-md-8">
                              <input type="text" name="Edit_pQty" class="form-control" required>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="row form-group">
                          <label for="" class="col-md-4">Product Price</label>
                          <div class="col-md-8">
                              <input type="text" name="Edit_pPrice" class="form-control" required>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row form-group">
                        <label for="" class="col-md-4">Featured</label>
                        <div class="col-md-8">
                            <select name="Edit_featured" id="Edit_featured" class="form-control">
                              <option value="1" selected>Active</option>
                              <option value="0">Not Active</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row form-group">
                        <label for="" class="col-md-4">Status</label>
                        <div class="col-md-8">
                            <select name="Edit_status" id="Edit_status" class="form-control" required>
                                <option value="1">In-Stock</option>
                                <option value="0">Out of stock</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-12 form-group">
                    <label for="">Product Details</label>
                    <textarea name="Edit_summernote" id="Edit_summernote" class="summernote" class="form-control"></textarea>
                  </div>
              </div>
              {{-- Product Picture --}}
              <div class="row">
                  <div class="col-md-3 form-group">
                      <label for="">Main Thumbnail</label>
                      <input type="file" name="Edit_pic1" class="form-control">
                  </div>
                  <div class="col-md-3 form-group">
                      <label for="">Images (3 image allowed)</label>
                      <input type="file" name="pic[]" class="form-control">
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-3"></div>
                  <div class="col-sm-3"></div>
                  <div class="col-sm-3"></div>
                  <div class="col-sm-3"></div>
              </div>
              {{-- Product Picture --}}
                <div class="mg-t-30 d-flex justify-content-end">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>