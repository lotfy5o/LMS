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
                            <li class="breadcrumb-item active" aria-current="page">Edit Lecture</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->

            {{-- @dd($courseLecture->); --}}

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Edit Lecture</h5>
                    <form id="myForm"
                        action=" {{ route('courses.lectures.update', ['course' => $course, 'lecture' => $lecture]) }} "
                        method="post" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="section_id" value="{{ $lecture->section->id }}">

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Lecture Title</label>
                            <input type="text" name="title" class="form-control" id="input1"
                                value="{{ $lecture->title }}">
                            <x-validation-error field="title"></x-validation-error>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Video Url </label>
                            <input type="text" name="url" class="form-control" id="input1"
                                value="{{ $lecture->url }}">
                            <x-validation-error field="url"></x-validation-error>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Lecture Content </label>
                            <textarea name="content" class="form-control">{{ $lecture->content }}</textarea>
                            <x-validation-error field="content"></x-validation-error>
                        </div>



                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Save
                                    Changes</button>

                                <a href="{{ route('courses.sections.create', ['course' => $course]) }}"
                                    class="btn btn-danger px-4">Home</a>
                            </div>
                            <div class="d-md-flex d-grid align-items-center gap-3">
                            </div>
                        </div>
                    </form>
                </div>
            </div>




        </div>
    </div>
@endsection
