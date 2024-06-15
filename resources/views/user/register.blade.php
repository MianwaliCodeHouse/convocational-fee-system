<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Singup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Custom CSS File Link -->
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
        <div class="main_container">

            <h2 class="sign_heading text-center">Registration Form</h2>
            @if ($errors->any())
                <div class="error text-center text-white fw-bold mb-4 bg-danger p-3 rounded">
                    <ul>


                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form section -->
            <form action="{{ route('registered.user') }}" method="POST" class="form">
                @csrf
                <div class="input_container">
                    <!-- First name -->
                    <div class="input_box margin">
                        <label for="username">Name <span>*</span></label>
                        <input type="text" placeholder="username" id="username" class="input" autocomplete="off"
                            name="username" value="{{ old('username') }}" required>
                    </div>
                    <!-- last name -->
                    <div class="input_box">
                        <label for="f_name">Father Name <span>*</span></label>
                        <input type="text" placeholder="father name" id="f_name" class="input" autocomplete="off"
                            name="father_name" value="{{ old('father_name') }}" required>
                    </div>
                </div>
            
                <div class="input_container">
                    <!-- date of birth -->
                    <div class="input_box margin">
                        <label for="birth_date">Birth date <span>*</span></label>
                        <input type="date" id="birth_date" class="input" name="birth_date" value="{{ old('birth_date') }}" required>
                    </div>
                    <!-- Radio button -->
                    <div class="input_box">
                        <label for="male">Gender <span>*</span></label>
                        <div class="gender">
                            <input type="radio" id="male" name="gender" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }} required>
                            <span>Male</span>
                            <input type="radio" id="female" name="gender" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }} required>
                            <span>Female</span>
                        </div>
                    </div>
                </div>
            
                <div class="input_container">
                    <!-- CNIC -->
                    <div class="input_box margin">
                        <label for="cnic">CNIC <span>*</span></label>
                        <input type="number" placeholder="Enter CNIC" id="cnic" class="input" autocomplete="off"
                            name="cnic" value="{{ old('cnic') }}" required>
                    </div>
                    <!-- Email -->
                    <div class="input_box">
                        <label for="email">Email <span>*</span></label>
                        <input type="email" placeholder="example.gmail.com" id="email" class="input"
                            autocomplete="off" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>
            
                <div class="input_container">
                    <!-- Password -->
                    <div class="input_box margin">
                        <label for="password">Password <span>*</span></label>
                        <input type="password" placeholder="Enter password" id="password" class="input"
                            autocomplete="off" name="password" required>
                    </div>
                    <!-- Confirm password -->
                    <div class="input_box">
                        <label for="confirm_password">Confirm Password <span>*</span></label>
                        <input type="password" placeholder="confirm password" id="confirm_password" class="input"
                            autocomplete="off" name="confirm_password" required>
                    </div>
                </div>
            
                <div class="input_container">
                    <!-- Program -->
                    <div class="input_box margin">
                        <label for="program">Program <span>*</span></label>
                        <select name="program" id="program" class="input" required>
                            <option value="bscs" {{ old('program') == 'bscs' ? 'selected' : '' }}>BSCS</option>
                            <option value="bsit" {{ old('program') == 'bsit' ? 'selected' : '' }}>BSIT</option>
                        </select>
                    </div>
                    <!-- Registration Number -->
                    <div class="input_box">
                        <label for="reg_no">Registration Number <span>*</span></label>
                        <input type="text" placeholder="enter registration number" id="reg_no" class="input"
                            autocomplete="off" name="registration_number" value="{{ old('registration_number') }}" required>
                    </div>
                </div>
            
                <div class="input_container">
                    <!-- Contact Number -->
                    <div class="input_box margin">
                        <label for="contact">Contact Number <span>*</span></label>
                        <div class="no_input flex">
                            <input type="number" placeholder="Contact Number" id="contact" class="input"
                                autocomplete="off" name="contact_number" value="{{ old('contact_number') }}" required>
                            <button>Send OTP</button>
                        </div>
                    </div>
                    <!-- OTP -->
                    <div class="input_box">
                        <label for="otp">OTP</label>
                        <div class="no_input flex">
                            <input type="number" placeholder="Enter OTP" id="otp" class="input"
                                autocomplete="off" name="otp" value="{{ old('otp') }}">
                            <button>Verify</button>
                        </div>
                    </div>
                </div>
            
                <button id="LoginBtn" class="button">Register</button>
            </form>
            
            

            <span class="register_link">Already have an Account? <a href="{{ route('user.login') }}">SignIn</a></span>
        </div>
    </main>
</body>
<script>
    $("#LoginBtn").on('click', function() {
        $(this).html(`<div class="spinner-border spinner-border-sm" role="status">
  <span class="visually-hidden">Loading...</span>
</div>`)
    })
</script>
</html>
