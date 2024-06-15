<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convocation 2024 UMW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script> --}}
    <!-- custom CSS File LinK -->
    <link rel="stylesheet" href="{{ url('') }}/public/assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</head>

<body>

    <main id="main">
        <header class="header">
            <h1 class="h_heading">Convocation 2024 UMW</h1>
        </header>
        <!-- Section -->

        <section class="section">
            <div class="instruction mb-0 pb-0">
                <h2 class="ins_heading">Instruction</h2>
                <ol class="inst_lists">
                    <li class="inst_s_list">Each Graduate Student must register by click on New User.</li>
                    <li class="inst_s_list">Fill all the required Field with correct data.</li>
                    <li class="inst_s_list">Enter OTP recieved on your mobile & submit.</li>
                    <li class="inst_s_list">Generate Fee slip and Take Print.</li>
                    <li class="inst_s_list">After Deposite Fee Slip in BOP.</li>
                    <li class="inst_s_list">Login by clicking on Already Account.</li>
                    <li class="inst_s_list">Enter your CNIC and password.</li>
                    <li class="inst_s_list">Upload scan copy of Fee slip and CNIC upto 25KB max size</li>
                </ol>
            </div>
            <span class="register_link px-2">Register New User <span><a
                        href="{{ route('user.register') }}">SignUp</a></span></span>
            </div>
            <h4 style="text-align: center; margin-bottom: 15px;">Already Registered User</h4>
            <div class="reg_login">
                <div class="login_form">
                    @if (session()->has('login-msg'))
                        <div class="text-center fs-5 text-white fw-bold mb-4 bg-danger p-3 rounded">
                            {{ session()->get('login-msg') }}
                        </div>
                    @endif
                    <form action="{{ route('user.logined') }}" method="POST" class="l_form">
                        @csrf
                        <div class="input_box margin">
                            <label for="log_cnic">CNIC</label>
                            <input type="number" name="cnic" placeholder="Enter your CNIC" id="log_cnic"
                                class="input log" autocomplete="off" value="{{ old('cnic') }}">
                            @error('cnic')
                                <span class="error text-danger mb-3">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input_box margin">
                            <label for="log_password">Password</label>
                            <input type="password" name="password" placeholder="Password" id="log_password"
                                class="input log" autocomplete="off">
                            @error('password')
                                <span class="error text-danger mb-3">{{ $message }}</span>
                            @enderror
                        </div>
                        <span><a href="#" class="forget">Forget Password?</a></span>



                        <button id="LoginBtn" class="log_button">LogIn</button>
                    </form>

                    {{-- <span class="register_link">Register New User <span><a
                                href="{{ route('user.register') }}">SignUp</a></span></span> --}}
                </div>
            </div>
        </section>
    </main>

</body>
<script>
    $("#LoginBtn").on('click', function() {
        $(this).html(`Verifying<div class="spinner-border spinner-border-sm" role="status">
  <span class="visually-hidden">Loading...</span>
</div>`)
    })
</script>

</html>
