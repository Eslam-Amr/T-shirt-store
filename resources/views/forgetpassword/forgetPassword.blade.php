@include('layout.header')
@include('layout.navbar')
@include('layout.breadcrumb', ['name' => 'login '])
<section class="login_part padding_top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2>New to our Shop?</h2>
                        <p>There are advances being made in science and technology
                            everyday, and a good example of this is the</p>
                        {{-- <a href="{{ route('register.index') }}" class="btn_3">Create an Account</a> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3>Welcome Back ! <br>
                            Please Sign in now</h3>
                        @if (session()->has('message'))
                            <div class="alert alert-danger" id="alert">

                                {{ session()->get('message') }}
                            </div>
                            <script type="text/javascript">
                                document.ready(setTimeout(function() {
                                    document.getElementById('alert').remove()
                                }, 3000))
                            </script>
                        @endif
                        <div class="" id="error-messages">
                            @error('email')
                                {{ $message }}
                                <br>
                            @enderror


                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var errorMessages = document.getElementById('error-messages');

                                // Check if the error messages div exists
                                if (errorMessages) {
                                    // Check if there are error messages
                                    var hasErrors = errorMessages.innerText.trim() !== "";

                                    // Add the alert classes if there are errors
                                    if (hasErrors) {
                                        errorMessages.classList.add('alert', 'alert-danger', 'p-2', 'mb-3');

                                        // Hide the error messages after 3 seconds
                                        setTimeout(function() {
                                            errorMessages.style.display = 'none';
                                        }, 3000); // 3000 milliseconds = 3 seconds
                                    }
                                }
                            });
                        </script>

                        {{-- <script>
                                    // Wait for the DOM to be fully loaded
                                    document.addEventListener('DOMContentLoaded', function () {
                                        // Select the error messages div
                                        var errorMessages = document.getElementById('error-messages');

                                        // Check if the error messages div exists

                                        if (errorMessages) {
                                            // Hide the error messages after 3 seconds
                                            setTimeout(function () {
                                                errorMessages.style.display = 'none';
                                            }, 3000); // 3000 milliseconds = 3 seconds
                                        }
                                    });
                                </script> --}}
                        {{-- <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        var errorMessages = document.getElementById('error-messages');

                                        // Check if the error messages div exists and contains any error messages
                                        if (errorMessages && errorMessages.innerText.trim() !== "") {
                                            // Hide the error messages after 3 seconds
                                            setTimeout(function () {
                                                errorMessages.style.display = 'none';
                                            }, 3000); // 3000 milliseconds = 3 seconds
                                        }
                                    });
                                </script> --}}

                        <form class="row contact_form" action="{{ route('submit.forgot.password') }}" method="post">
                            @csrf
                            <div class="col-md-12 form-group p_star">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="email">
                            </div>

                            <button type="submit" value="submit" class="btn_3">
                                log in
                            </button>
                            {{-- <div class="col-md-12 form-group">
                                    <div class="creat_account d-flex align-items-center">
                                        <input type="checkbox" id="f-option" name="selector">
                                        <label for="f-option">Remember me</label>
                                    </div>
                                    <button type="submit" value="submit" class="btn_3">
                                        log in
                                    </button>
                                </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layout.footer')
