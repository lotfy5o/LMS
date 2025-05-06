<script src="{{ asset('asset-front') }}/js/jquery-3.4.1.min.js"></script>
<script src="{{ asset('asset-front') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('asset-front') }}/js/bootstrap-select.min.js"></script>
<script src="{{ asset('asset-front') }}/js/owl.carousel.min.js"></script>
<script src="{{ asset('asset-front') }}/js/isotope.js"></script>
<script src="{{ asset('asset-front') }}/js/jquery.counterup.min.js"></script>
<script src="{{ asset('asset-front') }}/js/fancybox.js"></script>
<script src="{{ asset('asset-front') }}/js/chart.js"></script>
<script src="{{ asset('asset-front') }}/js/doughnut-chart.js"></script>
<script src="{{ asset('asset-front') }}/js/bar-chart.js"></script>
<script src="{{ asset('asset-front') }}/js/line-chart.js"></script>
<script src="{{ asset('asset-front') }}/js/datedropper.min.js"></script>
<script src="{{ asset('asset-front') }}/js/emojionearea.min.js"></script>
<script src="{{ asset('asset-front') }}/js/animated-skills.js"></script>
<script src="{{ asset('asset-front') }}/js/jquery.MultiFile.min.js"></script>
<script src="{{ asset('asset-front') }}/js/main.js"></script>

<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
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

<script>
    function getWishlistedCourses() {

        fetch('/get-wishlisted-courses', {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            }).then(response => response.json())
            .then(data => {
                console.log('Wishlisted Courses', data);
                let rows = '';
                data.wishlistedCourses.forEach(function(value) {
                    rows +=
                        `
                         <div class="col-lg-4 responsive-column-half">
            <div class="card card-item">
                <div class="card-image">
                    <a href="course-details.html" class="d-block">
                        <img class="card-img-top" src="${value.image}" alt="Card image cap">
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">${value.label}</h6>
                    <h5 class="card-title"><a href="course-details.html">${value.name}</a></h5>
                    <div class="d-flex justify-content-between align-items-center">
                        ${
                            value.discount_price === null
                                ? `<p class="card-price text-black font-weight-bold">$${value.selling_price}</p>`
                                : `<p class="card-price text-black font-weight-bold">$${value.discount_price} <span class="before-price font-weight-medium">$${value.selling_price}</span></p>`
                        }
                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Remove from Wishlist" id="${value.id}" onclick="removeWishlist(this.id)">
                            <i class="la la-heart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
                });
                document.getElementById('wishlist').innerHTML = rows;
            }).catch(error => {
                console.error('Error fetching wishlisted courses', error);
            });
    }

    getWishlistedCourses();

    function removeWishlist(courseId) {

        fetch(`/remove-wishlist/${courseId}`, {
                method: "GET",
                headers: {
                    'Accept': 'application/json'
                }
            }).then(response => response.json())
            .then(data => {

                // refresh the page
                getWishlistedCourses();

                // Show toast notification using SweetAlert
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                });

                if (!data.error) {
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: data.error
                    });
                }
            })
    }
</script>
