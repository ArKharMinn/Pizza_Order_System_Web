@extends('admin.layouts.master');

@section('title','Admin List');

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
                                    <h2 class="title-1">Category List</h2>

                                </div>
                            </div>
                            <div class="table-data__tool-right">
                                <a href="{{ route('category#createPage') }}">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        <i class="zmdi zmdi-plus"></i>add item
                                    </button>
                                </a>
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    CSV download
                                </button>
                            </div>
                        </div>

                        @if (session('deleteSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show col-4 offset-8" role="alert">
                            <strong>Delete Success!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif

                        <div class="row">
                            <div class="col-3">
                                <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('search') }}</span></h4>
                            </div>
                            <div class="col-3 offset-6">
                                <form class="mb-3 form-header" action="{{ route('admin#list') }}" method="GET">
                                    @csrf
                                    <input class="au-input" type="text" name="key" value="{{ request('key') }}" placeholder="Search for datas &amp; reports..." />
                                    <button class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-1 offset-11">
                                <h3 class="bg-white shadow-lg text-center p-2 rounded"><i class="fa-solid fa-database"></i> {{ $admin->total() }}</h3>
                            </div>
                        </div>

                        @if (count($admin) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="text-center table table-data2">
                                <thead class="">
                                    <tr class="fw-bolder">
                                        <th>IMAGE</th>
                                        <th>NAME</th>
                                        <th>EMAIL</th>
                                        <th>GENDER</th>
                                        <th>PHONE</th>
                                        <th>ADDRESS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admin as $a)
                                    <tr class="tr-shadow">
                                        <input type="hidden" class="userId" value="{{ $a->id }}">
                                        <td class="col-2 img-thumbnail">
                                            @if ( $a->image == null )
                                                @if ( $a->gender == 'male' )
                                                    <img src=" {{ asset('admin/images/profile.png') }} "/>
                                                @else
                                                    <img src="{{ asset('admin/images/profileFemale.jpg') }}"/>
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' .$a->image) }}"/>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="block-email">{{ $a->name }}</span>
                                        </td>
                                        <td class="desc">{{ $a->email }}</td>
                                        <td class="desc">{{ $a->gender }}</td>
                                        <td class="desc">{{ $a->phone }}</td>
                                        <td class="desc">{{ $a->address }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button> --}}

                                                @if ( Auth::user()->id == $a->id )

                                                @else

                                                    <button type="button" class="item changeRole"  value="user" data-toggle="tooltip" data-placement="top" title="Change Role">
                                                        <i class="fa-solid fa-person-circle-minus"></i>
                                                    </button>

                                                @endif

                                                @if ( Auth::user()->id == $a->id )

                                                @else
                                                 <a href="{{ route('admin#delete', $a->id) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete" ></i>
                                                    </button>
                                                 </a>
                                                @endif

                                                <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                    <i class="zmdi zmdi-more"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- END DATA TABLE -->

                        @else
                        <h3 class="text-center text-secondary mt-5">There is no Categories</h3>
                        @endif

                        <div class="mt-5">
                            {{ $admin->links('pagination::bootstrap-5') }}
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
            $('.changeRole').click(function(){
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('.userId').val();
                $role = $(this).val();

                $.ajax({
                    type : 'get',
                    url : '{{ route('admin#changeRole') }}',
                    data : {
                        'user_id' : $userId,
                        'role' : $role,
                    },
                    dataType : 'json',
                    success : function(response){
                        window.location.href="{{ route('admin#list') }}";
                    }
                })
            })
        })
    </script>
@endsection
