<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>IT CELL</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('links')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                        {{-- <p class="text-center small">Enter your personal details to create account</p> --}}
                                    </div>

                                    <form class="row g-3 needs-validation" id="registerFormElement" method="post"
                                        novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <label for="regEmail" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <input type="email" name="regEmail" class="form-control"
                                                    id="regEmail" placeholder="Enter Email" required>
                                                <div class="invalid-feedback">Please enter your email.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="regPassword" class="form-label">Password</label>
                                            <input type="password" name="regPassword" class="form-control"
                                                id="regPassword" placeholder="Enter Password" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                                            <input type="password" name="confirmPassword" class="form-control"
                                                id="confirmPassword" placeholder="Enter Confirm Password" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Already have an account? <a
                                                    href="{{ route('index') }}">Log in</a></p>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerFormElement');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const email = document.getElementById('regEmail').value;
                const password = document.getElementById('regPassword').value;
                const password_confirmation = document.getElementById('confirmPassword').value;

                axios.post('/api/register', {
                        email: email,
                        password: password,
                        password_confirmation: password_confirmation
                    }, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    })
                    .then(response => {
                        alert('Registered successfully');
                        window.location.href = "{{ route('login_form') }}";
                    })
                    .catch(error => {
                        if (error.response && error.response.data) {
                            const errorMessage = Object.values(error.response.data).flat().join('\n');
                            alert(errorMessage);
                        } else {
                            alert('An error occurred');
                        }
                        location.reload();
                    });
            });
        });
    </script>

</body>

</html>
