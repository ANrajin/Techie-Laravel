<div class="modal fade" id="brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered w-100" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Brand</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('brand.update')}}" id="brandEditForm" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="bId" id="bId">

                <div class="row">
                    <label class="col-sm-4 form-control-label">Brand: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" class="form-control" required
                        name="brandEdit" id="brandEdit" placeholder="Enter Brand Name">
                    </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Details: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <textarea rows="3" class="form-control" 
                        placeholder="Brand Details" name="detailsEdit" id="detailsEdit"></textarea>
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Picture: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <label class="custom-file">
                            <input type="file" name="picEdit" class="custom-file-input">
                            <span class="custom-file-control"></span>
                        </label>
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