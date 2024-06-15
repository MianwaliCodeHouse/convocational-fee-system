<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- custom CSS File LinK -->
    <link rel="stylesheet" href="{{ url('') }}/public/assets/css/style.css">
    <link rel="stylesheet" href="{{ url('') }}/public/assets/css/slip.css">
</head>

<body>

    <main id="main">
        <header class="header">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h_heading">
                        Convocation 2024 UMW
                    </h1>
                    <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
                </div>
            </div>

        </header>
        <!-- Section -->
        <section class="section deshboard_section">
            @if ($errors->any())
                <div class="error text-center text-white fw-bold mb-4 bg-danger p-3 rounded">
                    <ul>


                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if ($std->status == 0)
                <div id="step1" class="form-step active">
                    <h2 class="step_form_heading">Invite Guest?</h2>
                    <div class="form-group">
                        <label for="invite" class="text">Do you want to invite a guest?</label><br>
                        <input type="radio" id="invite-yes" name="invite" value="yes" checked>
                        <label for="invite-yes">Yes</label>
                        <input type="radio" id="invite-no" name="invite" value="no">
                        <label for="invite-no">No</label>
                    </div>
                    <button class="generate-button next_button" onclick="nextStep('next')">Next</button>
                </div>
                <div id="step2" class="form-step">
                    <h2 class="step_form_heading">Enter Guest Information</h2>
                    <form action="{{ route('submitGuest') }}" method="post" class="guest_form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="input_container">
                            <div class="input_box margin">
                                <label for="guest_name">Guest Name <span>*</span></label>
                                <input type="text" name="guest_name" placeholder="Enter guest name" id="guest_name"
                                    class="input" autocomplete="off" value="{{ old('guest_name') }}">
                            </div>
                            <div class="input_box">
                                <label for="guest_f_name">Father Name <span>*</span></label>
                                <input type="text" name="guest_f_name" placeholder="Enter guest Father name"
                                    id="guest_f_name" class="input" autocomplete="off"
                                    value="{{ old('guest_f_name') }}">
                            </div>
                        </div>
                        <div class="input_container">
                            <div class="input_box margin">
                                <label for="guest_cnic">Guest CNIC <span>*</span></label>
                                <input type="number" name="guest_cnic" placeholder="enter guest CNIC" id="guest_cnic"
                                    class="input" autocomplete="off" value="{{ old('guest_cnic') }}">
                            </div>
                            <div class="input_box">
                                <label for="guest_image">Guest Picture<span>*</span> (size 25KB)</label>
                                <input type="file" name="guest_image" id="guest_image" class="input">
                            </div>
                        </div>
                        <button type="button" class="generate-button next_button" id="submit_button"
                            onclick="nextStep('back')">Back</button>
                        <button class="generate-button next_button">Submit</button>
                    </form>

                </div>
                <div id="step3" class="form-step">
                    <h2 class="step_form_heading">Generate Slip</h2>
                    <button class="generate-button next_button" id="submit_button"
                        onclick="nextStep('back')">Back</button>
                    <button type="button" class="generate-button next_button" onclick="nextStep('generate')">Generate
                        Slip</button>
                </div>
                <!-- SLip Container -->
                <div class="slip_div" id="slip_container">
                    <button class="download" id="download_button">Download</button>
                    <div class="fee_container" id="fee_slip_download">
                        <div class="fullpage">
                            <div class="slip_section">
                                <div class="head_section">
                                    <div class="logo_sect">
                                        <img class="umwlogo"
                                            src="{{ url('') }}/public/assets/images/logoumw.jpg" />
                                        <img class="boplogo"
                                            src="{{ url('') }}/public/assets/images/BOP!.png" />
                                    </div>
                                    <div class="account_sect">
                                        <h2>University 0f Mianwali</h2>
                                        <span>The Bank of Punjab</span>
                                        <span>A/C.NO 6510204384600096</span>
                                        <span>Copy of Bank</span>
                                        <span>Slip.ID {{ $slip->slipId }}</span>
                                    </div>
                                </div>
                                <div class="stud_info_sect">
                                    <form action="" class="form_info">
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Due Date:</label>
                                            <input type="text" id="due_date" class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Name:</label>
                                            <input type="text" value="{{ $std->name }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Father Name:</label>
                                            <input type="text" value="{{ $std->fatherName }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">CNIC No:</label>
                                            <input type="text" value="{{ $std->cnic }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Subject:</label>
                                            <input type="text" value="{{ $std->department }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                    </form>
                                    <hr />
                                </div>
                                <div class="fees_sect">
                                    <div class="fees_type_sect">
                                        <span>Convocational Fees</span>
                                        @if ($guestNo > 0)
                                            <span>Guest Fees</span>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="fees_amount">
                                        <span>10000</span>
                                        @if ($guestNo > 0)
                                            <span>10000</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="total">
                                    <span>Total</span>
                                    @if ($guestNo > 0)
                                        <span>150000</span>
                                    @else
                                        <span>100000</span>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="slip_section">
                                <div class="head_section">
                                    <div class="logo_sect">
                                        <img class="umwlogo"
                                            src="{{ url('') }}/public/assets/images/logoumw.jpg" />
                                        <img class="boplogo"
                                            src="{{ url('') }}/public/assets/images/BOP!.png" />
                                    </div>
                                    <div class="account_sect">
                                        <h2>University 0f Mianwali</h2>
                                        <span>The Bank of Punjab</span>
                                        <span>A/C.NO 6510204384600096</span>
                                        <span>Copy of University</span>
                                        <span>Slip.ID {{ $slip->slipId }}</span>

                                    </div>
                                </div>
                                <div class="stud_info_sect">
                                    <form action="" class="form_info">
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Due Date:</label>
                                            <input type="text" id="due_date" class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Name:</label>
                                            <input type="text" value="{{ $std->name }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Father Name:</label>
                                            <input type="text" value="{{ $std->fatherName }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">CNIC No:</label>
                                            <input type="text" value="{{ $std->cnic }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Subject:</label>
                                            <input type="text" value="{{ $std->department }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                    </form>
                                    <hr />
                                </div>
                                <div class="fees_sect">
                                    <div class="fees_type_sect">
                                        <span>Convocational Fees</span>
                                        @if ($guestNo > 0)
                                            <span>Guest Fees</span>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="fees_amount">
                                        <span>10000</span>
                                        @if ($guestNo > 0)
                                            <span>10000</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="total">
                                    <span>Total</span>
                                    @if ($guestNo > 0)
                                        <span>150000</span>
                                    @else
                                        <span>100000</span>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="slip_section">
                                <div class="head_section">
                                    <div class="logo_sect">
                                        <img class="umwlogo"
                                            src="{{ url('') }}/public/assets/images/logoumw.jpg" />
                                        <img class="boplogo"
                                            src="{{ url('') }}/public/assets/images/BOP!.png" />
                                    </div>
                                    <div class="account_sect">
                                        <h2>University 0f Mianwali</h2>
                                        <span>The Bank of Punjab</span>
                                        <span>A/C.NO 6510204384600096</span>
                                        <span>Copy of Depositor</span>
                                        <span>Slip.ID {{ $slip->slipId }}</span>
                                    </div>
                                </div>
                                <div class="stud_info_sect">
                                    <form action="" class="form_info">
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Due Date:</label>
                                            <input type="text" id="due_date" class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Name:</label>
                                            <input type="text" value="{{ $std->name }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Father Name:</label>
                                            <input type="text" value="{{ $std->fatherName }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">CNIC No:</label>
                                            <input type="text" value="{{ $std->cnic }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Subject:</label>
                                            <input type="text" value="{{ $std->department }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                    </form>
                                    <hr />
                                </div>
                                <div class="fees_sect">
                                    <div class="fees_type_sect">
                                        <span>Convocational Fees</span>
                                        @if ($guestNo > 0)
                                            <span>Guest Fees</span>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="fees_amount">
                                        <span>10000</span>
                                        @if ($guestNo > 0)
                                            <span>10000</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="total">
                                    <span>Total</span>
                                    @if ($guestNo > 0)
                                        <span>150000</span>
                                    @else
                                        <span>100000</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($std->status == 1)
                <div id="step3" class="form-step active">
                    <h2 class="step_form_heading">Generate Slip</h2>

                    <button type="button" class="generate-button next_button"
                        onclick="nextStep2('generate')">Generate
                        Slip</button>
                </div>
                <!-- SLip Container -->
                <div class="slip_div" id="slip_container">
                    <button class="download" id="download_button">Download</button>
                    <div class="fee_container" id="fee_slip_download">
                        <div class="fullpage">
                            <div class="slip_section">
                                <div class="head_section">
                                    <div class="logo_sect">
                                        <img class="umwlogo"
                                            src="{{ url('') }}/public/assets/images/logoumw.jpg" />
                                        <img class="boplogo"
                                            src="{{ url('') }}/public/assets/images/BOP!.png" />
                                    </div>
                                    <div class="account_sect">
                                        <h2>University 0f Mianwali</h2>
                                        <span>The Bank of Punjab</span>
                                        <span>A/C.NO 6510204384600096</span>
                                        <span>Copy of Bank</span>
                                        <span>Slip.ID {{ $slip->slipId }}</span>
                                    </div>
                                </div>
                                <div class="stud_info_sect">
                                    <form action="" class="form_info">
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Due Date:</label>
                                            <input type="text" id="due_date" class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Name:</label>
                                            <input type="text" value="{{ $std->name }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Father Name:</label>
                                            <input type="text" value="{{ $std->fatherName }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">CNIC No:</label>
                                            <input type="text" value="{{ $std->cnic }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Subject:</label>
                                            <input type="text" value="{{ $std->department }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                    </form>
                                    <hr />
                                </div>
                                <div class="fees_sect">
                                    <div class="fees_type_sect">
                                        <span>Convocational Fees</span>
                                        @if ($guestNo > 0)
                                            <span>Guest Fees</span>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="fees_amount">
                                        <span>10000</span>
                                        @if ($guestNo > 0)
                                            <span>10000</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="total">
                                    <span>Total</span>
                                    @if ($guestNo > 0)
                                        <span>150000</span>
                                    @else
                                        <span>100000</span>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="slip_section">
                                <div class="head_section">
                                    <div class="logo_sect">
                                        <img class="umwlogo"
                                            src="{{ url('') }}/public/assets/images/logoumw.jpg" />
                                        <img class="boplogo"
                                            src="{{ url('') }}/public/assets/images/BOP!.png" />
                                    </div>
                                    <div class="account_sect">
                                        <h2>University 0f Mianwali</h2>
                                        <span>The Bank of Punjab</span>
                                        <span>A/C.NO 6510204384600096</span>
                                        <span>Copy of University</span>
                                        <span>Slip.ID {{ $slip->slipId }}</span>

                                    </div>
                                </div>
                                <div class="stud_info_sect">
                                    <form action="" class="form_info">
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Due Date:</label>
                                            <input type="text" id="due_date" class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Name:</label>
                                            <input type="text" value="{{ $std->name }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Father Name:</label>
                                            <input type="text" value="{{ $std->fatherName }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">CNIC No:</label>
                                            <input type="text" value="{{ $std->cnic }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Subject:</label>
                                            <input type="text" value="{{ $std->department }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                    </form>
                                    <hr />
                                </div>
                                <div class="fees_sect">
                                    <div class="fees_type_sect">
                                        <span>Convocational Fees</span>
                                        @if ($guestNo > 0)
                                            <span>Guest Fees</span>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="fees_amount">
                                        <span>10000</span>
                                        @if ($guestNo > 0)
                                            <span>10000</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="total">
                                    <span>Total</span>
                                    @if ($guestNo > 0)
                                        <span>150000</span>
                                    @else
                                        <span>100000</span>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="slip_section">
                                <div class="head_section">
                                    <div class="logo_sect">
                                        <img class="umwlogo"
                                            src="{{ url('') }}/public/assets/images/logoumw.jpg" />
                                        <img class="boplogo"
                                            src="{{ url('') }}/public/assets/images/BOP!.png" />
                                    </div>
                                    <div class="account_sect">
                                        <h2>University 0f Mianwali</h2>
                                        <span>The Bank of Punjab</span>
                                        <span>A/C.NO 6510204384600096</span>
                                        <span>Copy of Depositor</span>
                                        <span>Slip.ID {{ $slip->slipId }}</span>
                                    </div>
                                </div>
                                <div class="stud_info_sect">
                                    <form action="" class="form_info">
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Due Date:</label>
                                            <input type="text" id="due_date" class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Name:</label>
                                            <input type="text" value="{{ $std->name }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Father Name:</label>
                                            <input type="text" value="{{ $std->fatherName }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">CNIC No:</label>
                                            <input type="text" value="{{ $std->cnic }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                        <div class="input_sect">
                                            <label class="labels" for="due_date">Subject:</label>
                                            <input type="text" value="{{ $std->department }}" id="due_date"
                                                class="inputs" />
                                        </div>
                                    </form>
                                    <hr />
                                </div>
                                <div class="fees_sect">
                                    <div class="fees_type_sect">
                                        <span>Convocational Fees</span>
                                        @if ($guestNo > 0)
                                            <span>Guest Fees</span>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="fees_amount">
                                        <span>10000</span>
                                        @if ($guestNo > 0)
                                            <span>10000</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="total">
                                    <span>Total</span>
                                    @if ($guestNo > 0)
                                        <span>150000</span>
                                    @else
                                        <span>100000</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($std->status == 2)
            
                <button class="download d-none" id="download_button">Download</button>
                <h1>Upload a Scan Slip Copy</h1>

                <div class="mb-3">
                    <div class=" margin">
                        <label for="slip_id" class="">Verify using Slip ID <span>*</span></label>
                        <div class="no_input flex">
                            <input type="text" placeholder="Enter slip ID" id="slidId" class="input"
                                autocomplete="off">
                            <button class="h-100" id="vBtn" onclick="verifySlip()">Click to Verify
                                Slip</button>
                        </div>
                    </div>

                </div>
                <div id="slipVerify">

                </div>

                @else
<div class="text-center p-3 rounded">
                <h1>Thank You!</h1>
                <h3>You profile has been completed</h3>
            </div>

            @endif
        </section>
    </main>




    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <!-- Script File -->
    <script>
        function nextStep2(action) {


            var step3 = document.getElementById('step3');
            var slipGenerate = document.getElementById('slip_container')
            if (action == 'generate') {
                slipGenerate.classList.toggle('active');
            }
        }
    </script>
    <script src="{{ url('') }}/public/assets/js/dashboard.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function verifySlip() {
            $("#vBtn").html(`Verifying <div class="spinner-border spinner-border-sm" role="status">
         <span class="visually-hidden">Loading...</span>
                </div>`)
            $("#slipVerify").html(`Verifying...`)
            id = $("#slidId").val();
            if (id == '') {
                alert('slipId should not empty!')
                return 0;
            }
            $.ajax({
                url: '{{ route('verifySlip', '') }}/' + id,
                type: "GET",
                success: function(result) {
                    if (result > 0) {
                        $("#vBtn").html(`Verified slip`)

                        //                     $("#slipVerify").html(` <form action="{{ route('submitSlip') }}" method="post" class="guest_form mt-0" enctype="multipart/form-data">
                    //     @csrf
                    //     <label for="slip_copy">Upload Slip Copy <span>*</span> (size 25KB)</label>
                    //     <input type="file" id="slip_copy" name="slip_copy" class="input mb-3" required>

                    //     <label for="user_image">Upload User Image <span>*</span> (size 25KB)</label>
                    //     <input type="file" id="user_image" name="user_image" class="input" required>

                    //     <div class="distinguish">
                    //         <p>Do you have any distinguish certificate?</p>
                    //         <input type="radio" id="yes" name="invite" value="yes">
                    //         <label for="yes">Yes</label>
                    //         <input type="radio" id="no" name="invite" value="no">
                    //         <label for="no">No</label>
                    //     </div>

                    //     <div class="input_box margin distanguish_select" id="select_container">
                    //         <label for="certificate">Select Distinguish certificate <span>*</span></label>
                    //         <select name="certificate" id="certificate" class="input" required>
                    //             <option value="silver_medal" selected>Silver Medal</option>
                    //             <option value="gold_medal">Gold Medal</option>
                    //             <option value="distinction_certificate">Distinction Certificate</option>
                    //         </select>
                    //     </div>

                    //     <input type="submit" class="button" value="Submit">
                    // </form>
                    // `)
                        $("#slipVerify").html(` <form action="{{ route('submitSlip') }}" method="post" class="guest_form mt-0" enctype="multipart/form-data">
                            @csrf
                    <label for="slip_copy">Upload Slip Copy <span>*</span> (size 25KB)</label>
                    <input type="file" id="slip_copy" type="image/*" name="slip_copy" class="input mb-3" required>
                    <label for="user_image">Upload User Image <span>*</span> (size 25KB)</label>
                    <input type="file" id="user_image" type="image/*" name="user_image" class="input" required>

                    <div class="distinguish">
                        <p>Do you have any distanguish certificate?</p>
                        <input type="radio" id="yes" name="invite" value="yes">
                        <label for="yes">Yes</label>
                        <input type="radio" id="no" name="invite" value="no">
                        <label for="no">No</label>
                    </div>

                    <div class="input_box margin distanguish_select w-100" id="select_container">
                        <label for="country">Select Distanguish certificate <span>*</span></label>
                        <select name="certificate" id="certificate" class="input" required>
                            <option value="silver_madel" selected>Silver Medal</option>
                            <option value="gold_madel">Gold Medal</option>
                            <option value="Distinction_certificate">Distinction Certificate</option>
                        </select>
                        <div class="input_container">
                            <div class="input_box margin">
                                <label for="guest_name">Guest Name <span>*</span></label>
                                <input type="text" name="guest_name" placeholder="Enter guest name" id="guest_name"
                                    class="input" autocomplete="off" value="{{ old('guest_name') }}">
                            </div>
                            <div class="input_box">
                                <label for="guest_f_name">Father Name <span>*</span></label>
                                <input type="text" name="guest_f_name" placeholder="Enter guest Father name"
                                    id="guest_f_name" class="input" autocomplete="off"
                                    value="{{ old('guest_f_name') }}">
                            </div>
                        </div>
                        <div class="input_container">
                            <div class="input_box margin">
                                <label for="guest_cnic">Guest CNIC <span>*</span></label>
                                <input type="number" name="guest_cnic" placeholder="enter guest CNIC" id="guest_cnic"
                                    class="input" autocomplete="off" value="{{ old('guest_cnic') }}">
                            </div>
                            <div class="input_box">
                                <label for="guest_image">Guest Picture<span>*</span> (size 25KB)</label>
                                <input type="file" name="guest_image" id="guest_image" class="input">
                            </div>
                        </div>
                    </div>
                    
                    <input type="submit" class="button" value="Submit">
                </form>`)
                var DistanguishButtonYes = document.getElementById('yes');
        var DistanguishButtonNo = document.getElementById('no');
        var DistanguishMenu = document.getElementById("select_container");

        DistanguishButtonYes.addEventListener("click", () => {
            DistanguishMenu.classList.add("active");
        });
        DistanguishButtonNo.addEventListener("click", () => {
            DistanguishMenu.classList.remove("active");
        });
                    } else {
                        $("#vBtn").html(`Try Again`)
                        $("#slipVerify").html(`You Given slip Id is wrong!!`)
                    }

                }
            })

        }


        $("#download_button").on('click', function() {
            $(this).html(`<div class="spinner-border spinner-border-sm" role="status">
         <span class="visually-hidden">Loading...</span>
            </div>`)
            $.ajax({
                url: '{{ route('downloadSlip') }}',
                type: "GET",
                success: function(result) {
                    $("#download_button").html('downloaded')
                    setTimeout(() => {
                        window.location.reload()
                    }, 2000);
                }
            })
        })
    </script>

</body>

</html>
