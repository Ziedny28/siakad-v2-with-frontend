<!--Sidebar-->
<div class="sidebar transition overlay-scrollbars animate__animated animate__slideInLeft">
    <div class="sidebar-content">
        <div id="sidebar">
            <!-- Logo -->
            <div class="logo">
                <img src="assets/images/logo-man1.png" />
                <h3>SIAKAD</h3>
                <h5>MAN 1 Kota Malang</h5>
            </div>

            <ul class="side-menu">
                <li>
                    <a href="/admin-dashboard" class="{{ request()->is('admin-dashboard') ? 'active' : ''}}">
                        <i class="bx bxs-dashboard icon"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bx bxs-user-rectangle icon"></i> My Profile
                    </a>
                </li>
                <!-- Divider-->
                <li class="divider" data-text="Atrana">CONTROL SISWA</li>

                <li>
                    <a href="#">
                        <i class="bx bxs-user icon"></i>
                        Siswa
                        <i class="bx bx-chevron-right icon-right"></i>
                    </a>
                    <ul class="side-dropdown">
                        <li><a href="/students-control">MIPA</a></li>
                        <li><a href="/students-control">Bahasa</a></li>
                        <li><a href="/students-control">IPS</a></li>
                        <li><a href="/students-control">Agama</a></li>
                    </ul>
                </li>

                <!-- Divider-->
                <li class="divider" data-text="STARTER">CONTROL GURU</li>

                <li>
                    <a href="/teacher-control" class="{{ request()->is('teacher-control') ? 'active' : ''}}">
                        <i class="bx bxs-user icon"></i>
                        Guru
                    </a>
                </li>

                <!-- Divider-->
                <li class="divider" data-text="Pages">CONTROL MAPEL</li>

                <li>
                    <a href="/subjects-control" class="{{ request()->is('subjects-control') ? 'active' : ''}}">
                        <i class="bx bx-columns icon"></i>
                        Mapel
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="sidebar-overlay"></div>
<!-- End Sidebar-->