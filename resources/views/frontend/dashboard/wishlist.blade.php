@extends('frontend.frontend_dashboard')
@section('main')


    <!--Page Title-->
        <section class="page-title-two bg-color-1 centred">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});"></div>
                <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});"></div>
            </div>
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>WishList Property </h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>WishList Property</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->


        <!-- property-page-section -->
        <section class="property-page-section property-list">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                         
        @php

            $id = Auth::user()->id;
            $userData = App\Models\User::find($id); 
        @endphp


   <div class="blog-sidebar">
  <div class="sidebar-widget post-widget">
                    <div class="widget-title">
                        <h4>User Profile </h4>
                    </div>
                       <div class="post-inner d-flex justify-content-center">
                        <div class="post d-flex align-items-center p-6 shadow rounded bg-light" style="max-width: 350px;">
                        <figure class="post-thumb mb-0 me-3" style="margin-left: 10px;">
                            <a href="blog-details.html">
                                <img src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo) : url('upload/no_image.jpg') }}" 
                                            alt="User Image" 
                                            class="img-fluid rounded-circle border border-secondary p-1" 
                                            style="width: 80px; height: 100px; object-fit: cover;">
                            </a>
                        </figure>

                        <div class="text-end" style="margin-right: 10px;">
                            <h5 class="mb-1">
                                <a href="blog-details.html" class="text-dark text-decoration-none">{{ $userData->name }}</a>
                            </h5>
                            <p class="text-muted mb-0">{{ $userData->email }}</p>
                        </div>


                        </div> 
                    </div>
                </div> 


<div class="sidebar-widget category-widget">
            <div class="widget-title">
                
            </div>
             @include('frontend.dashboard.dashboard_sidebar')


          </div> 
</div>


                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="property-content-side">
                            
                            <div class="wrapper list">
                                <div class="deals-list-content list-item">
                                 
                                <div id="wishlist">
                  	
                  </div>

   
               </div> 
                           
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- property-page-section end -->


        <!-- subscribe-section -->
        <section class="subscribe-section bg-color-3">
            <div class="pattern-layer" style="background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }});"></div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                        <div class="text">
                            <span>Subscribe</span>
                            <h2>Sign Up To Our Newsletter To Get The Latest News And Offers.</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 form-column">
                        <div class="form-inner">
                            <form action="contact.html" method="post" class="subscribe-form">
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Enter your email" required="">
                                    <button type="submit">Subscribe Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- subscribe-section end -->






@endsection