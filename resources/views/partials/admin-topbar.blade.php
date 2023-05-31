<div class="topbar transition">
    <div class="bars">
        <button type="button" class="btn transition" id="sidebar-toggle">
            <i class='bx bx-menu'></i>
        </button>
    </div>
    <div class="menu">
        <ul>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src={{asset('assets/images/avatar/avatar-2.png')}} alt="" />
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/my-profile"><i class="bx bxs-user-circle size-icon-1"></i>
                        <span>My Profile</span></a>
                    <a class="dropdown-item" href="/undefined-fitur"><i class="bx bx-cog size-icon-1"></i>
                        <span>Settings</span></a>
                    <hr class="dropdown-divider" />
                    <a class="dropdown-item" href="/logout"><i class="bx bx-log-out size-icon-1"></i>
                        <span>Logout</span></a>
                </ul>
            </li>
        </ul>
    </div>
</div>
