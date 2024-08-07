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

<body style="background-color: gainsboro;">
    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-3 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        {{-- <p class="text-center small">Enter your email & password to login</p> --}}
                                    </div>

                                    <form class="row g-3 needs-validation" id="loginFormElement" method="post"
                                        novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email/Mobile No</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="email" class="form-control" id="email"
                                                    placeholder="Enter email" required>
                                                <div class="invalid-feedback">Please enter your email.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder="Enter password" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit"
                                                id="lsubmit">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have an account? <a
                                                    href="{{ route('registerForm') }}">Create an account</a></p>
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

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    {{-- javascript code to login --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginFormElement');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;

                axios.post('/api/login', {
                        email: email,
                        password: password
                    }, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    })
                    .then(response => {
                        // Redirect to dashboard on successful login
                        window.location.href = "{{ route('dashboard') }}";
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
