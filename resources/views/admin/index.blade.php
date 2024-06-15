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
                        Admin Dashboard of Convocation 2024 UMW
                    </h1>

                    <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
                </div>
            </div>

        </header>

        <div class="container mt-5">
            <div class="d-flex align-items-center justify-content-end mt-3">
                <a href="{{ route('export.stocks') }}" class="btn btn-primary me-3">Export CSV</a>

            </div>
        </div>

        <div class="container table-responsive mt-5">
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>RegisterationNo</th>
                        <th>StudentName</th>
                        <th>FatherName</th>
                        <th>Department</th>
                        <th>CNIC</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Program</th>
                        <th>MobileNumber</th>
                        <th>Image</th>
                        <th>SlipImage</th>
                        <th>Certificate</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $userUrl = url('') . '/public/uploads/images/users/';
                        $slipUrl = url('') . '/public/uploads/images/slips/';
                    @endphp
                    @foreach ($stds as $std)
                        <tr style="vertical-align: middle">
                            <td>{{ $std->registerationNo }}</td>
                            <td>{{ $std->name }}</td>
                            <td>{{ $std->fatherName }}</td>
                            <td>{{ $std->department }}</td>
                            <td>{{ $std->cnic }}</td>
                            <td>{{ $std->email }}</td>
                            <td>{{ $std->gender }}</td>
                            <td>{{ $std->dob }}</td>
                            <td>{{ $std->department }}</td>
                            <td>{{ $std->mobileNo }}</td>
                            <td><img src="{{ $userUrl . $std->image }}" alt="" width="50px"></td>
                            <td><img src="{{ $slipUrl . $std->slipImage }}" alt="" width="50px"></td>
                            <td>{{ $std->certificate }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>







</body>

</html>
