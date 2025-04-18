@extends('frontend.frontend_dashboard')
@section('main')


@section('title')
Buy Property Easy RealEstate
@endsection


<!--Page Title-->
<section class="page-title-two bg-color-1 centred">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});"></div>
        <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});"></div>
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Buy Property </h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Buy Property List</li>
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
                <div class="default-sidebar property-sidebar">
                    <div class="filter-widget sidebar-widget">
                        <div class="widget-title">
                            <h5>Property</h5>
                            @php
                                $states = App\Models\State::latest()->get();
                                $ptypes = App\Models\PropertyType::latest()->get();

                             @endphp
                        </div>
                            <div class="widget-content">
                                <div class="select-box">
                                    <select class="wide">
                                        <option data-display="Select Type">Select Type</option>
                                        @foreach($ptypes as $type)
                                            <option value="{{ $type->type_name }}">{{ $type->type_name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="select-box">
                                    <select class="wide">
                                        <option data-display="Select Location">Select Location</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->state_name }}">{{ $state->state_name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="filter-btn">
                                    <button type="submit" class="theme-btn btn-one"><i class="fas fa-filter"></i>&nbsp;Filter</button>
                                </div>
                            </div>
                        </div>


                    @if(session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Filter Applied:</strong> {{ session('message') }}
                        <a href="{{ route('buy.property') }}" class="btn btn-sm btn-outline-secondary ml-2">Clear Filter</a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="price-filter sidebar-widget">
                        <div class="widget-title">
                            <h5>Select Price Range</h5>
                        </div>
                        <div class="range-slider clearfix">
                            <form action="{{ route('price.filter') }}" method="GET">
                                <div class="form-group">
                                    <label>Minimum Price (₹):</label>
                                    <input type="number" 
                                           name="min_price" 
                                           class="form-control" 
                                           value="{{ request('min_price') }}" 
                                           min="0" 
                                           placeholder="Enter minimum price">
                                </div>
                                <div class="form-group">
                                    <label>Maximum Price (₹):</label>
                                    <input type="number" 
                                           name="max_price" 
                                           class="form-control" 
                                           value="{{ request('max_price') }}" 
                                           min="0" 
                                           placeholder="Enter maximum price">
                                </div>
                                <div class="button-group">
                                    <button type="submit" class="theme-btn btn-one">
                                        <i class="fas fa-filter"></i> Apply Filter
                                    </button>
                                    @if(request('min_price') || request('max_price'))
                                        <div class="vertical-divider"></div>
                                        <a href="{{ route('buy.property') }}" class="theme-btn btn-two">
                                            <i class="fas fa-times"></i> Clear Filter
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    
                    <!-- apply filter on property price     -->
                    <div class="category-widget sidebar-widget">
                        <div class="widget-title">
                            <h5>Status Of Property</h5>
                        </div>
                        <ul class="category-list clearfix">
                            <li>
                                <a href="{{ route('buy.property') }}">
                                    For Buy 
                                    <span>({{ isset($buyproperty) ? $buyproperty->count() : 0 }})</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="property-content-side">
                    <div class="item-shorting clearfix">
                        <div class="left-column pull-left">
                            @if(isset($property))
                                <h5>Search Results: <span>Showing {{ method_exists($property, 'total') ? $property->total() : $property->count() }} Listings</span></h5>
                            @else
                                <h5>Search Results: <span>Showing 0 Listings</span></h5>
                            @endif
                            @if(session('min_price') || session('max_price'))
                                <div class="active-filter">
                                    <p>Active Price Filter: 
                                        @if(session('min_price') && session('max_price'))
                                            ₹{{ formatIndianPrice(session('min_price')) }} - ₹{{ formatIndianPrice(session('max_price')) }}
                                        @elseif(session('min_price'))
                                            Above ₹{{ formatIndianPrice(session('min_price')) }}
                                        @elseif(session('max_price'))
                                            Below ₹{{ formatIndianPrice(session('max_price')) }}
                                        @endif
                                        <br><br><a href="{{ route('buy.property') }}" class="clear-filter">[Clear Filter]</a>
                                    </p>
                                </div>
                            @endif
                        </div>
                        <div class="right-column pull-right clearfix">


                        </div>
                    </div>
                    <div class="wrapper list">
                        <div class="deals-list-content list-item">
                            @if($property->count() > 0)
                                @foreach($property as $item)
                                <div class="deals-block-one">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image"><img src="{{ asset($item->property_thambnail) }}" alt="" style="width:300px; height:350px;"></figure>
                                            <div class="batch"><i class="icon-11"></i></div>
                                            @if($item->featured == 1)
                                            <span class="category">Featured</span>
                                            @else
                                            <span class="category">New</span>
                                            @endif


                                            <div class="buy-btn"><a href="property-details.html">For {{ $item->property_status }}</a></div>
                                        </div>
                                        <div class="lower-content">
                                            <div class="title-text">
                                                <h4><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}">{{ $item->property_name }}</a></h4>
                                            </div>
                                            <div class="price-box clearfix">
                                                <div class="price-info pull-left">
                                                    <h6>Start From</h6>
                                                    <h4>₹{{ $item->lowest_price }}</h4>
                                                </div>

                                                @if($item->agent_id == Null)
                                                <div class="author-box pull-right">
                                                    <figure class="author-thumb">
                                                        <img src="{{ url('upload/ariyan.jpg') }}" alt="">
                                                        <span>Admin</span>
                                                    </figure>
                                                </div>
                                                @else

                                                <div class="author-box pull-right">
                                                    <figure class="author-thumb">
                                                        <img src="{{ (!empty($item->user->photo)) ? url('upload/agent_images/'.$item->user->photo) : url('upload/no_image.jpg') }}" alt="">
                                                        <span>{{ $item->user->name }}</span>
                                                    </figure>
                                                </div>

                                                @endif
                                            </div>
                                            <p>{{ $item->short_descp }}</p>
                                            <ul class="more-details clearfix">
                                                <li><i class="icon-14"></i>{{ $item->bedrooms }} Beds</li>
                                                <li><i class="icon-15"></i>{{ $item->bathrooms }} Baths</li>
                                                <li><i class="icon-16"></i>{{ $item->property_size }} Sq Ft</li>
                                            </ul>
                                            <div class="other-info-box clearfix">
                                                <div class="btn-box pull-left"><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}" class="theme-btn btn-two">See Details</a></div>
                                                <ul class="other-option pull-right clearfix">
                                                    <li><a aria-label="Compare" class="action-btn" id="{{ $item->id }}" onclick="addToCompare(this.id)"><i class="icon-12"></i></a></li>

                                                    <li><a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id }}" onclick="addToWishList(this.id)"><i class="icon-13"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="no-results text-center py-5">
                                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                    <h3>No Properties Found</h3>
                                    <p>No properties match your selected price range.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="pagination-wrapper">
                        {{ $property->appends(request()->query())->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- property-page-section end -->


<!-- subscribe-section -->
<section class="subscribe-section bg-color-3">
    <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-2.png);"></div>
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

<style>
.button-group {
    display: flex;
    align-items: center;
    margin-top: 20px;
    gap: 15px;
}

.vertical-divider {
    height: 35px;
    width: 1px;
    background-color: #ddd;
    margin: 0 10px;
}

.button-group .theme-btn {
    min-width: 130px;
    text-align: center;
    padding: 10px 20px;
}

/* For smaller screens */
@media (max-width: 576px) {
    .button-group {
        flex-direction: column;
        gap: 10px;
    }
    
    .vertical-divider {
        height: 1px;
        width: 100%;
        margin: 5px 0;
    }
    
    .button-group .theme-btn {
        width: 100%;
    }
}
</style>

@endsection