@extends('admin.layouts.master');

@section('title','Voucher');

@section('content')
<div class="page-wrapper">


    <!-- PAGE CONTAINER-->
    <div class="page-container">

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <a href="{{ route('order#list') }}" class="nav-link p-2">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>
                <div class="container-fluid">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->

                        <div class="my-3 bg-white col-md-5 rounded shadow-sm p-4">
                            <h3><i class="fa-solid fa-ticket-simple me-2"></i>Order Voucher</h3>
                            <div class="row mt-5">
                                <div class="col-6">
                                    <h5><i class="me-2 fa-solid fa-user"></i>NAME</h5>
                                    <h5 class="my-3"><i class="me-2 fa-solid fa-barcode"></i>ORDER CODE</h5>
                                    <h5><i class="me-2 fa-regular fa-clock"></i>ORDER TIME</h5>
                                    <h5 class="mt-3"><i class="me-2 fa-solid fa-money-bill"></i>TOTAL</h5>
                                </div>

                                <div class="col-6">
                                    <h5>{{ $data->name }}</h5>
                                    <h5 class="my-3">{{ $data->order_code }}</h5>
                                    <h5>{{ $data->created_at->format('j-F-Y') }}</h5>
                                    <h5 class="mt-3">{{ $data->total_price }}</h5>
                                </div>
                            </div>
                        </div>

                        {{-- @if (count($data) != 0) --}}
                        <div class="table-responsive table-responsive-data2">
                            <table class="text-center table table-data2">
                                <thead class="">
                                    <tr class="fw-bolder">
                                        <th>PRODUCT IMAGE</th>
                                        <th>ORDER ID</th>
                                        <th>PRODUCT NAME</th>
                                        <th>ORDER DATE</th>
                                        <th>QTY</th>
                                        <th>AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                 <span id="" class="row">

                                    <tr class="tr-shadow">
                                        <td>
                                            <img src="{{ asset('storage/'.$order->image) }}" style="height: 150px" >
                                        </td>
                                        <td class="desc">{{ $order->id }}</td>
                                        <td class="desc">{{ $order->name }}</td>
                                        <td class="desc">{{ $order->created_at->format('j-F-Y') }}</td>
                                        <td class="desc">{{ $order->qty }}</td>
                                        <td class="desc">{{ $order->total+3000 }}</td>
                                    </tr>

                                 </span>
                                </tbody>
                            </table>
                        </div>
                        <!-- END DATA TABLE -->

                        {{-- @else --}}
                        {{-- <h3 class="text-center text-secondary mt-5">There is no Voucher</h3> --}}
                        {{-- @endif --}}
                    </div>

                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>
@endsection


