@php
$limit = isset($_GET['showAllCategories']) ? null : 5; // Check if showAllCategories parameter is set
$ptype = App\Models\PropertyType::latest()->limit($limit)->get();
@endphp
@php
$showAllCategories = isset($_GET['showAllCategories']);
@endphp
<section id ="category-section">

<section class="category-section centred">
<div class="auto-container" >

        <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
            <ul class="category-list clearfix">
                @foreach($ptype as $item)
                @php
                $property = App\Models\Property::where('ptype_id',$item->id)->get();
                @endphp
                <li>
                    <div class="category-block-one"style="margin-top: 3rem;">
                        <div class="inner-box">
                            <div class="icon-box"><i class="{{ $item->type_icon }}"></i></div>
                            <h5><a href="{{ route('property.type',$item->id) }}">{{ $item->type_name }}</a></h5>
                            <span>{{ count($property) }}</span>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="more-btn" style="{{ $showAllCategories ? 'display:none;' : '' }}">
                <!-- Add JavaScript to toggle URL parameter on button click -->
                <a href="?showAllCategories=true" class="theme-btn btn-one">Show All Categories</a>
            </div>
        </div>
    </div>
</section>
</section>
<script>
    // JavaScript to hide the button after page is refreshed
    window.onload = function() {
        var showAllCategories = '{{ $showAllCategories }}';
        if (showAllCategories) {
            document.querySelector('.more-btn').style.display = 'none';
        }
    };
</script>
