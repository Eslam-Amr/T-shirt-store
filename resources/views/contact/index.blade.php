@include('layout.header')
@include('layout.navbar')
@include('layout.breadcrumb', ['name' => 'contact us '])
  <section class="contact-section padding_top">
    <div class="container">
      {{-- @if (session()->has('message'))
      <div class="alert alert-danger" id="alert">

          {{ session()->get('message') }}
      </div>
      <script type="text/javascript">
          document.ready(setTimeout(function() {
              document.getElementById('alert').remove()
          }, 3000))
      </script>
      
      @endif --}}
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
      
  <div class="" id="error-messages">
    @error('email')
    {{ $message }}
    <br>
    @enderror
    
    @error('name')
    {{ $message }}
    @enderror
    <br>
    @error('message')
    {{ $message }}
    @enderror
  </div>
  
  @if(session()->has('message'))
  <div class="alert alert-success" id="alert">
  
      {{ session()->get('message') }}
  </div>
      <script type="text/javascript">
      document.ready(setTimeout(function(){
          document.getElementById('alert').remove()
      },3000))
      </script>
  @endif
      {{-- <div class="d-none d-sm-block mb-5 pb-4">
        <div id="map" style="height: 480px;"></div>
        <script>
          function initMap() {
            var uluru = {
              lat: -25.363,
              lng: 131.044
            };
            var grayStyles = [{
                featureType: "all",
                stylers: [{
                    saturation: -90
                  },
                  {
                    lightness: 50
                  }
                ]
              },
              {
                elementType: 'labels.text.fill',
                stylers: [{
                  color: '#ccdee9'
                }]
              }
            ];
            var map = new google.maps.Map(document.getElementById('map'), {
              center: {
                lat: -31.197,
                lng: 150.744
              },
              zoom: 9,
              styles: grayStyles,
              scrollwheel: false
            });
          }
        </script>
        <script
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&callback=initMap">
        </script>

      </div> --}}


      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">Get in Touch</h2>
        </div>
        <div class="col-lg-12">
          <form class=" " action="{{ route('contact.send') }}" method="post" id="">
            @csrf
            <div class="row">
              <div class="col-sm-6">
                <div>
                  <input class="form-control" name="name"  type="text" 
                   placeholder='Enter your name'>
                </div>
              </div>
              <div class="col-sm-6">
                <div>
                  <input class="form-control" name="email"  type="email" 
                   placeholder='Enter email address'>
                </div>
              </div>
              <div class="col-12 mt-3">
                <div>

                  <textarea class="form-control w-100" name="message"  cols="30" rows="9"
                    
                    placeholder='Enter Message'></textarea>
                </div>
              </div>
              {{-- <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Enter Subject'" placeholder='Enter Subject'>
                </div>
              </div> --}}
            </div>
            <div class="form-group mt-3">
              {{-- <a href="#" class="btn_3 button-contactForm">Send Message</a> --}}
              <input type="submit" class="btn_3 button-contactForm" value="Send Message">
            </div>
          </form>
        </div>
        {{-- <div class="col-lg-4">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
              <h3>Buttonwood, California.</h3>
              <p>Rosemead, CA 91770</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
            <div class="media-body">
              <h3>00 (440) 9865 562</h3>
              <p>Mon to Fri 9am to 6pm</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
              <h3>support@colorlib.com</h3>
              <p>Send us your query anytime!</p>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->

  <!--::footer_part start::-->
  @include('layout.footer')