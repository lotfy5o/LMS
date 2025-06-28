@extends('admin.admin-dashboard')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Course</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Show Course Details</h5>

                    <form id="myForm" action="{{ route('courses.update', ['course' => $course]) }}"
                        method="post" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Course Name</label>
                            <p type="text" name="name" class="form-control" id="input1">
                                {{ $course->name }}</p>

                            <x-validation-error field="name"></x-validation-error>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Course Title </label>
                            <p type="text" name="title" class="form-control" id="input1">
                                {{ $course->title }}</p>

                            <x-validation-error field="title"></x-validation-error>
                        </div>



                        <div class="form-group col-md-6">
                            <label class="form-label">Course Image</label>
                            <img src="{{ $course->getFirstMediaUrl('courses_images') ?: url('upload/no_image.jpg') }}"
                                alt="Course Image" class="img-fluid rounded" width="200">
                        </div>

                        <div class="form-group col-md-6">
                            @if ($course->getFirstMediaUrl('courses_videos'))
                                <label class="form-label">Course Intro Video</label>
                                <video width="300" controls>
                                    <source src="{{ $course->getFirstMediaUrl('courses_videos') }}"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <p>{{ $course->getFirstMedia('courses_videos')?->name }}</p>
                            @else
                                <label class="form-label">Course Intro Video</label>
                                <p class="form-control" readonly>No video available</p>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label class="form-label">Course Category</label>
                            <p class="form-control" readonly>
                                {{ optional($categories->where('id', $course->category_id)->first())->name ?? 'N/A' }}
                            </p>
                        </div>


                        <div class="form-group col-md-6">
                            <label class="form-label">Course Subcategory</label>
                            <p class="form-control" readonly>
                                {{ optional($subcategories->where('id', $course->subcategory_id)->first())->name ?? 'N/A' }}
                            </p>
                        </div>


                        <div class="form-group col-md-6">
                            <label class="form-label">Certificate Available</label>
                            <p class="form-control" readonly>
                                {{ $course->certificate }}
                            </p>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Course Label </label>
                            <p class="form-control" readonly>
                                {{ $course->label }}
                            </p>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="input1" class="form-label">Course Price </label>
                            <p class="form-control" readonly>
                                {{ $course->selling_price }}
                            </p>
                        </div>


                        <div class="form-group col-md-3">
                            <label for="input1" class="form-label">Discount Price </label>
                            <p class="form-control" readonly>
                                {{ $course->discount_price }}
                            </p>
                        </div>


                        <div class="form-group col-md-3">
                            <label for="input1" class="form-label">Duration </label>
                            <p class="form-control" readonly>
                                {{ $course->duration }}
                            </p>
                        </div>


                        <div class="form-group col-md-3">
                            <label for="input1" class="form-label">Resources </label>
                            <p class="form-control" readonly>
                                {{ $course->resources }}
                            </p>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="form-label">Course Prerequisites</label>
                            <p class="form-control" readonly>
                                {{ $course->prerequisites }}
                            </p>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Course Description </label>
                            <p class="form-control" readonly>
                                {{ $course->description }}
                            </p>
                        </div>




                        <hr>

                        <div class="row">

                            <div class="col-md-4">
                                <label class="form-label">Best Seller</label>
                                <p class="form-control" readonly>
                                    {{ $course->bestseller == '1' ? 'Yes' : 'No' }}
                                </p>
                            </div>


                            <div class="col-md-4">
                                <label class="form-label">Featured</label>
                                <p class="form-control" readonly>
                                    {{ $course->featured == '1' ? 'Yes' : 'No' }}
                                </p>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Highest Rated</label>
                                <p class="form-control" readonly>
                                    {{ $course->highest_rated == '1' ? 'Yes' : 'No' }}
                                </p>
                            </div>

                        </div>

                        <hr>






                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Save
                                    Changes</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

    <div class="page-wrapper">
        <div class="page-content">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('update.course.goal', ['course' => $course]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf


                        <!--   //////////// Goal Option /////////////// -->
                        @foreach ($goals as $goal)
                            <div class="mb-2">
                                <label class="form-label">Course Goals</label>
                                <span class="form-control" readonly>{{ $goal->goal_name }}</span>
                            </div>
                        @endforeach

                        <!--   //////////// End Goal Option /////////////// -->


                    </form>


                </div>
            </div>

        </div>

    </div>

    <!--========== Start of add multiple class with ajax ==============-->
    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                <div class="container mt-2">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="goals">Goals</label>
                            <input type="text" name="course_goals[]" id="goals"
                                class="form-control" placeholder="Goals  ">
                        </div>
                        <div class="form-group col-md-6" style="padding-top: 20px">
                            <span class="btn btn-success btn-sm addeventmore"><i
                                    class="fa fa-plus-circle">Add</i></span>
                            <span class="btn btn-danger btn-sm removeeventmore"><i
                                    class="fa fa-minus-circle">Remove</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!----For Section-------->
    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
    </script>
    <!--========== End of add multiple class with ajax ==============-->



    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subcategory_id"]').html('');
                            var d = $('select[name="subcategory_id"]')
                                .empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]')
                                    .append('<option value="' +
                                        value.id + '">' + value
                                        .name +
                                        '</option>');
                            });
                        },

                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script> --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#showImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);

                    // Update file name
                    $('#imageName').text(file.name);
                }
            });
        });
    </script>

    <script>
        document.getElementById('videoInput').addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file && file.type.startsWith('video/')) {
                const videoURL = URL.createObjectURL(file);

                const videoElement = document.getElementById('showVideo');
                const sourceElement = document.getElementById('videoSource');
                const videoName = document.getElementById('videoName');

                sourceElement.src = videoURL;
                videoElement.load(); // Reload the video with the new source
                videoElement.style.display = 'block';

                videoName.textContent = file.name;
            }
        });
    </script>
@endsection
