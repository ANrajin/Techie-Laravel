<script src="{{asset('AdminAssets/lib/popper.js/popper.js')}}"></script>
<script src="{{asset('AdminAssets/lib/bootstrap/bootstrap.js')}}"></script>
<script src="{{asset('AdminAssets/lib/jquery-ui/jquery-ui.js')}}"></script>
<!-- Datatable -->
<script src="{{asset('AdminAssets/lib/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('AdminAssets/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
<script src="{{asset('AdminAssets/lib/select2/js/select2.min.js')}}"></script>
{{-- summernote --}}
<script src="{{asset('AdminAssets/lib/summernote/summernote-bs4.min.js')}}"></script>
<!-- bootbox -->
<script src="{{asset('AdminAssets/js/bootbox.all.min.js')}}"></script>
{{-- toastr js notification --}}
<script src="{{asset('AdminAssets/js/toastr.min.js')}}"></script>
<script src="{{asset('AdminAssets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
<script src="{{asset('AdminAssets/lib/jquery.sparkline.bower/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('AdminAssets/lib/d3/d3.js')}}"></script>
<script src="{{asset('AdminAssets/lib/rickshaw/rickshaw.min.js')}}"></script>
<script src="{{asset('AdminAssets/lib/chart.js/Chart.js')}}"></script>
<script src="{{asset('AdminAssets/lib/Flot/jquery.flot.js')}}"></script>
<script src="{{asset('AdminAssets/lib/Flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('AdminAssets/lib/Flot/jquery.flot.resize.js')}}"></script>
<script src="{{asset('AdminAssets/lib/flot-spline/jquery.flot.spline.js')}}"></script>
<script src="{{asset('AdminAssets/js/custom.js')}}"></script>

<script src="{{asset('AdminAssets/js/starlight.js')}}"></script>
<script src="{{asset('AdminAssets/js/ResizeSensor.js')}}"></script>
<script src="{{asset('AdminAssets/js/dashboard.js')}}"></script>

<script>
    // Summernote editor
    $('.summernote').summernote({
        height: 200,
        tooltip: false
    })
        
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    @if(Session::has('message'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('message') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('message') }}");
                  break;
              case 'warning':
                 toastr.warning("{{ Session::get('message') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('message') }}");
                  break;
          }
    @endif
</script>
