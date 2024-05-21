@extends('user.layouts.master')

@section('title','Cart')

@section('content')
     <!-- Cart Start -->
     <div class="container-fluid">
        <a href="{{ route('user#home') }}" class="nav-link p-2">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table id="dataTable" class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>DATE</th>
                            <th>ORDER ID</th>
                            <th>TOTAL PRICE</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                        <tr>
                            <td class="align-middle">{{ $o->created_at }}</td>
                            <td class="align-middle" id="">{{ $o->order_code }}</td>
                            <td class="align-middle" id="">{{ $o->total_price }}</td>
                            <td class="align-middle">
                                @if ( $o->status == 0)
                                    <span class="text-warning fw-bold shadow-sm"><i class="fa-solid me-2 fa-stopwatch"></i>Pending</span>
                                @elseif ( $o->status == 1)
                                    <span class="text-success fw-bold shadow-sm"><i class="fa-solid me-2 fa-check"></i>Successed</span>
                                @elseif ( $o->status == 2)
                                    <span class="text-danger fw-bold shadow-sm"><i class="fa-solid me-2 fa-triangle-exclamation"></i>Rejected</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-5">
                    {{ $order->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>
    <!-- Cart End -->
@endsection

