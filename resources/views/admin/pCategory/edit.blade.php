<div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered w-100" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('category.update')}}" method="post">
                @csrf
                @method('put')
                <input type="hidden" name="cId" id="cId">
                <div class="row">
                    <label class="col-sm-4 form-control-label">Category: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" class="form-control" name="cNameEdit" id="cNameEdit" 
                        placeholder="Enter Category Name" required>
                    </div>
                  </div><!-- row -->
                  <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Parent: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <select class="form-control select2" name="pCategoryEdit" id="pCategoryEdit" 
                        data-placeholder="Choose Parent Category" required>
                            @foreach ($categories as $item)
                                <option value="{{$item->id}}"
                                    @if ($item->id == "1")
                                        selected
                                    @endif>
                                    {{$item->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Status: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <select class="form-control select2" name="statusEdit" id="statusEdit" 
                        data-placeholder="Choose status" required>
                            <option value="1" selected>Active</option>
                            <option value="0">in-active</option>
                        </select>
                    </div>
                  </div>
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