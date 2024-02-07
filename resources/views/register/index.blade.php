@include('layout.header')
@include('layout.navbar')
@include('layout.breadcrumb', ['name' => 'register'])
<!-- breadcrumb start-->

<!--================login_part Area =================-->
<section class="login_part padding_top">
    <div class="container text-center">
        @if (session()->has('message'))
            <div class="alert alert-success" id="alert">

                {{ session()->get('message') }}
            </div>
            <script type="text/javascript">
                document.ready(setTimeout(function() {
                    document.getElementById('alert').remove()
                }, 5000))
            </script>
        @endif

        <div class="row align-items-center">
            {{-- <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <h2>New to our Shop?</h2>
                            <p>There are advances being made in science and technology
                                everyday, and a good example of this is the</p>
                            <a href="#" class="btn_3">Create an Account</a>
                        </div>
                    </div>
                </div> --}}
            <div class="col-lg-12 col-md-12">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3>Welcome Back ! <br>
                            Please Sign in now</h3>
                        <form class="row contact_form" enctype="multipart/form-data" action="{{ route('register.auth') }}"
                            method="post" novalidate="novalidate">
                            @csrf
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="name" value="{{ old('name') }}">
                            </div>

                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="name" name="email"
                                    placeholder="email">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="phone">
                            </div>
                            <div class="col-md-12 form-group p_star float-left">
                                <label for="exampleFormControlTextarea6" class="form-label">insert image</label>
                                <input type="file" name="image" class="form-control"
                                    id="exampleFormControlTextarea6">
                            </div>
                            <div class="col-md-12 form-group p_star float-left justify-content-end">
                                <label for="male">Male</label>
                                <input type="radio" id="male" name="gender" value="male">

                                <label for="female">Female</label>
                                <input type="radio" id="female" name="gender" value="female">

                            </div>
                            <div class="col-md-4 form-group">
                                <a href="{{ route('login.index') }}" class="btn_3">alredy have account ? </a>
                            </div>
                            <div class="col-md-8 form-group">
                                {{-- <div class="creat_account d-flex align-items-center">
                                        <input type="checkbox" id="f-option" name="selector">
                                        <label for="f-option">Remember me</label>
                                    </div> --}}
                                <button type="submit" value="submit" class="btn_3">
                                    register
                                </button>
                                {{-- <a class="lost_pass" href="#">forget password?</a> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================login_part end =================-->
@include('layout.footer')
