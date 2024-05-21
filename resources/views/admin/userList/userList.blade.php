@extends('admin.layouts.master');

@section('title','User List');

@section('content')
<div class="page-wrapper">


    <!-- PAGE CONTAINER-->
    <div class="page-container">

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">

                <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-3">
                                <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('search') }}</span></h4>
                            </div>
                            <div class="col-3 offset-6">
                                <form class="mb-3 form-header" action="{{ route('admin#userList') }}" method="GET">
                                    @csrf
                                    <input class="au-input" type="text" name="search" value="{{ request('search') }}" placeholder="Search Users..." />
                                    <button class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- DATA TABLE -->

                        @if (count($user) != 0)
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
                                        <th>ROLE</th>
                                        <th>CRUD</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <span id="" class="row">
                                        @foreach ($user as $u)
                                        <tr class="tr-shadow">
                                            <input type="hidden" class="userId" value="{{ $u->id }}">
                                            <td>
                                                @if ($u->image == null)
                                                  @if ($u->gender == 'male')
                                                    <img src="{{ asset('admin/images/profile.png') }}" style="height: 100px">
                                                  @elseif ($u->gender == 'female')
                                                    <img src="{{ asset('admin/images/profileFemale.jpg') }}" style="height: 100px">
                                                  @endif
                                                @else
                                                  <img src="{{ asset('storage/'.$u->image) }}" style="height: 100px">
                                                @endif
                                            </td>
                                            <td class="desc">{{ $u->name }}</td>
                                            <td class="desc">{{ $u->email }}</td>
                                            <td class="desc">{{ $u->gender }}</td>
                                            <td class="desc">{{ $u->phone }}</td>
                                            <td class="desc">{{ $u->address }}</td>
                                            <td class="desc">
                                                <select name="" class="roleChange">
                                                    <option value="user" @if( $u->role == 'user') selected @endif>User</option>
                                                    <option value="admin" @if( $u->role == 'admin') selected @endif>Admin</option>
                                                </select>
                                            </td>

                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>

                                                        <button id="" class="item deleteUser" type="button" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>

                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                        <i class="zmdi zmdi-more"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                     </span>
                                </tbody>
                            </table>
                        </div>
                        <!-- END DATA TABLE -->

                        @else
                        <h3 class="text-center text-secondary mt-5">There is no User</h3>
                        @endif

                        {{-- <div class="mt-5">
                            {{ $user->links('pagination::bootstrap-5') }}
                        </div> --}}
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
      $('.deleteUser').click(function(){
        $parentNode = $(this).parents('tr');
        $userId = $parentNode.find('.userId').val();

        $.ajax({
            type : 'get',
            url : '{{ route('admin#userDelete') }}',
            data : { 'user_id' : $userId },
            dataType : 'json',
            success : function(respose){
                if(respose.status == 'success'){
                    window.location.href="{{ route('admin#userList') }}"
                }
            }
        })
      })

      $('.roleChange').change(function(){
        $roleValue = $(this).val();
        $parentNode = $(this).parents('tr');
        $userId = $parentNode.find('.userId').val();

        // console.log($roleValue)

        $.ajax({
            type : 'get',
            url : '{{ route('admin#userRole') }}',
            data : {
                'role' : $roleValue,
                'user_id' : $userId
            },
            dataType : 'json',
            success : function(response){
                window.location.href="{{ route('admin#userList') }}"
            }
        })
      })
   })
</script>
@endsection
