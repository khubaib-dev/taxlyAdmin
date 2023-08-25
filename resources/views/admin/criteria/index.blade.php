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
                            <h3 class="text-center mt-1">Criteria List</h3>
                            <button data-toggle="modal" data-target="#addCriteria"
                                class="btn btn-success d-block ml-auto mr-1"> <i class="fa fa-plus"></i> Add
                                New</button>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <div class="block full p-2">
                                        <table id="criteria-table"
                                            class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Occupation</th>
                                                    <th class="text-center">User Type</th>
                                                    <th class="text-center">Code</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($criterias as $criteria)
                                                    <tr>
                                                        <td class="text-center">{{ $criteria->name }}</td>
                                                        <td class="text-center">{{ $criteria->occupation }}</td>
                                                        <td class="text-center">{{ $criteria->user_type }}</td>
                                                        <td class="text-center">{{ $criteria->values }}</td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <button
                                                                    onclick="editor('{{ $criteria->id }}','{{ $criteria->name }}','{{ $criteria->values }}','{{ $criteria->occupation }}','{{ $criteria->user_type }}')"
                                                                    class="btn btn-primary"><i
                                                                        class="fa fa-pencil"></i></button>
                                                                <a onclick="return confirm('Are you sure you want to delete criteria')" href="{{ route('deleteCriteria',['id' => $criteria->id]) }}"
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
                <div class="modal fade" id="addCriteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Criteria</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('addCriteria') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="criteriaName">Criteria Name</label>
                                        <input type="text" name="criteriaName" id="criteriaName" class="form-control"
                                            placeholder="Enter Criteria Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="occupation">Select Occupation</label>
                                        <select name="occupation" id="occupation" class="form-control">
                                            <option selected disabled>Select Occupation</option>
                                            @foreach ($occupations as $occupation)
                                                <option value="{{ $occupation->name }}">{{ $occupation->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_type">Select User Type</label>
                                        <select name="user_type" id="user_type" class="form-control">
                                            <option selected disabled>Select User Type</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->name }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="criteriaCode">Criteria Code</label>
                                        <input type="text" name="criteriaCode" id="criteriaCode" class="form-control"
                                            placeholder="Enter Criteria Code with comma(,) seperation" required>
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
                <div class="modal fade" id="updateCriteria" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Criteria</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('updateCriteria') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="criteriaNameUpdate">Criteria Name</label>
                                        <input type="text" name="criteriaName" id="criteriaNameUpdate"
                                            class="form-control" placeholder="Enter Criteria Name" required>
                                        <input type="hidden" id="criteriaId" name="criteriaId" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="occupation">Select Occupation</label>
                                        <select name="occupation" id="occupationUpdate" class="form-control">
                                            <option selected disabled>Select Occupation</option>
                                            @foreach ($occupations as $occupation)
                                                <option value="{{ $occupation->name }}">{{ $occupation->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_type_update">Select User Type</label>
                                        <select name="user_type" id="user_type_update" class="form-control">
                                            <option selected disabled>Select User Type</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->name }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="criteriaCodeUpdate">Criteria Code</label>
                                        <input type="text" name="criteriaCode" id="criteriaCodeUpdate"
                                            class="form-control" placeholder="Enter Criteria Code with comma(,) seperation" required>
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
    function editor(id,cat,code,occupation,user_type)
    {
        code = code.substring(1, code.length-1)
        $('#criteriaId').val(id)
        $('#criteriaNameUpdate').val(cat)
        $('#criteriaCodeUpdate').val(code)
        $('#occupationUpdate').val(occupation)
        $('#user_type_update').val(user_type)
        $('#updateCriteria').modal('show')
    }

    $(document).ready(function() {
    $('#criteria-table').DataTable({
        // Replace "1" with the index of the column you want to make orderable (in this case, it's the second column, so index 1)
        "order": [[0, "asc"]],
        "columnDefs": [
            {
                "targets": [1],
                "orderable": false
            },
            {
                "targets": [2],
                "orderable": false
            }
        ],
        "lengthMenu": [10, 25, 50, 100],
    });
});
</script>
@endsection