@extends('admin.layouts.master');

@section('title','Account Info');

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
                            <div class="col-lg-6 offset-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Account Info</h3>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-6">
                                                @if ( Auth::user()->image == null)
                                                    @if ( Auth::user()->gender == 'male' )
                                                        <img src="{{ asset('admin/images/profile.png') }}"/>
                                                    @else
                                                        <img src="{{ asset('admin/images/profileFemale.jpg') }}"/>
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/' .Auth::user()->image ) }}"/>
                                                @endif
                                                <div class="text-center">
                                                    <a href="{{ route('admin#edit') }}" class="bg-black text-white rounded p-2 nav-link">
                                                        <i class="fa-solid fa-pen-to-square me-2"></i>
                                                        Edit Profile
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="fw-bold my-3">
                                                    <i class="fa-solid fa-user me-2"></i>
                                                    {{ Auth::user()->name }}
                                                </div>
                                                <div class="fw-bold my-3">
                                                    <i class="fa-solid fa-envelope me-2"></i>
                                                    {{ Auth::user()->email }}
                                                </div>
                                                <div class="fw-bold my-3">
                                                    <i class="fa-solid fa-phone me-2"></i>
                                                    {{ Auth::user()->phone }}
                                                </div>
                                                <div class="fw-bold my-3">
                                                    <i class="fa-solid fa-venus-mars"></i>
                                                    {{ Auth::user()->gender }}
                                                </div>
                                                <div class="fw-bold my-3">
                                                    <i class="fa-solid fa-location-dot me-2"></i>
                                                    {{ Auth::user()->address }}
                                                </div>
                                                <div class="fw-bold my-3">
                                                    <i class="fa-solid fa-clock me-2"></i>
                                                    {{ Auth::user()->created_at->format('j-F-Y') }}
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

