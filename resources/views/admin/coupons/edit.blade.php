<div class="modal fade" id="coupon" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered w-100" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Coupon</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('coupon.update')}}" method="post">
                @csrf
                @method('put')

                <input type="hidden" name="id" id="id">
                <div class="row">
                    <label class="col-sm-4 form-control-label">Coupon Name: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" class="form-control  @error('coupon_name') is-invalid @enderror" 
                        name="coupon_name" id="coupon_name" placeholder="Enter Coupon Name">
                        @error('coupon_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Coupon Code: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" class="form-control  @error('coupon_code') is-invalid @enderror" 
                        name="coupon_code" id="coupon_code" placeholder="Enter Coupon Code">
                        @error('coupon_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Discount: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" class="form-control  @error('discount') is-invalid @enderror" 
                        name="discount" id="discount" placeholder="Enter discount to apply">
                        @error('discount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Details: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <textarea rows="3" class="form-control" placeholder="Coupon Details" name="details" id="details"></textarea>
                    </div>
                </div>

                <div class="mg-t-30 d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-outline-info">Update Coupon</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>