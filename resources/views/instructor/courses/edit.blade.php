@extends('instructor.instructor-dashboard')

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
                    <h5 class="mb-4">Edit Course</h5>

                    <form id="myForm" action="{{ route('courses.update', ['course' => $course]) }}"
                        method="post" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Course Name</label>
                            <input type="text" name="name" class="form-control" id="input1"
                                value="{{ $course->name }}">
                            <x-validation-error field="name"></x-validation-error>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Course Title </label>
                            <input type="text" name="title" class="form-control" id="input1"
                                value="{{ $course->title }}">
                            <x-validation-error field="title"></x-validation-error>
                        </div>



                        <div class="form-group col-md-6">
                            <label for="input2" class="form-label">Course Image </label>
                            <input class="form-control" name="image" type="file" id="image">
                            <x-validation-error field="image"></x-validation-error>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Course Intro Video </label>
                            <input type="file" name="video" class="form-control"
                                accept="video/mp4, video/webm">
                        </div>

                        <div class="col-md-6">
                            <img id="showImage"
                                src="{{ $course->getFirstMediaUrl('courses_images') ?: url('upload/no_image.jpg') }}"
                                alt="Admin" class="rounded-circle p-1 bg-primary" width="200">
                            <p id="imageName">{{ $course->getFirstMedia('courses_images')?->name }}
                            </p>

                        </div>






                        <div class="form-group col-md-6">
                            <video id="showVideo" width="300" controls
                                style="display: {{ $course->getFirstMediaUrl('courses_videos') ? 'block' : 'none' }}">
                                <source id="videoSource"
                                    src="{{ $course->getFirstMediaUrl('courses_videos') }}"
                                    type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <p id="videoName">{{ $course->getFirstMedia('courses_videos')?->name }}
                            </p>

                        </div>

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Course Category </label>
                            <select name="category_id" class="form-select mb-3"
                                aria-label="Default select example">
                                <option selected="" disabled>Open this select menu</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ $cat->id == $course->category_id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach

                            </select>
                            <x-validation-error field="category_id"></x-validation-error>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Course Subcategory </label>
                            <select name="subcategory_id" class="form-select mb-3"
                                aria-label="Default select example">
                                <option selected="" disabled>Open this select menu</option>
                                @foreach ($subcategories as $subcat)
                                    <option value="{{ $subcat->id }}"
                                        {{ $subcat->id == $course->subcategory_id ? 'selected' : '' }}>
                                        {{ $subcat->name }}</option>
                                @endforeach

                            </select>
                            <x-validation-error field="subcategory_id"></x-validation-error>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Certificate Available </label>
                            <select name="certificate" class="form-select mb-3"
                                aria-label="Default select example">
                                <option selected="" disabled>Open this select menu</option>
                                <option value="Yes"
                                    {{ $course->certificate == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No"
                                    {{ $course->certificate == 'No' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Course Label </label>
                            <select name="label" class="form-select mb-3"
                                aria-label="Default select example">
                                <option selected="" disabled>Open this select menu</option>
                                <option value="Begginer"
                                    {{ $course->label == 'Begginer' ? 'selected' : '' }}>Begginer
                                </option>
                                <option value="Middle"
                                    {{ $course->label == 'Middle' ? 'selected' : '' }}>Middle
                                </option>
                                <option value="Advance"
                                    {{ $course->label == 'Advance' ? 'selected' : '' }}>Advance
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="input1" class="form-label">Course Price </label>
                            <input type="text" name="selling_price" class="form-control"
                                id="input1" value="{{ $course->selling_price }}">
                            <x-validation-error field="selling_price"></x-validation-error>
                        </div>


                        <div class="form-group col-md-3">
                            <label for="input1" class="form-label">Discount Price </label>
                            <input type="text" name="discount_price" class="form-control"
                                id="input1" value="{{ $course->discount_price }}">
                        </div>


                        <div class="form-group col-md-3">
                            <label for="input1" class="form-label">Duration </label>
                            <input type="text" name="duration" class="form-control"
                                id="input1" value="{{ $course->duration }}">
                        </div>


                        <div class="form-group col-md-3">
                            <label for="input1" class="form-label">Resources </label>
                            <input type="text" name="resources" class="form-control"
                                id="input1" value="{{ $course->resources }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Course Prerequisites </label>
                            <textarea name="prerequisites" class="form-control" id="input11"
                                placeholder="Prerequisites ..." rows="3">{{ $course->prerequisites }}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Course Description </label>
                            <textarea name="description" class="form-control" id="myeditorinstance"
                                placeholder="Write your Description here ...">{{ $course->description }}</textarea>
                        </div>




                        <hr>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="bestseller"
                                        value="1" id="flexCheckDefault"
                                        {{ $course->bestseller == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="flexCheckDefault">BestSeller</label>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="featured"
                                        value="1" id="flexCheckDefault"
                                        {{ $course->featured == '1' ? 'checked' : '' }}>>
                                    <label class="form-check-label"
                                        for="flexCheckDefault">Featured</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        name="highest_rated" value="1" id="flexCheckDefault"
                                        {{ $course->highest_rated == '1' ? 'checked' : '' }}>>>
                                    <label class="form-check-label" for="flexCheckDefault">Highest
                                        Rated</label>
                                </div>
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
                            <div class="row add_item">
                                <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                    <div class="container mt-2">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="goals" class="form-label"> Goals
                                                    </label>
                                                    <input type="text" name="course_goals[]"
                                                        id="goals" class="form-control"
                                                        value="{{ $goal->goal_name }}">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6"
                                                style="padding-top: 30px;">
                                                <a class="btn btn-success addeventmore"><i
                                                        class="fa fa-plus-circle"></i> Add More..</a>

                                                <span class="btn btn-danger btn-sm removeeventmore"><i
                                                        class="fa fa-minus-circle">Remove</i></span>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!---end row-->
                        @endforeach

                        <!--   //////////// End Goal Option /////////////// -->


                        <br><br>
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
