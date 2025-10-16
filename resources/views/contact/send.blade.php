@extends('layouts.main')
@section('content')
<section class="page-header">
    <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg-1-1.jpg);"></div>
    <!-- /.page-header__bg -->
    <div class="container">
        <div class="page-header__content">
            <h2 class="page-header__title">Contact Us</h2>
            <ul class="easilon-breadcrumb list-unstyled">
                <li><a href="index.html">Home</a></li>
                <li><span>Contact Us</span></li>
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
</section><!-- /.page-header -->


<section class="contact-one section-space">
    <div class="container">
        <div class="row gutter-y-50 align-items-center">
            <div class="col-lg-6">
                <div class="contact-one__image wow fadeInLeft" data-wow-duration="1500ms" style="background-image: url(assets/images/resources/contact-1-1.jpg);">
                    <div class="contact-one__info list-unstyled">
                        <div class="contact-one__info__shape"></div><!-- /.contact-one__info__shape -->
                        <div class="contact-one__info__inner">
                            <div class="contact-one__info__item">
                                <span class="contact-one__info__icon">
                                    <i class="icon-location"></i>
                                </span><!-- /.contact-one__info__icon -->
                                <div class="contact-one__info__content">
                                    <h4 class="contact-one__info__title">Mailing Address</h4><!-- /.contact-one__info__title -->
                                    <a href="https://maps.app.goo.gl/wpr8sgirX4NK6VsU7" class="contact-one__info__text">901 N Pitt Str., Suite <br> 170 Alexandria, USA</a><!-- /.contact-one__info__text -->
                                </div><!-- /.contact-one__info__content -->
                            </div><!-- /.contact-one__info__item -->
                            <div class="contact-one__info__item">
                                <span class="contact-one__info__icon">
                                    <i class="icon-telephone"></i>
                                </span><!-- /.contact-one__info__icon -->
                                <div class="contact-one__info__content">
                                    <h4 class="contact-one__info__title">Quick Contact</h4><!-- /.contact-one__info__title -->
                                    <a href="tel:(406)555-0120" class="contact-one__info__text">(406) 555-0120</a><!-- /.contact-one__info__text -->
                                </div><!-- /.contact-one__info__content -->
                            </div><!-- /.contact-one__info__item -->
                            <div class="contact-one__info__item">
                                <span class="contact-one__info__icon">
                                    <i class="icon-mail"></i>
                                </span><!-- /.contact-one__info__icon -->
                                <div class="contact-one__info__content">
                                    <h4 class="contact-one__info__title">support email</h4><!-- /.contact-one__info__title -->
                                    <a href="mailto:info@easilon.com" class="contact-one__info__text">info@easilon.com</a><!-- /.contact-one__info__text -->
                                </div><!-- /.contact-one__info__content -->
                            </div><!-- /.contact-one__info__item -->
                        </div><!-- /.contact-one__info__inner -->
                    </div><!-- /.contact-one__info -->
                </div><!-- /.contact-one__image -->
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <form class="contact-one__form contact-form-validated form-one wow fadeInRight" data-wow-duration="1500ms" action="https://easilonlaravel.bracketweb.com/inc/sendemail.php">
                    <h2 class="contact-one__form__title">Leave us a message</h2><!-- /.contact-one__form__title -->
                    <div class="form-one__group">
                        <div class="form-one__control">
                            <input type="text" name="name" placeholder="Your Name">
                        </div><!-- /.form-one__control -->
                        <div class="form-one__control">
                            <input type="email" name="email" placeholder="Your Email">
                        </div><!-- /.form-one__control -->
                        <div class="form-one__control form-one__control--full">
                            <div class="form-one__control__select">
                                <label class="sr-only" for="select-subject">Select Subject</label>
                                <select class="selectpicker" id="select-subject" aria-label="Subject line">
                                    <option selected>Select Subject</option>
                                    <option value="1">home loan</option>
                                    <option value="2">personal loan</option>
                                    <option value="3">business loan</option>
                                    <option value="4">study loan</option>
                                    <option value="5">bike loan</option>
                                    <option value="6">property loan</option>
                                </select>
                            </div><!-- /.form-one__control__select -->
                        </div><!-- /.form-one__control form-one__control--full -->
                        <div class="form-one__control form-one__control--full">
                            <textarea name="message" placeholder="Write Message"></textarea>
                        </div><!-- /.form-one__control -->
                        <div class="form-one__control form-one__control--full">
                            <button type="submit" class="contact-one__form__btn easilon-btn"><span>send message</span></button>
                        </div><!-- /.form-one__control -->
                    </div><!-- /.form-one__group -->
                </form>
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row gutter-y-50 -->
    </div><!-- /.container -->
</section><!-- /.contact-one section-space -->

<section class="contact-map">
    <div class="container-fluid">
        <div class="google-map google-map__contact">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.3861562612815!2d3.3370411749935904!3d6.598838293394981!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b9227e494bbf9%3A0x60de4821f5332071!2s5%20Babatola%20Cl%2C%20Ikeja%2C%20Lagos%20101233%2C%20Lagos!5e0!3m2!1sen!2sng!4v1760624085829!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <!-- /.google-map -->
        </div><!-- /.container-fluid -->
</section><!-- /.contact-map -->

@endsection
