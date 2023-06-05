<!--Sidebar-->
<div class="sidebar transition overlay-scrollbars animate__animated animate__slideInLeft">
    <div class="sidebar-content">
        <div id="sidebar">
            <!-- Logo -->
            <div class="logo">
                <img src={{ asset('assets/images/logo-man1.png') }} />
                <h3>SIAKAD</h3>
                <h5>MAN 1 Kota Malang</h5>
            </div>

            <ul class="side-menu">
                <li>
                    <a href="/dashboard-student" class="{{ request()->is('dashboard-student') ? 'active' : '' }}">
                        <i class="bx bxs-dashboard icon"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="/student-profile" class="{{ request()->is('student-profile') ? 'active' : '' }}">
                        <i class="bx bxs-user icon"></i> My Profile
                    </a>
                </li>

                <!-- Divider-->
                <li class="divider" data-text="STARTER">DATA NILAI</li>
                <li>
                    <a href="/student-task" class="{{ request()->is('student-task') ? 'active' : '' }}">
                        <i class='bx bx-task icon'></i>
                        Tugas
                    </a>
                </li>
                <li>
                    <a href="/student-score" class="{{ request()->is('student-score') ? 'active' : '' }}">
                        <i class='bx bx-task icon'></i>
                        Nilai
                    </a>
                </li>
                <!-- Divider-->
                <li class="divider" data-text="STARTER">LIHAT JADWAL</li>

                <li>
                    <a href="/student-schedule" class="{{ request()->is('student-schedule') ? 'active' : '' }}">
                        <i class='bx bxs-time-five icon'></i>
                        Jadwal Siswa
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="sidebar-overlay"></div>
<!-- End Sidebar-->
