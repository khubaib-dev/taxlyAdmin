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
                                                    <th class="text-center">Amount</th>
                                                    <th class="text-center">Category</th>
                                                    <th class="text-center">Transaction Date</th>
                                                    <th class="text-center">Code</th>
                                                    <th class="text-center">COA Record</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transactions as $transaction)
                                                    <tr>
                                                        <td class="text-center">{{ $transaction->amount }}</td>
                                                        <td class="text-center">{{ $transaction->category }}</td>
                                                        <td class="text-center">{{ $transaction->postDate }}</td>
                                                        <td class="text-center">{{ $transaction->category_id }}</td>
                                                        <td class="text-center">@if($transaction->flag_coa == 1) <span class="badge badge-success">Found</span> @else <span class="badge badge-danger">Not Found</span>@endif</td>
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
        // "order": [[1, "asc"]],
        "columnDefs": [
            {
                // Disable ordering for the last column (Action column)
                "targets": [4],
                "orderable": false
            }
        ],
        "lengthMenu": [10, 25, 50, 100],
    });
});
</script>
@endsection