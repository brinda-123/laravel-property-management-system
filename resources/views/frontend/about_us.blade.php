@extends('frontend.frontend_dashboard')
@section('main')

<body>

    <div class="boxed_wrapper">

        <section class="page-title centred" style="background-image: url({{ asset('frontend/assets/images/banner/img-1.jpg') }});">
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>About Us</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>About Us</li>
                    </ul>
                </div>
            </div>
        </section>


        <section class="about-section about-page pb-0">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="row align-items-center clearfix">
                        <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                            <div class="image_block_2">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset('frontend/assets/images/banner/img-3.jpg') }}" alt=""></figure>
                                    <div class="text wow fadeInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <h2>20</h2>
                                        <h4>Years of <br />Experience</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                            <div class="content_block_3">
                                <div class="content-box">
                                    <div class="sec-title">
                                        <h5>About</h5>
                                        <h2>Hi, Find Your House With Us..</h2>
                                    </div>
                                    <div class="text">
                                        <p>Dolor sit amet consectetur elit sed do eiusmod tempor incididunt labore et dolore magna aliqua enim ad minim veniam quis nostrud exercitation ullamco laboris aliquip ex ea commodo consequat duis aute irure.</p>
                                        <p>dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur excepteur sint occaecat.</p>
                                    </div>
                                    <ul class="list clearfix">
                                        <li>consectetur elit sed do eius</li>
                                        <li>consectetur elit sed</li>
                                    </ul>
                                    <div class="btn-box">
                                        <a href="{{ route('contactus') }}" class="theme-btn btn-one">Contact With Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="feature-style-three centred pb-110">
            <div class="auto-container">
                <div class="sec-title">
                    <h5>Our Services</h5>
                    <h2>Property Services</h2>
                </div>
                <div class="three-item-carousel owl-carousel owl-theme owl-nav-none dots-style-one">
                    <div class="feature-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-1"></i></div>
                            <h4>Excellent Reputation</h4>
                            <p>Lorem ipsum dolor sit consectetur sed eiusm tempor incididunt dolore magna.</p>
                        </div>
                    </div>
                    <div class="feature-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-26"></i></div>
                            <h4>Best Local Agents</h4>
                            <p>Lorem ipsum dolor sit consectetur sed eiusm tempor incididunt dolore magna.</p>
                        </div>
                    </div>
                    <div class="feature-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-21"></i></div>
                            <h4>Personalized Service</h4>
                            <p>Lorem ipsum dolor sit consectetur sed eiusm tempor incididunt dolore magna.</p>
                        </div>
                    </div>
                    <div class="feature-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-1"></i></div>
                            <h4>Excellent Reputation</h4>
                            <p>Lorem ipsum dolor sit consectetur sed eiusm tempor incididunt dolore magna.</p>
                        </div>
                    </div>
                    <div class="feature-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-26"></i></div>
                            <h4>Best Local Agents</h4>
                            <p>Lorem ipsum dolor sit consectetur sed eiusm tempor incididunt dolore magna.</p>
                        </div>
                    </div>
                    <div class="feature-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-21"></i></div>
                            <h4>Personalized Service</h4>
                            <p>Lorem ipsum dolor sit consectetur sed eiusm tempor incididunt dolore magna.</p>
                        </div>
                    </div>
                    <div class="feature-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-1"></i></div>
                            <h4>Excellent Reputation</h4>
                            <p>Lorem ipsum dolor sit consectetur sed eiusm tempor incididunt dolore magna.</p>
                        </div>
                    </div>
                    <div class="feature-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-26"></i></div>
                            <h4>Best Local Agents</h4>
                            <p>Lorem ipsum dolor sit consectetur sed eiusm tempor incididunt dolore magna.</p>
                        </div>
                    </div>
                    <div class="feature-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-21"></i></div>
                            <h4>Personalized Service</h4>
                            <p>Lorem ipsum dolor sit consectetur sed eiusm tempor incididunt dolore magna.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonial-style-four sec-pad centred">
            <div class="auto-container">

                @php
                $tesimonials = App\Models\Testimonial::latest()->get();
                @endphp

                <section class="testimonial-section bg-color-1 centred">
                    <div class="pattern-layer" style="background-image: url({{ asset('frontend/assets/images/shape/shape-1.png') }});"></div>
                    <div class="auto-container">
                        <div class="sec-title">
                            <h5>Testimonials</h5>
                            <h2>What They Say About Us</h2>
                        </div>
                        <div class="single-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">

                            @foreach($tesimonials as $item)
                            <div class="testimonial-block-one">
                                <div class="inner-box">
                                    <figure class="thumb-box"><img src="{{ asset($item->image) }}" alt=""></figure>
                                    <div class="text">
                                        <p>{{ $item->message }}</p>
                                    </div>
                                    <div class="author-info">
                                        <h4>{{ $item->name }}</h4>
                                        <span class="designation">{{ $item->position }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </section>
            </div>
        </section>
        <!-- testimonial-style-four end -->



        @endsection