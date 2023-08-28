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
                            <h3 class="text-center mt-1">Professions List</h3>
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
                                                    <th class="text-center">Occupation Name</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($professions as $profession)
                                                    <tr>
                                                        <td class="text-center">{{ $profession->name }}</td>
                                                        <td class="text-center">{{ $profession->occupation->name }}</td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <button
                                                                    onclick="editor('{{ $profession->name }}','{{ $profession->id }}','{{ $profession->occupation->id }}')"
                                                                    class="btn btn-primary"><i
                                                                        class="fa fa-pencil"></i></button>
                                                                <a onclick="return confirm('Are you sure you want to delete Profession')" href="{{ route('deleteProfession',['id' => $profession->id]) }}"
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
                                <h5 class="modal-title" id="exampleModalLabel">Add New Profession</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('addProfession') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Select Occupation</label>
                                        <select class="form-control" name="occupation">
                                            <option selected disabled>Select Any Occupation</option>
                                            @foreach ($occupations as $occupation)
                                                <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="ProfessionName">Profession Name</label>
                                        <input type="text" name="profession" id="ProfessionName"
                                            class="form-control" placeholder="Enter Profession Name" required>
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
                                <h5 class="modal-title" id="exampleModalLabel">Update Occupation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('updateProfession') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Select Occupation</label>
                                        <select class="form-control" id="selectedOccupation" name="occupation">
                                            <option selected disabled>Select Any Occupation</option>
                                            @foreach ($occupations as $occupation)
                                                <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="professionUpdate">Profession Name</label>
                                        <input type="text" name="profession" id="professionUpdate"
                                            class="form-control" placeholder="Enter Profession Name" required>
                                        <input type="hidden" id="professionUpdateId" name="professionId" class="form-control"
                                            required>
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
    function editor(name,id,occupation)
    {
        $('#professionUpdateId').val(id)
        $('#professionUpdate').val(name)
        $('#selectedOccupation').val(occupation)
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
            }
        ],
        "lengthMenu": [10, 25, 50, 100],
    });
});
</script>
@endsection