    <ul>
        <li class="{{ Request::is('admin/employee/view/*') ? 'active' : '' }}">
            <a href="{{route('admin.employee.view',$team_id)}}">Basic Details</a>
        </li>
        <li class="{{ Request::is('admin/employee/department/*') ? 'active' : '' }}">
            <a href="{{route('admin.employee.department.departmentlist',$team_id)}}">Department</a>
        </li>
        <li class="{{ Request::is('admin/employee/zone/*') ? 'active' : '' }}">
            <a href="{{route('admin.employee.zone.zonelist',$team_id)}}">Zone</a>
        </li>
        <li class="{{ Request::is('admin/employee/team/*') ? 'active' : '' }}">
            <a href="{{route('admin.employee.team.teamlist',$team_id) }}">Team</a>
        </li>
    </ul>
