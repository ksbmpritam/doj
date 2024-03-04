@extends('employee.layouts.app')

@section('content')
<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">Attandance</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('employee/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">Attandance</li>
            </ol>
        </div>
    </div>


    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">
                    <h1 class="p-5" style="justify-content:center;align-item:center;display:flex">Comming Soon</h1>
                    <!--<div class="card-header">-->
                    <!--    <ul class="nav nav-tabs align-items-end card-header-tabs w-100  justify-content-center">-->
                    <!--        <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">-->
                    <!--            <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>Attandance List</a>-->
                    <!--        </li>-->
                    <!--        <li class="nav-item" style="border: 1px solid #ff683a;border-radius:2px">-->
                    <!--            <a class="nav-link" href="{!! route('employee.attandance') !!}"><i class="fa fa-plus mr-2"></i>Create Attandance</a>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                    <!--</div>-->

                    <!--<div class="card-body">-->

                    <!--    <div class="table-responsive m-t-10">-->

                    <!--        <table id="data-table" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">-->

                    <!--            <thead>-->

                    <!--                <tr>-->
                    <!--                    <th>S.no.</th>-->
                    <!--                    <th> Attandance Name </th>-->
                    <!--                    <th> Status </th>-->
                    <!--                    <th>{{trans('lang.actions')}}</th>-->

                    <!--                </tr>-->

                    <!--            </thead>-->
                    <!--            <tbody>-->
                               

                    <!--            </tbody>-->

                    <!--        </table>-->

                    <!--    </div>-->

                    <!--</div>-->

                </div>

            </div>

        </div>

    </div>

</div>




@endsection