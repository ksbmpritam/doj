<ul>
    <li class="{{ request()->is('employee/franchies/team/details/*') ? 'active' : '' }}">
        <a href="{{route('employee.franchies.team.details',$team_ids)}}">Basic Details</a>
    </li>
    <li class="{{ request()->is('employee/franchies/team/restaurant/*') ? 'active' : '' }}"> 
        <a href="{{route('employee.franchies.team.restaurant',$team_ids)}}">Restaurant</a>
    </li>
    <li class="{{ request()->is('employee/franchies/team/rider/*') ? 'active' : '' }}"> 
        <a href="{{route('employee.franchies.team.rider',$team_ids)}}">Rider</a>
    </li>
    <li class="{{ request()->is('employee/franchies/team/product/*') ? 'active' : '' }}"> 
        <a href="{{route('employee.franchies.team.product',$team_ids) }}">Product</a>
    </li>
</ul>
