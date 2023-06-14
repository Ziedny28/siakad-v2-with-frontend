<!--Sidebar-->
<div class="sidebar transition overlay-scrollbars animate__animated animate__slideInLeft">
    <div class="sidebar-content">
        <div id="sidebar">
            <!-- Logo -->
            <div class="logo">
                <img src="{{ asset('assets/images/logo-man1.png') }}" />
                <h3>SIAKAD</h3>
                <h5>MAN 1 Kota Malang</h5>
            </div>

            <ul class="side-menu">
                <li>
                    <a href="/dashboard-teacher" class="{{ request()->is('dashboard-teacher') ? 'active' : '' }}">
                        <i class="bx bxs-dashboard icon"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="/teacher-profile" class="{{ request()->is('teacher-profile') ? 'active' : '' }}">
                        <i class="bx bxs-user icon"></i> My Profile
                    </a>
                </li>
                <!-- Divider-->
                <li class="divider" data-text="Atrana">CONTROL NILAI SISWA</li>

                <li>
                    <a href="/score" class="{{ request()->is('score') ? 'active' : '' }}">
                        <i class='bx bxs-file icon'></i>
                        Penilaian
                    </a>
                </li>

                <!-- Divider-->
                <li class="divider" data-text="STARTER">CONTROL TUGAS</li>

                <li>
                    <a href="/task" class="{{ request()->is('task') ? 'active' : '' }}">
                        <i class='bx bx-task icon'></i>
                        Tugas
                    </a>
                </li>
                <!-- Divider-->
                <li class="divider" data-text="STARTER">LIHAT JADWAL</li>

                <li>
                    <a href="/teacher-schedule" class="{{ request()->is('teacher-schedule') ? 'active' : '' }}">
                        <i class='bx bxs-time-five icon'></i>
                        Jadwal Guru
                    </a>
                </li>

                <!-- Divider-->
            </ul>
        </div>
    </div>
</div>
<div class="sidebar-overlay"></div>
<!-- End Sidebar-->
