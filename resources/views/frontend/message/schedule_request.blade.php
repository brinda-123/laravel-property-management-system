@extends('frontend.frontend_dashboard')
@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


 <!--Page Title-->
        <section class="page-title centred" style="background-image: url({{ asset('frontend/assets/images/background/page-title-5.jpg') }});">
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>Schedule Request  </h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Schedule Request</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->


        <!-- sidebar-page-container -->
        <section class="sidebar-page-container blog-details sec-pad-2">
            <div class="auto-container">
                <div class="row clearfix">
                    



          @php

            $id = Auth::user()->id;
            $userData = App\Models\User::find($id); 
        @endphp




        <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
            <div class="blog-sidebar">
              <div class="sidebar-widget post-widget">
                    <div class="widget-title">
                        <h4>User Profile </h4>
                    </div>

                    <div class="post-inner d-flex justify-content-center">
                        <div class="post d-flex align-items-center p-6 shadow rounded bg-light" style="max-width: 350px">
                            <figure class="post-thumb mb-0 me-3" style="margin-left: 10px;">
                                <a href="blog-details.html">
                                    <img src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo) : url('upload/no_image.jpg') }}" 
                                        alt="User Image" 
                                        class="img-fluid rounded-circle border border-secondary p-1" 
                                        style="width: 80px; height: 100px; object-fit: cover;">
                                </a>
                            </figure>
                        <!-- Text on the right -->
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
                        <div class="blog-details-content">
                            <div class="news-block-one">
                                <div class="inner-box">
                                    
                                    <div class="lower-content">
                                        
                                         
                                      
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">SR. No.</th>
      <th scope="col">Property Name </th>
      <th scope="col">Date</th>
      <th scope="col">Time</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach($srequest as $key => $item)
    <tr>
      <th scope="row">{{ $key+1 }}</th>
      <td>{{ $item['property']['property_name'] }}</td>
      <td>{{ $item->tour_date }}</td>
      <td>{{ $item->tour_time }}</td>
      <td>
          @if($item->status == 1)
          <span class="badge rounded-pill bg-success">Confirm</span>

          @else
       <span class="badge rounded-pill bg-danger">Pending</span>
          @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>


 

                                    </div>
                                </div>
                            </div>
                             
                            
                        </div>

 
                    </div> 


                </div>
            </div>
        </section>
        <!-- sidebar-page-container -->

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
