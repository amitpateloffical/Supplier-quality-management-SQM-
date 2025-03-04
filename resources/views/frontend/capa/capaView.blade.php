@extends('frontend.layout.main')
@section('container')
    @php
        $users = DB::table('users')->get();
    @endphp
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
        .remove-file  {
            color: white;
            cursor: pointer;
            margin-left: 10px;
        }

        .remove-file :hover {
            color: white;
        }
    </style>
    <style>
        .w-5 {
            width: 5%;
        }
        .w-10 {
            width: 10%;
        }
    
        .w-20 {
            width: 20%;
        }
    
        .w-25 {
            width: 25%;
        }
    
        .w-30 {
            width: 30%;
        }
    
        .w-40 {
            width: 40%;
        }
    
        .w-50 {
            width: 50%;
        }
    
        .w-60 {
            width: 60%;
        }
    
        .w-70 {
            width: 70%;
        }
    
        .w-80 {
            width: 80%;
        }
    
        .w-90 {
            width: 90%;
        }
    
        .w-100 {
            width: 100%;
        }
    
    </style>
<style>
    .mic-btn {
        background: none;
        border: none;
        outline: none;
        cursor: pointer;
        position: absolute;
        right: 10px; /* Position the button at the right corner */
        top: 50%; /* Center the button vertically */
        transform: translateY(-50%); /* Adjust for the button's height */
        box-shadow: none; /* Remove shadow */
    }
    .mic-btn i {
        color: black; /* Set the color of the icon */
        box-shadow: none; /* Remove shadow */
    }
    .mic-btn:focus,
    .mic-btn:hover,
    .mic-btn:active {
        box-shadow: none; /* Remove shadow on hover/focus/active */
    }

    .relative-container {
        position: relative;
    }

    .relative-container textarea {
        width: 100%;
        padding-right: 40px; /* Ensure the text does not overlap the button */
    }
</style>

<style>
    #start-record-btn {
        background: none;
        border: none;
        outline: none;
        cursor: pointer;
    }
    #start-record-btn i {
        color: black; /* Set the color of the icon */
        box-shadow: none; /* Remove shadow */
    }
    #start-record-btn:focus,
    #start-record-btn:hover,
    #start-record-btn:active {
        box-shadow: none; /* Remove shadow on hover/focus/active */
    }
</style>

<style>
    .group-input {
        margin-bottom: 20px;
    }
    .mic-btn, .speak-btn {
        background: none;
        border: none;
        outline: none;
        cursor: pointer;
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        box-shadow: none;
    }
    .mic-btn i, .speak-btn i {
        color: black;
    }
    .mic-btn:focus,
    .mic-btn:hover,
    .mic-btn:active,
    .speak-btn:focus,
    .speak-btn:hover,
    .speak-btn:active {
        /* box-shadow: none; */
    }
    .relative-container {
        position: relative;
    }
    .relative-container input {
        width: 100%;
        padding-right: 40px;
    }
</style>


<style>
    .mic-btn {
        background: none;
        border: none;
        outline: none;
        cursor: pointer;
        position: absolute;
        right: 10px; /* Position the button at the right corner */
        top: 50%; /* Center the button vertically */
        transform: translateY(-50%); /* Adjust for the button's height */
        box-shadow: none; /* Remove shadow */
    }
    .mic-btn i {
        color: black; /* Set the color of the icon */
        box-shadow: none; /* Remove shadow */
    }
    .mic-btn:focus,
    .mic-btn:hover,
    .mic-btn:active {
        box-shadow: none; /* Remove shadow on hover/focus/active */
    }

    .relative-container {
        position: relative;
    }

    .relative-container textarea {
        width: 100%;
        padding-right: 40px; /* Ensure the text does not overlap the button */
    }
</style>

    <style>
    #start-record-btn {
        background: none;
        border: none;
        outline: none;
        cursor: pointer;
    }
    #start-record-btn i {
        color: black; /* Set the color of the icon */
        box-shadow: none; /* Remove shadow */
    }
    #start-record-btn:focus,
    #start-record-btn:hover,
    #start-record-btn:active {
        box-shadow: none; /* Remove shadow on hover/focus/active */
    }
</style>


<style>
    .mic-btn {
        background: none;
        border: none;
        outline: none;
        cursor: pointer;
        position: absolute;
        right: 10px; /* Position the button at the right corner */
        top: 50%; /* Center the button vertically */
        transform: translateY(-50%); /* Adjust for the button's height */
        box-shadow: none; /* Remove shadow */
    }
    .mic-btn i {
        color: black; /* Set the color of the icon */
        box-shadow: none; /* Remove shadow */
    }
    .mic-btn:focus,
    .mic-btn:hover,
    .mic-btn:active {
        box-shadow: none; /* Remove shadow on hover/focus/active */
    }

    .relative-container {
        position: relative;
    }

    .relative-container textarea {
        width: 100%;
        padding-right: 40px; /* Ensure the text does not overlap the button */
    }
</style>

<style>
    .mini-modal {
        display: none;
        position: absolute;
        z-index: 1;
        padding: 10px;
        background-color: #fefefe;
        border: 1px solid #888;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        width: 200px; /* Adjust width as needed */
    }
    .mini-modal-content {
        background-color: #fefefe;
        padding: 10px;
        border-radius: 4px;
    }
    .mini-modal-content h2 {
        font-size: 16px;
        margin-top: 0;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 20px;
        font-weight: bold;
        cursor: pointer;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
    }

    .mic-btn {
        right: 50px; /* Adjust position to avoid overlap with speaker button */
    }

    .speak-btn {
        right: 16px;
    }
</style>


    <script>
        function addMultipleFiles(input, block_id) {
            let block = document.getElementById(block_id);
            block.innerHTML = "";
            let files = input.files;
            for (let i = 0; i < files.length; i++) {
                let div = document.createElement('div');
                div.innerHTML += files[i].name;
                let viewLink = document.createElement("a");
                viewLink.href = URL.createObjectURL(files[i]);
                viewLink.textContent = "View";
                div.appendChild(viewLink);
                block.appendChild(div);
            }
        }
    </script>

    <script>
        function otherController(value, checkValue, blockID) {
            let block = document.getElementById(blockID)
            let blockTextarea = block.getElementsByTagName('textarea')[0];
            let blockLabel = block.querySelector('label span.text-danger');
            if (value === checkValue) {
                blockLabel.classList.remove('d-none');
                blockTextarea.setAttribute('required', 'required');
            } else {
                blockLabel.classList.add('d-none');
                blockTextarea.removeAttribute('required');
            }
        }
    </script>

    <div class="form-field-head">
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName($data->division_id) }}/ CAPA
        </div>
    </div>

    {{-- ---------------------- --}}
    <div id="change-control-view">
        <div class="container-fluid">

            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow </div>

                    <div class="d-flex" style="gap:20px;">
                        @php
                        $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])->get();
                        $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                    @endphp
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}
                        <button class="button_theme1"> <a class="text-white" href="{{ url('CapaAuditTrial', $data->id) }}">
                                Audit Trail </a> </button>

                        @if ($data->stage == 1 && Helpers::check_roles($data->division_id, 'CAPA', 3))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Propose Plan
                            </button>
                        @elseif($data->stage == 2 && Helpers::check_roles($data->division_id, 'CAPA', 4))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#capa_more_info">
                                More Info Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Approve Plan
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button> --}}
                        @elseif($data->stage == 3 && Helpers::check_roles($data->division_id, 'CAPA', 7))
                               <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#capa_more_info">
                              QA More Info Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Complete
                            </button>
                            <button id="major" type="button" class="button_theme1" data-bs-toggle="modal"
                                data-bs-target="#child-modal">
                                Child
                            </button>
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button> --}}
                        @elseif($data->stage == 4 && Helpers::check_roles($data->division_id, 'CAPA', 7))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Approve

                            </button>
                            <!-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button> -->
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#capa_more_info">
                                Reject
                            </button>
                        @elseif($data->stage == 5 && Helpers::check_roles($data->division_id, 'CAPA', 9))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                All Actions Completed
                            </button>
                        @elseif($data->stage == 6 && Helpers::check_roles($data->division_id, 'CAPA', 9))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button>
                        @endif
                        <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                            </a> </button>


                    </div>

                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    {{-- ------------------------------By Pankaj-------------------------------- --}}
                    @if ($data->stage == 0)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars">
                            @if ($data->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif

                            @if ($data->stage >= 2)
                                <div class="active">Pending CAPA Plan </div>
                            @else
                                <div class="">Pending CAPA Plan</div>
                            @endif

                            @if ($data->stage >= 3)
                                <div class="active">CAPA In Progress</div>
                            @else
                                <div class="">CAPA In Progress</div>
                            @endif

                            @if ($data->stage >= 4)
                                <div class="active">QA Review</div>
                            @else
                                <div class="">QA Review</div>
                            @endif


                            @if ($data->stage >= 5)
                                <div class="active">Pending Actions Completion</div>
                            @else
                                <div class="">Pending Actions Completion</div>
                            @endif
                            @if ($data->stage >= 6)
                                <div class="bg-danger">Closed - Done</div>
                            @else
                                <div class="">Closed - Done</div>
                            @endif
                    @endif


                </div>
                {{-- @endif --}}
                {{-- ---------------------------------------------------------------------------------------- --}}
            </div>
        </div>

        <div class="control-list">

            {{-- ======================================
                    DATA FIELDS
            ======================================= --}}
            <div id="change-control-fields">
                <div class="container-fluid">

                    <!-- Tab links -->
                    <div class="cctab">
                        <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Equipment/Material Info</button>
                        {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Project/Study</button> --}}
                        <button class="cctablinks" onclick="openCity(event, 'CCForm3')">CAPA Details</button>
                        {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm8')">Additional Information</button> --}}
                        {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Group Comments</button> --}}
                        <button class="cctablinks" onclick="openCity(event, 'CCForm4')">CAPA Closure</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Activity Log</button>
                    </div>

                    <form id="mainform" action="{{ route('capaUpdate', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div id="step-form">

                            <!-- General information content -->
                            <div id="CCForm1" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RLS Record Number">Record Number</label>
                                                <input disabled type="text" id="record_number" name="record_number"
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}/CAPA/{{ Helpers::year($data->created_at) }}/{{ $data->record }}">
                                                {{-- <div class="static"></div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Division Code">Site/Location Code</label>
                                                <input disabled type="text" name="division_code"
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}">
                                                {{-- <div class="static"></div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator">Initiator</label>
                                                <input disabled type="text" name="initiator_id"
                                                    value="{{ $data->initiator_name }}">
                                                {{-- <div class="static"> </div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        <div class="group-input ">
                                            <label for="Date Due"><b>Date of Initiation</b></label>
                                            <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                            <input type="hidden" value="{{ date('d-m-Y') }}" name="intiation_date">
                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="search">
                                                    Assigned To <span class="text-danger"></span>
                                                </label>
                                                <select id="select-state" placeholder="Select..." name="assign_to"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}} >
                                                    <option value="">Select a value</option>
                                                    @foreach ($users as $value)
                                                        <option {{ $data->assign_to == $value->id ? 'selected' : '' }}
                                                            value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="due-date">Due Date <span class="text-danger">*</span></label>
                                                <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small></div>
                                                @if (!empty($revised_date))
                                                <input readonly type="text"
                                                value="{{ Helpers::getdateFormat($revised_date) }}">
                                                @else
                                                <input disabled type="text"
                                                value="{{ Helpers::getdateFormat($data->due_date) }}">
                                                @endif

                                            </div>
                                        </div> -->
                                        @php
                                $initiationDate = date('Y-m-d');
                                $dueDate = date('Y-m-d', strtotime($initiationDate . '+30 days'));
                            @endphp

                            <div class="col-md-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="due-date">Due Date</label>
                                    <div><small class="text-primary">Please mention expected date of completion</small></div>
                                    <div class="calenderauditee">
                                    <div class="calenderauditee">
                                        <input readonly type="text" value="{{ Helpers::getdateFormat($data->due_date) }}" name="due_date" id="due_date" />
                                        <input type="date" disabled name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, 'due_date')" />
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                    // Format the due date to DD-MM-YYYY
                                    // Your input date
                                    var dueDate = "{{ $dueDate }}"; // Replace {{ $dueDate }} with your actual date variable

                                    // Create a Date object
                                    var date = new Date(dueDate);

                                    // Array of month names
                                    var monthNames = [
                                        "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                                    ];

                                    // Extracting day, month, and year from the date
                                    var day = date.getDate().toString().padStart(2, '0'); // Ensuring two digits
                                    var monthIndex = date.getMonth();
                                    var year = date.getFullYear();

                                    // Formatting the date in "dd-MMM-yyyy" format
                                    var dueDateFormatted = `${day}-${monthNames[monthIndex]}-${year}`;

                                    // Set the formatted due date value to the input field
                                    document.getElementById('due_date').value = dueDateFormatted;
                                </script>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group">Initiator Group</label>
                                                <select name="initiator_Group" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                     id="initiator_group">
                                                     <option  value="">-- Select --</option>
                                                    <option value="CQA"
                                                        @if ($data->initiator_Group== 'CQA') selected @endif>Corporate
                                                        Quality Assurance</option>
                                                    <option value="QAB"
                                                        @if ($data->initiator_Group== 'QAB') selected @endif>Quality
                                                        Assurance Biopharma</option>
                                                    <option value="CQC"
                                                        @if ($data->initiator_Group== 'CQC') selected @endif>Central
                                                        Quality Control</option>
                                                    <option value="MANU"
                                                        @if ($data->initiator_Group== 'MANU') selected @endif>Manufacturing
                                                    </option>
                                                    <option value="PSG"
                                                        @if ($data->initiator_Group== 'PSG') selected @endif>Plasma
                                                        Sourcing Group</option>
                                                    <option value="CS"
                                                        @if ($data->initiator_Group== 'CS') selected @endif>Central
                                                        Stores</option>
                                                    <option value="ITG"
                                                        @if ($data->initiator_Group== 'ITG') selected @endif>Information
                                                        Technology Group</option>
                                                    <option value="MM"
                                                        @if ($data->initiator_Group== 'MM') selected @endif>Molecular
                                                        Medicine</option>
                                                    <option value="CL"
                                                        @if ($data->initiator_Group== 'CL') selected @endif>Central
                                                        Laboratory</option>
                                                    <option value="TT"
                                                        @if ($data->initiator_Group== 'TT') selected @endif>Tech
                                                        Team</option>
                                                    <option value="QA"
                                                        @if ($data->initiator_Group== 'QA') selected @endif>Quality
                                                        Assurance</option>
                                                    <option value="QM"
                                                        @if ($data->initiator_Group== 'QM') selected @endif>Quality
                                                        Management</option>
                                                    <option value="IA"
                                                        @if ($data->initiator_Group== 'IA') selected @endif>IT
                                                        Administration</option>
                                                    <option value="ACC"
                                                        @if ($data->initiator_Group== 'ACC') selected @endif>Accounting
                                                    </option>
                                                    <option value="LOG"
                                                        @if ($data->initiator_Group== 'LOG') selected @endif>Logistics
                                                    </option>
                                                    <option value="SM"
                                                        @if ($data->initiator_Group== 'SM') selected @endif>Senior
                                                        Management</option>
                                                    <option value="BA"
                                                        @if ($data->initiator_Group== 'BA') selected @endif>Business
                                                        Administration</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group Code">Initiator Group Code</label>
                                                <input readonly type="text" name="initiator_group_code"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    value="{{ $data->initiator_Group}}" id="initiator_group_code"
                                                    readonly>
                                                {{-- <div class="static"></div> --}}
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description <span
                                                        class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please mention brief summary</small></div>
                                                <textarea name="short_description"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->short_description }}</textarea>
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="group-input" id="short_description_group">
                                                <label for="short_description">Short Description<span class="text-danger">*</span></label>
                                                <span id="rchars">255</span> characters remaining
                                               <div class="relative-container">
                                                        <input type="text" name="short_description" id="docname" class="mic-input" maxlength="255" required {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} value="{{ $data->short_description }}">
                                                        @component('frontend.forms.language-model', ['disabled' => $data->stage == 0 || $data->stage == 6])
                                                        @endcomponent
                                                    
                                                    </div>
                                            </div>
                                            <p id="docnameError" style="color:red">**Short Description is required</p>
                                        </div>



                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="severity-level">Severity Level</label>
                                                <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span>
                                                <select {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} name="severity_level_form">
                                                    <option  value="">-- Select --</option>
                                                    <option @if ($data->severity_level_form=='minor') selected @endif value="minor">Minor</option>
                                                    <option @if ($data->severity_level_form=='major') selected @endif value="major">Major</option>
                                                    <option @if ($data->severity_level_form=='critical') selected @endif value="critical">Critical</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group">Initiated Through</label>
                                                <div><small class="text-primary">Please select related information</small></div>
                                                <select name="initiated_through"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    onchange="otherController(this.value, 'others', 'initiated_through_req')">
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option @if ($data->initiated_through == 'internal audit') selected @endif
                                                        value="internal audit">Internal Audit</option>
                                                        <option @if ($data->initiated_through == 'external audit') selected @endif
                                                        value="external audit">External Audit</option>
                                                    <option @if ($data->initiated_through == 'recall') selected @endif
                                                        value="recall">Recall</option>
                                                    <option @if ($data->initiated_through == 'return') selected @endif
                                                        value="return">Return</option>
                                                    <option @if ($data->initiated_through == 'deviation') selected @endif
                                                        value="deviation">Deviation</option>
                                                    <option @if ($data->initiated_through == 'complaint') selected @endif
                                                        value="complaint">Complaint</option>
                                                    <option @if ($data->initiated_through == 'regulatory') selected @endif
                                                        value="regulatory">Regulatory</option>
                                                    <option @if ($data->initiated_through == 'lab incident') selected @endif
                                                        value="lab incident">Lab Incident</option>
                                                    <option @if ($data->initiated_through == 'improvement') selected @endif
                                                        value="improvement">Improvement</option>
                                                    <option @if ($data->initiated_through == 'others') selected @endif
                                                        value="others">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6">
                                            <div class="group-input" id="initiated_through_req">
                                                <label for="initiated_through">Others<span
                                                        class="text-danger d-none">*</span></label>
                                                <textarea name="initiated_through_req"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}> {{ $data->initiated_through_req }}</textarea>
                                            </div>
                                        </div> --}}

                                        <div class="col-lg-6">
                                            <div class="group-input" id="initiated_through_req">
                                                <label for="initiated_through">Others<span class="text-danger d-none">*</span></label>
                                                <div class="relative-container">
                                                    <textarea name="initiated_through_req" id="initiated_through_textarea" class="mic-input" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->initiated_through_req }}</textarea>
                                                    @component('frontend.forms.language-model', ['disabled' => $data->stage == 0 || $data->stage == 6])
                                                    @endcomponent
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="repeat">Repeat</label>
                                                <div><small class="text-primary">Please select yes if it is has recurred in past six months</small></div>
                                                <select name="repeat"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    onchange="otherController(this.value, 'Yes', 'repeat_nature')">
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option @if ($data->repeat == 'Yes') selected @endif
                                                        value="Yes">Yes</option>
                                                    <option @if ($data->repeat == 'No') selected @endif
                                                        value="No">No</option>
                                                    <option @if ($data->repeat == 'NA') selected @endif
                                                        value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input" id="repeat_nature">
                                                <label for="repeat_nature">Repeat Nature<span class="text-danger d-none">*</span></label>
                                                <div class="relative-container">
                                                    <textarea name="repeat_nature" id="repeat_nature_textarea" class="mic-input" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->repeat_nature }}</textarea>
                                                    @component('frontend.forms.language-model', ['disabled' => $data->stage == 0 || $data->stage == 6])
                                                    @endcomponent
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input" id="problem_description_group">
                                                <label for="problem_description">Problem Description</label>
                                                <div class="relative-container">
                                                    <textarea name="problem_description" id="problem_description_textarea" class="mic-input" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->problem_description }}</textarea>
                                                    @component('frontend.forms.language-model', ['disabled' => $data->stage == 0 || $data->stage == 6])
                                                    @endcomponent
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="CAPA Team">CAPA Team</label>
                                                <select {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    multiple id="Audit" placeholder="Select..." name="capa_team[]">
                                                    @foreach ($users as $value)
                                                        <!-- <option {{ $data->capa_team == $value->id ? 'selected' : '' }}  value="{{ $value->id }}">{{ $value->name }}</option> -->
                                                        <option value="{{ $value->id }}"{{ in_array($value->id, explode(',', $data->capa_team)) ? 'selected' : '' }}>
                                                                   {{ $value->name }}
                                                        </option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="Reference Records">Reference Records</label>
                                                <select {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    multiple id="capa_related_record" name="capa_related_record[]"
                                                    id="">
                                                    @foreach ($old_record as $new)
                                                        <option value="{{ $new->id }}"{{ in_array($new->id, explode(',', $data->capa_related_record)) ? 'selected' : '' }}>
                                                            {{ Helpers::getDivisionName($new->division_id) }}/CAPA/{{ date('Y') }}/{{ Helpers::recordFormat($new->record) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="Reference Records">Reference Record</label>
                                                <select {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    multiple id="capa_related_record" name="capa_related_record[]">

                                                    @foreach ($old_record as $new)
                                                        @php
                                                            $recordValue =
                                                                Helpers::getDivisionName($new->division_id) .'/CAPA/'.date('Y') .'/' .
                                                                Helpers::recordFormat($new->record);
                                                                $selected = in_array($recordValue,explode(',', $data->capa_related_record),)
                                                                ? 'selected'
                                                                : '';
                                                        @endphp
                                                        <option value="{{ $recordValue }}" {{ $selected }}>
                                                            {{ $recordValue }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input" id="initial_observation_group">
                                                <label for="initial_observation">Initial Observation</label>
                                                <div class="relative-container">
                                                    <textarea name="initial_observation" id="initial_observation_textarea" class="mic-input" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->initial_observation }}</textarea>
                                                    @component('frontend.forms.language-model', ['disabled' => $data->stage == 0 || $data->stage == 6])
                                                    @endcomponent
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Interim Containnment">Interim Containnment</label>
                                                <select name="interim_containnment"
                                                    onchange="otherController(this.value, 'required', 'containment_comments')"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option
                                                        {{ $data->interim_containnment == 'required' ? 'selected' : '' }}
                                                        value="required">Required</option>
                                                    <option
                                                        {{ $data->interim_containnment == 'not-required' ? 'selected' : '' }}
                                                        value="not-required">Not Required</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input" id="containment_comments">
                                                <label for="Containment Comments">
                                                    Containment Comments <span class="text-danger d-none">*</span>
                                                </label>
                                                <textarea name="containment_comments" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->containment_comments }}</textarea>
                                            </div>
                                        </div>

                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="CAPA Attachments">CAPA Attachment</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                {{-- <input type="file" id="myfile" name="capa_attachment"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}> 
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="capa_attachment">

                                                        @if ($data->capa_attachment)
                                                            @foreach (json_decode($data->capa_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                                    <a type="button" class="remove-file"
                                                                        data-file-name="{{ $file }}"><i
                                                                            class="fa-solid fa-circle-xmark"
                                                                            style="color:red; font-size:20px;"></i></a>
                                                                </h6>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile" name="capa_attachment[]"
                                                            oninput="addMultipleFiles(this, 'capa_attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        @if ($data->capa_attachment)
                                        @foreach (json_decode($data->capa_attachment) as $file)
                                            <input id="ATFIFile-{{ $loop->index }}" type="hidden"
                                                name="existing_capa_attachment[{{ $loop->index }}]"
                                                value="{{ $file }}">
                                        @endforeach
                                    @endif
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="CAPA Attachments">CAPA Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="capa_attachment">
                                                    @if ($data->capa_attachment)
                                                        @foreach (json_decode($data->capa_attachment) as $file)
                                                            <h6 type="button" class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                        class="fa fa-eye text-primary"
                                                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file"
                                                                    data-remove-id="ATFIFile-{{ $loop->index }}"
                                                                    data-file-name="{{ $file }}"
                                                                    style="@if ($data->stage == 0 || $data->stage == 4 || $data->stage == 6) pointer-events: none; @endif"><i
                                                                        class="fa-solid fa-circle-xmark"
                                                                        style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input
                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile" name="capa_attachment[]"
                                                        oninput="addMultipleFiles(this, 'capa_attachment')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-12">
                                            <div class="group-input" id="capa_qa_comments_group">
                                                <label for="capa_qa_comments">Comments</label>
                                                <div class="relative-container">
                                                    <textarea name="capa_qa_comments" id="capa_qa_comments_textarea" class="mic-input" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->capa_qa_comments }}</textarea>
                                                    @component('frontend.forms.language-model', ['disabled' => $data->stage == 0 || $data->stage == 6])
                                                    @endcomponent
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="button-block">
                                        <button type="submit"  id="ChangesaveButton" class="saveButton on-submit-disable-button"
                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Information content -->
                            <div id="CCForm2" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12 sub-head">
                                            Product Details
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Product Details">
                                                    Product Details<button type="button" name="ann"
                                                    id="product"
                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>+</button>
                                                </label>
                                                <table class="table table-bordered" id="product_details">
                                                    <thead>
                                                        <tr>
                                                            <th class="w-5">Row #</th>
                                                            <th class="w-10">Product Name</th>
                                                            <th class="w-10">Batch No./Lot No./AR No.</th>
                                                            <th class="w-10">Manufacturing Date</th>
                                                            <th class="w-10">Date Of Expiry</th>
                                                            <th class="w-10">Batch Disposition Decision</th>
                                                            <th class="w-10">Remark</th>
                                                            <th class="w-10">Batch Status</th>
                                                            <th class="w-5">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($data1->product_name)
                                                        @foreach (unserialize($data1->product_name) as $key => $temps)
                                                        <tr>
                                                            <td><input type="text" name="serial_number[]"
                                                                    value="{{ $key + 1 }}"></td>
                                                            <td>                                                                   
                                                            <select name="product_name[]" id="product_name" {{ $data->stage == 0 || $data->stage == 6 ? ' disabled' : '' }}>
                                                                <option value="">-- Select value --</option>
                                                                <option value="PLACE BEFORE BIMATOPROST OPH.SOLO.01%W/"{{ isset(unserialize($data1->product_name)[$key]) && unserialize($data1->product_name)[$key] == 'PLACE BEFORE BIMATOPROST OPH.SOLO.01%W/' ? ' selected' : '' }}>PLACE BEFORE BIMATOPROST OPH.SOLO.01%W/</option>
                                                                <option value="BIMATOPROST AND TIMOLOL MALEATEED SOLUTION"{{ isset(unserialize($data1->product_name)[$key]) && unserialize($data1->product_name)[$key] == 'BIMATOPROST AND TIMOLOL MALEATEED SOLUTION' ? ' selected' : '' }}>BIMATOPROST AND TIMOLOL MALEATEED SOLUTION</option>
                                                                <option value="CAFFEINE CITRATE ORAL SOLUTION USP 60MG/3ML"{{ isset(unserialize($data1->product_name)[$key]) && unserialize($data1->product_name)[$key] == 'CAFFEINE CITRATE ORAL SOLUTION USP 60MG/3ML' ? ' selected' : '' }}>CAFFEINE CITRATE ORAL SOLUTION USP 60MG/3ML</option>
                                                                <option value="BRIMONIDINE TART. OPH SOL 0.1%W/V (CB)"{{ isset(unserialize($data1->product_name)[$key]) && unserialize($data1->product_name)[$key] == 'BRIMONIDINE TART. OPH SOL 0.1%W/V (CB)' ? ' selected' : '' }}>BRIMONIDINE TART. OPH SOL 0.1%W/V (CB)</option>
                                                                <option value="DORZOLAMIDE PFREE 20MG/ML EDSOLSINGLEDOSECO"{{ isset(unserialize($data1->product_name)[$key]) && unserialize($data1->product_name)[$key] == 'DORZOLAMIDE PFREE 20MG/ML EDSOLSINGLEDOSECO' ? ' selected' : '' }}>DORZOLAMIDE PFREE 20MG/ML EDSOLSINGLEDOSECO</option>
                                                            </select> 
                                                                <td>
                                                                   
                                                                   <select id="batch_no" name="batch_no[]"{{ $data->stage == 0 || $data->stage == 6 ? ' disabled' : '' }}>
                                                                    <option value="">-- Select value --</option>
                                                                    <option value="DCAU0030"{{ isset(unserialize($data1->batch_no)[$key]) && unserialize($data1->batch_no)[$key] == 'DCAU0030' ? ' selected' : '' }}>DCAU0030</option>
                                                                    <option value="BDZH0007"{{ isset(unserialize($data1->batch_no)[$key]) && unserialize($data1->batch_no)[$key] == 'BDZH0007' ? ' selected' : '' }}>BDZH0007</option>
                                                                    <option value="BDZH0006"{{ isset(unserialize($data1->batch_no)[$key]) && unserialize($data1->batch_no)[$key] == 'BDZH0006' ? ' selected' : '' }}>BDZH0006</option>                                                                    <option value="BDZH0006"{{ isset(unserialize($data1->batch_no)[$key]) && unserialize($data1->batch_no)[$key] == 'BDZH0006' ? ' selected' : '' }}>BDZH0006</option>
                                                                    <option value="BJJH0004A"{{ isset(unserialize($data1->batch_no)[$key]) && unserialize($data1->batch_no)[$key] == 'BJJH0004A' ? ' selected' : '' }}>BJJH0004A</option>
                                                                    <option value="DCAU0036"{{ isset(unserialize($data1->batch_no)[$key]) && unserialize($data1->batch_no)[$key] == 'DCAU0036' ? ' selected' : '' }}>DCAU0036</option>
                                                                </select>                                                          
                                                                    </td>
                                                                <td>
                                                                @php
                                                                    $mfg_date_array = @unserialize($data1->mfg_date);
                                                                    if (!is_array($mfg_date_array)) {
                                                                        $mfg_date_array = []; // Fallback to an empty array if unserialization fails
                                                                    }
                                                                @endphp                                         
                                                                <div class="group-input new-date-data-field mb-0">
                                                                   <div class="input-date ">
                                                                    <div class="calenderauditee">
                                                                        <input type="text" id="mfg_date{{$key}}" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($mfg_date_array[$key] ?? '') }}" />
                                                                        <input type="date" id="mfg_date{{$key}}_checkdate" value="{{ $mfg_date_array[$key] ?? '' }}" name="mfg_date[]" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} class="hide-input"
                                                                        oninput="handleDateInput(this, 'mfg_date{{$key}}'); checkDate('mfg_date{{$key}}_checkdate', 'expiry_date{{$key}}_checkdate')" />
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                 
                                                            </td>
                                                           
                                                            <td>
                                                                @php
                                                                    $expiry_date_array = @unserialize($data1->expiry_date);
                                                                    if (!is_array($expiry_date_array)) {
                                                                        $expiry_date_array = []; // Fallback to an empty array if unserialization fails
                                                                    }

                                                                    
                                                                    $expiry_date_value = $expiry_date_array[$key] ?? '';
                                                                @endphp                                                 
                                                                <div class="group-input new-date-data-field mb-0">
                                                                    <div class="input-date">
                                                                        <div class="calenderauditee">
                                                                            <input type="text" id="expiry_date{{$key}}" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($expiry_date_value) }}" />
                                                                            <input type="date" id="expiry_date{{$key}}_checkdate" value="{{ $expiry_date_value }}" name="expiry_date[]" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} class="hide-input"
                                                                            oninput="handleDateInput(this, 'expiry_date{{$key}}'); checkDate('mfg_date{{$key}}_checkdate', 'expiry_date{{$key}}_checkdate')" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                 
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $batchdespositionArray = @unserialize($data1->batch_desposition);
                                                                if ($batchdespositionArray === false) {
                                                                    $batchdespositionArray = [];
                                                                }
                                                                $value = isset($batchdespositionArray[$key]) ? $batchdespositionArray[$key] : '';
                                                                ?>
                                                                <input type="text" name="batch_desposition[]" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} value="<?php echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); ?>">
                                                            </td>

                                                            <td>
                                                                <?php
                                                                $remarkArray = @unserialize($data1->remark);
                                                                if ($remarkArray === false) {
                                                                    $remarkArray = [];
                                                                }
                                                                $value = isset($remarkArray[$key]) ? $remarkArray[$key] : '';
                                                                ?>
                                                                <input type="text" name="remark[]" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} value="<?php echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); ?>">
                                                            </td>

                                                            <td>
                                                                
                                                                    <select id="batch_status" name="batch_status[]"{{ $data->stage == 0 || $data->stage == 6 ? ' disabled' : '' }}>
                                                                        <option value="">-- Select value --</option>
                                                                        <option value="Hold"{{ isset(unserialize($data1->batch_status)[$key]) && unserialize($data1->batch_status)[$key] == 'Hold' ? ' selected' : '' }}>Hold</option>
                                                                        <option value="Release"{{ isset(unserialize($data1->batch_status)[$key]) && unserialize($data1->batch_status)[$key] == 'Release' ? ' selected' : '' }}>Release</option>
                                                                        <option value="quarantine"{{ isset(unserialize($data1->batch_status)[$key]) && unserialize($data1->batch_status)[$key] == 'quarantine' ? ' selected' : '' }}>Quarantine</option>
                                                                    </select>                                                               
                                                            </td>
                                                             <td><button type="text" class="removeRowBtn" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Remove</button></td>
                                                        </tr>
                                                        @endforeach
                                                        @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head">
                                            Material Details
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Material Details">
                                                    Material Details<button type="button" name="ann" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                    id="material">+</button>
                                                </label>
                                                <table class="table table-bordered" id="material_details">
                                                    <thead>
                                                        <tr>
                                                            <th class="w-5">Row #</th>
                                                            <th class="w-10">Material Name</th>
                                                            <th class="w-10">Batch No./Lot No./AR No.</th>
                                                            <th class="w-10">Manufacturing Date</th>
                                                            <th class="w-10">Date Of Expiry</th>
                                                            <th class="w-10">Batch Disposition Decision</th>
                                                            <th class="w-10">Remark</th>
                                                            <th class="w-10">Batch Status</th>
                                                            <th class="w-5">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($data2->material_name)
                                                        @foreach (unserialize($data2->material_name) as $key => $temps)
                                                        <tr>
                                                            <td><input type="text" name="serial_number[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                    value="{{ $key + 1 }}"></td>
                                                           
                                                            <td><input type="text" name="material_name[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                value="{{ unserialize($data2->material_name)[$key] ? unserialize($data2->material_name)[$key] : '' }}">
                                                        </td>
                                                            <td><input type="text" name="material_batch_no[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                    value="{{ unserialize($data2->material_batch_no)[$key] ? unserialize($data2->material_batch_no)[$key] : '' }}">
                                                            </td>
                                                            
                                                                <td><div class="group-input new-date-data-field mb-0">
                                                                <div class="input-date ">
                                                              <div class="calenderauditee">
                                                                <input type="text"   id="material_mfg_date{{$key}}" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat(unserialize($data2->material_mfg_date)[$key]) }}"/>
                                                                <input type="date"  id="material_mfg_date{{$key}}_checkdate" value="{{unserialize($data2->material_mfg_date)[$key]}}"  name="material_mfg_date[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} value="{{ Helpers::getdateFormat(unserialize($data2->material_mfg_date)[$key]) }}
                                                                "class="hide-input"
                                                                oninput="handleDateInput(this, `material_mfg_date{{$key}}`);checkDate('material_mfg_date{{$key}}_checkdate','material_expiry_date{{$key}}_checkdate')"  /></div></div></div></td>

                                                                
                                                               <td><div class="group-input new-date-data-field mb-0">
                                                                <div class="input-date ">
                                                                    <div class="calenderauditee">
                                                                <input type="text"   id="material_expiry_date{{$key}}" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat(unserialize($data2->material_expiry_date)[$key]) }}" />
                                                                <input type="date" id="material_expiry_date{{$key}}_checkdate" value="{{unserialize($data2->material_mfg_date)[$key]}}"  name="material_expiry_date[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} value="{{ Helpers::getdateFormat(unserialize($data2->material_expiry_date)[$key]) }}"class="hide-input"
                                                                oninput="handleDateInput(this, `material_expiry_date{{$key}}`);checkDate('material_mfg_date{{$key}}_checkdate','material_expiry_date{{$key}}_checkdate')"  /></div></div></div></td>

                                                            <td><input type="text" name="material_batch_desposition[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                    value="{{ unserialize($data2->material_batch_desposition)[$key] ? unserialize($data2->material_batch_desposition)[$key] : '' }}">
                                                            </td>
                                                             <td><input type="text" name="material_remark[]" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                    value="{{ unserialize($data2->material_remark)[$key] ? unserialize($data2->material_remark)[$key] : '' }}">
                                                            </td>
                                                             
                                                        <td>
                                                            <select id="batch_status" name="material_batch_status[]"{{ $data->stage == 0 || $data->stage == 6 ? ' disabled' : '' }}>
                                                                <option value="">-- Select value --</option>
                                                                <option value="Hold"{{ isset(unserialize($data2->material_batch_status)[$key]) && unserialize($data2->material_batch_status)[$key] == 'Hold' ? ' selected' : '' }}>Hold</option>
                                                                <option value="Release"{{ isset(unserialize($data2->material_batch_status)[$key]) && unserialize($data2->material_batch_status)[$key] == 'Release' ? ' selected' : '' }}>Release</option>
                                                                <option value="quarantine"{{ isset(unserialize($data2->material_batch_status)[$key]) && unserialize($data2->material_batch_status)[$key] == 'quarantine' ? ' selected' : '' }}>Quarantine</option>
                                                            </select>
                                                        </td>
                                                        <td><button type="text" class="removeRowBtn" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Remove</button></td>

                                                        </tr>
                                                    @endforeach
                                                        @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head">
                                            Equipment/Instruments Details
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Material Details">
                                                    Equipment/Instruments Details<button type="button" name="ann" id="equipment" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>+</button>
                                                </label>
                                                <table class="table table-bordered" id="equipment_details">
                                                    <thead>
                                                        <tr>
                                                            <th class="w-5">Row #</th>
                                                            <th class="w-10">Equipment/Instruments Name</th>
                                                            <th class="w-10">Equipment/Instruments ID</th>
                                                            <th class="w-10">Equipment/Instruments Comments</th>
                                                            <th class="w-5">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($data3->equipment)
                                                        @foreach (unserialize($data3->equipment) as $key => $temps)
                                                        <tr>
                                                            <td><input type="text" name="serial_number[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                    value="{{ $key + 1 }}"></td>

                                                            <td><input type="text" name="equipment[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                    value="{{ unserialize($data3->equipment)[$key] ? unserialize($data3->equipment)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="equipment_instruments[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                    value="{{ unserialize($data3->equipment_instruments)[$key] ? unserialize($data3->equipment_instruments)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="equipment_comments[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}
                                                                    value="{{ unserialize($data3->equipment_comments)[$key] ? unserialize($data3->equipment_comments)[$key] : '' }}">
                                                            </td>
                                                            <td><button type="text" class="removeRowBtn" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Remove</button></td>

                                                            </tr>
                                                    @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head">
                                            Other type CAPA Details
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input" id="details_new_group">
                                                <label for="details_new">Details</label>
                                                <div class="relative-container">
                                                    <input type="text" name="details_new" id="details_new_input" class="mic-input" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} value="{{ $data->details_new }}">
                                                    @component('frontend.forms.language-model', ['disabled' => $data->stage == 0 || $data->stage == 6])
                                                    @endcomponent
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input" id="capa_qa_comments2_group">
                                                <label for="capa_qa_comments2">CAPA QA Comments</label>
                                                <div class="relative-container">
                                                    <textarea name="capa_qa_comments2" id="capa_qa_comments2_textarea" class="mic-input" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->capa_qa_comments2 }}</textarea>
                                                    @component('frontend.forms.language-model', ['disabled' => $data->stage == 0 || $data->stage == 6])
                                                    @endcomponent
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton on-submit-disable-button"
                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Project Study content -->

                            {{-- CFT Information --}}
                           
                             
                               <!-- Group Commentes-->
                             
                            <!-- CAPA Details content -->
                            <div id="CCForm3" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="search">
                                            CAPA Type<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="capa_type"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            <option value="">Select a value</option>
                                            <option {{ $data->capa_type == "Corrective Action" ? 'selected' : '' }} value="Corrective Action">Corrective Action</option>
                                            <option {{ $data->capa_type == "Preventive Action" ? 'selected' : '' }} value="Preventive Action">Preventive Action</option>
                                            <option {{ $data->capa_type == "Corrective & Preventive Action"  ? 'selected' : '' }} value="Corrective & Preventive Action">Corrective & Preventive Action</option>

                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input" id="corrective_action_group">
                                        <label for="corrective_action">Corrective Action</label>
                                        <div class="relative-container">
                                            <textarea name="corrective_action" id="corrective_action_textarea" class="mic-input" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->corrective_action }}</textarea>
                                            @component('frontend.forms.language-model', ['disabled' => $data->stage == 0 || $data->stage == 6])
                                            @endcomponent
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input" id="preventive_action_group">
                                        <label for="preventive_action">Preventive Action</label>
                                        <div class="relative-container">
                                            <textarea name="preventive_action" id="preventive_action_textarea" class="mic-input" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->preventive_action }}</textarea>
                                            @component('frontend.forms.language-model', ['disabled' => $data->stage == 0 || $data->stage == 6])
                                            @endcomponent
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input" id="supervisor_review_comments_group">
                                        <label for="supervisor_review_comments">Supervisor Review Comments</label>
                                        <div class="relative-container">
                                            <textarea name="supervisor_review_comments" id="supervisor_review_comments_textarea" class="mic-input" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->supervisor_review_comments }}</textarea>
                                            @component('frontend.forms.language-model', ['disabled' => $data->stage == 0 || $data->stage == 6])
                                            @endcomponent
                                        </div>
                                    </div>
                                </div>

                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton on-submit-disable-button"
                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <!-- CAPA Closure content -->
                            <div id="CCForm4" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="group-input" id="qa_review_group">
                                                <label for="qa_review">QA Review & Closure</label>
                                                <div class="relative-container">
                                                    <textarea name="qa_review" id="qa_review_textarea" class="mic-input" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->qa_review }}</textarea>
                                                    @component('frontend.forms.language-model', ['disabled' => $data->stage == 0 || $data->stage == 6])
                                                    @endcomponent
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="Closure Attachments">Closure Attachment</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                {{-- <input type="file" id="myfile" name="closure_attachment"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}> 
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="closure_attachment1">
                                                        @if ($data->closure_attachment)
                                                            @foreach (json_decode($data->closure_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                                    <a type="button" class="remove-file"
                                                                        data-file-name="{{ $file }}"><i
                                                                            class="fa-solid fa-circle-xmark"
                                                                            style="color:red; font-size:20px;"></i></a>
                                                                </h6>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile" name="closure_attachment[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'closure_attachment1')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        @if ($data->closure_attachment)
                                        @foreach (json_decode($data->closure_attachment) as $file)
                                            <input id="EFCHATFile-{{ $loop->index }}" type="hidden"
                                                name="existing_closure_attachment[{{ $loop->index }}]"
                                                value="{{ $file }}">
                                        @endforeach
                                    @endif
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Closure Attachments">Closure Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="closure_attachment1">
                                                    @if ($data->closure_attachment)
                                                        @foreach (json_decode($data->closure_attachment) as $file)
                                                            <h6 type="button" class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                        class="fa fa-eye text-primary"
                                                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file"
                                                                    data-remove-id="EFCHATFile-{{ $loop->index }}"
                                                                    data-file-name="{{ $file }}"
                                                                    style="@if ($data->stage == 0 || $data->stage == 4 || $data->stage == 6) pointer-events: none; @endif"><i
                                                                        class="fa-solid fa-circle-xmark"
                                                                        style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input
                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile" name="closure_attachment[]"
                                                        oninput="addMultipleFiles(this, 'closure_attachment1')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                         <!-- <div class="col-12 sub-head">
                                    Effectiveness Check Details -->
                                </div>
                                        <!-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="Effectiveness Check required">Effectiveness Check
                                                    required</label>
                                                <select name="effect_check"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->effect_check == 'yes' ? 'selected' : '' }}
                                                        value="yes">Yes</option>
                                                    <option {{ $data->effect_check == 'no' ? 'selected' : '' }}
                                                        value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Effect.Check Creation Date">Effect.Check Creation
                                                    Date</label>
                                                <input type="date" name="effect_check_date"
                                                    value="{{ $data->effect_check_date }}">
                                                    <div class="calenderauditee">
                                                        <input type="text"  value="{{ $data->effect_check_date }}" id="effect_check_date"  readonly placeholder="DD-MMM-YYYY" />
                                                        <input type="date" name="effect_check_date" value=""
                                                        class="hide-input"
                                                        oninput="handleDateInput(this, 'effect_check_date')"/>
                                                    </div>
                                            </div>
                                        </div> --}}

                                        <div class="col-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Effect Check Creation Date">Effectiveness Check Creation Date</label>
                                                {{-- <input type="date" name="effect_check_date"> --}}
                                                <div class="calenderauditee">
                                                    <input type="text"  id="effect_check_date" readonly
                                                        placeholder="DD-MMM-YYYY"value="{{ Helpers::getdateFormat($data->effect_check_date) }}"/>
                                                    <input type="date" name="effect_check_date" value=""class="hide-input"
                                                        oninput="handleDateInput(this,'effect_check_date')" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="group-input">
                                                <label for="Effectiveness_checker">Effectiveness Checker</label>
                                                <select name="Effectiveness_checker">{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    <option value="">Enter Your Selection Here</option>
                                                    @foreach ($users as $value)
                                                        <option
                                                            {{ $data->Effectiveness_checker == $value->id ? 'selected' : '' }}
                                                            value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="effective_check_plan">Effectiveness Check Plan</label>
                                                <textarea name="effective_check_plan"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}> {{ $data->effective_check_plan }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head">
                                            Extension Justification
                                        </div> -->
                                        <div class="col-12 sub-head">
                                            Extension Justification
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input" id="due_date_extension_group">
                                                <label for="due_date_extension">Due Date Extension Justification</label>
                                                <div><small class="text-primary">Please mention justification if due date is crossed</small></div>
                                                <div class="relative-container">
                                                    <textarea name="due_date_extension" id="due_date_extension_textarea" class="mic-input" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->due_date_extension }}</textarea>
                                                    @component('frontend.forms.language-model', ['disabled' => $data->stage == 0 || $data->stage == 6])
                                                    @endcomponent
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton on-submit-disable-button">Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Activity Log content -->
                            <div id="CCForm5" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="Plan Proposed By">Proposed Plan By</label>
                                                <input type="hidden" name="plan_proposed_by"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->plan_proposed_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="Plan Proposed On">Proposed Plan On</label>
                                                <input type="hidden" name="plan_proposed_on"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->plan_proposed_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted Comment">Proposed Plan Comment</label>
                                                <div class="static">{{ $data->plan_proposed_comment }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="QA More Info Required By">More Info Required By</label>
                                                <input type="hidden" name="more_info_review_by"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->more_info_review_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="QA More Info Required On">More Info Required On</label>
                                                <input type="hidden" name="more_info_review_on"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->more_info_review_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted Comment">More Info Required Comment</label>
                                                <div class="static">{{ $data->more_info_review_comment }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Approved Plan By</label>
                                                <input type="hidden" name="plan_approved_by"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->plan_approved_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="Plan Approved On">Approved Plan On</label>
                                                <input type="hidden" name="plan_approved_on"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->Plan_approved_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted Comment">Approved Plan Comment</label>
                                                <div class="static">{{ $data->plan_approved_comment }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="QA More Info Required By">QA More Info Required By</label>
                                                <input type="hidden" name="qa_more_info_required_by"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->qa_more_info_required_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="QA More Info Required On">QA More Info Required On</label>
                                                <input type="hidden" name="qa_more_info_required_on"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->qa_more_info_required_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted Comment">QA More Info Required Comment</label>
                                                <div class="static">{{ $data->qa_more_info_required_comment }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="Completed By">Completed By</label>
                                                <input type="hidden" name="completed_by"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->completed_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="Completed On">Completed On</label>
                                                <input type="hidden" name="completed_on"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->completed_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted Comment">Completed Comment</label>
                                                <div class="static">{{ $data->completedd_comment }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="Approved By">Approved By</label>
                                                <input type="hidden" name="approved_by"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>

                                                <div class="static">{{ $data->approved_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="Approved On">Approved On</label>
                                                <input type="hidden" name="approved_on"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->approved_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted Comment">Approved Comment</label>
                                                <div class="static">{{ $data->approved_comment }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="Rejected By">Rejected By</label>
                                                <input type="hidden" name="reject_more_info_requierd_by"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->reject_more_info_requierd_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="Rejected On">Rejected On</label>
                                                <input type="hidden" name="reject_more_info_requierd_on"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->reject_more_info_requierd_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted Comment">Rejected Comment</label>
                                                <div class="static">{{ $data->reject_more_info_requierd_comment }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="Completed By">All Actions Completed By</label>
                                                <input type="hidden" name="all_actions_completed_by"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->all_actions_completed_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="Completed On">All Actions Completed On</label>
                                                <input type="hidden" name="all_actions_completed_on"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->all_actions_completed_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted Comment">All Actions Completed Comment</label>
                                                <div class="static">{{ $data->all_actions_completed_comment }}</div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="Cancelled By">Cancelled By</label>
                                                <input type="hidden" name="cancelled_by"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->cancelled_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="group-input">
                                                <label for="Cancelled On">Cancelled On</label>
                                                <input type="hidden" name="cancelled_on"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->cancelled_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted Comment">Cancelled Comment</label>
                                                <div class="static">{{ $data->cancelled_comment }}</div>
                                            </div>
                                        </div>

                                    <div class="button-block">
                                        {{-- <button type="submit" class="saveButton"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Save</button> --}}
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        {{-- <button type="submit"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Submit</button> --}}
                                        <button type="button"> <a class="text-white"href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>

            </div>

            <div class="modal fade" id="child-modal1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('capa_effectiveness_check', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">
                                    <label for="major">
                                        <input type="hidden" name="parent_name" value="Capa">
                                        <input type="hidden" name="due_date" value="{{ $data->due_date }}">
                                        <input type="radio" name="child_type" value="effectiveness_check">
                                        Effectiveness Check
                                    </label>

                                </div>

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" data-bs-dismiss="modal">Close</button>
                                <button type="submit">Continue</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="child-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('capa_child_changecontrol', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">
                                    @if ($data->stage == 3)
                                        <label for="major">

                                        </label>
                                         <label for="major">
                                            <input type="radio" name="child_type" value="Change_control">
                                            Change Control
                                        </label>
                                        <label for="major">
                                            <input type="radio" name="child_type" value="Action_Item">
                                            Action Item
                                        </label>
                                         <label for="major">
                                            <input type="radio" name="child_type" value="extension">
                                            Extension
                                        </label>
                                        <label for="major">
                                            <input type="radio" name="child_type" value="RCA">
                                          RCA
                                        </label>
                                    @endif

                                    @if ($data->stage == 6)
                                        <label for="major">
                                            <input type="radio" name="child_type" value="effectiveness_check">
                                            Effectiveness Check
                                        </label>
                                    @endif
                                </div>

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" data-bs-dismiss="modal">Close</button>
                                <button type="submit">Continue</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="child-modal1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('capa_effectiveness_check', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">
                                    <label for="major">
                                        <input type="radio" name="effectiveness_check" id="major"
                                            value="Effectiveness_check">
                                        Effectiveness Check
                                    </label>
                                </div>

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" data-bs-dismiss="modal">Close</button>
                                <button type="submit">Continue</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="rejection-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form id="formreject" action="{{ route('capa_reject', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username <span class="text-danger">*</span></label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment <span class="text-danger">*</span></label>
                                    <input type="comment" name="comment" required>
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <!-- <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                <button>Close</button>
                            </div> -->
                            <div class="modal-footer">
                              <button class=" on-submit-disable-button" type="submit">Submit</button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="cancel-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form id="formcancel" action="{{ route('capaCancel', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username <span class="text-danger">*</span></label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment <span class="text-danger">*</span></label>
                                    <input type="comment" name="comment" required>
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <!-- <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                <button>Close</button>
                            </div> -->
                            <div class="modal-footer">
                              <button class=" on-submit-disable-button" type="submit">Submit</button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="signature-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form id="formforword" action="{{ route('capa_send_stage', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username <span class="text-danger">*</span></label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment</label>
                                    <input type="comment" name="comment">
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <!-- <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                <button>Close</button>
                            </div> -->
                            <div class="modal-footer">
                              <button class=" on-submit-disable-button" type="submit">Submit</button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="capa_more_info">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form id="formSubmit" action="{{ route('capa_qa_more_info', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username <span class="text-danger">*</span></label>
                                    <input class="input-new" type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input class="input-new" type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment <span class="text-danger">*</span></label>
                                    <input class="input-new" type="comment" name="comment" required>
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <!-- <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                <button>Close</button>
                            </div> -->
                            <div class="modal-footer">
                              <button class=" on-submit-disable-button" type="submit">Submit</button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <style>
                #step-form>div {
                    display: none
                }

                #step-form>div:nth-child(1) {
                    display: block;
                }
                .input-new{
                    width: 100%;
                    margin-bottom: 10px;
                    border-radius: 5px;
                }
            </style>
            <script>
                $(document).ready(function() {
                    
                    $('#mainform').on('submit', function(e) {
                        $('.on-submit-disable-button').prop('disabled', true);
                    });
                })
            </script>

            <script>
                $(document).ready(function() {
                    
                    $('#formSubmit').on('submit', function(e) {
                        $('.on-submit-disable-button').prop('disabled', true);
                    });
                })
            </script>

            <script>
                $(document).ready(function() {
                    
                    $('#formforword').on('submit', function(e) {
                        $('.on-submit-disable-button').prop('disabled', true);
                    });
                })
            </script>

            <script>
                $(document).ready(function() {
                    
                    $('#formreject').on('submit', function(e) {
                        $('.on-submit-disable-button').prop('disabled', true);
                    });
                })
            </script>

            <script>
                $(document).ready(function() {
                    
                    $('#formcancel').on('submit', function(e) {
                        $('.on-submit-disable-button').prop('disabled', true);
                    });
                })
            </script>

            <script>
                $(document).ready(function() {
                    $('.remove-file').click(function() {
                        const removeId = $(this).data('remove-id')
                        console.log('removeId', removeId);
                        $('#' + removeId).remove();
                    })
                })
            </script>

            <script>
                VirtualSelect.init({
                    ele: '#Facility, #Group, #Audit, #Auditee ,#capa_related_record'
                });

                function openCity(evt, cityName) {
                    var i, cctabcontent, cctablinks;
                    cctabcontent = document.getElementsByClassName("cctabcontent");
                    for (i = 0; i < cctabcontent.length; i++) {
                        cctabcontent[i].style.display = "none";
                    }
                    cctablinks = document.getElementsByClassName("cctablinks");
                    for (i = 0; i < cctablinks.length; i++) {
                        cctablinks[i].className = cctablinks[i].className.replace(" active", "");
                    }
                    document.getElementById(cityName).style.display = "block";
                    evt.currentTarget.className += " active";
                }



                function openCity(evt, cityName) {
                    var i, cctabcontent, cctablinks;
                    cctabcontent = document.getElementsByClassName("cctabcontent");
                    for (i = 0; i < cctabcontent.length; i++) {
                        cctabcontent[i].style.display = "none";
                    }
                    cctablinks = document.getElementsByClassName("cctablinks");
                    for (i = 0; i < cctablinks.length; i++) {
                        cctablinks[i].className = cctablinks[i].className.replace(" active", "");
                    }
                    document.getElementById(cityName).style.display = "block";
                    evt.currentTarget.className += " active";

                    // Find the index of the clicked tab button
                    const index = Array.from(cctablinks).findIndex(button => button === evt.currentTarget);

                    // Update the currentStep to the index of the clicked tab
                    currentStep = index;
                }

                const saveButtons = document.querySelectorAll(".saveButton");
                const nextButtons = document.querySelectorAll(".nextButton");
                const form = document.getElementById("step-form");
                const stepButtons = document.querySelectorAll(".cctablinks");
                const steps = document.querySelectorAll(".cctabcontent");
                let currentStep = 0;

                function nextStep() {
                    // Check if there is a next step
                    if (currentStep < steps.length - 1) {
                        // Hide current step
                        steps[currentStep].style.display = "none";

                        // Show next step
                        steps[currentStep + 1].style.display = "block";

                        // Add active class to next button
                        stepButtons[currentStep + 1].classList.add("active");

                        // Remove active class from current button
                        stepButtons[currentStep].classList.remove("active");

                        // Update current step
                        currentStep++;
                    }
                }

                function previousStep() {
                    // Check if there is a previous step
                    if (currentStep > 0) {
                        // Hide current step
                        steps[currentStep].style.display = "none";

                        // Show previous step
                        steps[currentStep - 1].style.display = "block";

                        // Add active class to previous button
                        stepButtons[currentStep - 1].classList.add("active");

                        // Remove active class from current button
                        stepButtons[currentStep].classList.remove("active");

                        // Update current step
                        currentStep--;
                    }
                }
            </script>
                <script>
                    document.getElementById('initiator_group').addEventListener('change', function() {
                        var selectedValue = this.value;
                        document.getElementById('initiator_group_code').value = selectedValue;
                    });
                </script>
                 <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const removeButtons = document.querySelectorAll('.remove-file');

                        removeButtons.forEach(button => {
                            button.addEventListener('click', function () {
                                const fileName = this.getAttribute('data-file-name');
                                const fileContainer = this.closest('.file-container');

                                // Hide the file container
                                if (fileContainer) {
                                    fileContainer.style.display = 'none';
                                }
                            });
                        });
                    });
                </script>
                <script>
                    var maxLength = 255;
                    $('#docname').keyup(function() {
                        var textlen = maxLength - $(this).val().length;
                        $('#rchars').text(textlen);});
                </script>


<script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize speech recognition
        const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
        recognition.continuous = false;
        recognition.interimResults = false;
        recognition.lang = 'en-US';

        // Function to start speech recognition and append result to the target element
        function startRecognition(targetElement) {
            recognition.start();
            recognition.onresult = function(event) {
                const transcript = event.results[0][0].transcript;
                targetElement.value += transcript;
            };
            recognition.onerror = function(event) {
                console.error(event.error);
            };
        }

        // Event delegation for all mic buttons
        document.addEventListener('click', function(event) {
            if (event.target.closest('.mic-btn')) {
                const button = event.target.closest('.mic-btn');
                const inputField = button.previousElementSibling;
                if (inputField && inputField.classList.contains('mic-input')) {
                    startRecognition(inputField);
                }
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize speech recognition
        const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
        recognition.continuous = false;
        recognition.interimResults = false;
        recognition.lang = 'en-US';

        // Function to start speech recognition and append result to the target element
        function startRecognition(targetElement) {
            recognition.start();
            recognition.onresult = function(event) {
                const transcript = event.results[0][0].transcript;
                targetElement.value += transcript;
            };
            recognition.onerror = function(event) {
                console.error(event.error);
            };
        }

        // Event delegation for all mic buttons
        document.addEventListener('click', function(event) {
            if (event.target.closest('.mic-btn')) {
                const button = event.target.closest('.mic-btn');
                const inputField = button.previousElementSibling;
                if (inputField && inputField.classList.contains('mic-input')) {
                    startRecognition(inputField);
                }
            }
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize speech recognition
        const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
        recognition.continuous = false;
        recognition.interimResults = false;
        recognition.lang = 'en-US';

        // Function to start speech recognition and append result to the target element
        function startRecognition(targetElement) {
            recognition.start();
            recognition.onresult = function(event) {
                const transcript = event.results[0][0].transcript;
                targetElement.value += transcript;
            };
            recognition.onerror = function(event) {
                console.error(event.error);
            };
        }

        // Event delegation for all mic buttons
        document.addEventListener('click', function(event) {
            if (event.target.closest('.mic-btn')) {
                const button = event.target.closest('.mic-btn');
                const inputField = button.previousElementSibling;
                if (inputField && inputField.classList.contains('mic-input')) {
                    startRecognition(inputField);
                }
            }
        });
    });

    // Show/hide the container based on user selection
    function toggleOthersField(selectedValue) {
        const container = document.getElementById('external_agencies_req');
        if (selectedValue === 'others') {
            container.classList.remove('d-none');
        } else {
            container.classList.add('d-none');
        }
    }
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize speech recognition
    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
    recognition.continuous = false;
    recognition.interimResults = false;
    recognition.lang = 'en-US';

    // Function to start speech recognition and append result to the target element
    function startRecognition(targetElement) {
        recognition.start();
        recognition.onresult = function(event) {
            const transcript = event.results[0][0].transcript;
            targetElement.value += transcript;
        };
        recognition.onerror = function(event) {
            console.error(event.error);
        };
    }

    // Event delegation for all mic buttons
    document.addEventListener('click', function(event) {
        const button = event.target.closest('.mic-btn');
        if (button) {
            const inputField = button.previousElementSibling;
            if (inputField && inputField.classList.contains('mic-input')) {
                startRecognition(inputField);
            }
        }
    });

    // Show/hide mic button on focus/blur of input fields
    const micInputs = document.querySelectorAll('.mic-input');
    micInputs.forEach(input => {
        input.addEventListener('focus', function() {
            const micBtn = this.nextElementSibling;
            if (micBtn && micBtn.classList.contains('mic-btn')) {
                micBtn.style.display = 'block';
            }
        });
        input.addEventListener('blur', function(event) {
            const micBtn = this.nextElementSibling;
            if (micBtn && micBtn.classList.contains('mic-btn')) {
                // Use a timeout to prevent immediate hiding when the button is clicked
                setTimeout(() => {
                    if (!event.relatedTarget || !event.relatedTarget.classList.contains('mic-btn')) {
                        micBtn.style.display = 'none';
                    }
                }, 200);
            }
        });
    });

    // Show/hide the container based on user selection
    window.toggleOthersField = function(selectedValue) {
        const container = document.getElementById('external_agencies_req');
        if (selectedValue === 'others') {
            container.classList.remove('d-none');
        } else {
            container.classList.add('d-none');
        }
    }
});

$(document).ready(function() {
    let audio = null;
    let selectedLanguage = 'en-us'; // Default language
    const apiKey = '16f141b794484a71b679325faf2d5fc4'; // Use the provided API key

    // When the user clicks the button, open the mini modal
    $(document).on('click', '.speak-btn', function() {
        let inputField = $(this).siblings('textarea, input');
        let textToSpeak = inputField.val();
        let modal = $(this).siblings('.mini-modal');
        if (textToSpeak) {
            // Store the input field element
            $(modal).data('inputField', inputField);
            modal.css({
                display: 'block',
                top: $(this).position().top - modal.outerHeight() - 10,
                left: $(this).position().left + $(this).outerWidth() - modal.outerWidth()
            });
        }
    });

    // When the user clicks on <span> (x), close the mini modal
    $(document).on('click', '.close', function() {
        $(this).closest('.mini-modal').css('display', 'none');
    });

    // When the user selects a language and clicks the button
    $(document).on('click', '#select-language-btn', function(event) {
        event.preventDefault(); // Prevent form submission
        let modal = $(this).closest('.mini-modal');
        selectedLanguage = modal.find('#language-select').val();
        let inputField = modal.data('inputField');
        let textToSpeak = inputField.val();

        if (textToSpeak) {
            if (audio) {
                audio.pause();
                audio.currentTime = 0;
            }

            const url = `https://api.voicerss.org/?key=${apiKey}&hl=${selectedLanguage}&src=${encodeURIComponent(textToSpeak)}&r=0&c=WAV&f=44khz_16bit_stereo`;
            audio = new Audio(url);
            audio.play();
            audio.onended = function() {
                audio = null;
            };
        }

        modal.css('display', 'none');
    });

    // Speech-to-Text functionality
    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
    recognition.continuous = false;
    recognition.interimResults = false;
    recognition.lang = 'en-US';

    function startRecognition(targetElement) {
        recognition.start();
        recognition.onresult = function(event) {
            const transcript = event.results[0][0].transcript;
            targetElement.value += transcript;
        };
        recognition.onerror = function(event) {
            console.error(event.error);
        };
    }

    $(document).on('click', '.mic-btn', function() {
        const inputField = $(this).siblings('textarea, input');
        startRecognition(inputField[0]);
    });

    // Show mic button on hover
    $('.relative-container').hover(
        function() {
            $(this).find('.mic-btn').show();
        },
        function() {
            $(this).find('.mic-btn').hide();
        }
    );
});
</script>

// <script>
// $(document).ready(function(){
//     let audio = null;
//     let selectedLanguage = 'en-us'; // Default language
//     let inputText = '';

//     // When the user clicks the button, open the mini modal
//     $(document).on('click', '.speak-btn', function() {
//         let inputField = $(this).siblings('textarea, input');
//         inputText = inputField.val();
//         let modal = $(this).siblings('.mini-modal');
//         if (inputText) {
//             // Store the input field element
//             $(modal).data('inputField', inputField);
//             modal.css({
//                 display: 'block',
//                 top: $(this).position().top - modal.outerHeight() - 10,
//                 left: $(this).position().left + $(this).outerWidth() - modal.outerWidth()
//             });
//         }
//     });

//     // When the user clicks on <span> (x), close the mini modal
//     $(document).on('click', '.close', function() {
//         $(this).closest('.mini-modal').css('display', 'none');
//     });

//     // When the user selects a language and clicks the button
//     $(document).on('click', '#select-language-btn', function(event) {
//         event.preventDefault(); // Prevent form submission
//         let modal = $(this).closest('.mini-modal');
//         selectedLanguage = modal.find('#language-select').val();
//         let inputField = modal.data('inputField');
//         let textToSpeak = inputText;

//         if (textToSpeak) {
//             if (audio) {
//                 audio.pause();
//                 audio.currentTime = 0;
//             }

//             // Translate the text before converting to speech
//             translateText(textToSpeak, selectedLanguage).then(translatedText => {
//                 const apiKey = '16f141b794484a71b679325faf2d5fc4';
//                 const url = `https://api.voicerss.org/?key=${apiKey}&hl=${selectedLanguage}&src=${encodeURIComponent(translatedText)}&r=0&c=WAV&f=44khz_16bit_stereo`;
//                 audio = new Audio(url);
//                 audio.play();
//                 audio.onended = function() {
//                     audio = null;
//                 };
//             });

//         }

//         modal.css('display', 'none');
//     });

//     // Speech-to-Text functionality
//     const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
//     recognition.continuous = false;
//     recognition.interimResults = false;
//     recognition.lang = 'en-US';

//     function startRecognition(targetElement) {
//         recognition.start();
//         recognition.onresult = function(event) {
//             const transcript = event.results[0][0].transcript;
//             targetElement.value += transcript;
//         };
//         recognition.onerror = function(event) {
//             console.error(event.error);
//         };
//     }

//     $(document).on('click', '.mic-btn', function() {
//         const inputField = $(this).siblings('textarea, input');
//         startRecognition(inputField[0]);
//     });

//     // Show mic button on hover
//     $('.relative-container').hover(
//         function() {
//             $(this).find('.mic-btn').show();
//         },
//         function() {
//             $(this).find('.mic-btn').hide();
//         }
//     );

//     // Function to translate text using RapidAPI
//     async function translateText(text, targetLanguage) {
//         const url = 'https://google-translate1.p.rapidapi.com/language/translate/v2';
//         const options = {
//             method: 'POST',
//             headers: {
//                 'x-rapidapi-key': '04a1f9ac37mshad30c58bfab6ebcp1c47f3jsn2b23573a251f',
//                 'x-rapidapi-host': 'google-translate1.p.rapidapi.com',
//                 'Accept-Encoding': 'application/gzip',
//                 'Content-Type': 'application/x-www-form-urlencoded'
//             },
//             body: new URLSearchParams({
//                 q: text,
//                 target: targetLanguage.split('-')[0] // Get the language code only
//             })
//         };

//         const response = await fetch(url, options);
//         const data = await response.json();
//         return data.data.translations[0].translatedText;
//     }
// });

// </script>


        @endsection
