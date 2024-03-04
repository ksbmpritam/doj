    <ul>
        <li class="{{ Request::is('admin/franchies/team/teamDetail*') ? 'active' : '' }}">
            <a href="{{route('admin.franchies.team.teamDetail',$team_ids)}}">Basic Details</a>
        </li>
        <li class="{{ Request::is('admin/franchies/team/restaurant/*') ? 'active' : '' }}">
            <a href="{{route('admin.franchies.team.restaurant',$team_ids)}}">Restaurant</a>
        </li>
        <li class="{{ Request::is('admin/franchies/team/rider/*') ? 'active' : '' }}">
            <a href="{{route('admin.franchies.team.rider',$team_ids)}}">Rider</a>
        </li>
        <li class="{{ Request::is('admin/franchies/team/product/*') ? 'active' : '' }}">
            <a href="{{route('admin.franchies.team.product',$team_ids) }}">Product</a>
        </li>
       

    </ul>
