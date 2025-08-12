<script src="{{ asset('asset-front') }}/js/jquery-3.4.1.min.js"></script>
<script src="{{ asset('asset-front') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('asset-front') }}/js/bootstrap-select.min.js"></script>
<script src="{{ asset('asset-front') }}/js/owl.carousel.min.js"></script>
<script src="{{ asset('asset-front') }}/js/isotope.js"></script>
<script src="{{ asset('asset-front') }}/js/waypoint.min.js"></script>
<script src="{{ asset('asset-front') }}/js/jquery.counterup.min.js"></script>
<script src="{{ asset('asset-front') }}/js/fancybox.js"></script>
<script src="{{ asset('asset-front') }}/js/datedropper.min.js"></script>
<script src="{{ asset('asset-front') }}/js/emojionearea.min.js"></script>
<script src="{{ asset('asset-front') }}/js/tooltipster.bundle.min.js"></script>
<script src="{{ asset('asset-front') }}/js/jquery.lazy.min.js"></script>
<script src="{{ asset('asset-front') }}/js/main.js"></script>
<script src="{{ asset('asset-front') }}/js/plyr.js"></script>

<script>
    var player = new Plyr('#player');
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
    window.myCartUrl = "{{ route('myCart') }}";
</script>

<script>
    function toggleWishlist(courseId) {
        const button = document.querySelector(`[data-course-id="${courseId}"]`);
        const icon = button.querySelector('i');
        const textSpan = button.querySelector('.swapping-btn');
        const isWishlisted = icon.classList.contains('la-heart');

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/course/toggle-wishlist', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    course_id: courseId
                })
            })
            .then(response => response.json())
            .then(data => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                });

                if ($.isEmptyObject(data.error)) {
                    // ✅ Only update UI if successful
                    if (isWishlisted) {
                        icon.classList.remove('la-heart');
                        icon.classList.add('la-heart-o');
                        textSpan.textContent = 'Wishlist';
                    } else {
                        icon.classList.remove('la-heart-o');
                        icon.classList.add('la-heart');
                        textSpan.textContent = 'Wishlisted';
                    }

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
            .catch(error => {
                console.error('Error:', error);
            });
    }





    document.getElementById('wishlistBtn').addEventListener('click', function() {
        const courseId = this.getAttribute('data-course-id');
        toggleWishlist(courseId);
    });

    // document.getElementById('wishlistIcon').addEventListener('click', function() {
    //     const courseId = this.getAttribute('data-course-id');
    //     toggleWishlist(courseId);
    // });


    function addToCart(courseSlug, btn) {
        fetch(`/addToCart/${courseSlug}`, {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            }).then(response => response.json())
            .then(data => {
                console.log(data);
                loadMiniCart();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                });

                if ($.isEmptyObject(data.error)) {
                    // Update button UI
                    if (btn.classList.contains('btn-success')) {
                        btn.classList.remove('btn-success');
                        btn.classList.add('btn-danger');
                        btn.innerHTML =
                            '<i class="la la-shopping-cart mr-1 fs-18"></i>Remove From Cart';
                        btn.setAttribute('onclick', `removeFromCart('${courseSlug}', this)`);
                    } else {
                        btn.classList.remove('btn-danger');
                        btn.classList.add('btn-success');
                        btn.innerHTML =
                            '<i class="la la-shopping-cart mr-1 fs-18"></i>Add to Cart';
                        btn.setAttribute('onclick', `addToCart('${courseSlug}', this)`);
                    }
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    });
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    });
                }
            }).catch(error => {
                console.error('Error', error);
            });
    }



    function removeFromCart(courseSlug, btn) {
        fetch(`/removeFromCart/${courseSlug}`, {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            }).then(response => response.json())
            .then(data => {
                console.log(data);
                loadMiniCart();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                });

                if (data.success) {
                    // Update button UI
                    if (btn.classList.contains('btn-danger')) {
                        btn.classList.remove('btn-danger');
                        btn.classList.add('btn-success');
                        btn.innerHTML =
                            '<i class="la la-shopping-cart mr-1 fs-18"></i>Add to Cart';
                        btn.setAttribute('onclick', `addToCart('${courseSlug}', this)`);
                    } else {
                        btn.classList.remove('btn-success');
                        btn.classList.add('btn-danger');
                        btn.innerHTML =
                            '<i class="la la-shopping-cart mr-1 fs-18"></i>Remove From Cart';
                        btn.setAttribute('onclick', `removeFromCart('${courseSlug}', this)`);
                    }
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    });
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    });
                }
            }).catch(error => {
                console.error('Error', error);
            });
    }

    function loadMiniCart() {
        fetch('/cartData', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                const miniCartList = document.querySelector('.cart-dropdown-menu');
                miniCartList.innerHTML = ''; // Clear previous content

                // Update the product count dynamically
                const cartCount = document.querySelector('.product-count');
                if (cartCount) {
                    cartCount.textContent = data.cart_count || 0;
                }

                data.courses.forEach(course => {
                    const li = document.createElement('li');
                    li.className = 'media media-card';
                    li.innerHTML = `
                    
                    <a href="/courses/${course.slug}/course-details" class="media-img">
                        <img src="${course.image}" alt="${course.name}">
                    </a>

                    
                    <div class="media-body">
                        <h5><a href="/courses/${course.slug}/course-details">${course.name}</a></h5>
                        <span class="d-block lh-18 py-1">${course.instructor.name}</span>
                        <p class="text-black font-weight-semi-bold lh-18">
                            $${course.price}
                        </p>
                    </div>
                `;
                    miniCartList.appendChild(li);
                });

                // Total item
                const totalLi = document.createElement('li');
                totalLi.className = 'media media-card';
                totalLi.innerHTML = `
                <div class="media-body fs-16">
                    <p class="text-black font-weight-semi-bold lh-18">
                        Total: <span class="cart-total">$${data.total_price}</span>
                    </p>
                </div>
            `;
                miniCartList.appendChild(totalLi);

                // Go to cart button
                const buttonLi = document.createElement('li');
                buttonLi.innerHTML = `
                <a href="${window.myCartUrl}" class="btn theme-btn w-100">
                    Go to cart <i class="la la-arrow-right icon ml-1"></i>
                </a>
            `;
                miniCartList.appendChild(buttonLi);
            });
    }


    // 

    function removeCartRow(btn) {
        const courseSlug = btn.getAttribute('data-course-slug');
        const row = btn.closest('tr[data-course-slug]');
        fetch(`/removeFromCart/${courseSlug}`, {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (row) row.remove();
                    // loadMiniCart();
                    // Fetch new cart totals and update the DOM
                    fetch('/cartData', {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(cartData => {
                            // Update subtotal and total in the DOM
                            document.querySelectorAll('.cart-total, .subtotal-total')
                                .forEach(el => {
                                    el.textContent =
                                        `$${parseFloat(cartData.total_price).toFixed(2)}`;
                                });
                        });
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: data.success,
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: data.error,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });
    }

    function applyCoupon() {
        var couponInput = document.getElementById('coupon_name');
        var coupon_name = couponInput.value;

        fetch('/coupon-apply', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content') // For Laravel
                },
                body: JSON.stringify({
                    coupon_name: coupon_name
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                if (!data.error) {
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });
                    if (data.validity === true) {
                        document.getElementById('coupon-field').style.display = 'none';
                        const totalAmount = data.total_amount; // e.g., 39.99
                        const discountAmount = data.discount_amount; // e.g., 39.99
                        const couponName = data.coupon_name;

                        const origianl_price = document.querySelector(
                            'li.d-flex.align-items-center.justify-content-between.font-weight-semi-bold'
                        );
                        origianl_price.classList.add('before-price');

                        // Find the list
                        const list = document.querySelector('.generic-list-item.pb-4');

                        // Remove previous total-amount row if it exists
                        const oldAmount = list.querySelector('.total-amount-row');
                        if (oldAmount) oldAmount.remove();

                        //////// Create new li for discounted amount///////////
                        const coupon_name = document.createElement('li');
                        coupon_name.className =
                            'd-flex align-items-center justify-content-between font-weight-semi-bold total-amount-row';
                        coupon_name.innerHTML = `
    <span class="text-black">Coupon Name:</span>
    <span>${data.coupon_name} <button type="button" class="icon-element icon-element-xs shadow-sm border-0" data-toggle="tooltip" data-placement="top" onclick="removeCoupon()" >
                            <i class="la la-times"></i>
                        </button></span>
`;
                        // Append to the list
                        list.appendChild(coupon_name);


                        //////// Create new li for discounted amount///////////
                        const discount_amount = document.createElement('li');
                        discount_amount.className =
                            'd-flex align-items-center justify-content-between font-weight-semi-bold total-amount-row';
                        discount_amount.innerHTML = `
    <span class="text-black">Discount Amount:</span>
    <span class="total-amount">$${parseFloat(discountAmount).toFixed(2)}</span>
`;
                        // Append to the list
                        list.appendChild(discount_amount);




                        //////// Create new li for grand total//////////
                        const grandTotal = document.createElement('li');
                        grandTotal.className =
                            'd-flex align-items-center justify-content-between font-weight-semi-bold total-amount-row';
                        grandTotal.innerHTML = `
    <span class="text-black">Grand Total:</span>
    <span class="total-amount">$${parseFloat(totalAmount).toFixed(2)}</span>
`;
                        // Append to the list
                        list.appendChild(grandTotal);
                    }
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: data.error
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function removeCoupon() {
        fetch('/coupon-remove', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                if (!data.error) {
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });

                    // Show the coupon input field again
                    document.getElementById('coupon-field').style.display = '';

                    // Remove all elements with the 'total-amount-row' class (discount details)
                    document.querySelectorAll('.total-amount-row').forEach(el => el.remove());

                    // Remove the 'before-price' class from the original price element
                    const originalPrice = document.querySelector(
                        'li.d-flex.align-items-center.justify-content-between.font-weight-semi-bold'
                    );
                    if (originalPrice) {
                        originalPrice.classList.remove('before-price');
                    }

                } else {
                    Toast.fire({
                        icon: 'error',
                        title: data.error
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
