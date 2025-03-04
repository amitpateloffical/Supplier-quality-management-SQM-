@extends('frontend.layout.main')
@section('container')
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
    </style>





    <div class="form-field-head">
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            @if(!empty($parent_division_id))
                {{ Helpers::getDivisionName($parent_division_id) }} / Root Cause Analysis
            @else
                {{ Helpers::getDivisionName(session()->get('division')) }} / Root Cause Analysis
            @endif
        </div>
    </div>

    @php
        $users = DB::table('users')->get();
    @endphp

    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">

                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Investigation & Root Cause</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA Review</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Activity Log</button>
            </div>

            <form action="{{ route('root_store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (!empty($parent_id))
                    <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                    <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif
                <div id="step-form">
                    <!--Investigation-->

                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        @if(!empty($parent_division_id))
                                            <input disabled type="text" name="record_number"
                                                value="{{ Helpers::getDivisionName($parent_division_id) }}/RCA/{{ date('Y') }}/{{ $record_number }}">
                                        @else
                                            <input disabled type="text" name="record_number"
                                                value="{{ Helpers::getDivisionName(session()->get('division')) }}/RCA/{{ date('Y') }}/{{ $record_number }}">
                                        @endif
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code </b></label>
                                        @if(!empty($parent_division_id))
                                            <input readonly type="text" name="division_code"
                                                value="{{ Helpers::getDivisionName($parent_division_id) }}">
                                            <input type="hidden" name="division_id" value="{{ $parent_division_id }}">
                                        @else
                                            <input readonly type="text" name="division_code"
                                                value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                            <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="originator">Initiator</label>
                                        <input readonly type="text" name="originator_id"
                                            value="{{ Auth::user()->name }}" />
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input ">
                                        <label for="Date Due"><b>Date of Initiation</b></label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('d-m-Y') }}" name="intiation_date">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group"><b>Initiator Group</b></label>
                                        <select name="initiator_Group" id="initiator_group">
                                            <option value="">-- Select --</option>
                                            <option value="CQA" @if (old('initiator_Group') == 'CQA') selected @endif>
                                                Corporate Quality Assurance</option>
                                            <option value="QAB" @if (old('initiator_Group') == 'QAB') selected @endif>Quality
                                                Assurance Biopharma</option>
                                            <option value="CQC" @if (old('initiator_Group') == 'CQA') selected @endif>Central
                                                Quality Control</option>
                                            <option value="MANU" @if (old('initiator_Group') == 'MANU') selected @endif>
                                                Manufacturing</option>
                                            <option value="PSG" @if (old('initiator_Group') == 'PSG') selected @endif>Plasma
                                                Sourcing Group</option>
                                            <option value="CS" @if (old('initiator_Group') == 'CS') selected @endif>Central
                                                Stores</option>
                                            <option value="ITG" @if (old('initiator_Group') == 'ITG') selected @endif>
                                                Information Technology Group</option>
                                            <option value="MM" @if (old('initiator_Group') == 'MM') selected @endif>
                                                Molecular Medicine</option>
                                            <option value="CL" @if (old('initiator_Group') == 'CL') selected @endif>
                                                Central Laboratory</option>

                                            <option value="TT" @if (old('initiator_Group') == 'TT') selected @endif>Tech
                                                team</option>
                                            <option value="QA" @if (old('initiator_Group') == 'QA') selected @endif>
                                                Quality Assurance</option>
                                            <option value="QM" @if (old('initiator_Group') == 'QM') selected @endif>
                                                Quality Management</option>
                                            <option value="IA" @if (old('initiator_Group') == 'IA') selected @endif>IT
                                                Administration</option>
                                            <option value="ACC" @if (old('initiator_Group') == 'ACC') selected @endif>
                                                Accounting</option>
                                            <option value="LOG" @if (old('initiator_Group') == 'LOG') selected @endif>
                                                Logistics</option>
                                            <option value="SM" @if (old('initiator_Group') == 'SM') selected @endif>
                                                Senior Management</option>
                                            <option value="BA" @if (old('initiator_Group') == 'BA') selected @endif>
                                                Business Administration</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Initiator Group Code</label>
                                        <input type="text" name="initiator_group_code" id="initiator_group_code"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="assign_to">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Due Date"> Due Date </label>
                                        <div><small class="text-primary">If revising Due Date, kindly mention revision
                                                reason in "Due Date Extension Justification" data field.</small></div>
                                        <div class="calenderauditee">
                                            <input type="text" name="due_date" readonly
                                                value="{{ Helpers::getdateFormat($due_date) }}" />
                                            <!-- <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, 'due_date')" /> -->
                                        </div>
                                    </div>
                                </div>





                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining

                                        <div class="relative-container">
                                            <input class="mic-input" id="docname" type="text"
                                                name="short_description" maxlength="255" required>
                                            @component('frontend.forms.language-model')
                                            @endcomponent
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="severity-level">Severity Level</label>
                                        <span class="text-primary">Severity levels in a QMS record gauge issue seriousness,
                                            guiding priority for corrective actions. Ranging from low to high, they ensure
                                            quality standards and mitigate critical risks.</span>
                                        <select name="severity_level">
                                            <option value="0">-- Select --</option>
                                            <option value="minor">Minor</option>
                                            <option value="major">Major</option>
                                            <option value="critical">Critical</option>
                                        </select>
                                    </div>
                                </div>

                                @php
                                    // Calculate the due date (30 days from the initiation date)
                                    $initiationDate = date('Y-m-d'); // Current date as initiation date
                                    $dueDate = date('Y-m-d', strtotime($initiationDate . '+30 days')); // Due date
                                @endphp

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

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group">Initiated Through</label>
                                        <div><small class="text-primary">Please select related information</small></div>
                                        <select name="initiated_through"
                                            onchange="otherController(this.value, 'others', 'initiated_through_req')">
                                            <option value="">-- select --</option>
                                            <option value="recall">Recall</option>
                                            <option value="return">Return</option>
                                            <option value="deviation">Deviation</option>
                                            <option value="complaint">Complaint</option>
                                            <option value="regulatory">Regulatory</option>
                                            <option value="lab-incident">Lab Incident</option>
                                            <option value="improvement">Improvement</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input" id="initiated_through_req">
                                        <label for="initiated_if_other">Others<span
                                                class="text-danger d-none">*</span></label>
                                        <div class="relative-container">
                                            <textarea name="initiated_if_other" class="mic-input" id="initiated_if_other"></textarea>

                                            @component('frontend.forms.language-model')
                                            @endcomponent
                                        </div>
                                    </div>
                                </div>




                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Type">Type</label>
                                        <select name="Type">
                                            <option value="0">-- Select --</option>
                                            <option value="Facillties">Facillties</option>
                                            <option value="Other">Other</option>
                                            <option value="Stabillity">Stabillity</option>
                                            <option value="Raw Material">Raw Material</option>
                                            <option value="Clinical Production">Clinical Production</option>
                                            <option value="Commercial Production">Commercial Production</option>
                                            <option value="Labellling">Labellling</option>
                                            <option value="laboratory">laboratory</option>
                                            <option value="Utillities">Utillities</option>
                                            <option value="Validation">Validation</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="priority_level">Priority Level</label>
                                        <div><small class="text-primary">Choose high if Immidiate actions are
                                                required</small></div>
                                        <select name="priority_level">
                                            <option value="0">-- Select --</option>
                                            <option value="low">Low</option>
                                            <option value="medium">Medium</option>
                                            <option value="high">High</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6"> --}}
                                {{-- <div class="group-input">
                                        <label for="investigators">Additional Investigators</label>
                                        <select  name="investigators" placeholder="Select Investigators"
                                            data-search="false" data-silent-initial-value-set="true" id="investigators">
                                            <option value="">Select Investigators</option>
                                            <option value="1">Amit Guru</option>
                                            <option value="2">Shaleen Mishra</option>
                                            <option value="3">Madhulika Mishra</option>
                                            <option value="4">Amit Patel</option>
                                            <option value="5">Harsh Mishra</option>
                                        </select>
                                    </div> --}}
                                {{-- </div> --}}
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="department">Department(s)</label>
                                        <select multiple name="department[]" placeholder="Select Department(s)"
                                            data-search="false" data-silent-initial-value-set="true" id="department">
                                            <option value="Work Instruction">Work Instruction</option>
                                            <option value="Quality Assurance">Quality Assurance</option>
                                            <option value="Specifications">Specifications</option>
                                            <option value="Production">Production</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="sub-head">Investigation details</div>
                            </div>


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Short Description"> Description<span class="text-danger"></span></label>
                                    <div class="relative-container">
                                        <textarea name="description" id="description" class="mic-input"></textarea>
                                        @component('frontend.forms.language-model')
                                        @endcomponent
                                    </div>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="comments">Comments</label>
                                    <div class="relative-container">
                                        <textarea name="comments" class="mic-input" id="comments"></textarea>
                                        @component('frontend.forms.language-model')
                                        @endcomponent

                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">Initial Attachment</label>
                                    <div>
                                        <small class="text-primary">
                                            Please Attach all relevant or supporting documents
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="root_cause_initial_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="root_cause_initial_attachment[]"
                                                oninput="addMultipleFiles(this, 'root_cause_initial_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="severity-level">Sevrity Level</label>
                                        <select name="severity-level">
                                            <option value="0">-- Select --</option>
                                            <option value="minor">Minor</option>
                                            <option value="major">Major</option>
                                            <option value="critical">Critical</option>
                                        </select>
                                    </div>
                                </div> --}}
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="related_url">Related URL</label>
                                    <input type="url" name="related_url" />
                                </div>
                            </div>
                       
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a> </button>
                        </div>

                    </div>
                    </div>
                </div>

                <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="root-cause-methodology">Root Cause Methodology</label>
                                    <select name="root_cause_methodology[]" multiple placeholder="-- Select --"
                                        data-search="false" data-silent-initial-value-set="true"
                                        id="root-cause-methodology">

                                        <option value="Why-Why Chart">Why-Why Chart</option>
                                        <option value="Failure Mode and Efect Analysis">Failure Mode and Efect Analysis
                                        </option>
                                        <option value="Fishbone or Ishikawa Diagram">Fishbone or Ishikawa Diagram</option>
                                        <option value="Is/Is Not Analysis">Is/Is Not Analysis</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="root_cause">
                                        Root Cause
                                        <button type="button"
                                            onclick="add4Input_case('root-cause-first-table')">+</button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="root-cause-first-table">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Root Cause Category</th>
                                                    <th>Root Cause Sub-Category</th>
                                                    <th>Probability</th>
                                                    <th>Remarks</th>
                                                    <th style="width: 10px">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input type="text" name="Root_Cause_Category[]"></td>
                                                <td><input type="text" name="Root_Cause_Sub_Category[]"></td>
                                                <td><input type="text" name="Probability[]"></td>
                                                <td><input type="text" name="Remarks[]"></td>
                                                <td><button type="text" class="removeRowBtn">Remove</button></td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 sub-head"></div>
                            <div class="col-12 mb-4">
                                <div class="group-input">
                                    <label for="agenda">
                                        Failure Mode and Effect Analysis
                                        <button type="button" name="agenda"
                                            onclick="addRootCauseAnalysisRiskAssessment('risk-assessment-risk-management')">+</button>
                                        <span class="text-primary" style="font-size: 0.8rem; font-weight: 400;">
                                            (Launch Instruction)
                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" style="width: 200%"
                                            id="risk-assessment-risk-management">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Risk Factor</th>
                                                    <th>Risk element </th>
                                                    <th>Probable cause of risk element</th>
                                                    <th>Existing Risk Controls</th>
                                                    <th>Initial Severity- H(3)/M(2)/L(1)</th>
                                                    <th>Initial Probability- H(3)/M(2)/L(1)</th>
                                                    <th>Initial Detectability- H(1)/M(2)/L(3)</th>
                                                    <th>Initial RPN</th>
                                                    <th>Risk Acceptance (Y/N)</th>
                                                    <th>Proposed Additional Risk control measure (Mandatory for Risk
                                                        elements having RPN>4)</th>
                                                    <th>Residual Severity- H(3)/M(2)/L(1)</th>
                                                    <th>Residual Probability- H(3)/M(2)/L(1)</th>
                                                    <th>Residual Detectability- H(1)/M(2)/L(3)</th>
                                                    <th>Residual RPN</th>
                                                    <th>Risk Acceptance (Y/N)</th>
                                                    <th>Mitigation proposal (Mention either CAPA reference number, IQ,
                                                        OQ or
                                                        PQ)</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 sub-head"></div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="fishbone">
                                        Fishbone or Ishikawa Diagram
                                        <button type="button" name="agenda"
                                            onclick="addFishBone('.top-field-group', '.bottom-field-group')">+</button>
                                        <button type="button" name="agenda" class="fishbone-del-btn"
                                            onclick="deleteFishBone('.top-field-group', '.bottom-field-group')">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#fishbone-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400;">
                                            (Launch Instruction)
                                        </span>
                                    </label>
                                    <div class="fishbone-ishikawa-diagram">
                                        <div class="left-group">
                                            <div class="grid-field field-name">
                                                <div>Measurement</div>
                                                <div>Materials</div>
                                                <div>Methods</div>
                                            </div>
                                            <div class="top-field-group">
                                                <div class="grid-field fields top-field">
                                                    <div><input type="text" name="measurement[]"></div>
                                                    <div><input type="text" name="materials[]"></div>
                                                    <div><input type="text" name="methods[]"></div>
                                                </div>
                                            </div>
                                            <div class="mid"></div>
                                            <div class="bottom-field-group">
                                                <div class="grid-field fields bottom-field">
                                                    <div><input type="text" name="environment[]"></div>
                                                    <div><input type="text" name="manpower[]"></div>
                                                    <div><input type="text" name="machine[]"></div>
                                                </div>
                                            </div>
                                            <div class="grid-field field-name">
                                                <div>Environment</div>
                                                <div>Manpower</div>
                                                <div>Machine</div>
                                            </div>
                                        </div>
                                        <div class="right-group">
                                            <div class="field-name">
                                                Problem Statement
                                            </div>
                                            <div class="field relative-container">
                                                <textarea name="problem_statement"></textarea>
                                                @component('frontend.forms.language-model')
                                                @endcomponent
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 sub-head"></div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="why-why-chart">
                                        Why-Why Chart
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#why_chart-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400;">
                                            (Launch Instruction)
                                        </span>
                                    </label>
                                    <div class="why-why-chart">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr style="background: #f4bb22">
                                                    <th style="width:150px;">Problem Statement :</th>
                                                    <td class="relative-container">
                                                        <textarea name="why_problem_statement"></textarea>
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                    </td>
                                                </tr>
                                                <tr class="why-row">
                                                    <th style="width:150px; color: #393cd4;">
                                                        Why 1 <span
                                                            onclick="addWhyField('why_1_block', 'why_1[]')">+</span>
                                                    </th>
                                                    <td>
                                                        <div class="why_1_block  relative-container">
                                                            <textarea name="why_1[]"></textarea>
                                                            {{-- @component('frontend.forms.language-model')
                                                            @endcomponent --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="why-row">
                                                    <th style="width:150px; color: #393cd4;">
                                                        Why 2 <span
                                                            onclick="addWhyField('why_2_block', 'why_2[]')">+</span>
                                                    </th>
                                                    <td>
                                                        <div class="why_2_block  relative-container">
                                                            <textarea name="why_2[]"></textarea>
                                                            {{-- @component('frontend.forms.language-model')
                                                            @endcomponent --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="why-row">
                                                    <th style="width:150px; color: #393cd4;">
                                                        Why 3 <span
                                                            onclick="addWhyField('why_3_block', 'why_3[]')">+</span>
                                                    </th>
                                                    <td>
                                                        <div class="why_3_block  relative-container">
                                                            <textarea name="why_3[]"></textarea>
                                                            {{-- @component('frontend.forms.language-model')
                                                            @endcomponent --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="why-row">
                                                    <th style="width:150px; color: #393cd4;">
                                                        Why 4 <span
                                                            onclick="addWhyField('why_4_block', 'why_4[]')">+</span>
                                                    </th>
                                                    <td>
                                                        <div class="why_4_block  relative-container">
                                                            <textarea name="why_4[]"></textarea>
                                                            {{-- @component('frontend.forms.language-model')
                                                            @endcomponent --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="why-row">
                                                    <th style="width:150px; color: #393cd4;">
                                                        Why 5 <span
                                                            onclick="addWhyField('why_5_block', 'why_5[]')">+</span>
                                                    </th>
                                                    <td>
                                                        <div class="why_5_block  relative-container">
                                                            <textarea name="why_5[]"></textarea>
                                                            {{-- @component('frontend.forms.language-model')
                                                            @endcomponent --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr style="background: #0080006b;">
                                                    <th style="width:150px;">Root Cause :</th>
                                                    <td class=" relative-container">
                                                        <textarea name="why_root_cause"></textarea>
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 sub-head"></div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="why-why-chart">
                                        Is/Is Not Analysis
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#is_is_not-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400;">
                                            (Launch Instruction)
                                        </span>
                                    </label>
                                    <div class="why-why-chart">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>&nbsp;</th>
                                                    <th>Will Be</th>
                                                    <th>Will Not Be</th>
                                                    <th>Rationale</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th style="background: #0039bd85">What</th>
                                                    <td class="relative-container">
                                                        <textarea name="what_will_be"></textarea>
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                    </td>
                                                    <td class="relative-container">
                                                        <textarea name="what_will_not_be"></textarea>
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                    </td>
                                                    <td class="relative-container">
                                                        <textarea name="what_rationable"></textarea>
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="background: #0039bd85">Where</th>
                                                    <td class="relative-container">
                                                        <textarea name="where_will_be"></textarea>
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                    </td>
                                                    <td class="relative-container">
                                                        <textarea name="where_will_not_be"></textarea>
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                    </td>
                                                    <td class="relative-container">
                                                        <textarea name="where_rationable"></textarea>
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="background: #0039bd85">When</th>
                                                    <td class="relative-container">
                                                        <textarea name="when_will_be"></textarea>
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                    </td>
                                                    <td class="relative-container">
                                                        <textarea name="when_will_not_be"></textarea>
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                    </td>
                                                    <td class="relative-container">
                                                        <textarea name="when_rationable"></textarea>
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="background: #0039bd85">Coverage</th>
                                                    <td class="relative-container">
                                                        <textarea name="coverage_will_be"></textarea>
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                    </td>
                                                    <td class="relative-container">
                                                        <textarea name="coverage_will_not_be"></textarea>
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                    </td>
                                                    <td class="relative-container">
                                                        <textarea name="coverage_rationable"></textarea>
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="background: #0039bd85">Who</th>
                                                    <td class="relative-container">
                                                        <textarea name="who_will_be"></textarea>
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                    </td>
                                                    <td class="relative-container">
                                                        <textarea name="who_will_not_be"></textarea>
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                    </td>
                                                    <td class="relative-container">
                                                        <textarea name="who_rationable"></textarea>
                                                        @component('frontend.forms.language-model')
                                                        @endcomponent
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 sub-head"></div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="root_cause_description">Root Cause Description</label>
                                    <div class="relative-container">
                                        <textarea name="root_cause_description" class="mic-input" id="root_cause_description"></textarea>
                                        @component('frontend.forms.language-model')
                                        @endcomponent
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="investigation_summary">Investigation Summary</label>
                                    <div class="relative-container">
                                        <textarea name="investigation_summary" class="mic-input" id="investigation_summary"></textarea>
                                        @component('frontend.forms.language-model')
                                        @endcomponent
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
                <div id="CCForm4" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="cft_comments_new">Final Comments</label>
                                    <div class="relative-container">
                                        <textarea name="cft_comments_new" id="cft_comments_new" class="mic-input"></textarea>
                                        @component('frontend.forms.language-model')
                                        @endcomponent
                                    </div>
                                </div>
                            </div>




                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">Final Attachment</label>
                                    <div>
                                        <small class="text-primary">
                                            Please Attach all relevant or supporting documents
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="cft_attchament_new"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="cft_attchament_new[]"
                                                oninput="addMultipleFiles(this, 'cft_attchament_new')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="comments">Final Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="cft_attchament_new"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="cft_attchament_new[]"
                                                    oninput="addMultipleFiles(this, 'cft_attchament_new')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="row">
                                <div class="sub-head">
                                    Concerned Group Feedback
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">QA Comments</label>
                                        <textarea name="qa_comments_new"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">QA Head Designee Comments</label>
                                        <textarea name="designee_comments_new"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Warehouse Comments</label>
                                        <textarea name="Warehouse_comments_new"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Engineering Comments</label>
                                        <textarea name="Engineering_comments_new"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Instrumentation Comments</label>
                                        <textarea name="Instrumentation_comments_new"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Validation Comments</label>
                                        <textarea name="Validation_comments_new"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Others Comments</label>
                                        <textarea name="Others_comments_new"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Group Comments</label>
                                        <textarea name="Group_comments_new"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="group-attachments">Group Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="group_attachments_new"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="group_attachments_new[]"
                                                    oninput="addMultipleFiles(this, 'group_attachments_new')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>

                            </div>
                        </div>
                    </div>
                </div>

                <div id="CCForm3" class="inner-block cctabcontent">
                    <div class="inner-block-content">

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="Acknowledge_By">Acknowledge By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="Acknowledge_On">Acknowledge On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Acknowledge_On">Acknowledge Comment</label>
                                    <div class="static"></div>
                                </div>
                            </div>


                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="Submit_By">Submitted By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="Submit_On">Submitted On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Submit_On">Submitted Comment</label>
                                    <div class="static"></div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="QA_Review_Complete_By">QA Review Completed By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="QA_Review_Complete_On">QA Review Completed On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="QA_Review_Complete_On">QA Review Completed Comment</label>
                                    <div class="static"></div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="QA_Review_Complete_By">More Info Required By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="QA_Review_Complete_On">More Info Required On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="QA_Review_Complete_On">More Info Required Comment</label>
                                    <div class="static"></div>
                                </div>
                            </div>


                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="Cancelled By">Cancelled By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="Cancelled On">Cancelled On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Cancelled On">Cancelled Comment</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <!-- <button type="submit" class="saveButton">Save</button> -->
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <!-- <button type="submit">Submit</button> -->
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a> </button>
                        </div>
                    </div>
                </div>

        </div>
        </form>

    </div>
    </div>

    <style>
        #step-form>div {
            display: none
        }

        #step-form>div:nth-child(1) {
            display: block;
        }
    </style>

    <script>
        VirtualSelect.init({
            ele: '#investigators, #department, #root-cause-methodology'
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
        // ================================ FOUR INPUTS
        function add4Input_case(tableId) {
            var table = document.getElementById(tableId);
            var currentRowCount = table.rows.length;
            var newRow = table.insertRow(currentRowCount);

            newRow.setAttribute("id", "row" + currentRowCount);
            var cell1 = newRow.insertCell(0);
            cell1.innerHTML = currentRowCount;

            var cell2 = newRow.insertCell(1);
            cell2.innerHTML = "<input type='text' name='Root_Cause_Category[]'>";

            var cell3 = newRow.insertCell(2);
            cell3.innerHTML = "<input type='text'  name='Root_Cause_Sub_Category[]'>";

            var cell4 = newRow.insertCell(3);
            cell4.innerHTML = "<input type='text'  name='Probability[]''>";

            var cell5 = newRow.insertCell(4);
            cell5.innerHTML = "<input type='text'  name='Remarks[]'>";

            var cell6 = newRow.insertCell(5);
            cell6.innerHTML = '<button type="text" class="removeRowBtn">Remove</button>';
            for (var i = 1; i < currentRowCount; i++) {
                var row = table.rows[i];
                row.cells[0].innerHTML = i;
            }
        }
    </script>
    <script>
        function addFishBone(top, bottom) {
            let mainBlock = document.querySelector('.fishbone-ishikawa-diagram');
            let topBlock = mainBlock.querySelector(top)
            let bottomBlock = mainBlock.querySelector(bottom)

            let topField = document.createElement('div')
            topField.className = 'grid-field fields top-field'

            let measurement = document.createElement('div')
            let measurementInput = document.createElement('input')
            measurementInput.setAttribute('type', 'text')
            measurementInput.setAttribute('name', 'measurement[]')
            measurement.append(measurementInput)
            topField.append(measurement)

            let materials = document.createElement('div')
            let materialsInput = document.createElement('input')
            materialsInput.setAttribute('type', 'text')
            materialsInput.setAttribute('name', 'materials[]')
            materials.append(materialsInput)
            topField.append(materials)

            let methods = document.createElement('div')
            let methodsInput = document.createElement('input')
            methodsInput.setAttribute('type', 'text')
            methodsInput.setAttribute('name', 'methods[]')
            methods.append(methodsInput)
            topField.append(methods)

            topBlock.prepend(topField)

            let bottomField = document.createElement('div')
            bottomField.className = 'grid-field fields bottom-field'

            let environment = document.createElement('div')
            let environmentInput = document.createElement('input')
            environmentInput.setAttribute('type', 'text')
            environmentInput.setAttribute('name', 'environment[]')
            environment.append(environmentInput)
            bottomField.append(environment)

            let manpower = document.createElement('div')
            let manpowerInput = document.createElement('input')
            manpowerInput.setAttribute('type', 'text')
            manpowerInput.setAttribute('name', 'manpower[]')
            manpower.append(manpowerInput)
            bottomField.append(manpower)

            let machine = document.createElement('div')
            let machineInput = document.createElement('input')
            machineInput.setAttribute('type', 'text')
            machineInput.setAttribute('name', 'machine[]')
            machine.append(machineInput)
            bottomField.append(machine)

            bottomBlock.append(bottomField)
        }

        function deleteFishBone(top, bottom) {
            let mainBlock = document.querySelector('.fishbone-ishikawa-diagram');
            let topBlock = mainBlock.querySelector(top)
            let bottomBlock = mainBlock.querySelector(bottom)
            if (topBlock.firstChild) {
                topBlock.removeChild(topBlock.firstChild);
            }
            if (bottomBlock.lastChild) {
                bottomBlock.removeChild(bottomBlock.lastChild);
            }
        }
    </script>

    <script>
        function addWhyField(con_class, name) {
            let mainBlock = document.querySelector('.why-why-chart')
            let container = mainBlock.querySelector(`.${con_class}`)
            let textarea = document.createElement('textarea')
            textarea.setAttribute('name', name);
            container.append(textarea)
        }
    </script>

    <script>
        function calculateInitialResult(selectElement) {
            let row = selectElement.closest('tr');
            let R = parseFloat(row.querySelector('.fieldR').value) || 0;
            let P = parseFloat(row.querySelector('.fieldP').value) || 0;
            let N = parseFloat(row.querySelector('.fieldN').value) || 0;
            let result = R * P * N;
            row.querySelector('.initial-rpn').value = result;
        }
    </script>

    <script>
        function calculateResidualResult(selectElement) {
            let row = selectElement.closest('tr');
            let R = parseFloat(row.querySelector('.residual-fieldR').value) || 0;
            let P = parseFloat(row.querySelector('.residual-fieldP').value) || 0;
            let N = parseFloat(row.querySelector('.residual-fieldN').value) || 0;
            let result = R * P * N;
            row.querySelector('.residual-rpn').value = result;
        }
    </script>
    <script>
        document.getElementById('initiator_group').addEventListener('change', function() {
            var selectedValue = this.value;
            document.getElementById('initiator_group_code').value = selectedValue;
        });

        function setCurrentDate(item) {
            if (item == 'yes') {
                $('#effect_check_date').val('{{ date('
                                d - M - Y ') }}');
            } else {
                $('#effect_check_date').val('');
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
        document.addEventListener('DOMContentLoaded', function() {
            const removeButtons = document.querySelectorAll('.remove-file');

            removeButtons.forEach(button => {
                button.addEventListener('click', function() {
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
            $('#rchars').text(textlen);
        });
    </script>

    <style>
        .initial-rpn,
        .residual-rpn {
            pointer-events: none;
            /* This makes the field uneditable */
            background-color: #f1f1f1;
            /* Optional: To give a disabled look */
        }
    </style>
@endsection
