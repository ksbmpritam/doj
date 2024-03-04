@extends('franchies.layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor orderTitle">Rider List </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('franchies/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Rider</li> 
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">


                <div class="card">
                   <div class="card-body">
                        <div class="table-responsive m-t-10">

                            <table id="data-table" class="display  table table-bordered" cellspacing="0" width="100%">

                                <thead>

                                    <tr>

                                        <th>S.No.</th>
                                        <th>{{trans('lang.extra_image')}}</th>

                                        <th>{{trans('lang.user_name')}}</th>
                                        <th>{{trans('lang.phone')}}</th>
                                        <th>Franchies Name</th>
                                        <th>Team Name</th>
                                        <th>Approved</th>

                                        <th>{{trans('lang.status')}}</th>
                                        <th class="no-export">{{trans('lang.actions')}}</th>

                                    </tr>

                                </thead>
                                @foreach($drivers as $d)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td>
                                        <img  class="thumbnail-image" src="{{ asset('images/driver/profile/' . $d->profile_image) }}" onerror="this.src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSjUt44i013i_WJ-l3hKPaJ2u3vJd5z1GIvOpN30is&s'"  width="100" height="100" alt="..."/>
                                    </td>
                                    
                                    <td>{{$d->first_name}}&nbsp;{{$d->last_name}}</td>
                                    <td>{{$d->phone}}</td>
                                    
                                    <td class="franchise-name" data-franchise-id="{{ $d->team->franchies_id ?? '' }}"   style="cursor:pointer;"
                                        data-franchise-name="{{ $d->team && $d->team->franchies_id ? App\Models\Franchise::find($d->team->franchies_id)->franchies_name : 'N/A' }}">
                                        @if ($d->team && $d->team->franchies_id)
                                            {{ App\Models\Franchise::find($d->team->franchies_id)->franchies_name ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    
                                    <td class="team-name" data-team-id="{{ $d->team->id ?? '' }}" style="cursor:pointer;" data-team-name="{{ $d->team ? $d->team->name : 'N/A' }}">{{ $d->team ? $d->team->name : 'N/A' }}</td>

                                    <td >
                                        @if($d->team_approvel == 1)
                                            <!--<i class="fa fa-check text-success" aria-hidden="true"></i>-->
                                            <label class="badge badge-success open-modal"
                                                style="color:#fff;background:green;cursor:pointer;"
                                                data-toggle="tooltip" data-placement="top" data-restaurant-id="{{ $d->id }}" title="{{ $d->approved_by_name }}">Approved</label>
                                        @elseif($d->team_approvel == 0)
                                            <!--<i class="fa fa-tasks text-primary" aria-hidden="true"></i>-->
                                            <label class="badge badge-primary"
                                                data-toggle="tooltip" data-placement="top"
                                                title="{{ $d->cancel_reason }}">Progress</label>
                                        @elseif($d->team_approvel == -1)
                                            <!--<i class="fa fa-ban text-danger" aria-hidden="true"></i>-->
                                            <label class="badge badge-danger open-modal" data-restaurant-id="{{ $d->id }}"
                                                data-toggle="tooltip" data-placement="top"
                                                title="{{ $d->cancel_reason }}" style="cursor:pointer"> Reject</label>
                                        @elseif($d->team_approvel == 2)
                                            <label class="badge badge-warning" data-toggle="tooltip" data-placement="top"
                                                title="{{ $d->cancel_reason }}">Pending</label>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        @if($d->status==1)
                                            <span class="badge badge-success" >Active</span>
                                        @else
                                            <span class="badge badge-danger" >InActive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('franchies/rider/request/edit/' . $d->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"> <i class="fa fa-edit"></i> </a>
                                        <a href="{{ url('franchies/rider/request/view/' . $d->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Modal for Restaurant Data -->
<div class="modal fade" id="restaurantModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <!-- Data will be loaded here using AJAX -->
        </div>
    </div>
</div>
<div class="modal fade" id="franchiseModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <!-- Data will be loaded here using AJAX -->
        </div>
    </div>
</div>

<div class="modal fade" id="teamModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <!-- Data will be loaded here using AJAX -->
        </div>
    </div>
</div>

@endsection
@section('scripts')
<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.open-modal').on('click', function () {
            var restaurantId = $(this).data('restaurant-id');
            $('#restaurantModal .modal-content').empty();

            $.ajax({
                url: '/franchies/rider/request/' + restaurantId,
                type: 'GET',
                success: function (data) {
                    $('#restaurantModal .modal-content').html(data);
                    $('#restaurantModal').modal('show');
                },
                error: function (xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
        
        $('.franchise-name').on('click', function () {
            let franchiesId = $(this).data('franchise-id');
            let franchiesName = $(this).data('franchise-name');
            if (franchiesName !== 'N/A') {
                $('#franchiseModel .modal-content').empty();
        
                $.ajax({
                    url: '/franchies/rider/request/franchiesName/' + franchiesId,
                    type: 'GET',
                    success: function (data) {
                        $('#franchiseModel .modal-content').html(data);
                        $('#franchiseModel').modal('show');
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr);
                    }
                });
            }
        });

        
       
        
        
        $('.team-name').on('click', function () {
            let teamId = $(this).data('team-id');
            let teamName = $(this).data('team-name');
        
            if (teamName !== 'N/A') {
                $('#teamModel .modal-content').empty();
        
                $.ajax({
                    url: '/franchies/rider/request/teamName/' + teamId,
                    type: 'GET',
                    success: function (data) {
                        console.log(data);
                        $('#teamModel .modal-content').html(data);
                        $('#teamModel').modal('show');
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr);
                    }
                });
            }
        });

    });
</script>