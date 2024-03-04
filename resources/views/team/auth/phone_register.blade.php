<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title id="app_name"><?php echo @$_COOKIE['meta_title']; ?></title>
    <link rel="icon" id="favicon" type="image/x-icon"
          href="<?php echo str_replace('images/', 'images%2F', @$_COOKIE['favicon']); ?>">


    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/plugins/toast-master/css/jquery.toast.css')}}" rel="stylesheet">

    <link href="{{ asset('css/colors/blue.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet">

<!--  @yield('style')-->

    <?php if(isset($_COOKIE['store_panel_color'])){ ?>
    <style type="text/css">
        a, a:hover, a:focus {
            color: <?php echo $_COOKIE['store_panel_color']; ?>;
        }

        .form-group.default-admin {
            padding: 10px;
            font-size: 14px;
            color: #000;
            font-weight: 600;
            border-radius: 10px;
            box-shadow: 0 0px 6px 0px rgba(0, 0, 0, 0.5);
            margin: 20px 10px 10px 10px;
        }

        .form-group.default-admin .crediantials-field {
            position: relative;
            padding-right: 15px;
            text-align: left;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .form-group.default-admin .crediantials-field > a {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            margin: auto;
            height: 20px;
        }

        .btn-primary, .btn-primary.disabled, .btn-primary:hover, .btn-primary.disabled:hover {
            background: <?php echo $_COOKIE['store_panel_color']; ?>;
            border: 1px solid<?php echo $_COOKIE['store_panel_color']; ?>;
        }

        [type="checkbox"]:checked + label::before {
            border-right: 2px solid<?php echo $_COOKIE['store_panel_color']; ?>;
            border-bottom: 2px solid<?php echo $_COOKIE['store_panel_color']; ?>;
        }

        .form-material .form-control, .form-material .form-control.focus, .form-material .form-control:focus {
            background-image: linear-gradient(<?php echo $_COOKIE['store_panel_color']; ?>, <?php echo $_COOKIE['store_panel_color']; ?>), linear-gradient(rgba(120, 130, 140, 0.13), rgba(120, 130, 140, 0.13));
        }

        .btn-primary.active, .btn-primary:active, .btn-primary:focus, .btn-primary.disabled.active, .btn-primary.disabled:active, .btn-primary.disabled:focus, .btn-primary.active.focus, .btn-primary.active:focus, .btn-primary.active:hover, .btn-primary.focus:active, .btn-primary:active:focus, .btn-primary:active:hover, .open > .dropdown-toggle.btn-primary.focus, .open > .dropdown-toggle.btn-primary:focus, .open > .dropdown-toggle.btn-primary:hover, .btn-primary.focus, .btn-primary:focus, .btn-primary:not(:disabled):not(.disabled).active:focus, .btn-primary:not(:disabled):not(.disabled):active:focus, .show > .btn-primary.dropdown-toggle:focus {
            background: <?php echo $_COOKIE['store_panel_color']; ?>;
            border-color: <?php echo $_COOKIE['store_panel_color']; ?>;
            box-shadow: 0 0 0 0.2rem<?php echo $_COOKIE['store_panel_color']; ?>;
        }

        <?php } ?>
    </style>


</head>

<body>

<?php
$countries = file_get_contents(public_path('countriesdata.json'));
$countries = json_decode($countries);
$countries = (array)$countries;
$newcountries = array();
$newcountriesjs = array();
foreach ($countries as $keycountry => $valuecountry) {
    $newcountries[$valuecountry->phoneCode] = $valuecountry;
    $newcountriesjs[$valuecountry->phoneCode] = $valuecountry->code;
}
?>


<section id="wrapper">

    <?php if(isset($_COOKIE['store_panel_color'])){ ?>

    <div class="login-register" style="background-color:<?php echo $_COOKIE['store_panel_color']; ?>;">
        <?php } else{?>

        <div class="login-register" style="background-color:#FF683A;">
            <?php }?>


            <div class="login-logo text-center py-3" style="margin-top:5%;">

                <a href="#" style="display: inline-block;background: #fff ; padding: 10px;border-radius: 5px;"><img
                        src="{{ asset('images/logo_web.png') }}"> </a>

            </div>

            <div class="login-box card" style="margin-bottom:0%;">


                <div class="card-body">


                    <form class="form-horizontal form-material" name="loginwithphon" id="login-with-phone-box"
                          action="#" >
                        @csrf
                        <div class="box-title m-b-20">{{ trans('lang.sign_up_with_us') }}</div>
                        <div class="form-group" id="firstName_div">

                            <label for="firstName" class="text-dark">{{trans('lang.first_name')}}</label>

                            <input type="text" placeholder="Enter FirstName" class="form-control" id="firstName"
                                   required>
                            <input type="hidden" id="hidden_fName"/>
                        </div>

                        <div class="form-group" id="lastName_div">

                            <label for="lastName" class="text-dark">{{trans('lang.last_name')}}</label>

                            <input type="text" placeholder="Enter LastName" class="form-control" id="lastName" required>
                            <input type="hidden" id="hidden_lName"/>
                        </div>
                        <div class="form-group " id="phone-box">
                            <div class="col-xs-12">
                                <select name="country" id="country_selector">
                                    <?php foreach ($newcountries as $keycy => $valuecy) { ?>
                                    <?php $selected = ""; ?>
                                    <option <?php echo $selected; ?> code="<?php echo $valuecy->code; ?>"
                                            value="<?php echo $keycy; ?>">+<?php echo $valuecy->phoneCode; ?></option>
                                    <?php } ?>
                                </select>
                                <input class="form-control" placeholder="Phone" id="phone" type="phone"
                                       class="form-control" name="phone" value="{{ old('phone') }}" required
                                       autocomplete="phone" autofocus></div>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>

                        <div class="form-group " id="otp-box" style="display:none;">
                            <input class="form-control" placeholder="OTP" id="verificationcode" type="text"
                                   class="form-control" name="otp" value="{{ old('otp') }}" required autocomplete="otp"
                                   autofocus>
                                   <div class="otp_error" >

                                   </div>
                        </div>
                        <div id="recaptcha-container" style="display:none;"></div>

                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button type="button" style="display:none;" onclick="applicationVerifier()"
                                        id="verify_btn"
                                        class="btn btn-dark btn-lg btn-block text-uppercase waves-effect waves-light btn btn-primary">{{ trans('lang.otp_verify') }}</button>
                                <button type="button"  onclick="sendOTP()" id="send-code"
                                        class="btn btn-dark btn-lg btn-block text-uppercase waves-effect waves-light btn btn-primary">{{ trans('lang.otp_send') }}</button>


                            </div>
                        </div>
                    </form>
                    <div class="new-acc d-flex align-items-center justify-content-center mt-4 mb-3">

                        <a href="{{url('login')}}">

                            <p class="text-center m-0">  {{trans('lang.already_an_account')}}  {{trans('lang.sign_in')}}</p>

                        </a>

                    </div>


                </div>

                <!-- </div>

            </div>

        </div> -->

            </div>

        </div>
    </div>

</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>

<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/plugins/select2/dist/js/select2.min.js') }}"></script>

<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>

<script src="{{ asset('js/waves.js') }}"></script>

<script src="{{ asset('js/sidebarmenu.js') }}"></script>

<script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>

<script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

<script src="{{ asset('js/custom.min.js') }}"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-firestore.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-storage.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-auth.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-database.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
<script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>
<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>

<script type="text/javascript">@include('vendor.notifications.init_firebase')</script>

<script type="text/javascript">
var creds = firebase.auth();
console.log(creds);
    var createdAtman = firebase.firestore.Timestamp.fromDate(new Date());
    var createdAt = {_nanoseconds: createdAtman.nanoseconds, _seconds: createdAtman.seconds};

    var database = firebase.firestore();
    var geoFirestore = new GeoFirestore(database);

    var restaurant_active = false;
      var autoAprroveRestaurant = database.collection('settings').doc("restaurant");
    autoAprroveRestaurant.get().then(async function (snapshots) {
        var restaurantdata = snapshots.data();
      if(restaurantdata.auto_approve_restaurant==true){
          restaurant_active =true;
      }
     });




    var newcountriesjs = '<?php echo json_encode($newcountriesjs); ?>';
    var newcountriesjs = JSON.parse(newcountriesjs);

    function formatState(state) {

        if (!state.id) {
            return state.text;
        }
        var baseUrl = "<?php echo URL::to('/');?>/flags/120/";
        var $state = $(
            '<span><img src="' + baseUrl + '/' + newcountriesjs[state.element.value].toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
        );
        return $state;
    }

    function formatState2(state) {
        if (!state.id) {
            return state.text;
        }

        var baseUrl = "<?php echo URL::to('/');?>/flags/120/"
        var $state = $(
            '<span><img class="img-flag" /> <span></span></span>'
        );
        $state.find("span").text(state.text);
        $state.find("img").attr("src", baseUrl + "/" + newcountriesjs[state.element.value].toLowerCase() + ".png");

        return $state;
    }

    jQuery(document).ready(function () {

        jQuery("#country_selector").select2({
            templateResult: formatState,
            templateSelection: formatState2,
            placeholder: "Select Country",
            allowClear: true
        });

        /*setTimeout(function () {

            jQuery("#recaptcha-container").show();

            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                'size': 'invisible',
                'callback': (response) => {

                }
            );
        }, 1000);*/

    });


    function sendOTP(){
      if (!window.recaptchaVerifier) {
      jQuery("#recaptcha-container").show();

      window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
          'size': 'invisible',
          'callback': (response) => {

          }
          });
}

      if (jQuery("#phone").val() && jQuery("#country_selector").val()) {
          var phoneNumber = '+' + jQuery("#country_selector").val() + jQuery("#phone").val();
          var firstName = $('#firstName').val();
          var lastName = $('#lastName').val();

          database.collection("users").where('phoneNumber', '==', phoneNumber).get().then(async function (snapshots) {
              if(snapshots.docs.length>0){
                  alert('You already have account with this phone number')
                  return false;
              }else{
                $('#hidden_fName').val(firstName);
                $('#hidden_lName').val(lastName);


                firebase.auth().signInWithPhoneNumber(phoneNumber, window.recaptchaVerifier)
                    .then(function (confirmationResult) {
                        console.log(confirmationResult);
                        window.confirmationResult = confirmationResult;
                        if (confirmationResult.verificationId) {
                            console.log("confirmationResult.verificationId " + confirmationResult.verificationId);
                            $('#firstName_div').hide();
                            $('#lastName_div').hide();

                            $('#phone-box').hide();


                            jQuery("#recaptcha-container").hide();
                            jQuery("#verify_btn").show();
                            jQuery("#otp-box").show();
                        }
                    });
              }
          })


    }
  }

    function applicationVerifier() {
      var code=$('#verificationcode').val();
      console.log(code);
      if(code==""){
              $('.otp_error').html('Please Enter OTP')
      }else{
      window.confirmationResult.confirm(document.getElementById("verificationcode").value)
          .then( async function (result) {
              console.log(result.user);
              var phoneNumber=result.user.phoneNumber;
              var firstName=$('#hidden_fName').val();
              var lastName=$('#hidden_lName').val();

              var password="";

              var uuid = result.user.uid;

              var restaurant_id = database.collection("tmp").doc().id;
              database.collection("users").doc(uuid).set({
                  'email': "",
                  'firstName': firstName,
                  'lastName': lastName,
                  'id': uuid,
                  'phoneNumber': phoneNumber,
                  'role': "vendor",
                  'profilePictureURL': "",
                  'vendorID': restaurant_id,
                  'active': restaurant_active,
                  'createdAt': createdAt
              }).then(() => {

                database.collection('vendors').doc(restaurant_id).set({
                    'title': "",
                    'description': "",
                    'latitude': "",
                    'longitude': "",
                    'location': "",
                    'photo': "",
                    'categoryID': "",
                    'phonenumber': phoneNumber,
                    'categoryTitle': "",
                    'coordinates': "",
                    'id': restaurant_id,
                    'filters': "",
                    'photos': "",
                    'author': uuid,
                    'authorName': firstName+ " "+lastName,
                    'authorProfilePic': "",
                    'reststatus': false,
                    hidephotos: false,
                    createdAt: createdAt,
                    'enabledDiveInFuture': false,
                    'restaurantMenuPhotos': "",
                    'restaurantCost': "",
                    'openDineTime': "",
                    'closeDineTime': "",
                    'workingHours': "",
                    'specialDiscount': ""
                }).then(function (result) {

                autoAprroveRestaurant.get().then(async function (snapshots) {
                        var restaurantdata = snapshots.data();
                    if(restaurantdata.auto_approve_restaurant==false){
                        $(".alert-success").show();
                        $(".alert-success").html("");
                        $(".alert-success").append("<p>{{trans('lang.signup_waiting_approval')}}</p>");
                        window.scrollTo(0, 0);
                        setTimeout(function(){
                            window.location.href = '{{ route("login")}}';
                        }, 5000);
                     }

                    else{
                        $(".alert-success").show();
                        $(".alert-success").html("");
                        $(".alert-success").append("<p>{{trans('lang.thank_you_signup_msg')}}</p>");
                        window.scrollTo(0, 0);
                        setTimeout(function(){
                            window.location.href = '{{ route("login")}}';
                        }, 5000);
                    }
                  });

            }).catch((error) => {

                  console.error("Error writing document: ", error);
                  $("#field_error").html(error);

              });
          });


      }).catch((error)=>{
        console.error("OTP verification failed ", error);
        $(".otp_error").html("OTP verification failed");
      });
    }
  }



</script>
