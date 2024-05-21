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
                            <a href="{{ route('admin#inbox') }}" class="nav-link p-2">
                                <i class="fa-solid fa-arrow-left"></i> Back
                            </a>
                            <div class="col-lg-8 offset-2 parentDiv">
                                <input type="hidden" class="contactId" value="{{ $data->contact_id }}"/>
                                <div class="card p-5">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <h3 class="">{{ $data->name }}</h3>
                                        </div>
                                        <div class="col-md-1">
                                            <button class="item deleteBtn" id="" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <h2><i class="zmdi zmdi-delete text-danger"></i></h2>
                                            </button>
                                        </div>
                                    </div>
                                    <h5 class="my-4 text-primary">{{ $data->email }}</h5>
                                    <p class="">{{ $data->message }}</p>
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

@section('scriptSource')
    <script>
        $(document).ready(function(){
           $('.deleteBtn').click(function(){
            $parentNode = $(this).parents('div');
            $contactId = $parentNode.find('.contactId').val();

            $.ajax({
                type : 'get',
                url : '{{ route('admin#messageDelete') }}',
                data : {
                    'contactId' : $contactId,
                },
                dataType : 'json',
                success : function(response){
                    if(response.status == 'success'){
                        window.location.href="{{ route('admin#inbox') }}";
                    }
                }
            })
           })
        })
    </script>
@endsection
