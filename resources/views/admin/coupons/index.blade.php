@extends('admin.admin-dashboard')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style>
        .large-checkbox {
            transform: scale(1.1);
        }
    </style>
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
                            <li class="breadcrumb-item active" aria-current="page">All Coupon</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('back.coupons.create') }}" class="btn btn-primary px-5">Create
                            Coupon
                        </a>
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
                                    <th>Sl</th>
                                    <th>Coupon Name </th>
                                    <th>Coupon Discount</th>
                                    <th>Coupon Validity</th>
                                    <th>Coupon Status </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($coupons as $key => $coupon)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td> {{ $coupon->name }} </td>
                                        <td>{{ $coupon->discount }}%</td>
                                        <td> {{ Carbon\Carbon::parse($coupon->validity)->format('D, d F Y') }}
                                        </td>
                                        <td>
                                            @if ($coupon->validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                                <span class="badge bg-success">Valid</span>
                                            @else
                                                <span class="badge bg-danger">Invalid</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('back.coupons.edit', ['coupon' => $coupon]) }}"
                                                class="btn btn-info px-5">Edit </a>
                                            {{-- <a href="{{ route('delete.category', $coupon->id) }}"
                                                class="btn btn-danger px-5" id="delete">Delete </a> --}}

                                            <form
                                                action="{{ route('back.coupons.destroy', ['coupon' => $coupon]) }}"
                                                method="post" id="deleteForm-{{ $coupon->id }}"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button" class="btn btn-danger px-5"
                                                    onclick="confirmDelete({{ $coupon->id }})">
                                                    <i class="lni lni-trash"></i>
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
@endsection
