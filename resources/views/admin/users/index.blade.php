@extends('layouts.admin')
@section('style')

@endsection

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Ecommerce Starts -->
            <section id="dashboard-ecommerce">

                <div class="row match-height">
                    <!-- Company Table Card -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card card-company-table">
                            <h3 class="text-center mt-1">Users</h3>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <div class="block full p-2">
                                        <table id="users-table"
                                            class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">First Name</th>
                                                    <th class="text-center">Last Name</th>
                                                    <th class="text-center">Email</th>
                                                    <th class="text-center"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td class="text-center">{{ $user['fname'] }}</td>
                                                        <td class="text-center">{{ $user['lname'] }}</td>
                                                        <td class="text-center">{{ $user['email'] }}</td>
                                                        <td class="text-center"><div class="btn-group">
                                                            {{-- <button class="btn btn-primary"><i class="fa fa-pencil"></i></button>     --}}
                                                            <a href="{{ route('UserDelete',['id' => $user->id,'aMemberId' => $user['user_id']]) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>    
                                                        </div></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <!-- Dashboard Ecommerce ends -->

        </div>
    </div>
</div>
<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#users-table').DataTable({
        // Replace "1" with the index of the column you want to make orderable (in this case, it's the second column, so index 1)
        "order": [[1, "asc"]],
        "columnDefs": [
            {
                // Disable ordering for the last column (Action column)
                "targets": [3],
                "orderable": false
            }
        ],
        "lengthMenu": [10, 25, 50, 100],
    });
});
</script>
@endsection