    <ul>
        <li class="{{ Request::is('admin/employee/team/teamDetail*') ? 'active' : '' }}">
            <a href="{{route('admin.employee.team.teamDetail',$team_ids)}}">Basic Details</a>
        </li>
        <li class="{{ Request::is('admin/employee/team/restaurant/*') ? 'active' : '' }}">
            <a href="{{route('admin.employee.team.restaurant',$team_ids)}}">Restaurant</a>
        </li>
        <li class="{{ Request::is('admin/employee/team/rider/*') ? 'active' : '' }}">
            <a href="{{route('admin.employee.team.rider',$team_ids)}}">Rider</a>
        </li>
        <li class="{{ Request::is('admin/employee/team/product/*') ? 'active' : '' }}">
            <a href="{{route('admin.employee.team.product',$team_ids) }}">Product</a>
        </li>
       

    </ul>
