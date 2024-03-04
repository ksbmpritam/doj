    <ul>
        <li class="{{ Request::is('admin/franchies/view/*') ? 'active' : '' }}">
            <a href="{{route('admin.franchies.view',$team_id)}}">Basic Details</a>
        </li>
        <li class="{{ Request::is('admin/franchies/department/*') ? 'active' : '' }}">
            <a href="{{route('admin.franchies.department.departmentlist',$team_id)}}">Department</a>
        </li>
        <li class="{{ Request::is('admin/franchies/zone/*') ? 'active' : '' }}">
            <a href="{{route('admin.franchies.zone.zonelist',$team_id)}}">Zone</a>
        </li>
        <li class="{{ Request::is('admin/franchies/team/*') ? 'active' : '' }}">
            <a href="{{route('admin.franchies.team.teamlist',$team_id) }}">Team</a>
        </li>
    </ul>
