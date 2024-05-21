@extends('user.layouts.master');

@section('title','Home');

@section('content')
 <!-- Shop Start -->
 <div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- category Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox text-white px-3 py-2 d-flex align-items-center bg-dark justify-content-between mb-3">
                        <label class="" for="price-all">Category</label>
                        <span class="badge border font-weight-normal">{{ count($category) }}</span>
                    </div>
                    <div class=" d-flex align-items-center justify-content-between mb-3">
                        <a href="{{ route('user#home') }}" class="nav-link">
                            <label class="" for="price-1">All</label>
                        </a>
                     </div>
                    @foreach ($category as $c)
                     <div class=" d-flex align-items-center justify-content-between mb-3">
                        <a href="{{ route('user#filter',$c->id) }}" class="nav-link">
                            <label class="" for="price-1">{{ $c->name }}</label>
                        </a>
                     </div>
                    @endforeach
                </form>
            </div>
            <!-- category end -->

            <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div>

        </div>
        <!-- Shop Sidebar End -->
         <!-- Shop Product Start -->
 <div class="col-lg-9 col-md-8">
    <div class="row pb-3">
        <div class="col-12 pb-1">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="">
                    <a href="{{ route('cart#list') }}" class="">
                        <button type="button" class="btn bg-dark p-2 text-white position-relative">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ count($cart) }}
                            </span>
                        </button>
                    </a>

                    <a href="{{ route('user#history') }}" class="ms-2">
                        <button type="button" class="btn bg-dark p-2 text-white position-relative">
                            <i class="fa-solid fa-history"></i> History
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ count($history) }}
                            </span>
                        </button>
                    </a>
                </div>
                <div class="ml-2">
                    <div class="btn-group">
                        <select name="sorting" id="sortingOption" class="form-control bg-dark text-white">
                            <option value="" >Sorting</option>
                            <option value="asc" >Asscending</option>
                            <option value="desc" >Descending</option>
                        </select>
                    </div>

                </div>
            </div>
        </div>

        {{-- looping start  --}}
     <span class="row " id="dataList">
      @if (count($pizza) != 0)
       @foreach ($pizza as $p)
       <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
           <div class="product-item bg-light mb-4">
               <div class="product-img position-relative overflow-hidden">
                   <img class="img-fluid w-100" src="{{ asset('storage/'.$p->image) }}" alt="">
                   <div class="product-action">
                       <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                       <a class="btn btn-outline-dark btn-square" href="{{ route('pizza#detail',$p->product_id) }}"><i class="fa-solid fa-circle-info"></i></a>
                   </div>
               </div>
               <div class="text-center py-4">
                   <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                   <div class="d-flex align-items-center justify-content-center mt-2">
                       <h5>{{ $p->price }}</h5><h6 class="text-muted ml-2">
                   </div>
                   <div class="d-flex align-items-center justify-content-center mb-1">
                       <small class="fa fa-star text-primary mr-1"></small>
                       <small class="fa fa-star text-primary mr-1"></small>
                       <small class="fa fa-star text-primary mr-1"></small>
                       <small class="fa fa-star text-primary mr-1"></small>
                       <small class="fa fa-star text-primary mr-1"></small>
                   </div>
               </div>
           </div>
       </div>
       @endforeach
      @else
           <div class="text-center">
            <h4 class="">There is no pizza<i class="fa-solid fa-pizza-slice"></i></h4>
           </div>
      @endif
     </span>
        {{-- looping end  --}}
    </div>
</div>
<!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
@endsection

@section('scriptSource')
  <script>
     $(document).ready(function(){

            $('#sortingOption').change(function(){
            $eventOption = $('#sortingOption').val();

            if($eventOption == 'asc') {
                $.ajax({
                    type : 'get',
                    url : 'http://localhost:8000/user/ajax/priceList',
                    data : { 'status' : 'asc' },
                    dataType : 'json',
                    success : function(response){
                        $list = ''
                        for($i = 0 ; $i < response.length ; $i++){
                            $list += `  <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>${response[$i].price}</h5><h6 class="text-muted ml-2">
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                    </div>
                </div>
            </div>
        </div>                   `;
                        }
            $('#dataList').html($list)
                    }
                })
            } else if($eventOption == 'desc') {
                $.ajax({
                    type : 'get',
                    url : '{{ route('ajax#priceList') }}',
                    data : { 'status' : 'desc' },
                    dataType : 'json',
                    success : function(response){
                        $list = ''
                        for($i = 0 ; $i < response.length ; $i++){
                            $list += ` <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>${response[$i].price}</h5><h6 class="text-muted ml-2">
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                    </div>
                </div>
            </div>
        </div>      `;
                        }
            $('#dataList').html($list)
                    }
                })
            }
        })
     })
  </script>
@endsection
