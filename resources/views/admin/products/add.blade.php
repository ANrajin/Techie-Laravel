<div class="modal fade" id="AddProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered w-100 modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add New Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                      <div class="row form-group">
                          <label for="" class="col-md-4">Product SKU</label>
                          <div class="col-md-8">
                              <input type="text" name="sku" class="form-control" value="SKU-" required>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="row form-group">
                          <label for="" class="col-md-4">Product Name</label>
                          <div class="col-md-8">
                              <input type="text" name="pName" class="form-control" required>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="row form-group">
                          <label for="" class="col-md-4">Category</label>
                          <div class="col-md-8">
                              <select name="pCat" class="form-control" required>
                                  <option>Select Category</option>
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
                              <select name="pBrand" class="form-control" required>
                                  <option>Select Brand</option>
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
                              <input type="text" name="pQty" class="form-control" required>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="row form-group">
                          <label for="" class="col-md-4">Product Price</label>
                          <div class="col-md-8">
                              <input type="text" name="pPrice" class="form-control" required>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row form-group">
                        <label for="" class="col-md-4">Featured</label>
                        <div class="col-md-8">
                            <select name="featured" class="form-control">
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
                            <select name="status" class="form-control" required>
                                <option value="1">In-Stock</option>
                                <option value="0">Out of stock</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-12 form-group">
                    <label for="">Product Details</label>
                    <textarea name="summernote" class="summernote" class="form-control"></textarea>
                  </div>
              </div>
              {{-- Product Picture --}}
              <div class="row">
                  <div class="col-md-3 form-group">
                      <label for="">Main Thumbnail</label>
                      <input type="file" name="pic1" class="form-control" required>
                  </div>
                  <div class="col-md-3 form-group">
                      <label for="">Thumbnail two</label>
                      <input type="file" name="pic[]" class="form-control" multiple>
                  </div>
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