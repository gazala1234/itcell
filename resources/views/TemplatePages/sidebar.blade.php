<!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="{{ route('dashboard') }}">
                    <i class="bi bi-grid" style="font-size: 20px;"></i><span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            {{-- TECHING AND NON-TEACHING SIDEBAR --}}
            @php
                $role = session('role');
                // echo $role;
                if($role == 'Teaching' || $role == 'Non-Teaching'){
            @endphp
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse"
                            href="#">
                            <i class="bi bi-folder-plus" style="font-size: 20px;"></i><span>Assignments</span><i
                                class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <li>
                                <a href="{{ route('add_assignment') }}">
                                    <i class="bi bi-plus-circle-fill" style="font-size: 13px;"></i><span>Add Assignment</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('view_assignment') }}">
                                    <i class="bi bi-table" style="font-size: 13px;"></i><span>View Assignment</span>
                                </a>
                            </li>
                        </ul>
                    </li>
            @php
                }
            @endphp

            {{-- ADMIN SIDEBAR --}}
            @php
            $role = session('role');
            // echo $role;
            if($role == 'admin'){
            @endphp
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('contact') }}">
                        <i class="bi bi-table" style="font-size: 20px;"></i><span>Assigned Tasks</span>                   
                    </a>
                </li>
            @php
            }
            @endphp

            {{-- DEVELOPER SIDEBAR --}}
            @php
            $role = session('role');
            // echo $role;
            if($role == 'developer'){
            @endphp
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('contact') }}">
                        <i class="bi bi-table" style="font-size: 20px;"></i><span>Assigned Tasks</span>                   
                    </a>
                </li>
            @php
            }
            @endphp

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('contact') }}">
                    <i class="bi bi-people-fill" style="font-size: 20px;"></i><span>Contact</span>                   
                </a>
            </li><!-- End Contact Page Nav -->
        </ul>

    </aside>
    <!-- End Sidebar-->




    
