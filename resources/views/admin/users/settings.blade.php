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
                            <h3 class="text-center mt-1">{{ $user['name'] }} Settings</h3>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <div class="block full p-2">
                                        <table id="users-table"
                                            class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Work Status</th>
                                                    <th class="text-center">Work Type</th>
                                                    <th class="text-center">Travel Type</th>
                                                    <th class="text-center">Profession</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <tr>
                                                        <td class="text-center">{{ $settings->work_status }}</td>
                                                        <td class="text-center">{{ $settings->work_type }}</td>
                                                        <td class="text-center">{{ $settings->travel_type }}</td>
                                                        <td class="text-center">{{ $settings->profession }}</td>
                                                        
                                                    </tr>
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
        // "order": [[1, "asc"]],
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