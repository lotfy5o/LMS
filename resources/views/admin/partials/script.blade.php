<!-- Bootstrap JS -->
<script src="{{asset('asset-back')}}/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="{{asset('asset-back')}}/js/jquery.min.js"></script>
<script src="{{asset('asset-back')}}/plugins/simplebar/js/simplebar.min.js"></script>
<script src="{{asset('asset-back')}}/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="{{asset('asset-back')}}/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="{{asset('asset-back')}}/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="{{asset('asset-back')}}/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="{{asset('asset-back')}}/plugins/chartjs/js/chart.js"></script>
<script src="{{asset('asset-back')}}/js/index.js"></script>
<!--app JS-->
<script src="{{asset('asset-back')}}/js/app.js"></script>
<script>
    new PerfectScrollbar(".app-container")
</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break;
 }
 @endif
</script>
