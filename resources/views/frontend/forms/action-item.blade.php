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
        {{-- <div class="pr-id">
            New Child
        </div> --}}
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName($parent_division_id) }} / Action Item
        </div>
    </div>

    {{-- voice Command --}}

    {{-- <style>
        .mic-btn {
            background: none;
            border: none;
            outline: none;
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            box-shadow: none;
            color: black;
            display: none;
            /* Hide the button initially */
        }

        .relative-container textarea {
            width: 100%;
            padding-right: 40px;
        }

        .relative-container input:focus+.mic-btn {
            display: inline-block;
            /* Show the button when input is focused */
        }

        .mic-btn:focus,
        .mic-btn:hover,
        .mic-btn:active {
            box-shadow: none;
        }
    </style>

    <script>
        < link rel = "stylesheet"
        href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" >
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const recognition = new(window.SpeechRecognition || window.webkitSpeechRecognition)();
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

            document.addEventListener('click', function(event) {
                if (event.target.closest('.mic-btn')) {
                    const button = event.target.closest('.mic-btn');
                    const inputField = button.previousElementSibling;
                    if (inputField && inputField.classList.contains('mic-input')) {
                        startRecognition(inputField);
                    }
                }
            });

            document.querySelectorAll('.mic-input').forEach(input => {
                input.addEventListener('focus', function() {
                    const micBtn = this.nextElementSibling;
                    if (micBtn && micBtn.classList.contains('mic-btn')) {
                        micBtn.style.display = 'inline-block';
                    }
                });

                input.addEventListener('blur', function() {
                    const micBtn = this.nextElementSibling;
                    if (micBtn && micBtn.classList.contains('mic-btn')) {
                        setTimeout(() => {
                            micBtn.style.display = 'none';
                        }, 200); // Delay to prevent button from hiding immediately when clicked
                    }
                });
            });
        });
    </script> --}}


    @php
        $users = DB::table('users')->get();
    @endphp


    {{-- ! ========================================= --}}
    {{-- !               DATA FIELDS                 --}}
    {{-- ! ========================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Parent Information</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Post Completion</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Action Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Activity Log</button>
            </div>

            <form class="formSubmit" action="{{ route('actionItem.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div id="step-form">
                    @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                    @endif
                    <!-- Tab content -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                General Information
                            </div> <!-- RECORD NUMBER -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input disabled type="text" name="record_number"
                                            value="{{ Helpers::getDivisionName($parent_division_id) }}/AI/{{ date('Y') }}/{{ $record_number }}">
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Division Code</b></label>
                                        <input disabled type="text" name="division_id"
                                            value="{{ Helpers::getDivisionName($parent_division_id) }}">
                                        <input type="hidden" name="division_id" value="{{ $parent_division_id }}">
                                        {{-- <div class="static">QMS-North America</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    @if (!empty($cc->id))
                                        <input type="hidden" name="ccId" value="{{ $cc->id }}">
                                    @endif
                                    <div class="group-input">
                                        <label for="originator">Initiator</label>
                                        <input disabled type="text"
                                            value="{{ Helpers::getInitiatorName($parent_initiator_id) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Opened">Date of Initiation</label>
                                        {{-- <div class="static">{{ date('d-M-Y') }}</div> --}}
                                        <input disabled type="text"
                                            value="{{ Helpers::getdateFormat($parent_intiation_date) }}"
                                            name="intiation_date">
                                        <input type="hidden" value="{{ $parent_intiation_date }}" name="intiation_date">
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Due Date">Due Date</label>

                                        @if (!empty($cc->due_date))
                                        <div class="static">{{ $cc->due_date }}</div>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To <span class="text-danger"></span>
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
                                @php
                                    $initiationDate = date('Y-m-d');
                                    $dueDate = date('Y-m-d', strtotime($initiationDate . '+30 days'));
                                @endphp

                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Date Due</label>
                                        <div><small class="text-primary">Please mention expected date of completion</small>
                                        </div>
                                        <div class="calenderauditee">
                                            <div class="calenderauditee">
                                                <input type="text" name="due_date" id="due_date" readonly
                                                    placeholder="DD-MM-YYYY" />
                                                <input type="hidden" name="due_date_n"
                                                    min="{{ \Carbon\Carbon::now()->format('d-M-Y') }}" class="hide-input"
                                                    oninput="handleDateInput(this, 'due_date')" />
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

                                    // Formatting the date in "DD-MM-YYYY" format
                                    var dueDateFormatted = `${day}-${monthNames[monthIndex]}-${year}`;

                                    // Set the formatted due date value to the input field
                                    document.getElementById('due_date').value = dueDateFormatted;
                                </script>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining

                                        <div class="relative-container">
                                            <input class="mic-input" id="docname" type="text" name="short_description"
                                                maxlength="255" required>
                                            @component('frontend.forms.language-model')
                                            @endcomponent
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Related Records">Action Item Related Records</label>
                                        <select multiple id="Reference_Recores1" name="Reference_Recores1[]"
                                            placeholder="Select Reference Records">

                                            @foreach ($old_record as $new)
                                                <option
                                                    value="{{ Helpers::getDivisionName($new->division_id) . '/AI/' . date('Y') . '/' . Helpers::recordFormat($new->record) }}">
                                                    {{ Helpers::getDivisionName($new->division_id) . '/AI/' . date('Y') . '/' . Helpers::recordFormat($new->record) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="HOD Persons">HOD Person</label>
                                        <select name="hod_preson[]" placeholder="Select HOD Person" data-search="false"
                                            data-silent-initial-value-set="true" id="hod">
                                            <option value="">select</option>
                                            @foreach ($users as $value)
                                                <option value="{{ ' ' . $value->name }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Short Description"> Description<span
                                                class="text-danger"></span></label>
                                        <div class="relative-container">
                                            <textarea name="description" id="description" class="mic-input"></textarea>
                                            @component('frontend.forms.language-model')
                                            @endcomponent
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Responsible Department">Responsible Department</label>
                                        <select name="departments">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="Quality Assurance-CQA">Quality Assurance-CQA</option>
                                            <option value="Research and development">Research and development</option>
                                            <option value="Regulatory Science">Regulatory Science</option>
                                            <option value="Supply Chain Management">Supply Chain Management</option>
                                            <option value="Finance">Finance</option>
                                            <option value="QA-Digital">QA-Digital</option>
                                            <option value="Central Engineering">Central Engineering</option>
                                            <option value="Projects">Projects</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="QCAT">QCAT</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="GMP Pilot Plant">GMP Pilot Plant</option>
                                            <option value="Manufacturing Sciences and Technology">Manufacturing Sciences
                                                and Technology</option>
                                            <option value="Environment, Health and Safety">Environment, Health and Safety
                                            </option>
                                            <option value="Business Relationship Management">Business Relationship
                                                Management</option>
                                            <option value="National Regulatory Affairs">National Regulatory Affairs
                                            </option>
                                            <option value="HR">HR</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Program Management QA Analytical (Q13)">Program Management QA
                                                Analytical (Q13)</option>
                                            <option value="QA Analytical (Q8)">QA Analytical (Q8)</option>
                                            <option value="QA Packaging Development">QA Packaging Development</option>
                                            <option value="QA Engineering">QA Engineering</option>
                                            <option value="DS Quality Assurance">DS Quality Assurance</option>
                                            <option value="Quality Control (Q13)">Quality Control (Q13)</option>
                                            <option value="Quality Control (Q8)">Quality Control (Q8)</option>
                                            <option value="Quality Control (Q15)">Quality Control (Q15)</option>
                                            <option value="QC Microbiology (B1)">QC Microbiology (B1)</option>
                                            <option value="QC Microbiology (B2)">QC Microbiology (B2)</option>
                                            <option value="Production (B1)">Production (B1)</option>
                                            <option value="Production (B2)">Production (B2)</option>
                                            <option value="Production (Packing)">Production (Packing)</option>
                                            <option value="Production (Devices)">Production (Devices)</option>
                                            <option value="Production (DS)">Production (DS)</option>
                                            <option value="Engineering and Maintenance (B1)">Engineering and Maintenance
                                                (B1)</option>
                                            <option value="Engineering and Maintenance (B2)">Engineering and Maintenance
                                                (B2)</option>
                                            <option value="Engineering and Maintenance (W20)">Engineering and Maintenance
                                                (W20)</option>
                                            <option value="Device Technology Principle Management">Device Technology
                                                Principle Management</option>
                                            <option value="Production (82)">Production (82)</option>
                                            <option value="Production (Packing)">Production (Packing)</option>
                                            <option value="Production (Devices)">Production (Devices)</option>
                                            <option value="Production (DS)">Production (DS)</option>
                                            <option value="Engineering and Maintenance (B1)">Engineering and Maintenance
                                                (B1)</option>
                                            <option value="Engineering and Maintenance (B2)">Engineering and Maintenance
                                                (B2)</option>
                                            <option value="Engineering and Maintenance (W20)">Engineering and Maintenance
                                                (W20)</option>
                                            <option value="Device Technology Principle Management">Device Technology
                                                Principle Management</option>
                                            <option value="Warehouse(DP)">Warehouse(DP)</option>
                                            <option value="Drug safety">Drug safety</option>
                                            <option value="Others">Others</option>
                                            <option value="Visual Inspection">Visual Inspection</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="file_attach">File Attachments</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="file_attach"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="file_attach[]"
                                                    oninput="addMultipleFiles(this, 'file_attach')" multiple>
                                            </div>
                                        </div>
                                        {{-- <input type="file" name="file_attach[]" multiple> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton on-submit-disable-button">Save</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>

                            </div>
                        </div>
                    </div>

                    {{-- <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="Action Taken">RLS Record Number</label>
                                        <div class="static">Parent Record Number</div>
                                        <input disabled type="text"
                                            value="{{ Helpers::getDivisionName($parent_division_id) }}/{{ $parent_name }}/2023/{{ Helpers::recordFormat($parent_record) }}">
                                    </div>
                                </div>

                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">
                                            Exit </a> </button>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head col-12">Post Completion</div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="action_taken">Action Taken</label>
                                        <div class="relative-container">
                                            <textarea class="mic-input" name="action_taken"></textarea>
                                            @component('frontend.forms.language-model')
                                            @endcomponent
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="start_date">Actual Start Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="start_date" readonly placeholder="DD-MM-YYYY" />
                                            <input type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                id="start_date_checkdate" name="start_date" class="hide-input"
                                                oninput="handleDateInput(this, 'start_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6  new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="end_date">Actual End Date</lable>
                                            <div class="calenderauditee">
                                                <input type="text" id="end_date" placeholder="DD-MM-YYYY" />
                                                <input type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    id="end_date_checkdate" name="end_date" class="hide-input"
                                                    oninput="handleDateInput(this, 'end_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                            </div>


                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Comments">Comments</label>

                                        <div class="relative-container">
                                            <textarea class="mic-input" name="comments"></textarea>
                                            @component('frontend.forms.language-model')
                                            @endcomponent
                                        </div>

                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Support_doc">Supporting Documents</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Support_doc"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Support_doc[]"
                                                    oninput="addMultipleFiles(this, 'Support_doc')" multiple>
                                            </div>
                                        </div>

                                    </div>
                                </div> --}}
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton on-submit-disable-button">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">Action Approval</div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="qa_comments">QA Review Comments</label>
                                        <div class="relative-container">
                                            <textarea class="mic-input" name="qa_comments"></textarea>
                                            @component('frontend.forms.language-model')
                                            @endcomponent
                                        </div>

                                    </div>
                                </div>
                                {{--
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="file_attach">Final Attachments</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="final_attach"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="final_attach[]"
                                                    oninput="addMultipleFiles(this, 'final_attach')" multiple>
                                            </div>
                                        </div>

                                    </div>
                                </div> --}}
                                <div class="col-12 sub-head">
                                    Extension Justification
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="due-dateextension">Due Date Extension Justification</label>
                                        <div class="relative-container">
                                            <textarea class="mic-input" name="due_date_extension"></textarea>
                                            @component('frontend.forms.language-model')
                                            @endcomponent
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton on-submit-disable-button">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Electronic Signatures
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submitted by">Submitted By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submitted on">Submitted On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted Comment">Submitted Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="cancelled by">Cancelled By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="cancelled on">Cancelled On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="cancelled Comment">Cancelled Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="More information required By">More information required By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="More information required On">More information required On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="More information required Comment">More information required
                                            Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="completed by">Completed By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="completed on">Completed On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="completed Comment">Completed Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="button-block">
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                {{-- <button type="submit" class="saveButton">Save</button> --}}
                                <button type="button"> <a class="text-white"
                                        href="{{ url('rcms/qms-dashboard') }}">Exit
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
            ele: '#Reference_Recores1'
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
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>
    <script>
        $(document).ready(function() {

            $('.formSubmit').on('submit', function(e) {
                $('.on-submit-disable-button').prop('disabled', true);
            });
        })
    </script>
@endsection
