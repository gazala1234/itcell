@extends('mainPage')

@section('maincontent')
    <div class="container mt-5">
        <h2 class="text-center">Change Password</h2>
        <form method="POST">
            @csrf

            <!-- Old Password Field -->
            <div class="form-group">
                <label for="old_password">Old Password</label>
                <input type="password" class="form-control" id="old_pass" name="old_pass" required
                    placeholder="Enter old password">
            </div>

            <!-- New Password Field -->
            <div class="form-group mt-3">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control" id="new_pass" name="new_pass" required
                    placeholder="Enter new password">
            </div>

            <!-- Confirm New Password Field -->
            <div class="form-group mt-3">
                <label for="new_password_confirmation">Confirm New Password</label>
                <input type="password" class="form-control" id="new_confirm" name="new_confirm"
                    placeholder="Enter Confirm Password" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary mt-3" style="margin-left: 40%;">Change Password</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginFormElement');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const old_pass = document.getElementById('old_pass').value;
                const new_pass = document.getElementById('new_pass').value;
                const new_confirm = document.getElementById('new_confirm').value;


                axios.post('/api/submitPass', {
                        old_pass: old_pass,
                        new_pass: new_pass,
                        new_confirm: new_confirm
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
@endsection
