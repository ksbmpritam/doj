    <ul>
        <li class="{{ Request::is('franchies/team/view/*') ? 'active' : '' }}">
            <a href="{{route('franchies.team.view',$team_id)}}">Basic Details</a>
        </li>
        <li class="{{ Request::is('franchies/team/restaurant/*') ? 'active' : '' }}">
            <a href="{{route('franchies.team.restaurant',$team_id)}}">Restaurant</a>
        </li>
        <li class="{{ Request::is('franchies/team/rider/*') ? 'active' : '' }}">
            <a href="{{route('franchies.team.rider',$team_id)}}">Rider</a>
        </li>
        <li class="{{ Request::is('franchies/team/product/*') ? 'active' : '' }}">
            <a href="{{route('franchies.team.product',$team_id) }}">Product</a>
        </li>
       

    </ul>
