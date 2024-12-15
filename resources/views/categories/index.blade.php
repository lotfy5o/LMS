@extends('admin.admin-dashboard')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Categories</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('back.categories.create') }}" class="btn btn-primary px-5">Add Cateogy</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $category )

                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>

                                    <img src="{{ $category->getFirstMediaUrl('categories', 'thumb') }}" alt="not_found">

                                </td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('back.categories.show', ['category' => $category]) }}"
                                        class="btn mb-2 btn-success">Show</a>
                                    <a href="{{ route('back.categories.edit', ['category' => $category]) }}"
                                        class="btn mb-2 btn-warning">Edit</a>
                                    {{-- <a href="{{ route('back.categories.destroy', ['category' => $category]) }}"
                                        id="delete" class="btn mb-2 btn-danger">Delete</a> --}}

                                    <form action="{{ route('back.categories.destroy', ['category' => $category]) }}"
                                        method="post" id="deleteForm-{{ $category->id }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" class="btn mb-2  btn-danger"
                                            onclick="confirmDelete({{ $category->id }})">
                                            Delete
                                        </button>
                                    </form>
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

<script>
    function confirmDelete(id){
        if(confirm('Are You Sure You Want To Delete This?')){
            document.getElementById('deleteForm-' + id).submit();
        }
    }
</script>

@endsection
