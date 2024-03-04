<ul>
    <li class="{{ Request::is('employee/franchies/view/*') ? 'active' : '' }}">
        <a href="{{route('employee.franchies.view',$team_id)}}">Basic Details</a>
    </li>
    <li class="{{ request()->is('employee/franchies/department/*') ? 'active' : '' }} "> 
        <a href="{{route('employee.franchies.department.list',$team_id)}}">Department</a>
    </li>
    <li class="{{ Request::is('employee/franchies/zone/*') ? 'active' : '' }}">
        <a href="{{route('employee.franchies.zone.list',$team_id)}}">Zone</a>
    </li> 
    
    <li class="{{ request()->is('employee/franchies/team/*') ? 'active' : '' }}">
        <a href="{{route('employee.franchies.team.list',$team_id) }}">Team</a>
    </li>
</ul>
