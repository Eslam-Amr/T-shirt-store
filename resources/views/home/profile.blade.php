@include('layout.header')
@include('layout.navbar')
@include('layout.breadcrumb', ['name' => 'profile '])
    <div class="container mt-4">

        <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="{{ route('update.profile') }}" >
       @csrf
            <div class="row">
        <div class="col-md-4 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                @php($profile_image = auth()->user()->profile_image)
                {{-- <img class="rounded-circle mt-5" height="250" width="250" src="@if($profile_image == null) {{ asset("uplode/Registered/profile_images/avatar.png") }}  @else {{ asset("uplode/Registered/"){{ $profile_image }} }} @endif" id="image_preview_container"> --}}
   {{-- @dd(auth()->user()) --}}

                <img class="rounded-circle mt-5"   style="border: 50px white solid; width: 700px; transform: translate(-25%)"
                src="@if($profile_image == null &&  auth()->user()->gender == 'male') {{ asset("uplode").'/Registered/avatarMale.jpg' }}
                @elseif($profile_image == null &&  auth()->user()->gender == 'female') {{ asset("uplode").'/Registered/avatarFemale.jpg' }}
                @else {{asset('uplode')}}/Registered/{{ $profile_image }}  @endif"
                {{-- src="{{asset('uplode')}}/Registered/{{ $profile_image }}"  --}}
                 alt="">

                <span class="font-weight-bold">
                    <input type="file" name="profile_image" id="profile_image"  class="form-control">
                </span>
            </div>
        </div>
        <div class="col-md-8 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row" id="res"></div>
                <div class="row mt-2">

                    <div class="col-md-6">
                        <label class="labels">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="first name" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Email</label>
                        <input type="text"  disabled class="form-control" value="{{ auth()->user()->email }}" placeholder="Email">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ auth()->user()->phone }}">
                    </div>
                    {{-- <div class="col-md-6">
                        <label class="labels">Address</label>
                        <input type="text" name="address" class="form-control" value="{{ auth()->user()->address }}" placeholder="Address">
                    </div> --}}
                </div>

                <div class="mt-5 text-center"><button id="btn" class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
            </div>
        </div>

    </div>

        </form>
    </div>
 <script>

     $(document).ready(function(){

         // image preview
         $("#profile_image").change(function(){
             let reader = new FileReader();

             reader.onload = (e) => {
                 $("#image_preview_container").attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            })

            $("#profile_setup_frm").submit(function(e){
                e.preventDefault();

                var formData = new FormData(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $("#btn").attr("disabled", true);
                $("#btn").html("Updating...");
                $.ajax({
                    type:"POST",
                    url: this.action,
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        if (response.code == 400) {
                            let error = '<span class="alert alert-danger">'+response.msg+'</span>';
                            $("#res").html(error);
                            $("#btn").attr("disabled", false);
                            $("#btn").html("Save Profile");
                        }else if(response.code == 200){
                            let success = '<span class="alert alert-success">'+response.msg+'</span>';
                            $("#res").html(success);
                            $("#btn").attr("disabled", false);
                            $("#btn").html("Save Profile");
                        }
                    }
                })
            })
        })
        </script>
        @include('layout.footer')
