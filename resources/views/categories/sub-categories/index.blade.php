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
                        <li class="breadcrumb-item active" aria-current="page">All SubCategories</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('back.SubCategories.create') }}" class="btn btn-primary px-5">Add SubCateogy</a>
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
                                <th>SubCategory</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SubCategories as $key => $SubCategory )

                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>

                                    <img src="{{ $SubCategory->getFirstMediaUrl('SubCategories', 'thumb') }}"
                                        alt="not_found">

                                </td>
                                <td>{{ $SubCategory->name }}</td>
                                <td>{{ $SubCategory->category->name }}</td>
                                <td>
                                    <a href="{{ route('back.SubCategories.show', ['SubCategory' => $SubCategory]) }}"
                                        class="btn mb-2 btn-success">Show</a>
                                    <a href="{{ route('back.SubCategories.edit', ['SubCategory' => $SubCategory]) }}"
                                        class="btn mb-2 btn-warning">Edit</a>
                                    {{-- <a
                                        href="{{ route('back.SubCategories.destroy', ['SubCategory' => $SubCategory]) }}"
                                        id="delete" class="btn mb-2 btn-danger">Delete</a> --}}

                                    <form
                                        action="{{ route('back.SubCategories.destroy', ['SubCategory' => $SubCategory]) }}"
                                        method="post" id="deleteForm-{{ $SubCategory->id }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" class="btn mb-2  btn-danger"
                                            onclick="confirmDelete({{ $SubCategory->id }})">
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