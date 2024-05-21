<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password</title>
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
            <div class="main-content p-5">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="container-fluid d-flex  justify-content-center align-items-center">
                                {{-- <div class="row">
                                    <div class="col-3 offset-8">
                                        <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                                    </div>
                                </div> --}}
                                <div class="col-lg-6 ">
                                    <div class="card">
                                        <a href="{{ route('user#home') }}" class="p-3 nav-link" >
                                            <i class="fa-solid fa-arrow-left"></i>
                                            BACK
                                        </a>
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h3 class="text-center title-2">Change Password</h3>
                                            </div>
                                            <hr>
                                                    @if ( session('key') )
                                                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong class="text-danger">The old password is not match</strong> Please try again.
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                      </div>
                                                    @endif
                                            <form action="{{ route('user#passwordChange') }}" method="post" novalidate="novalidate">
                                                @csrf
                                                <div class="form-group my-3">
                                                    <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                                    <input id="cc-pament" name="oldPassword" type="password" class="form-control @error('oldPassword')  is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Old Password...">
                                                    @error('oldPassword')
                                                        <small class="text-danger invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">New Password</label>
                                                    <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword')  is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Password...">
                                                    @error('newPassword')
                                                        <small class="text-danger invalid-feedback">{{ $message }}</small>
                                                    @enderror

                                                </div>

                                                <div class="form-group my-3">
                                                    <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                                    <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword')  is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password...">
                                                    @error('confirmPassword')
                                                        <small class="text-danger invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                        <span id="payment-button-amount"><i class="fa-solid fa-key me-2"></i>Change</span>
                                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                                        {{-- <i class="fa-solid fa-circle-right"></i> --}}
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
    {{-- Bootstrap Javascript  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
