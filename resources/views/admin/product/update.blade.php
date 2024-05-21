@extends('admin.layouts.master');

@section('title','Update Pizza');

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
                            {{-- <div class="row">
                                <div class="col-3 offset-8">
                                    <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                                </div>
                            </div> --}}
                            <div class="col-lg-8 offset-2">
                                <div class="card">
                                    <i class="fa-solid fa-arrow-left-long m-3" onclick="history.back()">Back</i>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Update Pizza</h3>
                                        </div>
                                        <hr>

                                    <form action="{{ route('product#update', $pizza->product_id ) }}" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">

                                                    <img src="{{ asset('storage/' . $pizza->image ) }}"/>

                                                <input type="file" name="image" class="form-control"/>
                                                <div class="text-center">
                                                    <button id="payment-button" type="submit" class="btn btn-lg btn-dark mt-2 btn-block">
                                                        <span id="payment-button-amount">Update Pizza</span>
                                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                                        <i class="fa-solid fa-circle-right"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                    <div class=" my-3">
                                                        <label for="">Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $pizza->name }}">
                                                    </div>

                                                    <div class=" my-3">
                                                        <label for="">Description</label>
                                                        <textarea rows="10" cols="30" name="description" class="form-control">{{ $pizza->description }}</textarea>
                                                    </div>

                                                    <div class=" my-3">
                                                        <label for="">Price</label>
                                                        <input type="number" name="price" class="form-control" value="{{ $pizza->price }}">
                                                    </div>

                                                    <div class=" my-3">
                                                        <label for="">Waiting Time</label>
                                                        <input type="text" name="waitingTime" class="form-control" value="{{ $pizza->waiting_time }}">
                                                    </div>

                                                    <div class=" my-3">
                                                        <label for="">Category</label>
                                                        <select class="form-control" name="category">
                                                            <option value="">Choose Your Category...</option>
                                                            @foreach ( $category as $c)
                                                                <option value="{{ $c->id }}" @if ( $pizza->id == $c->product_id ) selected @endif>{{ $c->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class=" my-3">
                                                        <label for="">View Count</label>
                                                        <input type="text" class="form-control" value="{{ $pizza->view_count }}" disabled>
                                                    </div>

                                                    <div class=" my-3">
                                                        <label for="">Created Date</label>
                                                        <input type="text" class="form-control" value="{{ $pizza->created_at->format('d-F-Y') }}" disabled>
                                                    </div>
                                            </div>
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

