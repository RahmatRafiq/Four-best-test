<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebarMenuScroll custom-scrollbar">
        <ul class="sidebar-menu">
            <li class="{{ request()->routeIs('dashboard') ? 'active current-page' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            <li class="treeview {{ request()->is('admin/role-permissions*') ? 'active current-page open' : '' }}">
                <a href="#" class="treeview-toggle">
                    <i class="bi bi-person-gear"></i>
                    <span class="menu-text">Manajemen Pengguna</span>
                </a>
                <ul class="treeview-menu"
                    style="{{ request()->is('admin/role-permissions*') ? 'display: block;' : 'display: none;' }}">
                    <li class="{{ request()->routeIs('permission.index') ? 'active-sub' : '' }}">
                        <a href="{{ route('permission.index') }}">Permissions</a>
                    </li>
                    <li class="{{ request()->routeIs('role.index') ? 'active-sub' : '' }}">
                        <a href="{{ route('role.index') }}">Role</a>
                    </li>
                    <li class="{{ request()->routeIs('user.index') ? 'active-sub' : '' }}">
                        <a href="{{ route('user.index') }}">Users</a>
                    </li>
                    <li class="{{ request()->routeIs('position.index') ? 'active current-page' : '' }}">
                        <a href="{{ route('position.index') }}">
                            <span class="menu-text">Manajemen Posisi</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('about-app.index') ? 'active-sub' : '' }}">
                        <a href="{{ route('about-app.index') }}">Tentang Aplikasi</a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('profile.edit') ? 'active current-page' : '' }}">
                <a href="{{ route('profile.edit') }}">
                    <i class="bi bi-person"></i>
                    <span class="menu-text">Manajemen Profil</span>
                </a>
            </li>

            <li
                class="treeview {{ request()->is('admin/employee*') || request()->is('admin/work-days*') ? 'active current-page open' : '' }}">
                <a href="#" class="treeview-toggle">
                    <i class="bi bi-people"></i>
                    <span class="menu-text">Employee Management</span>
                </a>
                <ul class="treeview-menu"
                    style="{{ request()->is('admin/employee*') || request()->is('admin/work-days*') ? 'display: block;' : 'display: none;' }}">
                    <li class="{{ request()->routeIs('employee.index') ? 'active-sub' : '' }}">
                        <a href="{{ route('employee.index') }}">Employees</a>
                    </li>
                    <li class="{{ request()->routeIs('employee.create') ? 'active-sub' : '' }}">
                        <a href="{{ route('employee.create') }}">Add Employee</a>
                    </li>
                    <li class="{{ request()->routeIs('work-days.index') ? 'active-sub' : '' }}">
                        <a href="{{ route('work-days.index') }}">Work Days</a>
                    </li>
                    <li class="{{ request()->routeIs('work-days.create') ? 'active-sub' : '' }}">
                        <a href="{{ route('work-days.create') }}">Add Work Day</a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ request()->is('attendance*') ? 'active current-page open' : '' }}">
                <a href="#" class="treeview-toggle">
                    <i class="bi bi-clock-history"></i>
                    <span class="menu-text">Attendance</span>
                </a>
                <ul class="treeview-menu"
                    style="{{ request()->is('attendance*') ? 'display: block;' : 'display: none;' }}">
                    <li class="{{ request()->routeIs('attendance.index') ? 'active-sub' : '' }}">
                        <a href="{{ route('attendance.index') }}">Attendance Records</a>
                    </li>
                    <li class="{{ request()->routeIs('attendance.create') ? 'active-sub' : '' }}">
                        <a href="{{ route('attendance.create') }}">Add Attendance</a>
                    </li>
                </ul>
            </li>


            <li class="treeview {{ request()->is('salary*') ? 'active current-page open' : '' }}">
                <a href="#" class="treeview-toggle">
                    <i class="bi bi-cash-stack"></i>
                    <span class="menu-text">Salary Management</span>
                </a>
                <ul class="treeview-menu" style="{{ request()->is('salary*') ? 'display: block;' : 'display: none;' }}">
                    <li class="{{ request()->routeIs('salary.index') ? 'active-sub' : '' }}">
                        <a href="{{ route('salary.index') }}">Salary Records</a>
                    </li>
                    <li class="{{ request()->routeIs('salary.calculate') ? 'active-sub' : '' }}">
                        <a href="{{ route('salary.calculate', ['employeeId' => 1]) }}">Calculate Salary (Example)</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>