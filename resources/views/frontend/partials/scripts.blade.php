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
</script>
