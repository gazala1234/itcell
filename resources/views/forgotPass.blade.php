<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>IT CELL</title>
    {{-- add css link file --}}
    @include('links')
</head>

<style>
    .card {
        width: 120%;
        margin-top: 70px;
    }
</style>

<body style="background-color: gainsboro;">
    <main>
        <div class="container">
            <section class="section register d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pb-2">
                                        <h5 class="card-title text-center pb-0 fs-5">Forgot Password</h5>
                                    </div>

                                    <form id="passwordForm" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Enter your email">
                                        </div>

                                        <div class="form-group mt-3">
                                            <label for="new_password">New Password</label>
                                            <input type="password" class="form-control" id="new_pass" name="new_pass"
                                                placeholder="Enter new password">
                                        </div>

                                        <div class="form-group mt-3">
                                            <label for="new_password_confirmation">Confirm New Password</label>
                                            <input type="password" class="form-control" id="new_confirm"
                                                name="new_confirm" placeholder="Enter Confirm Password">
                                        </div>

                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-primary mt-3">Forgot Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('passwordForm');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                var email = document.getElementById('email').value;
                var pass = document.getElementById('new_pass').value;
                var cpass = document.getElementById('new_confirm').value;

                axios.post('/api/forgotPassword', {
                        email: email,
                        new_pass: pass,
                        new_confirm: cpass
                    }, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    })
                    .then(response => {
                        alert('Password set successfully');
                        window.location.href = "{{ route('login') }}";
                    })
                    .catch(error => {
                        // Handle error response
                        let errorMessage = '';
                        if (error.response && error.response.data) {
                            errorMessage = Object.values(error.response.data).flat().join('\n');
                        } else {
                            errorMessage = 'An unexpected error occurred.';
                        }
                        alert(errorMessage);
                        console.error('Error:', error);
                    });
            });
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>

</body>

</html>
