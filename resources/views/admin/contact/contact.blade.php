@extends('admin.layouts.master')

@section('title','Inbox');

@section('content')
<div class="page-wrapper">


    <!-- PAGE CONTAINER-->
    <div class="page-container">

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                <div class="overview-wrap">
                                    <h2 class="title-1"><i class="fa-solid fa-inbox me-2"></i>Inbox</h2>

                                </div>
                            </div>

                        </div>

                        @if (session('deleteSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show col-4 offset-8" role="alert">
                            <strong>Delete Success!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif

                        <div class="row">

                            <div class="col-md-7">
                                <form class="mb-3 form-header" action="{{ route('admin#inbox') }}" method="GET">
                                    @csrf
                                    <input id="search" class="form-control " type="text" name="search" value="{{ request('search') }}" placeholder="Search Inbox Message" />
                                    <div class="p-2 clearBtn ">
                                        <h3 class="text-danger">
                                            <i class="fa-solid fa-circle-xmark" data-toggle="tooltip"  title="Clear Search"></i>
                                        </h3>
                                    </div>
                                    <button class="au-btn--submit" type="submit" data-toggle="tooltip"  title=" Search">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>


                        {{-- <div class="my-3">
                            <label for="" class="me-3">Status</label>
                            <select id="orderStatus" class="p-1">
                                <option value="">All</option>
                                <option value="0">Pending</option>
                                <option value="1" >Successed</option>
                                <option value="2">Rejected</option>
                            </select>
                        </div> --}}

                        @if (count($inbox) != 0)
                        <div class="table-responsive table-responsive-data2">
                            @foreach ($inbox as $i)
                                <nav class="rounded shadow-lg bg-white p-4 my-3">
                                    <input type="hidden" class="inboxId" value="{{ $i->contact_id }}">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h3 class="">{{ $i->name }}</h3>
                                        </div>
                                        <div class="col-md-2">
                                            <p class="d-inline me-2">{{ $i->created_at }}</p>
                                            <button class="item deleteBtn" id="" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <h3><i class="zmdi zmdi-delete text-danger"></i></h3>
                                            </button>
                                        </div>
                                    </div>
                                    <h4 class="my-3 text-primary">{{ $i->email }}</h4>
                                    <p>{{ Str::limit($i->message,200,'...') }} </p>
                                    <a href="{{ route('admin#message',$i->contact_id) }}" class="text-primary nav-link" class="mt-4">read more</a>
                                </nav>
                            @endforeach
                        </div>
                        <!-- END DATA TABLE -->

                        @else
                        <h3 class="text-center text-secondary mt-5">There is no Inbox</h3>
                        @endif

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
                $parentNode = $(this).parents("nav");
                $contactId = $parentNode.find('.inboxId').val();
                // console.log($contactId)

                $.ajax({
                    type : 'get',
                    url : '{{ route('admin#inboxDelete') }}',
                    data : { 'contact_id' : $contactId },
                    dataType : 'json',
                    success : function(response){
                        if(response.status == 'success'){
                            window.location.href="{{ route('admin#inbox') }}"
                        }
                    }
                })
            })

            //clear btn
            $('.clearBtn').click(function(){
                $('#search').val("")
            })
        })
    </script>
@endsection
