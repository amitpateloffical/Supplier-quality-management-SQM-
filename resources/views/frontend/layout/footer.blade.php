{{-- ======================================
            ADVANCED SEARCH MODAL
======================================= --}}
<div class="modal modal-lg fade" id="advanced-search">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Advanced Search</h4>
            </div>
            <form action="{{ url('advanceSearch') }}" method="get">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="advanced-table">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Operator</th>
                                    <th>Value</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="select-option" name="field[]">
                                            <option value="document_name">Document Name</option>
                                            <option value="short_description">Short Description</option>
                                            option value="short_description">Keywords</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="select-option" name="operator">
                                            <option value="contains">Contains</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="value[]" class="text-input">
                                    </td>
                                    <td>
                                        <button class="deleteBtn" onclick="deleteRow(this)">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" onclick="addRow()">Add Row</button>

                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit">Search</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>




{{-- ======================================
                SCRIPT TAGS
======================================= --}}
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/jquery-ui.min.js" integrity="sha512-MlEyuwT6VkRXExjj8CdBKNgd+e2H+aYZOCUaCrt9KRk6MlZDOs91V1yK22rwm8aCIsb5Ec1euL8f0g58RKT/Pg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('user/js/index.js') }}"></script>
<script src="{{ asset('user/js/validate.js') }}"></script>
<script src="{{ asset('user/js/countryState.js') }}"></script>
{{-- @toastr_js @toastr_render @jquery --}}
<script src="https://cdn.tiny.cloud/1/5vbh0y1nq5y6uokc071mjvy9n4fnss5ctasrjft7x7ajm9fl/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>
{{-- JQUERY DATEPICKER SCRIPT START --}}
<script>
    function initializeDatepicker()
    {
        $('.agenda-dates').datepicker({
            dateFormat: 'dd M yy',
        });
    }
    
    $(document).ready(function() {
        initializeDatepicker();
    });
</script>
{{-- JQUERY DATEPICKER SCRIPT END --}}

<script>
    $(document).ready(function() {

        const api_key = "{{ config('app.OPEN_AI_KEY') }}";

        const languages = [
            "Afrikaans", "Albanian", "Amharic", "Arabic", "Armenian", "Azerbaijani",
            "Basque", "Belarusian", "Bengali", "Bosnian", "Bulgarian",
            "Catalan", "Cebuano", "Chichewa", "Chinese (Simplified)", "Chinese (Traditional)",
            "Corsican", "Croatian", "Czech", "Danish", "Dutch", "English", "Esperanto", "Estonian",
            "Filipino", "Finnish", "French", "Frisian", "Galician", "Georgian", "German", "Greek",
            "Gujarati", "Haitian Creole", "Hausa", "Hawaiian", "Hebrew", "Hindi", "Hmong", "Hungarian",
            "Icelandic", "Igbo", "Indonesian", "Irish", "Italian", "Japanese", "Javanese", "Kannada",
            "Kazakh", "Khmer", "Kinyarwanda", "Korean", "Kurdish (Kurmanji)", "Kyrgyz",
            "Lao", "Latin", "Latvian", "Lithuanian", "Luxembourgish", "Macedonian", "Malagasy", "Malay",
            "Malayalam", "Maltese", "Maori", "Marathi", "Mongolian", "Myanmar (Burmese)", "Nepali",
            "Norwegian", "Odia (Oriya)", "Pashto", "Persian", "Polish", "Portuguese", "Punjabi", "Romanian",
            "Russian", "Samoan", "Scots Gaelic", "Serbian", "Sesotho", "Shona", "Sindhi", "Sinhala",
            "Slovak", "Slovenian", "Somali", "Spanish", "Sundanese", "Swahili", "Swedish",
            "Tajik", "Tamil", "Tatar", "Telugu", "Thai", "Turkish", "Turkmen", "Ukrainian", "Urdu",
            "Uyghur", "Uzbek", "Vietnamese", "Welsh", "Xhosa", "Yiddish", "Yoruba", "Zulu"
        ];

        const languageObjects = languages.map(language => ({
            title: language,
            prompt: `Translate this to ${language} language.`,
            selection: true
        }));

        // console.log(languageObjects);

        // $(document).ready(function(){
        //     var editor = new FroalaEditor('textarea.tiny', {
        //         key: "uXD2lC7C4B4D4D4J4B11dNSWXf1h1MDb1CF1PLPFf1C1EESFKVlA3C11A8D7D2B4B4G2D3J3==",
        //         imageUploadParam: 'image_param',
        //         imageUploadMethod: 'POST',
        //         imageMaxSize: 20 * 1024 * 1024,
        //         imageUploadURL: "https://s1.vidyagxp.com/api/upload-files",
        //         fileUploadParam: 'image_param',
        //         fileUploadURL: "https://s1.vidyagxp.com/api/upload-files",
        //         videoUploadParam: 'image_param',
        //         videoUploadURL: "https://s1.vidyagxp.com/api/upload-files",
        //         videoMaxSize: 500 * 1024 * 1024,
        //         toolbarButtons: {

        //             'moreText': {

        //                 'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting']

        //             },

        //             'moreParagraph': {

        //                 'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']

        //             },

        //             'moreRich': {

        //                 'buttons': ['insertLink', 'insertImage', 'insertVideo', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertFile', 'insertHR']

        //             },

        //             'moreMisc': {

        //                 'buttons': ['undo', 'redo', 'fullscreen', 'print', 'getPDF', 'spellChecker', 'selectAll', 'html', 'help'],

        //                 'align': 'right',

        //                 'buttonsVisible': 2

        //             }

        //         }

        //     });

        //     var disabledEditors = new FroalaEditor('textarea.tiny-disable', {
        //         key: "uXD2lC7C4B4D4D4J4B11dNSWXf1h1MDb1CF1PLPFf1C1EESFKVlA3C11A8D7D2B4B4G2D3J3==",
        //     }, function() {
        //         disabledEditors.edit.off();
        //     });

        // }) 
        // new FroalaEditor('.selector', {  toolbarButtons: {  'moreText': {    'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting']  },  'moreParagraph': {    'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']  },  'moreRich': {    'buttons': ['insertLink', 'insertImage', 'insertVideo', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertFile', 'insertHR']  },  'moreMisc': {    'buttons': ['undo', 'redo', 'fullscreen', 'print', 'getPDF', 'spellChecker', 'selectAll', 'html', 'help'],    'align': 'right',    'buttonsVisible': 2  }}});


        tinymce.init({
            selector: 'textarea.tiny', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'ai preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen link codesample table charmap pagebreak nonbreaking anchor tableofcontents insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker editimage help formatpainter permanentpen pageembed charmap mentions quickbars linkchecker emoticons advtable footnotes mergetags autocorrect typography advtemplate markdown',
            toolbar: 'undo redo | aidialog aishortcuts | charmap | blocks fontsizeinput | bold italic | align numlist bullist | link | table pageembed | lineheight  outdent indent | strikethrough forecolor backcolor formatpainter removeformat | emoticons checklist | code fullscreen preview | save print | pagebreak anchor codesample footnotes mergetags | addtemplate inserttemplate | addcomment showcomments | ltr rtl casechange | spellcheckdialog a11ycheck',
            ai_request: (request, respondWith) => {
                const openAiOptions = {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${api_key}`
                    },
                    body: JSON.stringify({
                        model: 'gpt-3.5-turbo',
                        temperature: 0.7,
                        max_tokens: 800,
                        messages: [{
                            role: 'user',
                            content: request.prompt
                        }],
                    })
                };
                respondWith.string((signal) => window.fetch(
                        'https://api.openai.com/v1/chat/completions', {
                            signal,
                            ...openAiOptions
                        })
                    .then(async (response) => {
                        if (response) {
                            const data = await response.json();
                            if (data.error) {
                                throw new Error(
                                    `${data.error.type}: ${data.error.message}`);
                            } else if (response.ok) {
                                // Extract the response content from the data returned by the API
                                return data?.choices[0]?.message?.content?.trim();
                            }
                        } else {
                            throw new Error('Failed to communicate with the AI');
                        }
                    })
                );
            },
            ai_shortcuts: [{
                    title: 'Translate',
                    subprompts: languageObjects
                },
                {
                    title: 'Summarize content',
                    prompt: 'Provide the key points and concepts in this content in a succinct summary.',
                    selection: true
                },
                {
                    title: 'Improve writing',
                    prompt: 'Rewrite this content with no spelling mistakes, proper grammar, and with more descriptive language, using best writing practices without losing the original meaning.',
                    selection: true
                },
                {
                    title: 'Simplify language',
                    prompt: 'Rewrite this content with simplified language and reduce the complexity of the writing, so that the content is easier to understand.',
                    selection: true
                },
                {
                    title: 'Expand upon',
                    prompt: 'Expand upon this content with descriptive language and more detailed explanations, to make the writing easier to understand and increase the length of the content.',
                    selection: true
                },
                {
                    title: 'Trim content',
                    prompt: 'Remove any repetitive, redundant, or non-essential writing in this content without changing the meaning or losing any key information.',
                    selection: true
                },
                {
                    title: 'Change tone',
                    subprompts: [{
                            title: 'Professional',
                            prompt: 'Rewrite this content using polished, formal, and respectful language to convey professional expertise and competence.',
                            selection: true
                        },
                        {
                            title: 'Casual',
                            prompt: 'Rewrite this content with casual, informal language to convey a casual conversation with a real person.',
                            selection: true
                        },
                        {
                            title: 'Direct',
                            prompt: 'Rewrite this content with direct language using only the essential information.',
                            selection: true
                        },
                        {
                            title: 'Confident',
                            prompt: 'Rewrite this content using compelling, optimistic language to convey confidence in the writing.',
                            selection: true
                        },
                        {
                            title: 'Friendly',
                            prompt: 'Rewrite this content using friendly, comforting language, to convey understanding and empathy.',
                            selection: true
                        },
                    ]
                },
                {
                    title: 'Change style',
                    subprompts: [{
                            title: 'Business',
                            prompt: 'Rewrite this content as a business professional with formal language.',
                            selection: true
                        },
                        {
                            title: 'Legal',
                            prompt: 'Rewrite this content as a legal professional using valid legal terminology.',
                            selection: true
                        },
                        {
                            title: 'Journalism',
                            prompt: 'Rewrite this content as a journalist using engaging language to convey the importance of the information.',
                            selection: true
                        },
                        {
                            title: 'Medical',
                            prompt: 'Rewrite this content as a medical professional using valid medical terminology.',
                            selection: true
                        },
                        {
                            title: 'Poetic',
                            prompt: 'Rewrite this content as a poem using poetic techniques without losing the original meaning.',
                            selection: true
                        },
                    ]
                }
            ],
            paste_data_images: true,
            images_upload_url: false,
            images_upload_handler: false,
            automatic_uploads: false

        });
    })
</script>
<script>
    $(document).on('click', '.removeRowBtn', function() {
        $(this).closest('tr').remove();
    })
</script>
<script>
    function addRow() {
        var table = document.getElementById("myTable");
        var row = table.insertRow(-1);

        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);

        var select1 = document.createElement("select");
        select1.className = "select-option";
        select1.name = "field";
        var option1 = document.createElement("option");
        option1.text = "Document Name";
        var option2 = document.createElement("option");
        option2.text = "Short Description";
        select1.appendChild(option1);
        select1.appendChild(option2);
        cell1.appendChild(select1);

        var select2 = document.createElement("select");
        select2.className = "select-option";
        select2.name = "operator";
        var optionA = document.createElement("option");
        optionA.text = "Contains";
        select2.appendChild(optionA);
        cell2.appendChild(select2);

        var input = document.createElement("input");
        input.type = "text";
        input.name = "value[]";
        input.className = "text-input";
        cell3.appendChild(input);

        var deleteBtn = document.createElement("button");
        deleteBtn.className = "deleteBtn";
        deleteBtn.innerHTML = "Delete";
        deleteBtn.onclick = function() {
            deleteRow(this);
        };
        cell4.appendChild(deleteBtn);
    }

    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }





    const commentSections = $('.comment');
    commentSections.each(function() {
        const inputField = $(this).find('.input-field');
        const timestamp = $(this).find('.timestamp');
        const button = $(this).find('.button');

        button.on('click', function() {
            timestamp.show();
            inputField.show();
            button.hide();
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.filter-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function(e) {
                const targetId = e.target.dataset.target;
                const targetElement = document.getElementById(targetId);

                if (e.target.checked) {
                    targetElement.style.display = 'block';
                } else {
                    targetElement.style.display = 'none';
                }
            });
        });
    });


    $(document).ready(function() {
        $('#tms-all-block').show();
        $('input[type=radio][name=dash-tabs]').change(function() {
            $('input[type=radio][name=dash-tabs]').change(function() {
                if (this.checked) {
                    var target = $(this).data('target');
                    $('.tms-block').hide();
                    $('#' + target).show();
                    $('.tab-btn').removeClass('active');
                    $(this).closest('.tab-btn').addClass('active');
                }
            });
        });
    });


    $(document).ready(function() {


        $('#responsibilitybtnadd').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="responsibility[]" class="myclassname"></div>';

            $('#responsibilitydiv').append(html);

        });



        $('#abbreviationbtnadd').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="abbreviation[]" class="myclassname"></div>';

            $('#abbreviationdiv').append(html);

        });

        $('#Definitionbtnadd').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="defination[]" class="myclassname"></div>';

            $('#definitiondiv').append(html);

        });

        $('#reportingbtadd').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="reporting[]" class="myclassname"></div>';

            $('#reportingdiv').append(html);

        });

        $('#referencesbtadd').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="references[]" class="myclassname"></div>';

            $('#referencesdiv').append(html);

        });
        $('#annbtadd').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="ann[]" class="myclassname"></div>';

            $('#anndiv').append(html);

        });

        $('#distributionbtnadd').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="distribution[]" class="myclassname"></div>';

            $('#distributiondiv').append(html);

        });

        $('#materialsbtadd').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="materials_and_equipments[]" class="myclassname"></div>';

            $('#materialsdiv').append(html);

        });

        $('#currentpracticeadd').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="currentpractice[]" class="myclassname"></div>';

            $('#currentpracticediv').append(html);

        });

        $('#proposedchangeadd').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="proposedchange[]" class="myclassname"></div>';

            $('#proposedchangediv').append(html);

        });

        $('#reasonchangeadd').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="reasonchange[]" class="myclassname"></div>';

            $('#reasonchangediv').append(html);

        });

        $('#super-com-add').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="super-com[]" class="myclassname"></div>';

            $('#super-com-div').append(html);

        });

        $('#optionsbtnadd').click(function(e) {

            var html =
                '<div class="option-group"><input type="text" name="options[]"><input type="radio" name="answer" value="0"></div>';

            $('#optionsdiv').append(html);

        });

        $('#multi_optionsbtnadd').click(function(e) {

            var html =
                '<div class="option-group"><input type="text" name="options[]"><input type="checkbox" name="answer" value="0"></div>';

            $('#multi_optionsdiv').append(html);

        });

        $('#answersbtnadd').click(function(e) {

            var html =
                '<input type="text" name="answers[]">';

            $('#answersdiv').append(html);

        });


        $('#othercomadd').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="othercom[]" class="myclassname"></div>';

            $('#othercomdiv').append(html);

        });

        $('#cancellation').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="cancellation[]" class="myclassname"></div>';

            $('#cancellation').append(html);

        });


        $('.deleterowres').click(function(e) {
            alert('hi');
        });


        $('#initiator-group').change(function() {
            var departmentCode = $(this).find(':selected').val();
            if (departmentCode !== undefined) {
                $('#initiator-code').text(departmentCode);
            }
        });

        $('.material-info').change(function() {

            var departmentCode = $(this).find(':selected').attr('data-id');
            var mat = $(this).find(':selected').val();
            var cus = $(this).find(':selected').attr('data-value');
            if (departmentCode !== undefined) {

                $('.material-name').text(departmentCode);
                $('.material-market').text(mat);
                $('.material-customer').text(cus);
            }
        });


        $('.product-info').change(function() {

            var departmentCode = $(this).find(':selected').attr('data-id');
            var mat = $(this).find(':selected').val();
            var cus = $(this).find(':selected').attr('data-value');
            var profor = $(this).find(':selected').attr('data-price');
            if (departmentCode !== undefined) {

                $('.product-name').text(departmentCode);
                $('.product-market').text(mat);
                $('.product-customer').text(cus);
                $('.product-for').text(profor);
            }
        });

        $('#depart-name').change(function() {
            var departmentCode = $(this).find(':selected').attr('data-id');
            if (departmentCode !== undefined) {
                $('#department-code').text(departmentCode);
            }
        });

        $('#doc-type').change(function() {
            var typeCode = $(this).find(':selected').attr('data-id');
            if (typeCode !== undefined) {
                $('#document_type_code').text(typeCode);
            }
        });

        $('#doc-subtype').change(function() {
            var typeCode = $(this).find(':selected').attr('data-id');
            if (typeCode !== undefined) {
                $('#document_subtype_code').text(typeCode);
            }
        });
        $('#doc-lang').change(function() {
            var docLang = $(this).find(':selected').attr('data-id');
            if (docLang !== undefined) {
                $('#document_language').text(docLang);
            }
        });

        $("#submit-division").click(function() {
            $("#division-modal").addClass("d-none");
        });
        $("#set-division").click(function() {
            $("#division-modal").removeClass("d-none");
        });
        // -------------by pankaj---------

        // -------------by pankaj---------


        $('#question-bank').change(function() {
            var departmentCode = $(this).find(':selected').attr('data-id');
            var myarr = departmentCode;
            var url = "{{ route('data', [':myarr']) }}";
            url = url.replace(':myarr', myarr);
            $('#question-list').empty();
            $.ajax({
                url: url,
                dataType: 'json',
                success: function(response) {

                    $('#question-list').append(response.htmls);

                }
            });
        });

        var selectQuestion = $('#selectQuestion').attr('data-id');
        var quesData = selectQuestion;
        var url = "{{ route('questiondata', [':quesData']) }}";
        url = url.replace(':quesData', quesData);
        $('#selected-list').empty();
        $.ajax({
            url: url,
            dataType: 'json',
            success: function(response) {

                $('#selected-list').append(response.htmls);

            }
        });

        var question = $('#data-question').attr('data-id');
        var question = question;
        var url = "{{ route('datag', [':question']) }}";
        url = url.replace(':question', question);
        $('#selected-question').empty();
        $.ajax({
            url: url,
            dataType: 'json',
            success: function(response) {

                $('#selected-question').append(response.htmls);

            }
        });



        $('#quize').change(function() {
            var effective = $(this).find(':selected').attr('data-id');
            if (effective !== undefined) {
                $('#effective').val(effective);
            }
        });

        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#searchTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });


        $("#query").on("change", function() {

            var value = $(this).val().toLowerCase();
            if (value !== '') {
                $("#searchTable tr").filter(function() {
                    $(this).toggle(true)
                    var selectedText = $("#scope option:selected").val();
                    // alert(selectedText);
                    if (selectedText !== '') {
                        $(this).toggle(($(this).text().toLowerCase().indexOf(selectedText) && $(
                            this).text().toLowerCase().indexOf(value)) > -1)
                    } else {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    }
                });

            } else {
                var selectedText = $("#scope option:selected").val();

                if (selectedText !== '') {
                    $("#searchTable tr").filter(function() {
                        $(this).toggle(true)
                        $(this).toggle($(this).text().toLowerCase().indexOf(selectedText) > -1)
                    });
                } else {
                    $("#searchTable tr").filter(function() {
                        $(this).toggle(true)
                    });
                }

            }
        });

        $("#scope").on("change", function() {

            var value = $(this).val().toLowerCase();
            if (value !== '') {

                $("#searchTable tr").filter(function() {
                    $(this).toggle(true)
                    var selectedText = $("#query option:selected").val();
                    if (selectedText !== '') {
                        $(this).toggle(($(this).text().toLowerCase().indexOf(selectedText) && $(
                            this).text().toLowerCase().indexOf(value)) > -1)
                    } else {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    }
                });


            } else {

                $("#searchTable tr").filter(function() {
                    $(this).toggle(true)
                });
                var selectedText = $("#query option:selected").val();

                if (selectedText !== '') {
                    $("#searchTable tr").filter(function() {
                        $(this).toggle(true)
                        $(this).toggle($(this).text().toLowerCase().indexOf(selectedText) > -1)
                    });
                }


            }
        });

        $('#annexurebtnadd').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="annexure_number[]"></td>' +
                    '<td><input type="text" name="annexure_data[]"></td>' +
                    '</tr>';

                return html;
            }
            var tableBody = $('#annexure tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });

        $('#DocDetailbtn').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input disabled  type="text" name="serial_number[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="current_doc_number[]"></td>' +
                    '<td><input type="text" name="current_version[]"></td>' +
                    '<td><input type="text" name="new_doc_number[]"></td>' +
                    '<td><input type="text" name="new_version[]"></td>' +
                    '<td><button type="text" class="removeBtnDD">Remove</button></td>' +
                    '</tr>';

                return html;
            }
            var tableBody = $('#doc-detail tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        $(document).on('click', '.removeBtnDD', function() {
            $(this).closest('tr').remove();
        })

        $('#addAffectedDocumentsbtn').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="affected_documents[]"></td>' +
                    '<td><input type="text" name="document_name[]"></td>' +
                    '<td><input type="number" name="document_no[]"></td>' +
                    '<td><input type="text" name="version_no[]"></td>' +
                    // '<td><input type="date" name="implementation_date[]"></td>' 
                    // '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="implementation_date' +
                    // serialNumber +
                    // '" readonly placeholder="DD-MM-YYYY" /><input type="date" name="implementation_date[]" class="hide-input" oninput="handleDateInput(this, `implementation_date' +
                    // serialNumber + '`)" /></div></div></div></td>' +

                    '<td><input type="text" name="implementation_date[]" class="agenda-dates" placeholder="DD-MM-YYYY"></td>'+

                    '<td><input type="text" name="new_document_no[]"></td>' +
                    '<td><input type="text" name="new_version_no[]"></td>' +
                    '<td><button type="text" class="removeaddAffectedDocumentsbtn">Remove</button></td>' +
                    '</tr>';

                return html;
            }
            var tableBody = $('#affected-documents tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);

            initializeDatepicker();

        });
        $(document).on('click', '.removeaddAffectedDocumentsbtn', function() {
            $(this).closest('tr').remove();
        })
       
               
                
                
        $('#addProductDetail').click(function(e) {
            @php
                $product = DB::table('products')->get();
                $material = DB::table('materials')->get();
            @endphp

            function generateTableRow(serialNumber) {

                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="plant"></td>' +
                    '<td><input type="text" name="product_code"></td>' +
                    '<td><input type="text" name="product_name"></td>' +
                    '<td><input type="text" name="market"></td>' +
                    '<td><input type="text" name="customer"></td>' +
                    '<td><input type="text" name="product_for"></td>' +
                    '</tr>';

                return html;
            }
            var tableBody = $('#product-detail tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });

        $('#addMaterialDetail').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="plant"></td>' +
                    '<td><input type="text" name="material_code"></td>' +
                    '<td><input type="text" name="material_name"></td>' +
                    '<td><input type="text" name="market"></td>' +
                    '<td><input type="text" name="customer"></td>' +
                    '</tr>';

                return html;
            }
            var tableBody = $('#material-detail tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        // -----------------------------------------root cuase analysis  table------------------------

        //--------------------------Root CAuse Analysis-----------------------

        $('#Chemical-Analysis1').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="questions[]"></td>' +
                    '<td><input type="text" name="response[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 2-----------------------

        $('#Chemical-Analysis2').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number2[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions2[]"></td>' +
                    '<td><input type="text" name="response2[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge2 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 3-----------------------

        $('#Chemical-Analysis3').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number3[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions3[]"></td>' +
                    '<td><input type="text" name="response3[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge3 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 4-----------------------

        $('#Chemical-Analysis4').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number4[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions4[]"></td>' +
                    '<td><input type="text" name="response4[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge4 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 5-----------------------

        $('#Chemical-Analysis5').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number5[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions5[]"></td>' +
                    '<td><input type="text" name="response5[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge5 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 6-----------------------

        $('#Chemical-Analysis6').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number6[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions6[]"></td>' +
                    '<td><input type="text" name="response6[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge6 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 7-----------------------

        $('#Chemical-Analysis7').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number7[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions7[]"></td>' +
                    '<td><input type="text" name="response7[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge7 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 8-----------------------

        $('#Chemical-Analysis8').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number8[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions8[]"></td>' +
                    '<td><input type="text" name="response8[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge8 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 9-----------------------

        $('#Chemical-Analysis9').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number9[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions9[]"></td>' +
                    '<td><input type="text" name="response9[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge9 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 10-----------------------

        $('#Chemical-Analysis10').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number10[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions10[]"></td>' +
                    '<td><input type="text" name="response10[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge10 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 11-----------------------

        $('#Chemical-Analysis11').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number11[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions11[]"></td>' +
                    '<td><input type="text" name="response11[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge11 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 12-----------------------

        $('#Chemical-Analysis12').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number12[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions12[]"></td>' +
                    '<td><input type="text" name="response12[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge12 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 13-----------------------

        $('#Chemical-Analysis13').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number13[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions13[]"></td>' +
                    '<td><input type="text" name="response13[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge13 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 14-----------------------

        $('#Chemical-Analysis14').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number14[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions14[]"></td>' +
                    '<td><input type="text" name="response14[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge14 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        // ------------------------------Observation--------------------------
        $('#observation-table').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="action[]"></td>' +
                    '<td><input type="text" name="responsible[]"></td>' +
                    // '<td><input type="text" name="deadline[]"></td>' +
                    '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="deadline' +
                    serialNumber +
                    '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="deadline[]" class="hide-input" oninput="handleDateInput(this, `deadline' +
                    serialNumber + '`)" /></div></div></div></td>' +

                    '<td><input type="text" name="item_status[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#observation tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });

        // -------------------------agenda--------------------
        $('#agenda').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    // '<td><input type="date" name="date[]"></td>' +
                    '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="deadline' +
                    serialNumber +
                    '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="deadline[]" class="hide-input" oninput="handleDateInput(this, `deadline' +
                    serialNumber + '`)" /></div></div></div></td>' +
                    '<td><input type="text" name="topic[]"></td>' +
                    '<td><input type="text" name="responsible[]"></td>' +
                    '<td><input type="time" name="start_time[]"></td>' +
                    '<td><input type="time" name="end_time[]"></td>' +
                    '<td><input type="text" name="comment[]"></td>' +
                    '</tr>';
                return html;
            }
            var tableBody = $('#agenda_body tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });

        // --------------------------------Capa Grids--------------------
        $('#product').click(function(e) {

            function generateTableRow(serialNumber) {
                var html = '<tr>' +
                    '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><select name="product_name[]" id="product_name">' +
                    '<option value="">-- Select value --</option>' +
                    '<option value="PLACE BEFORE BIMATOPROST OPH.SOLO.01%W/">PLACE BEFORE BIMATOPROST OPH.SOLO.01%W/</option>' +
                    '<option value="BIMATOPROST AND TIMOLOL MALEATEED SOLUTION">BIMATOPROST AND TIMOLOL MALEATEED SOLUTION</option>' +
                    '<option value="CAFFEINE CITRATE ORAL SOLUTION USP 60MG/3ML">CAFFEINE CITRATE ORAL SOLUTION USP 60MG/3ML</option>' +
                    '<option value="BRIMONIDINE TART. OPH SOL 0.1%W/V (CB)">BRIMONIDINE TART. OPH SOL 0.1%W/V (CB)</option>' +
                    '<option value="DORZOLAMIDE PFREE 20MG/ML EDSOLSINGLEDOSECO">DORZOLAMIDE PFREE 20MG/ML EDSOLSINGLEDOSECO</option>' +
                    '</select></td>' +
                    '<td><select name="batch_no[]" id="batch_no">' +
                    '<option value="">select value</option>' +
                    '<option value="DCAU0030">DCAU0030</option>' +
                    '<option value="BDZH0007">BDZH0007</option>' +
                    '<option value="BDZH0006">BDZH0006</option>' +
                    '<option value="BJJH0004A">BJJH0004A</option>' +
                    '<option value="DCAU0036">DCAU0036</option>' +
                    '</select></td>' +
                    '<td> <div class="group-input new-date-data-field mb-0"><div class="input-date"><div class="calenderauditee"><input type="text" id="mfg_date' + serialNumber + '" readonly placeholder="DD-MM-YYYY" /><input type="date" name="mfg_date[]" id="mfg_date' + serialNumber + '_checkdate" class="hide-input" max="' + new Date().toISOString().split('T')[0] + '" oninput="handleDateInput(this, `mfg_date' + serialNumber + '`);checkDate(`mfg_date' + serialNumber + '_checkdate`,`expiry_date' + serialNumber + '_checkdate`)" /></div></div></div></td>' +
                    '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="expiry_date' +
                    serialNumber +
                    '" readonly placeholder="DD-MM-YYYY" /><input type="date" name="expiry_date[]" id="expiry_date' +
                    serialNumber +
                    '_checkdate" class="hide-input" oninput="handleDateInput(this, `expiry_date' +
                    serialNumber + '`);checkDate(`mfg_date' + serialNumber +
                    '_checkdate`,`expiry_date' + serialNumber +
                    '_checkdate`)" /></div></div></div></td>' +
                    '<td><input type="text" name="batch_desposition[]"></td>' +
                    '<td><input type="text" name="remark[]"></td>' +
                    '<td><select name="batch_status[]" id="batch_status">' +
                    '<option value="">-- Select value --</option>' +
                    '<option value="Hold">Hold</option>' +
                    '<option value="Release">Release</option>' +
                    '<option value="quarantine">Quarantine</option>' +
                    '</select></td>' +
                    '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                    '</tr>';

                return html;
            }
            var tableBody = $('#product_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        $('#material ').click(function(e) {
            function generateTableRow(serialNumber) {
                var html = '<tr>' +
                    '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                    '"></td>' +
                    // '<td><select name="material_name[]" id="material_name">' +
                    // '<option value="">-- Select value --</option>' +
                    // '<option value="PLACEBEFOREBIMATOPROSTOPH.SOLO.01%W/">PLACEBEFOREBIMATOPROSTOPH.SOLO.01%W/</option>' +
                    // '<option value="BIMATOPROSTANDTIMOLOLMALEATEEDSOLUTION">BIMATOPROSTANDTIMOLOLMALEATEEDSOLUTION</option>' +
                    // '<option value="CAFFEINECITRATEORALSOLUTION USP 60MG/3ML">CAFFEINECITRATEORALSOLUTION USP 60MG/3ML</option>' +
                    // '<option value="BRIMONIDINE TART. OPH SOL 0.1%W/V (CB)">BRIMONIDINE TART. OPH SOL 0.1%W/V (CB)</option>' +
                    // '<option value="DORZOLAMIDEPFREE20MG/MLEDSOLSINGLEDOSECO">DORZOLAMIDEPFREE20MG/MLEDSOLSINGLEDOSECO</option>' +
                    // '</select></td>' +
                    '<td><input type="text" name="material_name[]"></td>' +
                    // '<td><select name="material_batch_no[]" id="batch_no">' +
                    // '<option value="">select value</option>' +
                    // '<option value="DCAU0030">DCAU0030</option>' +
                    // '<option value="BDZH0007">BDZH0007</option>' +
                    // '<option value="BDZH0006">BDZH0006</option>' +
                    // '<option value="BJJH0004A">BJJH0004A</option>' +
                    // '<option value="DCAU0036">DCAU0036</option>' +
                    // '</select></td>' +
                    '<td><input type="text" name="material_batch_no[]"></td>' +
                    // '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="material_mfg_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="material_mfg_date[]" class="hide-input" oninput="handleDateInput(this, `material_mfg_date' + serialNumber +'`)" /></div></div></div></td>' +
                    // '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="material_expiry_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="material_expiry_date[]" class="hide-input" oninput="handleDateInput(this, `material_expiry_date' + serialNumber +'`)" /></div></div></div></td>' +
                    '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="material_mfg_date' +
                    serialNumber +
                    '" readonly placeholder="DD-MM-YYYY" /><input type="date" name="material_mfg_date[]" id="material_mfg_date' +
                    serialNumber +
                    '_checkdate"  class="hide-input" max="' + new Date().toISOString().split('T')[0] + '" oninput="handleDateInput(this, `material_mfg_date' +
                    serialNumber + '`);checkDate(`material_mfg_date' + serialNumber +
                    '_checkdate`,`material_expiry_date' + serialNumber +
                    '_checkdate`)" /></div></div></div></td>' +
                    '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="material_expiry_date' +
                    serialNumber +
                    '" readonly placeholder="DD-MM-YYYY" /><input type="date" name="material_expiry_date[]" id="material_expiry_date' +
                    serialNumber +
                    '_checkdate" class="hide-input" oninput="handleDateInput(this, `material_expiry_date' +
                    serialNumber + '`);checkDate(`material_mfg_date' + serialNumber +
                    '_checkdate`,`material_expiry_date' + serialNumber +
                    '_checkdate`)" /></div></div></div></td>' +

                    '<td><input type="text" name="material_batch_desposition[]"></td>' +
                    '<td><input type="text" name="material_remark[]"></td>' +
                    '<td><select name="material_batch_status[]" id="batch_status">' +
                    '<option value="">-- Select value --</option>' +
                    '<option value="Hold">Hold</option>' +
                    '<option value="Release">Release</option>' +
                    '<option value="quarantine">Quarantine</option>' +
                    '</select></td>' +
                    '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                    '</tr>';

                return html;
            }
            var tableBody = $('#material_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        $('#equipment ').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +'"></td>' +
                    '<td><input type="text" name="equipment[]"></td>' +
                    '<td><input type="text" name="equipment_instruments[]"></td>' +
                    '<td><input type="text" name="equipment_comments[]"></td>' +
                    '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                    '</tr>';
                return html;
            }
            var tableBody = $('#equipment_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });

        // $('#action_plan').click(function(e) {
        //     function generateTableRow(serialNumber) {
        //         var html =
        //             '<tr>' +
        //             '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
        //             '<td><input type="text" name="action[]"></td>' +
        //             '<td><select name="responsible[]">' +
        //                 '<option value="">Select a value</option>';

        //             for (var i = 0; i < users.length; i++) {
        //                 html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
        //             }

        //             html += '</select></td>' +
        //             '<td><input type="text" name="deadline[]"></td>' +
        //             '<td><input type="text" name="item_static[]"></td>' +
        //             '</tr>';
        //         return html;
        //     }
        //     var tableBody = $('#action_plan_details tbody');
        //     var rowCount = tableBody.children('tr').length;
        //     var newRow = generateTableRow(rowCount + 1);
        //     tableBody.append(newRow);
        // });

        $('#action_plan2').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="mitigation_steps[]"></td>' +
                    '<td><input type="text" name="deadline2[]"></td>' +
                    '<td><select name="responsible_person[]">' +
                    '<option value="">Select a value</option>';

                for (var i = 0; i < users.length; i++) {
                    html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                }

                html += '</select></td>' +
                    '<td><input type="text" name="status[]"></td>' +
                    '<td><input type="text" name="remark[]"></td>' +
                    '</tr>';
                return html;
            }
            var tableBody = $('#action_plan_details2 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        // ---------------------------------------------------
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
    integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

<script>
    document.querySelector("#next_review_date").addEventListener("click", function() {
        var effectveDate = document.querySelector("#effectve_date").value;
        var years = Number(document.querySelector("#review_period").value);
        var dueDateElement = document.querySelector("#next_review_date");

        if (!isNaN(years) && effectveDate.length) {
            effectveDate = effectveDate.split("-");
            effectveDate = new Date(effectveDate[0], effectveDate[1] - 1, effectveDate[2]);
            effectveDate.setFullYear(effectveDate.getFullYear() + years);
            dueDateElement.valueAsDate = null;
            dueDateElement.valueAsDate = effectveDate;
        }
    });
</script>

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

<script>
    // Get the textarea element
    var textArea = document.getElementById('textArea');
    // Get the paragraph element to display character count
    var charCountDisplay = document.getElementById('charCount');

    // Function to count characters in the textarea
    function countCharacters() {
        var text = textArea.value;
        // Display the character count
        charCountDisplay.textContent = 'Character count: ' + text.length;
    }

    // Add an event listener to the textarea to trigger character count on input
    textArea.addEventListener('input', function() {
        countCharacters();
        // Limit the text to 2500 characters
        if (textArea.value.length > 2500) {
            textArea.value = textArea.value.slice(0, 2500);
            countCharacters(); // Update character count after truncation
        }
    });

    // Call the countCharacters function initially to display character count for any existing text
    countCharacters();
</script>



</body>

</html>
