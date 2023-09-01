@extends('layouts.admin')
@section('style')
<style>
.icon-select {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
}

.icon-option {
    display: flex; /* Align icon and text vertically */
    align-items: center;
    padding: 5px;
    border: 1px solid transparent;
    cursor: pointer;
    transition: border-color 0.3s;
}

.icon-option.selected {
    border-color: #007bff;
}

.icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon-name {
    margin-left: 5px;
}
.scrollable{
    max-height: 200px;
    overflow-y: auto;
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
                                                    <th class="text-center">Profession</th>
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
                                                    <td class="text-center">{{ ($onboading->profession_id != null) ? $onboading->profession->name : 'Not selected' }}</td>
                                                    <td class="text-center">{{ $onboading->criteria->name }}</td>
                                                    <td class="text-center"><img src="{{ $onboading->icon }}" style="width: 50px; height: 50px;" alt="SVG Image"></td>
                                                    <td class="text-center">{{ $onboading->heading }}</td>
                                                    <td class="text-center">{{ $onboading->sub_heading }}</td>
                                                    <td class="text-center">{{ $onboading->type }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button onclick="editor(
                                                            '{{ $onboading->occupation->id }}',
                                                            '{{ $onboading->profession_id }}',
                                                            '{{ $onboading->criteria->id }}',
                                                            '{{ $onboading->icon }}',
                                                            '{{ $onboading->id }}',
                                                            '{{ addslashes($onboading->heading) }}',
                                                            '{{ addslashes($onboading->sub_heading) }}',
                                                            '{{ $onboading->type }}',
                                                            '{{ addslashes($onboading->questions) }}'
                                                            )"
                                                                class="btn btn-primary"><i
                                                                    class="fa fa-pencil"></i></button>
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
                                    <label>Select Profession</label>
                                    <select class="form-control" id="selectedProfession" name="profession">
                                        <option value="" selected >Select Any Profession</option>
                                        
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
                                <label for="iconSelect">Select Icon</label>                                    
                                <div class="form-group scrollable">
                                    <div class="icon-select">
                                        @foreach(glob(public_path('icons/*.svg')) as $iconPath)
                                            <?php
                                                $iconName = basename($iconPath, '.svg');
                                                $iconContent = file_get_contents($iconPath);
                                            ?>
                                            <label class="icon-option">
                                                <input type="radio" name="selected_icon" value="{{ $iconName }}" class="d-none">
                                                <div class="icon">
                                                    {!! $iconContent !!}
                                                </div>
                                                <div class="icon-name">{{ $iconName }}</div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Select Question Type</label>
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
                                <h5 class="modal-title" id="exampleModalLabel">Update OnBoarding</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('updateOnBoarding') }}" method="post" enctype="multipart/form-data" class="p-1">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="id" id="onBoardingIdUpdate">
                                    <label for="selectedOccupationUpdate">Select Occupation</label>
                                    <select class="form-control" id="selectedOccupationUpdate" name="occupation" required>
                                        <option value="" selected disabled>Select Any Occupation</option>
                                        @foreach ($occupations as $occupation)
                                        <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="selectedProfessionUpdate">Select Profession</label>
                                    <select class="form-control" id="selectedProfessionUpdate" name="profession">
                                        <option value="" selected disabled>Select Any Profession</option>
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="selectedCriteriaUpdate">Select Criteria</label>
                                    <select class="form-control" id="selectedCriteriaUpdate" name="criteria" required>
                                        <option value="" selected disabled>Select Any Criteria</option>
                                        @foreach ($criterias as $criteria)
                                        <option value="{{ $criteria->id }}">{{ $criteria->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="onBoardingHeadingUpdate">OnBoarding Heading</label>
                                    <input type="text" name="heading" id="onBoardingHeadingUpdate" class="form-control"
                                        placeholder="Enter Heading" required>
                                </div>
                                <div class="form-group">
                                    <label for="onBoardingSubHeadingUpdate">OnBoarding Sub Heading</label>
                                    <input type="text" name="sub_heading" id="onBoardingSubHeadingUpdate" class="form-control"
                                        placeholder="Enter Sub Heading" required>
                                </div>
                                <label for="iconSelectUpdate">Select Icon</label>
                                <div class="form-group scrollable">
                                    <div class="icon-select">
                                        @foreach(glob(public_path('icons/*.svg')) as $iconPath)
                                            <?php
                                                $iconName = basename($iconPath, '.svg');
                                                $iconContent = file_get_contents($iconPath);
                                            ?>
                                            <label class="icon-option">
                                                <input type="radio" name="selected_icon" value="{{ $iconName }}" class="d-none">
                                                <div class="icon">
                                                    {!! $iconContent !!}
                                                </div>
                                                <div class="icon-name">{{ $iconName }}</div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Select Question Type</label>
                                    <br>
                                    <label for="checkboxUpdate">CheckBox</label>
                                    <input type="radio" name="type" id="checkboxUpdate" value="1" required>
                                    <label for="radioUpdate">Radio</label>
                                    <input type="radio" name="type" id="radioUpdate" value="0" required>
                                </div>
                                <hr>
                                <div class="row p-2">
                                    <h6>Questions</h6>
                                    <button type="button" id="addQuestionBtnUpdate" class="btn btn-primary ml-auto">Add
                                        Question</button>
                                </div>
                                <input type="hidden" id="total_questionsUpdate" name="total_questions">
                                <div id="questionListUpdate" class="mt-3"></div>
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
    $(document).ready(function() {
    $('.icon-option').click(function() {
        $('.icon-option').removeClass('selected');
        $(this).addClass('selected');
    });
});
</script>

<script>
    var baseUrl = "{{ url('/') }}"

    async function editor(occupation,profession,criteria,icon,id,heading,sub_heading,type,questions)
    {
        await showQuestions(JSON.parse(questions))
        await getProfessions(occupation)
        $('#onBoardingIdUpdate').val(id)
        $('#selectedOccupationUpdate').val(occupation)
        $('#selectedProfessionUpdate').val(profession)
        $('#selectedCriteriaUpdate').val(criteria)
        $('#onBoardingHeadingUpdate').val(heading)
        $('#onBoardingSubHeadingUpdate').val(sub_heading)
        $('#onBoardingHeadingUpdate').val(heading)
        if(type == 'CheckBox') 
        {
            $('#checkboxUpdate').prop("checked", true)
        }
        else 
        {
            $('#radioUpdate').prop("checked", true)
        }

        $('#updateCriteria').modal('show')
  
    }

    function generateProfessionSelectUpdate(professions,reload)
    { 
        const selectElement = document.getElementById("selectedProfessionUpdate");
        if(reload || professions.length == 0)
        {
            while (selectElement.options.length > 0) {
                selectElement.remove(0);
            }
            //dummy option selected
            const option = document.createElement("option");
            option.value = '';
            option.textContent = 'Select Any Profession';
            option.selected = true;
            option.disabled = false;
            selectElement.appendChild(option);
        }
        
        //Actual options selected
        professions.forEach(profession => {
            const option = document.createElement("option");
            option.value = profession.id;
            option.textContent = profession.name;
            selectElement.appendChild(option);
        })
    }

    function getProfessions(occupation)
    {
        var url = baseUrl + "/admin/onBoarding/getProfession";
        $.ajax({
            url: url,
            type: "GET",
            data: {
                id: occupation
            },
            success: async function (response) {
                if (response.ok) {
                    await generateProfessionSelectUpdate(response.professions,false)
                }
            },
            error: function (xhr, status, error) {
                // Handle the error response
            }
        });
    }


    $('#selectedOccupation').change(function(){
        const occupation = $('#selectedOccupation').val()
        var url = baseUrl + "/admin/onBoarding/getProfession";
        $.ajax({
            url: url,
            type: "GET",
            data: {
                id: occupation
            },
            success: async function (response) {
                if (response.ok) {
                    generateProfessionSelect(response.professions)
                }
            },
            error: function (xhr, status, error) {
                // Handle the error response
            }
        });
    })
    
    $('#selectedOccupationUpdate').change(function(){
        const occupation = $('#selectedOccupationUpdate').val()
        var url = baseUrl + "/admin/onBoarding/getProfession";
        $.ajax({
            url: url,
            type: "GET",
            data: {
                id: occupation
            },
            success: async function (response) {
                if (response.ok) {
                    generateProfessionSelectUpdate(response.professions,true)
                }
            },
            error: function (xhr, status, error) {
                // Handle the error response
            }
        });
    })

    function generateProfessionSelect(professions)
    {
        const selectElement = document.getElementById("selectedProfession");
        if(professions.length == 0)
        {
            while (selectElement.options.length > 0) {
                selectElement.remove(0);
            }
            const option = document.createElement("option");
            option.value = '';
            option.textContent = 'Select Any Profession';
            option.selected = true;
            option.disabled = false;
            selectElement.appendChild(option);
        }
        professions.forEach(profession => {
            const option = document.createElement("option");
            option.value = profession.id;
            option.textContent = profession.name;
            selectElement.appendChild(option);
        })
    }
    

</script>


<script>
    var questionCounterUpdate = 0
    function showQuestions(questions){
        const questionListUpdateDiv = document.getElementById("questionListUpdate");

        while (questionListUpdateDiv.firstChild) {
            questionListUpdateDiv.removeChild(questionListUpdateDiv.firstChild);
        }
        
        questionCounterUpdate = questions.length;
        
        questions.forEach((question) => {

            const questionDiv = document.createElement("div");
            questionDiv.className = "input-group mb-3";
            
            const questionInput = document.createElement("input");
            questionInput.type = "text";
            questionInput.className = "form-control question-input-update";
            questionInput.name = `question_${questionCounterUpdate}`;
            questionInput.value = question.label;
            questionInput.required = true;

            const questionOrder = document.createElement("select");
            questionOrder.className = "form-control question-order-update";
            questionOrder.name = `question_order_${questionCounterUpdate}`;
            questionOrder.required = true;

            // Create option for "Yes"
            const yesOption = document.createElement("option");
            yesOption.value = 1;
            yesOption.selected = (question.order == 1) ? true : false
            yesOption.text = "Yes";
            questionOrder.appendChild(yesOption);

            // Create option for "No"
            const noOption = document.createElement("option");
            noOption.value = 0;
            noOption.selected = (question.order == 0) ? true : false
            noOption.text = "No";
            questionOrder.appendChild(noOption)
            
            const deleteButton = document.createElement("button");
            deleteButton.className = "btn btn-danger";
            deleteButton.textContent = "Delete";
            
            deleteButton.addEventListener("click", function() {
                questionDiv.remove();
                updateQuestionNamesUpdate()
            })
            
            questionDiv.appendChild(questionInput);
            questionDiv.appendChild(questionOrder);
            questionDiv.appendChild(deleteButton);
            
            document.getElementById("questionListUpdate").appendChild(questionDiv);
            updateQuestionNamesUpdate()
            
        })
        
    }

function updateQuestionNamesUpdate() {
    const questionInputs = document.querySelectorAll(".question-input-update");
    const questionOrders = document.querySelectorAll(".question-order-update");
    questionCounterUpdate = 0;
    questionOrderCounter = 0;
    
    questionInputs.forEach((input, index) => {
        questionCounterUpdate++;
        input.name = `question_${questionCounterUpdate}`;
    });

    questionOrders.forEach((input, index) => {
        questionOrderCounter++;
        input.name = `question_order_${questionOrderCounter}`;
    });

    $('#total_questionsUpdate').val(questionCounterUpdate);
}

// Function to add a new question
function addQuestionUpdate() {
    questionCounterUpdate++;
    
    const questionDiv = document.createElement("div");
    questionDiv.className = "input-group mb-3";
    
    const questionInput = document.createElement("input");
    questionInput.type = "text";
    questionInput.className = "form-control question-input-update";
    questionInput.name = `question_${questionCounterUpdate}`;
    questionInput.placeholder = "Enter your question...";
    questionInput.required = true;

    const questionOrder = document.createElement("select");
    questionOrder.className = "form-control question-order-update";
    questionOrder.name = `question_order_${questionCounterUpdate}`;
    questionOrder.required = true;

    // Create option for "Yes"
    const yesOption = document.createElement("option");
    yesOption.value = 1;
    yesOption.text = "Yes";
    questionOrder.appendChild(yesOption);

    // Create option for "No"
    const noOption = document.createElement("option");
    noOption.value = 0;
    noOption.text = "No";
    questionOrder.appendChild(noOption)
    
    const deleteButton = document.createElement("button");
    deleteButton.className = "btn btn-danger";
    deleteButton.textContent = "Delete";
    
    deleteButton.addEventListener("click", function() {
        questionDiv.remove();
        updateQuestionNamesUpdate()
    })
    
    questionDiv.appendChild(questionInput);
    questionDiv.appendChild(questionOrder);
    questionDiv.appendChild(deleteButton);
    
    document.getElementById("questionListUpdate").appendChild(questionDiv);
    updateQuestionNamesUpdate()
}

// Add event listener to the "Add New Question" button
document.getElementById("addQuestionBtnUpdate").addEventListener("click", addQuestionUpdate);
</script>


<script>
    let questionCounter = 0;
    let questionOrderCounter = 0;

function updateQuestionNames() {
    const questionInputs = document.querySelectorAll(".question-input");
    const questionOrders = document.querySelectorAll(".question-order");
    questionCounter = 0;
    questionOrderCounter = 0;
    
    questionInputs.forEach((input, index) => {
        questionCounter++;
        input.name = `question_${questionCounter}`;
    });
    
    questionOrders.forEach((input, index) => {
        questionOrderCounter++;
        input.name = `question_order_${questionOrderCounter}`;
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
    questionInput.required = true;
    
    const questionOrder = document.createElement("select");
    questionOrder.className = "form-control question-order";
    questionOrder.name = `question_order_${questionCounter}`;
    questionOrder.required = true;

    // Create option for "Yes"
    const yesOption = document.createElement("option");
    yesOption.value = 1;
    yesOption.text = "Yes";
    questionOrder.appendChild(yesOption);

    // Create option for "No"
    const noOption = document.createElement("option");
    noOption.value = 0;
    noOption.text = "No";
    questionOrder.appendChild(noOption)
    
    const deleteButton = document.createElement("button");
    deleteButton.className = "btn btn-danger";
    deleteButton.textContent = "Delete";
    
    deleteButton.addEventListener("click", function() {
        questionDiv.remove();
        updateQuestionNames()
    })
    
    questionDiv.appendChild(questionInput);
    questionDiv.appendChild(questionOrder);
    questionDiv.appendChild(deleteButton);
    
    document.getElementById("questionList").appendChild(questionDiv);
    updateQuestionNames()
}

// Add event listener to the "Add New Question" button
document.getElementById("addQuestionBtn").addEventListener("click", addQuestion);
</script>
<script>
    $(document).ready(function() {
    $('#criteria-table').DataTable({
        // Replace "1" with the index of the column you want to make orderable (in this case, it's the second column, so index 1)
        "order": [[0, "asc"]],
        "columnDefs": [
            {
                "targets": [2],
                "orderable": false
            },
            {
                "targets": [5],
                "orderable": false
            },
            {
                "targets": [6],
                "orderable": false
            }
        ],
        "lengthMenu": [10, 25, 50, 100],
    });
});
</script>
@endsection