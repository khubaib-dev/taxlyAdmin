@extends('layouts.admin')
@section('style')
<style>
    .breadcrumb-item{
        font-size: 10px
    }
</style>
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
                            <h3 class="text-center mt-1">Chart of Account</h3>
                            <div class="row p-2">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        @foreach ($array as $page)
                                            @if(--$counter > 0)
                                            <li class="breadcrumb-item"><a href="{{ route('showCOA',['id' => $page['id']]) }}">{{ $page['cat'] }}</a></li>
                                            @else
                                            <li class="breadcrumb-item">{{ $page['cat'] }}</li>
                                            @endif
                                        @endforeach
                                    </ol>
                                  </nav>
                                <button data-toggle="modal" data-target="#addCoa"
                                    class="btn btn-success d-block ml-auto mr-1"> <i class="fa fa-plus"></i> Add
                                    New</button>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <div class="block full p-2">
                                        <table id="coa-table" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Category</th>
                                                    <th class="text-center">Code</th>
                                                    <th class="text-center">Child</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($coas as $coa)
                                                <tr>
                                                    <td class="text-center">{{ $coa->category }}</td>
                                                    <td class="text-center">{{ $coa->code }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ route('showCOA',['id' => $coa->id]) }}"
                                                                class="btn btn-primary"><i
                                                                    class="fa fa-arrow-down"></i></a>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button onclick="editor('{{ $coa->id }}','{{ $coa->category }}','{{ $coa->code }}')" class="btn btn-primary"><i
                                                                    class="fa fa-pencil"></i></button>
                                                            <a onclick="return confirm('Are you sure you want to delete this COA entry?');" href="{{ route('deleteCOA',['id' => $coa->id]) }}"
                                                                class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </td>
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
                <div class="modal fade" id="addCoa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Chart of Account</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('addCOA') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="categoryName">Category Name</label>
                                        <input type="text" name="categoryName" id="categoryName" class="form-control" placeholder="Enter Category Name" required>
                                        <input type="hidden" id="categoryParent" name="categoryParent" class="form-control" value="{{ $id }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="categoryCode">Category Code</label>
                                        <input type="number" name="categoryCode" id="categoryCode" class="form-control" placeholder="Enter Category Code" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- Update Modal --}}
                <div class="modal fade" id="updateCOA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Chart of Account</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('updateCOA') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="categoryNameUpdate">Category Name</label>
                                        <input type="text" name="categoryName" id="categoryNameUpdate" class="form-control" placeholder="Enter Category Name" required>
                                        <input type="hidden" id="categoryParentUpdate" name="categoryParent" class="form-control" value="{{ $id }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="categoryCodeUpdate">Category Code</label>
                                        <input type="number" name="categoryCode" id="categoryCodeUpdate" class="form-control" placeholder="Enter Category Code" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
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
    function editor(id,cat,code)
    {
        $('#categoryParentUpdate').val(id)
        $('#categoryNameUpdate').val(cat)
        $('#categoryCodeUpdate').val(code)
        $('#updateCOA').modal('show')
    }

    $(document).ready(function() {
    $('#coa-table').DataTable({
        // Replace "1" with the index of the column you want to make orderable (in this case, it's the second column, so index 1)
        "order": [[1, "asc"]],
        "columnDefs": [
            {
                "targets": [2],
                "orderable": false
            },
            {
                "targets": [3],
                "orderable": false
            },
        ],
        "lengthMenu": [10, 25, 50, 100],
    });
});
</script>
@endsection