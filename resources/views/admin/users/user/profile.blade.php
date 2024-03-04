@extends('admin.layouts.app')

@section('content')

<div class="page-wrapper">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">{{trans('lang.user_profile')}}</h3>
		</div>

		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
				<li class="breadcrumb-item"><a href= "" > Profile</a></li>
				<li class="breadcrumb-item active">Edit Profile</li>
			</ol>
		</div>

</div>

 <div class="profile-form">
    <div class="card-body">
        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>

        <div class="column">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="post" action="{{ route('admin.users.profile.update',['id'=>$user->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row restaurant_payout_create">
                    <div class="twPc-div">
                        <div class="container">
                            <div class="twPc-divUser">
                                <div class="twPc-divName">
                                    <a href="#">{{ $user->name }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row restaurant_payout_create">
                    <div class="restaurant_payout_create-inner">
                        <fieldset>
                            <!-- Your form fields -->

                            <div class="form-group row">
                                <label class="col-5 control-label">{{ trans('lang.name') }}</label>
                                <div class="col-7">
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $user->name }}" placeholder="Full name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-5 control-label">Email</label>
                                <div class="col-7">
                                    <input type="text" class="form-control" name="email"
                                        value="{{ $user->email }}" placeholder="email address" readonly>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="form-group col-12 text-center btm-btn">
                    <button type="submit" class="btn btn-primary save_user_btn" id="save_user_btn"><i
                            class="fa fa-save"></i> Update Profile</button>
                    <a href="#" class="btn btn-default"><i class="fa fa-undo"></i> Reset</a>
                </div>
            </form>
        </div>
    </div>
</div>


    </div>

</div>


@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var profileImageInput = document.getElementById('profileImageInput');
            var profileImagePreview = document.getElementById('profileImagePreview');

            profileImageInput.addEventListener('change', function () {
                if (profileImageInput.files && profileImageInput.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        profileImagePreview.src = e.target.result;
                    }

                    reader.readAsDataURL(profileImageInput.files[0]);
                }
            });
        });
    </script>
@endsection

@endsection

@section('scripts')

@endsection