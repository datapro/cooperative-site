@include('inc.head')
{{-- <section class="page-header">
    <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg-1-1.jpg);"></div>
    <!-- /.page-header__bg -->
    <div class="container">
        <div class="page-header__content">
            <h2 class="page-header__title">Log in</h2>
            <ul class="easilon-breadcrumb list-unstyled">
                <li><a href="{{route('index')}}">Home</a></li>
                <li><span>Log In</span></li>
            </ul><!-- /.thm-breadcrumb list-unstyled -->
        </div><!-- /.page-header__content -->
    </div><!-- /.container -->
    <div class="page-header__border-box">
        <div class="page-header__border page-header__border--1"></div><!-- /.page-header__border -->
        <div class="page-header__border page-header__border--2"></div><!-- /.page-header__border -->
        <div class="page-header__border page-header__border--3"></div><!-- /.page-header__border -->
        <div class="page-header__border page-header__border--4"></div><!-- /.page-header__border -->
        <div class="page-header__border page-header__border--5"></div><!-- /.page-header__border -->
    </div><!-- /.page-header__border-box -->
</section><!-- /.page-header --> --}}

<section class="login-page section-space">
    <div class="container">
        <div class="row gutter-y-80">
            <div class="col-xl-6 wow fadeInLeft" data-wow-duration="1500ms">
                <div class="login-page__image">
                    <div class="login-page__image__inner">
                        <h1 style="font-weight: bold;text-align:center;">NASU CO-OPERATIVE FUOYE CHAPTER</h1>
                        <img src="assets/images/nasulogo.jpeg" alt="login" style="border-radius:50px;">
                    </div><!-- /.login-page__image__inner -->
                </div><!-- /.login-page__image -->
            </div><!-- /.col-xl-6 -->
            <div class="col-xl-6 wow fadeInRight fadeInRight" data-wow-duration="1500ms">
                <div class="login-page__wrap login-page__main-tab-box tabs-box">
                    <div class="login-page__wrap__bg" style="background-image: url('assets/images/shapes/login-bg-1.png');"></div>
                    <!-- /.login-page__wrap__bg -->
                    <div class="login-page__wrap__top">
                        <div class="login-page__wrap__content">
                            <h3 class="login-page__wrap__title">welcome</h3>
                        </div><!-- /.login-page__wrap__content -->
                        <ul class="tab-buttons">
                            <li data-tab="#login" class="easilon-btn easilon-btn--white tab-btn active-btn"><span>log
                                    in</span></li>
                            <li data-tab="#register" class="easilon-btn easilon-btn--white tab-btn">
                                <span>register</span>
                            </li>
                        </ul><!-- /.tab-buttons -->
                    </div><!-- /.login-page__wrap__top -->
                    <div class="tabs-content">
                        <div class="tab active-tab fadeInUp animated" data-wow-delay="200ms" id="login" style="display: block;">
                            <span class="login-page__tab-title">sign in your account</span>
                            <form class="login-page__form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="login-page__form__input-box">
                                    <input type="email" placeholder="Your Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <span class="login-page__form__icon">
                                        <i class="icon-mail-2"></i>
                                    </span><!-- /.login-page__form__icon -->
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div><!-- /.login-page__form__input-box -->

                                <div class="login-page__form__input-box">
                                    <input type="password" placeholder="Password" class="login-page__password" name="password" required autocomplete="current-password">
                                    <span class="login-page__form__icon">
                                        <i class="icon-padlock"></i>
                                    </span><!-- /.login-page__form__icon -->
                                    <i class="toggle-password pass-field-icon fa fa-fw fa-eye-slash"></i>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div><!-- /.login-page__form__input-box -->

                                <div class="login-page__form__input-box login-page__form__input-box--bottom">
                                    <div class="login-page__form__checked-box">
                                        <input type="checkbox" name="remember-policy" id="remember-policy" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember-policy"><span></span>remember me</label>
                                    </div>
                                    @if (Route::has('password.request'))
                                    <a class="login-page__form__forgot" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                    <!-- /.login-page__form__forgot -->
                                </div><!-- /.login-page__form__input-box -->
                                <div class="login-page__form__input-box login-page__form__input-box--button">
                                    <button type="submit" class="easilon-btn login-page__form__btn">
                                        <span>login</span>

                                    </button>
                                </div><!-- /.login-page__form__button -->
                            </form><!-- /.login-page__form -->
                            <div class="login-page__signin">
                                <h4 class="login-page__signin__title">don’t have an account? <a href="#">register</a>
                                </h4><!-- /.login-page__signin__title -->
                                <span class="login-page__signin__text">or sign in with</span>
                                <!-- /.login-page__signin__text -->
                                <div class="login-page__signin__buttons">
                                    <button type="button" class="login-page__signin__btn"><img src="assets/images/shapes/google.png" alt="google"></button>
                                    <button type="button" class="login-page__signin__btn"><img src="assets/images/shapes/apple.png" alt="apple"></button>
                                    <button type="button" class="login-page__signin__btn"><img src="assets/images/shapes/facebook.png" alt="facebook"></button>
                                </div><!-- /.login-page__signin__buttons -->
                            </div><!-- /.login-page__signin -->
                        </div><!-- /.login-tab -->

                        <div class="tab fadeInUp animated" data-wow-delay="200ms" id="register" style="display: none;">
                            <span class="login-page__tab-title">sign up your account</span>
                            <form class="login-page__form" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @include('flash.messages')
                                <div class="login-page__form__input-box">
                                    <input type="text" placeholder="Name" name="name" >
                                    <span class="login-page__form__icon">
                                    </span><!-- /.login-page__form__icon -->
                                </div><!-- /.login-page__form__input-box -->
                                <div class="login-page__form__input-box">
                                    <input type="text" placeholder="Occupation" name="occupation" >
                                    <span class="login-page__form__icon">
                                    </span><!-- /.login-page__form__icon -->
                                </div><!-- /.login-page__form__input-box -->
                                <div class="login-page__form__input-box">
                                    <input type="text" placeholder="Contact number here" name="phone">
                                    <span class="login-page__form__icon">
                                    </span><!-- /.login-page__form__icon -->
                                </div><!-- /.login-page__form__input-box -->
                                <div class="login-page__form__input-box">
                                    <input type="text" placeholder="Department" name="department">
                                    <span class="login-page__form__icon">
                                    </span><!-- /.login-page__form__icon -->
                                </div><!-- /.login-page__form__input-box -->
                                <div class="login-page__form__input-box">
                                    <textarea  placeholder="Address Here:" cols="60" rows="3" name="address"></textarea>
                                    </span><!-- /.login-page__form__icon -->
                                </div><!-- /.login-page__form__input-box -->
                                <div class="login-page__form__input-box">
                                    <input type="text" placeholder="Membership Number | Staff ID" name="membership_no">
                                    <span class="login-page__form__icon">
                                    </span><!-- /.login-page__form__icon -->
                                </div><!-- /.login-page__form__input-box -->
                                <div class="login-page__form__input-box">
                                   <select  id="" name="status" >
                                    <option value="active">Active</option>
                                    {{-- <option value="Inactive">In-Active</option> --}}
                                   </select>
                                    <!-- /.login-page__form__icon -->
                                </div><!-- /.login-page__form__input-box -->

                                <div class="login-page__form__input-box">
                                    <input type="email" placeholder="Email" name="email">
                                    <span class="login-page__form__icon">
                                        <i class="icon-mail-2"></i>
                                    </span><!-- /.login-page__form__icon -->

                                </div><!-- /.login-page__form__input-box -->

                                <div class="login-page__form__input-box">
                                    <input type="password" placeholder="Password" class="login-page__password" name="password">
                                    <span class="login-page__form__icon">
                                        <i class="icon-padlock"></i>
                                    </span><!-- /.login-page__form__icon -->
                                    <i class="toggle-password pass-field-icon fa fa-fw fa-eye-slash"></i>


                                </div><!-- /.login-page__form__input-box -->

                                <div class="login-page__form__input-box">
                                    <input type="password" placeholder="Confirme Password" class="login-page__password" name="password_confirmation" required autocomplete="new-password">
                                    <span class="login-page__form__icon">
                                        <i class="icon-padlock"></i>
                                    </span><!-- /.login-page__form__icon -->
                                    <i class="toggle-password pass-field-icon fa fa-fw fa-eye-slash"></i>
                                </div><!-- /.login-page__form__input-box -->

                                <div class="login-page__form__input-box login-page__form__input-box--bottom">
                                    <div class="login-page__form__checked-box">
                                        <label for="accept-policy"><span></span>Please upload a passport(optional)</label>
                                        <input type="file" name="passport" id="accept-policy">
                                    </div>
                                </div>


                                <!-- /.login-page__form__input-box -->
                                <div class="login-page__form__input-box login-page__form__input-box--button">
                                    <button type="submit" class="easilon-btn login-page__form__btn"><span>Register</span></button>
                                </div><!-- /.login-page__form__button -->
                            </form><!-- /.login-page__form -->
                            <div class="login-page__signin">
                                <h4 class="login-page__signin__title">Already have an account? <a href="{{route('userlogin')}}">Sign In</a>
                                </h4><!-- /.login-page__signin__title -->
                                <span class="login-page__signin__text">or sign in with</span>
                                <!-- /.login-page__signin__text -->
                                <div class="login-page__signin__buttons">
                                    <button type="button" class="login-page__signin__btn"><img src="assets/images/shapes/google.png" alt="google"></button>
                                    <button type="button" class="login-page__signin__btn"><img src="assets/images/shapes/apple.png" alt="apple"></button>
                                    <button type="button" class="login-page__signin__btn"><img src="assets/images/shapes/facebook.png" alt="facebook"></button>
                                </div><!-- /.login-page__signin__buttons -->
                            </div><!-- /.login-page__signin -->
                        </div><!-- /.register-tab -->
                    </div><!-- /.tab-content -->
                    <div class="login-page__top-shape">
                        <div class="login-page__top-shape__one"></div><!-- /.login-page__top-shape__one -->
                        <div class="login-page__top-shape__two"></div><!-- /.login-page__top-shape__two -->
                    </div><!-- /.login-page__top-shape -->
                    <div class="login-page__bottom-shape">
                        <div class="login-page__bottom-shape__one"></div><!-- /.login-page__bottom-shape__one -->
                        <div class="login-page__bottom-shape__two"></div><!-- /.login-page__bottom-shape__two -->
                    </div><!-- /.login-page__bottom-shape -->
                </div><!-- /.login-page__main-tab-box -->
            </div><!-- /.col-xl-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.login-page section-space -->


<script src="{{asset('assets/vendors/jquery/jquery-3.7.0.min.js')}}"></script>
<script src="{{asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendors/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script src="{{asset('assets/vendors/jarallax/jarallax.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-ui/jquery-ui.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-appear/jquery.appear.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-validate/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/vendors/nouislider/nouislider.min.js')}}"></script>
<script src="{{asset('assets/vendors/tiny-slider/tiny-slider.js')}}"></script>
<script src="{{asset('assets/vendors/wnumb/wNumb.min.js')}}"></script>
<script src="{{asset('assets/vendors/owl-carousel/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/vendors/slick/slick.min.js')}}"></script>
<script src="{{asset('assets/vendors/wow/wow.js')}}"></script>
<script src="{{asset('assets/vendors/imagesloaded/imagesloaded.min.js')}}"></script>
<script src="{{asset('assets/vendors/isotope/isotope.js')}}"></script>
<script src="{{asset('assets/vendors/countdown/countdown.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-circleType/jquery.circleType.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-lettering/jquery.lettering.min.js')}}"></script>
<!-- template js -->
<script src="{{asset('assets/js/easilon.js')}}"></script>

