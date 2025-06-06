@extends('instructor.instructor-dashboard')

@section('content')
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
                            <li class="breadcrumb-item active" aria-current="page">Course</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('courses.create') }}" class="btn btn-primary px-5">Add
                            Course </a>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image </th>
                                    <th>Course Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($courses as $key => $course)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td> <img
                                                src="{{ $course->getFirstMediaUrl('courses_images', 'thumb') }}"
                                                alt="not_found">
                                        </td>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->category->name }}</td>
                                        <td>{{ $course->selling_price }}</td>
                                        <td>{{ $course->discount_price }}</td>
                                        <td>
                                            <a href="{{ route('courses.edit', ['course' => $course]) }}"
                                                class="btn btn-info"><i class="lni lni-eraser"></i> </a>

                                            <form
                                                action="{{ route('courses.destroy', ['course' => $course]) }}"
                                                method="post" id="deleteForm-{{ $course->id }}"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $course->id }})">
                                                    <i class="lni lni-trash"></i>
                                                </button>
                                            </form>

                                            <a href="{{ route('courses.sections.create', ['course' => $course]) }}"
                                                class="btn btn-warning" title="Lecture"><i
                                                    class="lni lni-list"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>




        </div>
    </div>
@endsection
