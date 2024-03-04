<ul>
    <li class="{{ request()->is('employee/team/view/*') ? 'active' : '' }}">
        <a href="{{ route('employee.team.view', $team_id) }}">Basic Details</a>
    </li>
    <li class="{{ request()->is('employee/team/restaurant/*') ? 'active' : '' }}">
        <a href="{{ route('employee.team.restaurant', $team_id) }}">Restaurant</a>
    </li>
    <li class="{{ request()->is('employee/team/rider/*') ? 'active' : '' }}">
        <a href="{{ route('employee.team.rider', $team_id) }}">Rider</a>
    </li>
    <li class="{{ request()->is('employee/team/product/*') ? 'active' : '' }}">
        <a href="{{ route('employee.team.product', $team_id) }}">Product</a>
    </li>
</ul>

