@extends('agent.agent_dashboard')
@section('agent')

@php
$id = Auth::user()->id;
$agentId = App\Models\User::find($id);
$status = $agentId->status;
$properties = App\Models\Property::where('agent_id', $id)->get();
$allPropertiesCount = $properties->count();
$featuredPropertiesCount = $properties->where('featured', 1)->count();
$featuredProperties = $properties->where('featured', 1);
$hotPropertiesCount = $properties->where('hot', 1)->count();
$usermsg = App\Models\PropertyMessage::where('agent_id', $id)->get();
$agents = App\Models\User::where('id', $id)->get();
$package = App\Models\PackagePlan::get();
@endphp

<div class="page-content">


  @if($status === 'active')
  <h4>Agent Account Is <span class="text-success">Active </span> </h4>

  @else
  <h4>Agent Account Is <span class="text-danger">Inactive </span> </h4>
  <p class="text-danger"><b> Plz wait admin will check and approve your account</b></p>
  @endif


  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="mb-3 mb-md-0">Welcome to Real🏗️<span>state </span></h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
      <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
        <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
        <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
      </div>

    </div>
  </div>

  <div class="row">
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card text-center">
        <div class="card-header d-flex justify-content-between align-items-center">
          <!-- <h2 class="card-title mb-0">Properties</h2> -->
          <a href="{{ route('all.property') }}" class="icon-lg"><span data-feather="home"></span></a>

          <ul class="nav nav-tabs card-header-tabs justify-content-center" id="propertyTabs">
            <li class="nav-item"><a class="nav-link active" href="#" data-tab="AllProperties">All</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-tab="FeaturedProperties">Featured</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-tab="HotProperties">Hot</a></li>
          </ul>
          <div class="dropdown">
            <button class="btn btn-link text-decoration-none text-muted" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg" data-feather="more-horizontal"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton7">
              <a class="dropdown-item d-flex align-items-center" href="{{ route('agent.all.property') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('agent.all.property') }}"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h2 class="card-title mb-0">Properties Information</h2><br>
          <h4 class=" mb-4" id="propertyInfo">{{$allPropertiesCount}}</h4>
          <a href="{{ route('agent.add.property') }}" class="btn btn-inverse-primary"> Add Property </a>

        </div>
      </div>
    </div>

    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <a href="{{ route('agent.property.message') }}" class="icon-lg"><span data-feather="inbox"></span></a>

          <h6 class="card-title mb-0">Inbox</h6>
          <div class="dropdown mb-2">
            <a type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
              <a class="dropdown-item d-flex align-items-center" href="{{ route('agent.property.message') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
            </div>
          </div>
        </div>
        <div class="card-body">

          @foreach($usermsg as $msg)
          <div class="email-list-item">

            <a href="{{ route('agent.message.details',$msg->id) }}" class="email-list-detail">
              <div class="content">
                <span class="from">{{ $msg['user']['name'] }}</span>
                <p class="msg"> {{ $msg->message }} </p>
              </div>
              <span class="date">
                <span class="icon"><i data-feather="paperclip"></i> </span>
                {{ $msg->created_at->format('l M d') }}
              </span>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="col-md-4 grid-margin stretch-card">
      @foreach($agents as $agent)

      <div class="card text-center">
        <div class="card-header d-flex justify-content-between align-items-center">
          <a href="{{ route('package.history') }}" class="icon-lg"><span data-feather="package"></span></a>

          <h6 class="card-title mb-0 justify-content-center"><span>{{$agent->name}}</span> Package Limit</h6>
          <div class="dropdown mb-2">
            <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
              <a class="dropdown-item d-flex align-items-center" href="{{ route('package.history') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
            </div>
          </div>
        </div>

        <div class="card-body">
          <!-- <h5>Credit: <span>[{{$agent->credit}}]</span></h5> -->
          <h4 class=" mb-4">YOUR CREDIT IS: {{$agent->credit}}</h4>

          <p class="card-title text-success mb-4">
            <span> YOU ARE ELIGIBLE TO ADD ({{ $agent->credit}}) PROPERTIES...!</span>
          </p>

          <a href="{{ route('buy.package') }}" class="btn btn-inverse-info"> Buy Package </a>

        </div>

        @endforeach
      </div>

    </div> <!-- row -->




    
  </div>

  <div class="row">
    <div class="col-lg-12 col-xl-12 stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-baseline mb-2">
            <h6 class="card-title mb-0">Agent's Top Property</h6>
            <div class="dropdown mb-2">
              <a type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                <a class="dropdown-item d-flex align-items-center" href="{{ route('agent.all.property') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('agent.all.property') }}"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>SR. No. </th>
                  <th>Property Image </th>
                  <th>Property Name </th>
                  <th>Property Type </th>
                  <th>Status Type </th>
                  <th>City </th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($featuredProperties as $key => $item)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td><img src="{{ asset($item->property_thambnail) }}" style="width:100px; height:70px; object-fit:cover; border-radius:5px;"></td>
                  <td>{{ $item->property_name }}</td>
                  <td>{{ $item['type']['type_name'] }}</td>
                  <td>{{ $item->property_status }}</td>
                  <td>{{ $item->city }}</td>
                  <td><a href="{{ route('agent.details.property',$item->id) }}" class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i> </a></td>

                </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div> <!-- row -->

</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initial load - show all properties
    showPropertyInfo('AllProperties');

    // Add click event listeners to property tabs
    const propertyTabLinks = document.querySelectorAll('#propertyTabs .nav-link');
    propertyTabLinks.forEach(function(tabLink) {
      tabLink.addEventListener('click', function(event) {
        event.preventDefault();

        // Remove 'active' class from all property tab links
        propertyTabLinks.forEach(function(link) {
          link.classList.remove('active');
        });

        // Add 'active' class to the clicked property tab link
        this.classList.add('active');

        const tab = this.getAttribute('data-tab');
        showPropertyInfo(tab);
      });
    });

    // Function to show property information based on selected tab
    function showPropertyInfo(tab) {
      let propertyCount = 0; // Placeholder for property count

      // Example logic to fetch property count based on tab
      if (tab === 'AllProperties') {
        propertyCount = <?php echo $allPropertiesCount; ?>;
      } else if (tab === 'FeaturedProperties') {
        propertyCount = <?php echo $featuredPropertiesCount; ?>;
      } else if (tab === 'HotProperties') {
        propertyCount = <?php echo $hotPropertiesCount; ?>;
      }

      // Update the card text with the property count
      const propertyInfo = document.getElementById('propertyInfo');
      propertyInfo.textContent = `${tab.replace('Properties', '')} Properties: ${propertyCount}`;
    }
  });
</script>

@endsection