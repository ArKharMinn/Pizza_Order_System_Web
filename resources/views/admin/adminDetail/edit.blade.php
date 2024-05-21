@extends('admin.layouts.master');

@section('title','Account Profile');

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
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Account Profile</h3>
                                        </div>
                                        <hr>

                                    <form action="{{ route('admin#update', Auth::user()->id ) }}" enctype="multipart/form-data" method="POST">
                                        @csrf
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
                                                <input type="file" name="image" class="form-control"/>
                                                <div class="text-center">
                                                    <a href="{{ route('admin#edit') }}" class="bg-black text-white rounded p-2 mt-5 nav-link">

                                                        <button type="submit" class="text-white">
                                                            <i class="fa-solid fa-pen-to-square me-2"></i>
                                                            Update Profile
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                    <div class=" my-3">
                                                        <label for="">Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                                                    </div>

                                                    <div class=" my-3">
                                                        <label for="">Email</label>
                                                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                                                    </div>

                                                    <div class=" my-3">
                                                        <label for="">Phone</label>
                                                        <input type="number" name="phone" class="form-control" value="{{ Auth::user()->phone }}">
                                                    </div>

                                                    <div class=" my-3">
                                                        <label for="">Gender</label>
                                                        <select class="form-control" name="gender">
                                                            <option value="">Choose Your Gender...</option>
                                                            <option value="male" @if ( Auth::user()->gender == 'male' ) selected @endif>Male</option>
                                                            <option value="famale" @if ( Auth::user()->gender == 'female' ) selected @endif>Female</option>
                                                        </select>
                                                    </div>

                                                    <div class=" my-3">
                                                        <label for="">Address</label>
                                                        <textarea rows="4" name="address" class="form-control">{{ Auth::user()->address }}</textarea>
                                                    </div>

                                                    <div class=" my-3">
                                                        <label for="">Role</label>
                                                        <input type="text" class="form-control" value="{{ Auth::user()->role }}" disabled>
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

