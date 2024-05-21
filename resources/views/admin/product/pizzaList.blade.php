@extends('admin.layouts.master');

@section('title','Product Pizza');

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
                                    <h2 class="title-1">Product List</h2>

                                </div>
                            </div>
                            <div class="table-data__tool-right">
                                <a href="{{ route('product#create') }}">
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
                                <form class="mb-3 form-header" action="{{ route('product#list') }}" method="GET">
                                    @csrf
                                    <input class="au-input" type="text" name="search" value="{{ request('search') }}" placeholder="Search for datas &amp; reports..." />
                                    <button class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-1 offset-11">
                                <h3 class="bg-white shadow-lg text-center p-2 rounded"><i class="fa-solid fa-database"></i>  </h3>
                            </div>
                        </div>

                        @if (count($pizzas) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="text-center table table-data2">
                                <thead class="">
                                    <tr class="fw-bolder">
                                        <th>IMAGE</th>
                                        <th>NAME</th>
                                        <th>PRICE</th>
                                        <th>CATEGORY</th>
                                        <th>VIEW COUNT</th>
                                        <th>CRUD</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizzas as $p)
                                    <tr class="tr-shadow">
                                        <td class="col-2"><img src="{{ asset('storage/' . $p->image ) }}" class=" img-thumbnail shadow-sm"></td>
                                        <td>
                                            <span class="block-email">{{ $p->name }}</span>
                                        </td>
                                        <td class="desc">{{ $p->price }}</td>
                                        <td class="desc">{{ $p->category_name }}</td>
                                        <td class="desc"><i class="fa-solid fa-eye me-2"></i>{{ $p->view_count }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('product#view',$p->product_id) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('product#updatePizza',$p->product_id) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('product#deletePizza',$p->product_id) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>
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
                        <h3 class="text-center text-secondary mt-5">There is no Pizza</h3>
                        @endif

                        <div class="mt-5">
                           {{ $pizzas->links('pagination::bootstrap-5') }}
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
