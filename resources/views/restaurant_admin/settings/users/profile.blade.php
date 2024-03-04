@extends('layouts.app')

@section('content')

<div class="page-wrapper">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">{{trans('lang.user_profile')}}</h3>
		</div>

		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('restaurant/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
				<li class="breadcrumb-item"><a href= "{!! route('users') !!}" >{{trans('lang.user_profile')}}</a></li>
				<li class="breadcrumb-item active">{{trans('lang.user_edit')}}</li>
			</ol>
		</div>

</div>

 <div class="profile-form">
            @if (Session::has('message'))
                <div class="alert alert-error">{{Session::get('message')}}</div>
            @endif

            <div class="card-body">
                
                <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>

                  <div class="column">
                      <form method="post" action="{{ route('users.profile.update',$user->id) }}">
                        @csrf
                   
                   
                    <div class="row restaurant_payout_create">
                        <div class="twPc-div">
                            <a class="twPc-bg twPc-block"></a>
                        
                        	<div>
                        	
                        
                        		<a title="Mert S. Kaplan" href="#" class="twPc-avatarLink">
                        			<img alt="profile" src="https://doj.patialamart.com/admin/doj_admin/images/profile.jpg" class="twPc-avatarImg">
                        		</a>
                        
                        		<div class="twPc-divUser">
                        			<div class="twPc-divName">
                        				<a href="https://twitter.com/mertskaplan">Rohan Singh</a>
                        			</div>
                        			<span>
                        				<a href="https://twitter.com/mertskaplan">Abc</a>
                        			</span>
                        		</div>
                        
                        		
                        	</div>
                        </div>
                    </div>
                   
                   
                   
                   <div class="row restaurant_payout_create">
                    <div class="restaurant_payout_create-inner">
                        <fieldset>     
                   
                    <div class="form-group row">
                        <label class="col-5 control-label">{{trans('lang.user_name')}}</label>
                       <div class="col-7"> 
                        <input type="text" class=" col-6 form-control" name="name" placeholder="username">
                        
                    </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-5 control-label">Mobile Number</label>
                       <div class="col-7"> 
                        <input type="text" class=" col-6 form-control" name="name" value="" placeholder="mobile number">
                        
                    </div>
                    </div>
                    
                     <div class="form-group row">
                        <label class="col-5 control-label">Old Password</label>
                       <div class="col-7"> 
                        <input type="password" class=" col-6 form-control" name="name" value="" placeholder="old password">
                        
                    </div>
                    </div>
                    
                     <div class="form-group row">
                        <label class="col-5 control-label">New Password</label>
                       <div class="col-7"> 
                        <input type="password" class=" col-6 form-control" name="name" value="" placeholder="new password">
                        
                    </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-5 control-label">Confirm Password</label>
                       <div class="col-7"> 
                        <input type="password" class=" col-6 form-control" name="name" value="" placeholder="confirm password">
                        
                    </div>
                    </div>
                    
                  
                   </fieldset> 
                  </div>
                  </div>
                </div>

        <div class="form-group col-12 text-center btm-btn" >
            <button type="submit" class="btn btn-primary  save_user_btn" id="save_user_btn" ><i class="fa fa-save"></i>Update Profile</button>
            <a href="#" class="btn btn-default"><i class="fa fa-undo"></i>Reset</a>
        </div>
     </form>

    </div>

</div>

@endsection

@section('scripts')

@endsection