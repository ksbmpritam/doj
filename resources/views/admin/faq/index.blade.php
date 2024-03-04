@extends('admin.layouts.app')

@section('content')

<style>
     .warpper {
        display: flex;
        flex-direction: column;
        align-items: left;
    }

    .tab {
        cursor: pointer;
        padding: 10px 20px;
        margin: 0px 2px;
        background: #000;
        display: inline-block;
        color: #fff;
        border-radius: 3px 3px 0px 0px;
        box-shadow: 0 0.5rem 0.8rem #00000080;
    }

    .panels {
        background: #fffffff6;
        box-shadow: 0 2rem 2rem #00000080;
        min-height: 200px;
        width: 100%;
        max-width: 1200px;
        border-radius: 3px;
        overflow: hidden;
        padding: 20px;
    }

    .panel {
        display: none;
        animation: fadein .8s;
    }

    @keyframes fadein {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .panel-title {
        font-size: 1.5em;
        font-weight: bold
    }

    .radio {
        display: none;
    }

    #one:checked~.panels #one-panel,
    #two:checked~.panels #two-panel,
    #three:checked~.panels #three-panel {
        display: block
    }

    #one:checked~.tabs #one-tab,
    #two:checked~.tabs #two-tab,
    #three:checked~.tabs #three-tab {
        background: #fffffff6;
        color: #000;
        border-top: 3px solid #000;
    }
</style>
<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">Manage FAQ</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item active"><a href="{{url('admin/faq')}}">Manage FAQ</a></li>

            </ol>

        </div>
    </div>




    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link " href="{!! route('admin.faq') !!}"><i class="fa fa-list mr-2"></i>FAQ</a>
                            </li>
                            <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">
                                <a class="nav-link active" href="{!! route('admin.faq.create') !!}"><i class="fa fa-plus mr-2"></i>Create FAQ</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">

                    <div class="table-responsive m-t-10">
                        @if(session('success'))
                            <div class="alert alert-success" id="success-message">
                                {{ session('success') }}
                            </div>
                        @endif

                         <div class="warpper">
                            <input class="radio" id="one" name="group" type="radio" checked>
                            <input class="radio" id="two" name="group" type="radio">
                            <input class="radio" id="three" name="group" type="radio">
                            <div class="tabs">
                                <label class="tab" id="one-tab" for="one">Customer</label>
                                <label class="tab" id="two-tab" for="two">Partner</label>
                                <label class="tab" id="three-tab" for="three">Driver</label>
                            </div>
                            <div class="panels">
                                <div class="panel" id="one-panel">
                                    <table id="customer" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>App</th>
        
                                            <th>Title</th>
        
                                            <th>Content</th>
        
                                            <th>{{trans('lang.actions')}}</th>
        
                                        </tr>
        
                                    </thead>
        
                                    <tbody>
                                      @foreach($data as $t)
                                      @if($t->app==2)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                @if($t->app == 1)
                                                    {{ __('Driver') }}
                                                @elseif($t->app == 2)
                                                    {{ __('Customer') }}
                                                @elseif($t->app == 3)
                                                    {{ __('Partner') }}
                                                @endif
                                            </td>
                                            <td>{{strip_tags($t->title)}}</td>
                                            <td> {!! html_entity_decode(substr($t->content, 0, 50)) !!} {{ strlen($t->content) > 50 ? '...' : '' }}</td>
                                            <td>
                                                <a href="{{ url('admin/faq/edit/' . $t->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> </a>
                                                <a href="{{ url('admin/faq/delete/' . $t->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete ?')"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                      @endif
                                      @endforeach
                                    </tbody>
        
        
        
                                </table>
                                </div>
                                <div class="panel" id="two-panel">
                                    <table id="partner" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                        <thead>
                                            <tr>
                                                <th>S.no</th>
                                                <th>App</th>
            
                                                <th>Title</th>
            
                                                <th>Content</th>
            
                                                <th>{{trans('lang.actions')}}</th>
            
                                            </tr>
            
                                        </thead>
            
                                        <tbody>
                                          @foreach($data as $p)
                                          @if($p->app==3)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    @if($p->app == 1)
                                                        {{ __('Driver') }}
                                                    @elseif($p->app == 2)
                                                        {{ __('Customer') }}
                                                    @elseif($p->app == 3)
                                                        {{ __('Partner') }}
                                                    @endif
                                                </td>
                                                <td>{{strip_tags($p->title)}}</td>
                                                <td> {!! html_entity_decode(substr($p->content, 0, 50)) !!} {{ strlen($p->content) > 50 ? '...' : '' }}</td>
            
                                                <td>
                                                    <a href="{{ url('admin/faq/edit/' . $p->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> </a>
                                                    <a href="{{ url('admin/faq/delete/' . $p->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete ?')"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                          @endif
                                          @endforeach
                                        </tbody>
            
            
            
                                    </table>

                                </div>
                                <div class="panel" id="three-panel">
                                    <table id="driver" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                        <thead>
                                            <tr>
                                                <th>S.no</th>
                                                <th>App</th>
            
                                                <th>Title</th>
            
                                                <th>Content</th>
            
                                                <th>{{trans('lang.actions')}}</th>
            
                                            </tr>
            
                                        </thead>
            
                                        <tbody>
                                          @foreach($data as $a)
                                          @if($a->app==1)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    @if($a->app == 1)
                                                        {{ __('Driver') }}
                                                    @elseif($a->app == 2)
                                                        {{ __('Customer') }}
                                                    @elseif($a->app == 3)
                                                        {{ __('Partner') }}
                                                    @endif
                                                </td>
                                                <td>{{strip_tags($a->title)}}</td>
                                                <td> {!! html_entity_decode(substr($a->content, 0, 50)) !!} {{ strlen($a->content) > 50 ? '...' : '' }}</td>
            
                                                <td>
                                                    <a href="{{ url('admin/faq/edit/' . $a->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> </a>
                                                    <a href="{{ url('admin/faq/delete/' . $a->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete ?')"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                          @endif
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

</div>

</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var successMessage = $('#success-message');

        if (successMessage.length > 0) {
            setTimeout(function() {
                successMessage.fadeOut(500, function() {
                    successMessage.remove(); 
                });
            }, 3000); 
        }
    });
    
    $('#customer').DataTable({
        searching: true,
        pageLength: 10,
      
    });
    
    $('#partner').DataTable({
        searching: true,
        pageLength: 10,
      
    });
    
    $('#driver').DataTable({
        searching: true,
        pageLength: 10,
      
    });
    
</script>

@endsection