@extends('admin.layouts.master');

@section('title','Order List');

@section('content')
<div class="page-wrapper">


    <!-- PAGE CONTAINER-->
    <div class="page-container">

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Order List</h2>

                                </div>
                            </div>

                        </div>

                        @if (session('deleteSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show col-4 offset-8" role="alert">
                            <strong>Delete Success!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif

                        <div class="row">
                            <div class="col-3">
                                <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('search') }}</span></h4>
                            </div>
                            <div class="col-3 offset-6">
                                <form class="mb-3 form-header" action="{{ route('order#list') }}" method="GET">
                                    @csrf
                                    <input class="au-input" type="text" name="search" value="{{ request('search') }}" placeholder="Search for datas &amp; reports..." />
                                    <button class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-1 offset-11">
                                <h3 class="bg-white shadow-lg text-center p-2 rounded"><i class="fa-solid fa-database"></i> {{ count($order) }} </h3>
                            </div>
                        </div>

                        <div class="my-3">
                            <label for="" class="me-3">Status</label>
                            <select id="orderStatus" class="p-1">
                                <option value="">All</option>
                                <option value="0">Pending</option>
                                <option value="1" >Successed</option>
                                <option value="2">Rejected</option>
                            </select>
                        </div>

                        @if (count($order) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="text-center table table-data2">
                                <thead class="">
                                    <tr class="fw-bolder">
                                        <th>ORDER ID</th>
                                        <th>USER NAME</th>
                                        <th>ORDER DATE</th>
                                        <th>ORDER CODE</th>
                                        <th>AMOUNT</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                 <span id="" class="row">
                                    @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" id="statusId" value="{{ $o->order_id }}">
                                        <td>
                                            <span id="orderId" class="block-email">{{ $o->order_id }}</span>
                                        </td>
                                        <td class="desc">{{ $o->name }}</td>
                                        <td class="desc">{{ $o->created_at }}</td>
                                        <td class="desc">
                                            <a href="{{ route('order#voucher',$o->order_code ) }}" class="nav-link">
                                                {{ $o->order_code }}
                                            </a>
                                        </td>
                                        <td class="desc">{{ $o->total_price }}</td>
                                        <td class="desc">
                                            <select name="status" class="statusChange">
                                                <option value="0" @if( $o->status == 0) selected @endif>Pending</option>
                                                <option value="1" @if( $o->status == 1) selected @endif>Successed</option>
                                                <option value="2" @if( $o->status == 2) selected @endif>Rejected</option>
                                            </select>
                                        </td>
                                    </tr>
                                    @endforeach
                                 </span>
                                </tbody>
                            </table>
                        </div>
                        <!-- END DATA TABLE -->

                        @else
                        <h3 class="text-center text-secondary mt-5">There is no Order</h3>
                        @endif

                        {{-- <div class="mt-5">
                           {{ $order->links('pagination::bootstrap-5') }}
                        </div> --}}
                    </div>

                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>
@endsection

@section('scriptSource')
<script src="{{ asset('user/js/statusUser.js') }}"></script>

<script>
  $(document).ready(function(){
       //status change
       $('.statusChange').change(function(){
                    $changeStatus = $(this).val();
                    $parentNode = $(this).parents('tr')
                    $orderId = $parentNode.find('#statusId').val()

                    $data = {
                       'status' : $changeStatus,
                       'order_id' : $orderId
                    }
                    $.ajax({
                       type : 'get',
                       url : 'http://localhost:8000/order/change',
                       data : $data,
                       dataType : 'json',
                       success : function(response){
                        if(response.status == 'status'){
                            window.location.href="http://localhost:8000/order/list"
                        }
                       }
                       })

                   })
  })
</script>
@endsection


