@extends('instructor.instructor-dashboard')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="page-wrapper">

        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-courses-center mb-3">
                <div class="breadcrumb-title pe-3">Order Details</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-course"><a href="javascript:;"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-course active" aria-current="page">Order Details</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                </div>
            </div>
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-6">

                            <div class="card">



                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $payment->user->name }}
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $payment->user->email }}
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Phone</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $payment->user->phone }}
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Address</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $payment->user->address }}
                                        </div>
                                    </div>


                                </div>



                            </div>

                        </div>


                        <div class="col-lg-6">
                            <div class="card">



                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Payment Method</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $payment->payment_method }}
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Invoice Number</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $payment->invoice_no }}
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Order Date</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $payment->created_at->format('d-m-Y') }}
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Status</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">

                                            @if ($payment->status == 'pending')
                                                <a href="{{ route('back.orders.confirm', $payment->id) }}"
                                                    class="btn btn-sm btn-block btn-warning"
                                                    id="confirm">Confirm
                                                    Order</a>
                                            @elseif ($payment->status == 'paid')
                                                <a href=""
                                                    class="btn btn-block btn-success">Confirmed
                                                    Order</a>
                                            @endif

                                        </div>
                                    </div>



                                </div>



                            </div>



                        </div>
                    </div>
                </div>
            </div>

            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-courses-center">

                        <div class="flex-grow-1 ms-3">
                            <div class="table-responsive">
                                <table class="table" style="font-weight: 600;">
                                    <tbody>
                                        <tr>
                                            <td class="col-md-1">
                                                <label>Image</label>
                                            </td>
                                            <td class="col-md-2">
                                                <label>Course Name</label>
                                            </td>
                                            <td class="col-md-2">
                                                <label>Category </label>
                                            </td>

                                            <td class="col-md-2">
                                                <label>Instructor</label>
                                            </td>
                                            <td class="col-md-2">
                                                <label>Price</label>
                                            </td>
                                        </tr>

                                        @foreach ($order->courses as $course)
                                            <tr>
                                                <td class="col-md-1">
                                                    <label><img
                                                            src="{{ $course->getFirstMediaUrl('courses_images', 'thumb') }}"
                                                            alt=""
                                                            style="width: 50px; height:50px;"> </label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label> {{ $course->name }} </label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label>{{ $course->category->name }}</label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label> {{ $course->instructor->name }} </label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label> ${{ $course->discount_price }} </label>
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td colspan="4"></td>
                                            <td class="col-md-3">
                                                <strong>Total Price : ${{ $total_price }}</strong>
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>

                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>



    </div>
@endsection
