
<!---- Permission 1: Attendance --->

<a href="#attendanceSubmenu" data-toggle="collapse" aria-expanded="false">
    <i style="color: yellow; padding-left: 0.6em;!important;" class="far fa-calendar"></i>
    <span class="menu-collapsed"> &nbsp;Attendance </span>
    <span class="dropdown-toggle ml-auto"></span>
</a>

<ul class="collapse list-unstyled" id="attendanceSubmenu">
    <li>
        <a href="{{route('employee.attendance.create')}}">
            <span class="menu-collapsed"> Attendance today </span>
        </a>
    </li>
    <li>
        <a href="{{route('employee.attendance.list')}}">
            <span class="menu-collapsed"> List of attendace </span>
        </a>
    </li>
</ul>


<!---- Permission 2: Leave --->

<a href="#leaveSubmenu" data-toggle="collapse" aria-expanded="false">
    <i style="color: yellow; padding-left: 0.6em;!important;" class="far fa-user-times"></i>
    <span class="menu-collapsed"> &nbsp;Leave </span>
    <span class="dropdown-toggle ml-auto"></span>
</a>

<ul class="collapse list-unstyled" id="leaveSubmenu">
    <li>
        <a href="{{route('employee.leave.create_form')}}">
            <span class="menu-collapsed"> Create form </span>
        </a>
    </li>
    <li>
        <a href="{{route('employee.leave.list_leaves')}}">
            <span class="menu-collapsed"> List of leaves </span>
        </a>
    </li>
</ul>
