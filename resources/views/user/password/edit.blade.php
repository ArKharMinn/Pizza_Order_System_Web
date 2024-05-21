<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accont Update</title>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/17730cb0db.js" crossorigin="anonymous"></script>
    {{-- bootstrap  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>

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
                                    <a href="{{ route('user#home') }}" class="p-3 nav-link" >
                                        <i class="fa-solid fa-arrow-left"></i>
                                        BACK
                                    </a>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Account Update</h3>
                                        </div>
                                        <hr>

                                    <form action="{{ route('user#update', Auth::user()->id ) }}" enctype="multipart/form-data" method="POST">
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
                                                    <button type="submit" class="btn btn-dark mt-3">
                                                        <i class="fa-solid fa-pen-to-square me-2"></i>
                                                        Update Profile
                                                    </button>
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

    {{-- Bootstrap Javascript  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
