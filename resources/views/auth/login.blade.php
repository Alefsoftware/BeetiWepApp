@extends('front.layouts.main')

@section('content')
         <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <img class="border-radius-15" src="{{asset('front/assets/imgs/page/login-1.png')}}" alt="" />
                            </div>
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">{{__('Login')}}</h1>
                                            <p class="mb-30">{{__("Don't have an account?")}} <a href="{{url('register')}}">{{__('Create here')}}</a></p>
                                        </div>
                                        <form method="POST" action="{{ route('client.login') }}">
                                                @csrf
                                         <div class="form-group">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Username or Email *" >

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                 </div>
                                            <div class="form-group">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Your password *" >

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                            {{-- <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <input type="text" required="" name="s" placeholder="Security code *" />
                                                </div>
                                                @php $FourDigitRandomNumber = mt_rand(1111,9999);
                                                $resultArray = str_split($FourDigitRandomNumber);
                                                @endphp
                                                <span class="security-code">

                                                    <b class="text-new"><?php echo $resultArray[0];?></b>
                                                    <b class="text-hot"><?php echo $resultArray[1];?></b>
                                                    <b class="text-sale"><?php echo$resultArray[2];?></b>
                                                    <b class="text-best"><?php echo$resultArray[3];?></b>
                                                </span>
                                            </div>
                                            <input type="hidden" value="{{$FourDigitRandomNumber}}"> --}}

                                            {{-- <div class="login_footer form-group mb-50">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="" />
                                                        <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                                    </div>
                                                </div>
                                                <a class="text-muted" href="#">Forgot password?</a>
                                            </div> --}}
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-heading btn-block hover-up" name="login">Log in</button>
                                            </div>
                                            <hr>
                                            <div class="mobile-social-icon">
                                                <h6 class="mb-5">Or Login With</h6>

                                            <a href="{{url('auth/facebook')}}" > <img src="{{asset('front/assets/imgs/theme/icons/icon-facebook-white.svg')}}" alt="Facebook" style="max-width: 100%;     background-color: rebeccapurple;"> </a>
                                            <a href="{{url('auth/google')}}" ><img src="{{asset('front/assets/imgs/theme/icons/logo-google.svg')}}" alt="Facebook" style="max-width: 100%;"></a>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   @endsection
