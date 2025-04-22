@extends('instructor.instructor-dashboard')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-12">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="{{ $course->getFirstMediaUrl('courses_images') }}"
                                    class="rounded-circle p-1 border" width="90" height="90"
                                    alt="...">
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mt-0">{{ $course->name }}</h5>
                                    <p class="mb-0">{{ $course->title }}</p>
                                </div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Add Section</button>
                            </div>
                        </div>
                    </div>

                    {{-- Add Section and Lecture  --}}
                    <div class="container">
                        <div class="main-body">
                            @forelse ($sections as $key => $section)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body p-4 d-flex justify-content-between">
                                                <h6>{{ $section->name }} </h6>

                                                <div
                                                    class="d-flex justify-content-between align-items-center">

                                                    <form
                                                        action="{{ route('courses.sections.destroy', ['course' => $course, 'section' => $section]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger px-2 ms-auto">Delete
                                                            Section</button>&nbsp;
                                                    </form>

                                                    {{-- <button type="submit"
                                                        class="btn btn-danger px-2 ms-auto">
                                                        Delete
                                                        Section</button> &nbsp; --}}


                                                    <a class="btn btn-primary"
                                                        onclick="addLectureDiv({{ $course->id }}, '{{ $course->slug }}', {{ $section->id }}, 'lectureContainer{{ $key }}' )"
                                                        id="addLectureBtn($key)">
                                                        Add Lecture </a>
                                                    {{-- <a class="btn btn-primary"
                                                        onclick="addLectureDiv({{ $course->id }}, '{{ $course->slug }}', {{ $section->id }}, 'lectureContainer{{ $key }}' )"
                                                        id="addLectureBtn($key)">
                                                        Add Lecture </a> --}}

                                                </div>

                                            </div>

                                            <div class="courseHide"
                                                id="lectureContainer{{ $key }}">
                                                @foreach ($section->lectures as $lecture)
                                                    <div class="container">
                                                        <div
                                                            class="lectureDiv mb-3 d-flex align-items-center justify-content-between">
                                                            <div>
                                                                <strong> {{ $loop->iteration }} .
                                                                    {{ $lecture->title }} </strong>
                                                            </div>

                                                            <div class="btn-group">
                                                                <a href=" {{ route('courses.lectures.edit', ['course' => $course, 'lecture' => $lecture]) }} "
                                                                    class="btn btn-sm btn-primary">Edit</a>
                                                                &nbsp;
                                                                <form
                                                                    action="{{ route('courses.lectures.destroy', ['course' => $course, 'lecture' => $lecture]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-danger">Delete</button>
                                                                </form>


                                                                {{-- @dd($lecture) --}}

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            @empty
                                <div></div>
                            @endforelse
                        </div>
                    </div>

                </div>



            </div>
        </div>







        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Section </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('courses.sections.store', ['course' => $course]) }}"
                            method="POST">
                            @csrf

                            <input type="hidden" name="course_id" value="{{ $course->id }}">

                            <div class="form-group mb-3">
                                <label for="input1" class="form-label">Course Section</label>
                                <input type="text" name="name" class="form-control"
                                    id="input1">
                            </div>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
    </div>




    <script>
        function addLectureDiv(courseId, courseSlug, sectionId, lectureContainerId) {
            const lectureContainer = document.getElementById(lectureContainerId);
            const newLectureDiv = document.createElement('div');

            newLectureDiv.classList.add('lectureDiv', 'mb-3');

            newLectureDiv.innerHTML =
                `<div class="container">
            <h6>Lecture Title </h6>
            <input type="text" class="form-control" placeholder="Enter Lecture Title">
            <textarea class="form-control mt-2" placeholder="Enter Lecture Content"  ></textarea>
 
            <h6 class="mt-3">Add Video Url</h6>
            <input type="text" name="url" class="form-control" placeholder="Add URL">
 
            <button class="btn btn-primary mt-3" onclick="saveLecture(${courseId}, '${courseSlug}', ${sectionId}, '${lectureContainerId}' )" >Save Lecture</button>
            <button class="btn btn-secondary mt-3" onclick="hideLecture('${lectureContainerId}')">Cancel</button>

            </div>`;



            lectureContainer.appendChild(newLectureDiv);

        }

        function hideLecture(lectureContainerId) {
            // the lectureContainerId is passed by the addLectureDiv function
            // through template literal
            const lectureContainer = document.getElementById(lectureContainerId);
            lectureContainer.style.display = 'none';

            //this reloads the page if I canceled
            // location.reload();
        }
    </script>

    <script>
        function saveLecture(courseId, courseSlug, sectionId, containerId) {
            const lectureContainer = document.getElementById(containerId);
            const lectureTitle = lectureContainer.querySelector('input[type="text"]').value;
            const lectureContent = lectureContainer.querySelector('textarea').value;
            const lectureUrl = lectureContainer.querySelector('input[name="url"]').value;
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/courses/${courseSlug}/lectures ', {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-Token": token
                    },
                    body: JSON.stringify({
                        // course_id: courseId,
                        section_id: sectionId,
                        title: lectureTitle,
                        url: lectureUrl,
                        content: lectureContent,
                    }),
                })
                // convert the Json comming from the backend into Javascript Object.
                .then(response => response.json())
                // after it converted to javascript object it then it displayed in the console.
                .then(data => {
                    console.log(data);

                    // hides the lecture input fields
                    lectureContainer.style.display = 'none';

                    // reload the page. the previos line then -the container- style refreshes
                    location.reload();

                    // Start Message 

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 6000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            title: data.success,
                        })

                    } else {

                        Toast.fire({
                            type: 'error',
                            title: data.error,
                        })
                    }



                })
                .catch(error => {
                    console.error(error);
                });
        }
    </script>

    {{-- <script>
        function saveLecture(courseId, courseSlug, sectionId, lectureContainerId) {
            // all three variable comming from the arguments of the addLectureDiv function

            const lectureContainer = document.getElementById(lectureContainerId);
            const lectureTitle = lectureContainer.querySelector('input[type="text"]').value;
            const lectureUrl = lectureContainer.querySelector('input[name="url"]').value;
            const lectureContent = lectureContainer.querySelector('textarea').value;

            console.log('sending data to the server');

            fetch(`/courses/${courseSlug}/save/lecture`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        // why send course_id for the lecture alghough the databaser for lectures 
                        // doesn't have course_id
                        course_id: courseId,
                        section_id: sectionId,
                        title: lectureTitle,
                        url: lectureUrl,
                        content: lectureContent,
                        // he didin't include a duration
                        // duration: lectureDuration,

                    })
                })
                .then((response) =>
                    response.json())
                .then((data) => {
                    console.log(data);
                })
                .catch((error) => {
                    console.log(error);
                })
        }
    </script> --}}
@endsection
