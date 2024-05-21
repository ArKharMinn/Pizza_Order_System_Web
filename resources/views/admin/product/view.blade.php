@extends('admin.layouts.master');

@section('title','View Pizza');

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
                            <div class="col-lg-10 offset-1">
                                <div class="card">
                                    <i class="fa-solid fa-arrow-left-long m-3" onclick="history.back()">Back</i>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Pizza Overview</h3>
                                        </div>
                                        <hr>
                                        <div class="row">

                                            <div class="col-3 offset-1">
                                                    <img src="{{ asset('storage/' . $view->image ) }}"/>
                                            </div>

                                            <div class="col-7">
                                                <div class="fw-bold my-3">
                                                    <div class="bg-danger d-inline-block p-2 text-white shadow-lg rounded">
                                                        <i class="fa-solid fa-pizza-slice  me-2"></i>
                                                        {{ $view->name }}
                                                    </div>
                                                </div>

                                                <div class="d-flex  flex-wrap">
                                                    <div class="fw-bold my-3 me-2 bg-black rounded text-white p-2">
                                                        <i class="fa-solid fa-money-bill-wave me-2"></i>
                                                        {{ $view->price }} Kyats
                                                    </div>
                                                    <div class="fw-bold my-3 me-2 bg-black rounded text-white p-2">
                                                        <i class="fa-regular fa-calendar-days me-2"></i>
                                                        {{ $view->waiting_time }}
                                                    </div>
                                                    <div class="fw-bold my-3 me-2 bg-black rounded text-white p-2">
                                                        <i class="fa-solid fa-eye me-2"></i>
                                                        {{ $view->view_count }}
                                                    </div>
                                                    <div class="fw-bold my-3 me-2 bg-black rounded text-white p-2">
                                                        <i class="fa-solid fa-list"></i>
                                                        {{ $view->category_name }}
                                                    </div>
                                                    <div class=" fw-bold my-3 bg-black rounded text-white p-2">
                                                        <i class="fa-solid fa-clock me-2"></i>
                                                        {{ $view->created_at->format('j-F-Y') }}
                                                    </div>
                                                </div>

                                                <div class="fw-bold my-3">
                                                    <i class="fa-solid fs-3 fa-file-waveform me-2"></i>
                                                    Details
                                                    <div class="mt-2">
                                                        {{ $view->description }}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
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

