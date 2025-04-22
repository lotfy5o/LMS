<script src="{{asset('asset-front')}}/js/jquery-3.4.1.min.js"></script>
<script src="{{asset('asset-front')}}/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('asset-front')}}/js/bootstrap-select.min.js"></script>
<script src="{{asset('asset-front')}}/js/owl.carousel.min.js"></script>
<script src="{{asset('asset-front')}}/js/isotope.js"></script>
<script src="{{asset('asset-front')}}/js/jquery.counterup.min.js"></script>
<script src="{{asset('asset-front')}}/js/fancybox.js"></script>
<script src="{{asset('asset-front')}}/js/chart.js"></script>
<script src="{{asset('asset-front')}}/js/doughnut-chart.js"></script>
<script src="{{asset('asset-front')}}/js/bar-chart.js"></script>
<script src="{{asset('asset-front')}}/js/line-chart.js"></script>
<script src="{{asset('asset-front')}}/js/datedropper.min.js"></script>
<script src="{{asset('asset-front')}}/js/emojionearea.min.js"></script>
<script src="{{asset('asset-front')}}/js/animated-skills.js"></script>
<script src="{{asset('asset-front')}}/js/jquery.MultiFile.min.js"></script>
<script src="{{asset('asset-front')}}/js/main.js"></script>

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
