    <div class="topbar">
        <div class="container-fluid">
            <div class="topbar__inner">
                <ul class="list-unstyled topbar__info">
                    <li>
                        <span class="topbar__info__icon">
                            <i class="icon-mail-1"></i>
                        </span>
                        <a href="mailto:datapro2014@gmail.com">datapro2014@gmail.com</a>
                    </li>
                    <li>
                        <span class="topbar__info__icon topbar__info__icon--phone">
                            <i class="icon-headset"></i>
                        </span>
                        <a href="tel:16205">+2347032446095</a>
                    </li>
                </ul><!-- /.list-unstyled topbar__info -->
                <div class="topbar__right">
                    <ul class="list-unstyled topbar__pages">
                        <li><a href="{{route('userlogin')}}">log in</a></li>
                        <li><a href="{{route('about')}}">career</a></li>
                        {{-- <li><a href="{{route('/about')}}">media</a></li> --}}
                        {{-- <li><a href="faq.html">Faq’s</a></li> --}}
                    </ul><!-- /.topbar__pages -->
                    <div class="topbar__social">
                        <a href="https://facebook.com/">
                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                            <span class="sr-only">Facebook</span>
                        </a>
                        <a href="https://twitter.com/">
                            <i class="fab fa-twitter" aria-hidden="true"></i>
                            <span class="sr-only">Twitter</span>
                        </a>
                        <a href="https://linkedin.com/">
                            <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                            <span class="sr-only">Linkedin</span>
                        </a>
                        <a href="https://youtube.com/">
                            <i class="fab fa-youtube" aria-hidden="true"></i>
                            <span class="sr-only">Youtube</span>
                        </a>
                    </div><!-- /.topbar__social -->
                </div><!-- /.list-unstyled topbar__right -->
            </div><!-- /.topbar__inner -->
        </div><!-- /.container-fluid -->
    </div><!-- /.topbar -->

    <header class="main-header sticky-header sticky-header--normal">
        <div class="container-fluid">
            <div class="main-header__inner">
                <div class="main-header__logo logo-retina">
                    <a href="index.html">
                        <img src="{{asset('assets/images/logonh.png')}}" alt="Corporative Site" width="400">
                    </a>
                </div><!-- /.main-header__logo -->
                <div class="main-header__right">
                    <nav class="main-header__nav main-menu">
                        <ul class="main-menu__list">

                            <li class="dropdown megamenu">
                                <a href="{{route('index')}}">Home</a>
                                {{-- <ul>
                                  <li>

                                      <section class="home-showcase">
                                          <div class="container">
                                              <div class="home-showcase__inner">
                                                  <div class="row">
                                                      <div class="col-md-6 col-lg-3">
                                                          <div class="demo-one__card">
                                                              <div class="demo-one__image">
                                                                  <img src="{{asset('assets/images/home-showcase/home-showcase-1.jpg')}}" alt="">
                                <div class="demo-one__btns">
                                    <a href="index.html" class="easilon-btn demo-one__btn">
                                        <span>Multi Page</span>
                                        <span class="easilon-btn__icon">
                                            <i class="icon-double-right-arrow"></i>
                                        </span>
                                    </a><!-- /.thm-btn demo-one__btn -->
                                    <a href="index-one-page.html" class="easilon-btn demo-one__btn">
                                        <span>One Page</span>
                                        <span class="easilon-btn__icon">
                                            <i class="icon-double-right-arrow"></i>
                                        </span>
                                    </a><!-- /.thm-btn demo-one__btn -->
                                </div><!-- /.demo-one__btns -->
                </div><!-- /.demo-one__image -->
                <div class="demo-one__content">
                    <h3 class="demo-one__title">
                        <a href="index.html">Home Page 01</a>
                    </h3><!-- /.demo-one__title -->
                </div><!-- /.demo-one__content -->
            </div><!-- /.demo-one__card -->
        </div><!-- /.col-md-6 col-lg-3 -->
        <div class="col-md-6 col-lg-3">
            <div class="demo-one__card">
                <div class="demo-one__image">
                    <img src="{{asset('assets/images/home-showcase/home-showcase-2.jp')}}" alt="">
                    <div class="demo-one__btns">
                        <a href="index-2.html" class="easilon-btn demo-one__btn">
                            <span>Multi Page</span>
                            <span class="easilon-btn__icon">
                                <i class="icon-double-right-arrow"></i>
                            </span>
                        </a><!-- /.thm-btn demo-one__btn -->
                        <a href="index-2-one-page.html" class="easilon-btn demo-one__btn">
                            <span>One Page</span>
                            <span class="easilon-btn__icon">
                                <i class="icon-double-right-arrow"></i>
                            </span>
                        </a><!-- /.thm-btn demo-one__btn -->
                    </div><!-- /.demo-one__btns -->
                </div><!-- /.demo-one__image -->
                <div class="demo-one__content">
                    <h3 class="demo-one__title">
                        <a href="index-2.html">Home Page 02</a>
                    </h3><!-- /.demo-one__title -->
                </div><!-- /.demo-one__content -->
            </div><!-- /.demo-one__card -->
        </div><!-- /.col-md-6 col-lg-3 -->
        <div class="col-md-6 col-lg-3">
            <div class="demo-one__card">
                <div class="demo-one__image">
                    <img src="{{asset('assets/images/home-showcase/home-showcase-3.jpg')}}" alt="">
                    <div class="demo-one__btns">
                        <a href="index-3.html" class="easilon-btn demo-one__btn">
                            <span>Multi Page</span>
                            <span class="easilon-btn__icon">
                                <i class="icon-double-right-arrow"></i>
                            </span>
                        </a><!-- /.thm-btn demo-one__btn -->
                        <a href="index-3-one-page.html" class="easilon-btn demo-one__btn">
                            <span>One Page</span>
                            <span class="easilon-btn__icon">
                                <i class="icon-double-right-arrow"></i>
                            </span>
                        </a><!-- /.thm-btn demo-one__btn -->
                    </div><!-- /.demo-one__btns -->
                </div><!-- /.demo-one__image -->
                <div class="demo-one__content">
                    <h3 class="demo-one__title">
                        <a href="index-3.html">Home Page 03</a>
                    </h3><!-- /.demo-one__title -->
                </div><!-- /.demo-one__content -->
            </div><!-- /.demo-one__card -->
        </div><!-- /.col-md-6 col-lg-3 -->
        <div class="col-md-6 col-lg-3">
            <div class="demo-one__card">
                <div class="demo-one__image">
                    <img src="{{asset('assets/images/home-showcase/home-showcase-4.jpg')}}" alt="">
                    <div class="demo-one__btns">
                        <a href="index-dark.html" class="easilon-btn demo-one__btn">
                            <span>View Page</span>
                            <span class="easilon-btn__icon">
                                <i class="icon-double-right-arrow"></i>
                            </span>
                        </a><!-- /.thm-btn demo-one__btn -->
                    </div><!-- /.demo-one__btns -->
                </div><!-- /.demo-one__image -->
                <div class="demo-one__content">
                    <h3 class="demo-one__title">
                        <a href="index-dark.html">Home Dark</a>
                    </h3><!-- /.demo-one__title -->
                </div><!-- /.demo-one__content -->
            </div><!-- /.demo-one__card -->
        </div><!-- /.col-md-6 col-lg-3 -->
        </div><!-- /.row -->

        </div><!-- /.home-showcase__inner -->
        </div><!-- /.container -->
        </section>
        </li>
        </ul> --}}
        </li>


        <li>
            <a href="{{route('about')}}">About Us</a>
        </li>
        {{-- <li class="dropdown">
          <a href="#">Our Services</a>
          <ul>
              <li><a href="services.html">Services</a></li>
              <li><a href="services-carousel.html">Services Carousel 01</a></li>
              <li><a href="services-carousel-2.html">Services Carousel 02</a></li>
              <li><a href="service-d-home-loan.html">home loan</a></li>
              <li><a href="service-d-auto-loan.html">auto loan</a></li>
              <li><a href="service-d-personal-loan.html">personal loan</a></li>
              <li><a href="service-d-business-loan.html">business loan</a></li>
              <li><a href="service-d-study-loan.html">study loan</a></li>
              <li><a href="service-d-bike-loan.html">bike loan</a></li>
              <li><a href="service-d-property-loan.html">property loan</a></li>
          </ul>
      </li> --}}
        {{-- <li class="dropdown">
          <a href="#">Pages</a>
          <ul>
              <li><a href="team.html">Our Team</a></li>
              <li><a href="team-carousel.html">Team Carousel 01</a></li>
              <li><a href="team-carousel-2.html">Team Carousel 02</a></li>
              <li><a href="team-details.html">Team Details</a></li>
              <li><a href="testimonials-carousel.html">testimonials carousel 01</a></li>
              <li><a href="testimonials-carousel-2.html">testimonials carousel 02</a></li>
              <li><a href="history.html">Our History</a></li>
              <li>
                  <a href="gallery.html">Gallery</a>
                  <ul>
                      <li><a href="gallery.html">Gallery masonry</a></li>
                      <li><a href="gallery-filter.html">Gallery filter</a></li>
                      <li><a href="gallery-grid.html">Gallery Grid</a></li>
                      <li><a href="gallery-carousel.html">Gallery Carousel</a></li>
                  </ul>
              </li> 
      <li><a href="faq.html">FAQ</a></li>
      <li><a href="apply-loan.html">apply loan</a></li>
      <li><a href="loan-eligibility.html">loan eligibility</a></li>
      <li><a href="login.html">Login</a></li>
      <li><a href="404.html">404 Error</a></li>
      </ul>
      </li>
      <li class="dropdown">
          <a href="#">Shop</a>
          <ul>
              <li class="dropdown">
                  <a href="#">Products</a>
                  <ul>
                      <li><a href="products.html">No sidebar</a></li>
                      <li><a href="products-left.html">Left sidebar</a></li>
                      <li><a href="products-right.html">Right sidebar</a></li>
                  </ul>
              </li>
              <li><a href="products-carousel.html">Products carousel</a></li>
              <li><a href="product-details.html">Product details</a></li>
              <li><a href="cart.html">Cart</a></li>
              <li><a href="checkout.html">Checkout</a></li>
          </ul>
      </li>
      <li class="dropdown">
          <a href="#">News</a>
          <ul>
              <li class="dropdown">
                  <a href="#">News grid</a>
                  <ul>
                      <li><a href="blog-grid.html">No sidebar</a></li>
                      <li><a href="blog-grid-left.html">Left sidebar</a></li>
                      <li><a href="blog-grid-right.html">Right sidebar</a></li>
                  </ul>
              </li>
              <li class="dropdown">
                  <a href="#">News list</a>
                  <ul>
                      <li><a href="blog-list.html">No sidebar</a></li>
                      <li><a href="blog-list-left.html">Left sidebar</a></li>
                      <li><a href="blog-list-right.html">Right sidebar</a></li>
                  </ul>
              </li>
              <li><a href="blog-carousel.html">News carousel 01</a></li>
              <li><a href="blog-carousel-2.html">News carousel 02</a></li>
              <li class="dropdown">
                  <a href="#">News details</a>
                  <ul>
                      <li><a href="blog-details.html">No sidebar</a></li>
                      <li><a href="blog-details-left.html">Left sidebar</a></li>
                      <li><a href="blog-details-right.html">Right sidebar</a></li>
                  </ul>
              </li>
          </ul>
      </li>--}}
        <li>
            <a href="{{route('contact.send')}}">Contact Us</a>
        </li>
        </ul>
        </nav><!-- /.main-header__nav -->
        <div class="mobile-nav__btn mobile-nav__toggler">
            <span></span>
            <span></span>
            <span></span>
        </div><!-- /.mobile-nav__toggler -->
        <a href="#" class="search-toggler main-header__search">
            <i class="icon-search" aria-hidden="true"></i>
            <span class="sr-only">Search</span>
        </a><!-- /.search-toggler -->
        {{-- <a href="cart.html" class="main-header__cart">
          <i class="icon-cart" aria-hidden="true"></i>
          <span class="sr-only">Shopping Cart</span>
      </a><!-- /.search-toggler --> --}}
        <a href="{{route('apply')}}" class="easilon-btn main-header__btn">
            <span>Apply for loan</span>
            <span class="easilon-btn__icon"><i class="icon-right-arrow"></i></span>
        </a><!-- /.easilon-btn main-header__btn -->
        </div><!-- /.main-header__right -->
        </div><!-- /.main-header__inner -->
        </div><!-- /.container-fluid -->
    </header><!-- /.main-header -->
