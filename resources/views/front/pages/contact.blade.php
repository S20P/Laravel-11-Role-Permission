@extends('layouts.app')
@section('content')

<style>
  .error{
    color: red
  }
</style>

<section class="page-title bg-2">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
            <ul class="list-inline mb-0">
              <li class="list-inline-item"><a href="index.html" class="text-sm letter-spacing text-white text-uppercase font-weight-bold">Home</a></li>
              <li class="list-inline-item"><span class="text-white">|</span></li>
              <li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">contact</a></li>
            </ul>
             <h1 class="text-lg text-white mt-2">Contact Us</h1>
        </div>
      </div>
    </div>
  </section>

<!-- contact form start -->
<section class="contact-form section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <div class="section-title">
            <div class="divider mb-3"></div>
            <h2>Contact Us</h2>
            <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. In error reprehenderit
              quam enim obcaecati, repudiandae officia a cumque nemo provident!</p>
          </div>
        </div>
      </div>
  
      <div class="row justify-content-center pb-5">
        <div class="col-lg-9 text-center">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <form action="{{ route('front.contact.save') }}" method="POST"  id="contact-form">
                @csrf
            <div class="form-row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                  <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" value="{{ old('name') }}">
                  @if ($errors->has('name'))
                  <span class="text-light error">{{ $errors->first('name') }}</span>
                  @endif
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                  <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address"  value="{{ old('email') }}">
                  @if ($errors->has('email'))
                  <span class="text-light error">{{ $errors->first('email') }}</span>
                  @endif
                </div>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                  <input name="subject" type="text" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject"  value="{{ old('subject') }}">
                  @if ($errors->has('subject'))
                  <span class="text-light error">{{ $errors->first('subject') }}</span>
                  @endif
                </div>
              </div>
  
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="form-group-2">
                  <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="8" placeholder="Your Message"  value="{{ old('message') }}">{{ old('message') }}</textarea>
                  @if ($errors->has('message'))
                  <span class="text-light error">{{ $errors->first('message') }}</span>
                  @endif
                </div>
  
                <div class="text-center">
                  <button class="btn btn-main mt-3 " type="submit">Send Message</button>
                </div>
              </div>
            </div>
            <div class="error" id="error">Sorry Msg dose not sent</div>
            <div class="success" id="success">Message Sent</div>
          </form>
        </div>
      </div>
    </div>
  
    <div class="google-map position-relative mt-5">
      <div class="map" id="map_canvas" data-latitude="51.507351" data-longitude="-0.127758"
        data-marker="images/marker.png"></div>
    </div>
  
    <div class="container mt--170">
      <div class="row">
        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
          <div class="card rounded-0 border-0 shadow-sm text-center py-5 px-4 contact-info">
            <i class="ti-mobile mb-3 text-lg text-color"></i>
            <span>Call us</span>
            <p class="lead text-black mb-0 mt-3">+75 7494 5107</p>
            <p class="lead">9:00 am - 8:00 pm</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
          <div class="card rounded-0 border-0 shadow-sm text-center py-5 px-4 contact-info">
            <i class="ti-email mb-3 text-lg text-color"></i>
            <span>Email at</span>
            <p class="lead text-black mt-3 mb-0">satish6073@gmail.com</p>
            <p class="lead text-black ">satish6073@gmail.com</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
          <div class="card rounded-0 border-0 shadow-sm text-center py-5 px-4 contact-info">
            <i class="ti-home mb-3 text-lg text-color"></i>
            <span>Location</span>
            <p class="lead text-black mt-3">Fitness Center Bedford Heights,North London, USA</p>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')

   <!--  Magnific Popup-->
   <script src="{{ asset('plugins/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>
   <!-- Form Validator -->
   <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.32/jquery.form.js"></script>
   <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js"></script>

  <!-- Google Map -->
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu5nZKbeK-WHQ70oqOWo-_4VmwOwKP9YQ"></script>
     <script src="{{ asset('plugins/google-map/gmap.js')}}"></script>

     <script>
    
	$('#contact-form').validate({
		rules: {
			name: {
				required: true,
				minlength: 4
			},
			email: {
				required: true,
				email: true
			},
			subject: {
				required: false
			},
			message: {
				required: true
			}
		},
		messages: {
			name: {
				required: 'Come on, you have a name don\'t you?',
				minlength: 'Your name must consist of at least 2 characters'
			},
			email: {
				required: 'Please put your email address'
			},
      subject: {
				required: 'Please put your subject'
			},
			message: {
				required: 'Put some messages here?',
				minlength: 'Your name must consist of at least 2 characters'
			}
		},
		submitHandler: function (form) {
      form.submit();
			// $(form).ajaxSubmit({
			// 	type: 'POST',
			// 	data: $(form).serialize(),
			// 	url: '{{route("front.contact.save")}}',
			// 	success: function () {
			// 		$('#contact-form #success').fadeIn();
			// 	},
			// 	error: function () {
			// 		$('#contact-form #error').fadeIn();
			// 	}
			// });
		}
	});

     </script>
@endpush