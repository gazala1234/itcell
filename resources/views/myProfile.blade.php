@extends('mainPage')

@section('maincontent')
    <div class="container mt-5">
        <div class="card profile-card">
            <div class="card-body text-center">
                <!-- Profile Image -->
                <div class="profile-img">
                    <img src="{{ asset('images/myprofile.png')}}" alt="Profile Image" class="rounded-circle">
                </div>
                <!-- Name -->
                <h2 class="card-title mt-0">John Doe</h2>
                <!-- Border under Name -->
                <hr class="name-divider">
                <!-- Employee Details -->
                <p class="card-text"><strong class="heading">Designation:</strong> Senior Software Engineer</p>
                <p class="card-text"><strong class="heading">Role:</strong> Backend Developer</p>
                <p class="card-text"><strong class="heading">College:</strong> XYZ University</p>
                <p class="card-text"><strong class="heading">Department:</strong> IT</p>
                <p class="card-text"><strong class="heading">Email:</strong> john.doe@example.com</p>
                <p class="card-text"><strong class="heading">Mobile No:</strong> +123 456 7890</p>
                <p class="card-text"><strong class="heading">Date of Birth:</strong> January 1, 1985</p>
                <p class="card-text"><strong class="heading">Gender:</strong> Male</p>
            </div>
            <!-- Footer with buttons -->
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Edit Profile</button>
            </div>
        </div>
    </div>
@endsection
