@extends('admin.layouts.master');

@section('title','Create Pizza');

@section('content')
<div class="page-wrapper">

    <!-- PAGE CONTAINER-->
    <div class="page-container">

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-3 offset-8">
                                    <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                                </div>
                            </div>
                            <div class="col-lg-6 offset-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Category Form</h3>
                                        </div>
                                        <hr>
                                        <form action="{{ route('product#createPizza') }}" enctype="multipart/form-data" method="POST" novalidate="novalidate">
                                            @csrf
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                                <input id="cc-pament" value="{{ old('name') }}" name="name" type="text" class="form-control @error('name')  is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name">
                                                @error('name')
                                                    <small class="text-danger invalid-feedback">{{ $message }}</small>
                                                @enderror

                                                <label for="" class="control-label mb-1">Category</label>
                                                <select name="category" class="form-control @error('category')  is-invalid @enderror" >
                                                    <option value="">Choose Your Category</option>
                                                    @foreach ($categories as $item)
                                                       <option value=" {{ $item->id }} ">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                    <small class="text-danger invalid-feedback">{{ $message }}</small>
                                                @enderror

                                                <label for="" class="control-label mb-1">Description</label>
                                                <textarea name="description" cols="30" rows="6" class="form-control @error('description')  is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Description">{{ old('description') }}</textarea>
                                                @error('description')
                                                    <small class="text-danger invalid-feedback">{{ $message }}</small>
                                                @enderror

                                                <label for="" class="control-label mb-1">Image</label>
                                                <input id="" name="image" type="file" class="form-control @error('image')  is-invalid @enderror" aria-required="true" aria-invalid="false">
                                                @error('image')
                                                    <small class="text-danger invalid-feedback">{{ $message }}</small>
                                                @enderror

                                                <label for="" class="control-label mb-1">Waiting Time</label>
                                                <input id="" value="{{ old('waitingTime') }}" name="waitingTime" type="number" class="form-control @error('time')  is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time">
                                                @error('time')
                                                    <small class="text-danger invalid-feedback">{{ $message }}</small>
                                                @enderror

                                                <label for="" class="control-label mb-1">Price</label>
                                                <input id="" value="{{ old('price') }}" name="price" type="number" class="form-control @error('price')  is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Price">
                                                @error('price')
                                                    <small class="text-danger invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <span id="payment-button-amount">Create</span>
                                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                                    <i class="fa-solid fa-circle-right"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>
@endsection

