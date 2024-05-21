@extends('user.layouts.master')

@section('title','Cart')

@section('content')
     <!-- Cart Start -->
     <div class="container-fluid">
        <a href="{{ route('user#home') }}" class="nav-link p-2">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table id="dataTable" class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $c)
                        <tr class="">
                            <input type="hidden" value="{{ $c->price }}" id="price"/>
                            <input type="hidden" value="{{ $c->cart_id }}" id="cartId"/>
                            <input type="hidden" value="{{ $c->user_id }}" id="userId"/>
                            <input type="hidden" value="{{ $c->product_id }}" id="productId"/>
                            <td class="align-middle"><img src="{{ asset('storage/'.$c->image) }}" alt="" style="width: 50px;"> </td>
                            <td class="align-middle">{{ $c->pizza_name }}</td>
                            <td class="align-middle" id="">{{ $c->price }}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary minus btn-minus" id="">
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" id="qty" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $c->qty }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus plus" id="">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="total">{{ $c->price * $c->qty }}</td>
                            <td class="align-middle"><button id="" class="btnRemove btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subtotal">{{ $total }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="result">{{ $total + 3000 }}</h5>
                        </div>
                        <button id="orderBtn" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                        <button id="clearBtn" class="btn btn-block btn-danger font-weight-bold my-3 py-3">
                            Clear Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script src="{{ asset('user/js/order.js') }}"></script>

    <script>

        $(document).ready(function(){

             //clearBtn
             $('#clearBtn').click(function(){
                $('#dataTable tbody tr').remove();
                $('#subtotal').html(0);
                $('#result').html(0);

              $.ajax({
                type : 'get',
                url : '{{ route('ajax#clear') }}',
                dataType : 'json'
              })
            })

        })
    </script>

@endsection
