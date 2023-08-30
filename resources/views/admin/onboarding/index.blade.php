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
                            <h3 class="text-center mt-1">OnBoardings List</h3>
                            <div class="row px-2">
                                <button data-toggle="modal" data-target="#addCriteria" class="btn btn-success ml-auto">
                                    <i class="fa fa-plus"></i> Add New</button>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <div class="block full p-2">
                                        <table id="criteria-table" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Occupation</th>
                                                    <th class="text-center">Criteria</th>
                                                    <th class="text-center">Icon</th>
                                                    <th class="text-center">Heading</th>
                                                    <th class="text-center">Sub Heading</th>
                                                    <th class="text-center">Type</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($onboadings as $onboading)
                                                <tr>
                                                    <td class="text-center">{{ $onboading->occupation->name }}</td>
                                                    <td class="text-center">{{ $onboading->criteria->name }}</td>
                                                    <td class="text-center"><img src="{{ $onboading->icon }}" alt="SVG Image"></td>
                                                    <td class="text-center">{{ $onboading->heading }}</td>
                                                    <td class="text-center">{{ $onboading->sub_heading }}</td>
                                                    <td class="text-center">{{ $onboading->type }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            {{-- <button
                                                                onclick="editor('{{ $onboading->occupation->id }}','{{ $onboading->criteria->id }}',
                                                                '{{ $onboading->id }}','{{ $onboading->heading }}','{{ $onboading->sub_heading }}','{{ $onboading->type }}')"
                                                                class="btn btn-primary"><i
                                                                    class="fa fa-pencil"></i></button> --}}
                                                            <a onclick="return confirm('Are you sure you want to delete OnBoarding')"
                                                                href="{{ route('deleteOnBoarding',['id' => $onboading->id]) }}"
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
                                <h5 class="modal-title" id="exampleModalLabel">Add New OnBoarding</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('addOnBoarding') }}" method="post" class="p-1" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Select Occupation</label>
                                    <select class="form-control" id="selectedOccupation" name="occupation" required>
                                        <option value="" selected disabled>Select Any Occupation</option>
                                        @foreach ($occupations as $occupation)
                                        <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Select Criteria</label>
                                    <select class="form-control" id="selectedCriteria" name="criteria" required>
                                        <option value="" selected disabled>Select Any Criteria</option>
                                        @foreach ($criterias as $criteria)
                                        <option value="{{ $criteria->id }}">{{ $criteria->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="onBoardingHeading">OnBoarding Heading</label>
                                    <input type="text" name="heading" id="onBoardingHeading" class="form-control"
                                        placeholder="Enter Heading" required>
                                </div>
                                <div class="form-group">
                                    <label for="onBoardingSubHeading">OnBoarding Sub Heading</label>
                                    <input type="text" name="sub_heading" id="onBoardingSubHeading" class="form-control"
                                        placeholder="Enter Sub Heading" required>
                                </div>
                                <div class="form-group">
                                    <label for="iconSelect">Select Icon</label>                                    
                                    <input type="file" name="icon" id="iconSelect" accept=".svg" required>
                                </div>
                                <div class="form-group">
                                    <label>Select Type</label>
                                    <br>
                                    <label for="checkbox">CheckBox</label>
                                    <input type="radio" name="type" id="checkbox" value="1" required>
                                    <label for="radio">Radio</label>
                                    <input type="radio" name="type" id="radio" value="0" required>
                                </div>
                                <hr>
                                <div class="row p-2">
                                    <h6>Add Questions</h6>
                                    <button type="button" id="addQuestionBtn" class="btn btn-primary ml-auto">Add
                                        Question</button>
                                </div>
                                <input type="hidden" id="total_questions" name="total_questions">
                                <div id="questionList" class="mt-3"></div>
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
                            <form action="{{ route('updateOccupation') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="occupationUpdate">Occupation Name</label>
                                        <input type="text" name="occupation" id="occupationUpdate" class="form-control"
                                            placeholder="Enter Occupation Name" required>
                                        <input type="hidden" id="occupationUpdateId" name="occupationId"
                                            class="form-control" required>
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
    let questionCounter = 0;

function updateQuestionNames() {
    const questionInputs = document.querySelectorAll(".question-input");
    questionCounter = 0;
    
    questionInputs.forEach((input, index) => {
        questionCounter++;
        input.name = `question_${questionCounter}`;
    });

    $('#total_questions').val(questionCounter);
}

// Function to add a new question
function addQuestion() {
    questionCounter++;
    
    const questionDiv = document.createElement("div");
    questionDiv.className = "input-group mb-3";
    
    const questionInput = document.createElement("input");
    questionInput.type = "text";
    questionInput.className = "form-control question-input";
    questionInput.name = `question_${questionCounter}`;
    questionInput.placeholder = "Enter your question...";
    
    const deleteButton = document.createElement("button");
    deleteButton.className = "btn btn-danger";
    deleteButton.textContent = "Delete";
    
    deleteButton.addEventListener("click", function() {
        questionDiv.remove();
        updateQuestionNames()
    })
    
    questionDiv.appendChild(questionInput);
    questionDiv.appendChild(deleteButton);
    
    document.getElementById("questionList").appendChild(questionDiv);
    updateQuestionNames()
}

// Add event listener to the "Add New Question" button
document.getElementById("addQuestionBtn").addEventListener("click", addQuestion);
</script>
<script>
    function editor(occupation,criteria,id,heading,sub_heading,type)
    {
        
        
        // $('#updateCriteria').modal('show')
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