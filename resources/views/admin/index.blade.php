~@extends('admin.admin_dashboard')
@section('admin')
@php
$allAgentsCount = App\Models\User::where('role', 'agent')->count();
$activeAgentsCount = App\Models\User::where('role', 'agent')->where('status', 'active')->count();
$inactiveAgentsCount = App\Models\User::where('role', 'agent')->where('status', 'inactive')->count();
$allagent = App\Models\User::where('role', 'agent')->limit(5)->get();
$allPropertiesCount = App\Models\Property::count();
$featuredPropertiesCount = App\Models\Property::where('featured', 1)->count();
$hotproperty = App\Models\Property::where('hot', 1)->latest()->limit(4)->get();
$hotPropertiesCount = App\Models\Property::where('hot', 1)->count();
$allproperty = App\Models\Property::get();
$usermsg = App\Models\PropertyMessage::latest()->limit(2)->get();

@endphp

<div class="page-content">

  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="mb-3 mb-md-0">Welcome to Real🏗️<span>Estate </span></h4>
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
              <a class="dropdown-item d-flex align-items-center" href="{{ route('all.property') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('all.property') }}"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h2 class="card-title mb-1">Properties Information</h2><br>
          <h4 class="mb-3" id="propertyInfo">{{$allPropertiesCount}}</h4>
          <a href="{{ route('add.property') }}" class="btn btn-inverse-primary"> Add Property </a>

        </div>
      </div>
    </div>
    
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <a href="{{ route('admin.property.message') }}" class="icon-lg"><span data-feather="inbox"></span></a>

          <h6 class="card-title mb-0">Inbox</h6>
          <div class="dropdown mb-2">
            <a type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
              <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.property.message') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
            </div>
          </div>
        </div>
        <div class="card-body">

          @foreach($usermsg as $msg)
          <div class="email-list-item">

            <a href="{{ route('admin.message.details',$msg->id) }}" class="email-list-detail">
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
      <div class="card text-center">
        <div class="card-header d-flex justify-content-between align-items-center">
          <a href="{{ route('all.agent') }}" class="icon-lg"><span data-feather="users"></span></a>
          <!-- <h2 class="card-title mb-0">Agents</h2> -->

          <ul class="nav nav-tabs card-header-tabs justify-content-center" id="agentTabs">
            <li class="nav-item"><a class="nav-link active" href="#" data-tab="AllAgents">All</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-tab="ActiveAgents">Active</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-tab="InactiveAgents">Inactive</a></li>
          </ul>
          <div class="dropdown">
            <button class="btn btn-link text-decoration-none text-muted" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg" data-feather="more-horizontal"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton7">
              <a class="dropdown-item d-flex align-items-center" href="{{ route('all.agent') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('all.agent') }}"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
            </div>
          </div>
        </div>

        <div class="card-body">
          <h2 class="card-title mb-1">Agent Information</h2><br>
          <h4 class="mb-3" id="agentInfo">{{$allAgentsCount}}</h4>
          <a href="{{ route('all.agent') }}" class="btn btn-inverse-warning"> Manage Agent </a>

        </div>
      </div>
    </div>

  </div> <!-- row -->


 

  <div class="row">
  <div class="col-lg-12 col-xl-7 stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-baseline mb-2">
            <h6 class="card-title mb-0">Top Property</h6>
            <div class="dropdown mb-2">
              <a type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                <a class="dropdown-item d-flex align-items-center" href="{{ route('all.property') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('all.property') }}"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table id="#" class="table">
              <thead>
                <tr>
                  <th>Sl </th>
                  <th>Image </th>
                  <th>P Type </th>
                  <th>City </th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($hotproperty as $key => $item)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td><img src="{{ asset($item->property_thambnail) }}" style="width:70px; height:40px;"> </td>
                  <td>{{ $item['type']['type_name'] }}</td>
                  <td>{{ $item->city }}</td>
                  <td><a href="{{ route('details.property',$item->id) }}" class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i> </a></td>

                </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-7 col-xl-5 stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-baseline mb-2">
            <h6 class="card-title mb-0">Top AGENT List:</h6>
            <div class="dropdown mb-2">
              <a type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                <a class="dropdown-item d-flex align-items-center" href="{{ route('all.agent') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('all.agent') }}"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('all.agent') }}"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table id="#" class="table">
              <thead>
                <tr>
                  <th>Sl </th>
                  <th>Image </th>
                  <th>Name </th>
                  <th>Status </th>
                </tr>
              </thead>
              <tbody>
                @foreach($allagent as $key => $item)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td><img src="{{ (!empty($item->photo)) ? url('upload/agent_images/'.$item->photo) : url('upload/no_image.jpg') }}" style="width:70px; height:40px;"> </td>
                  <td>{{ $item->name }}</td>
                  <td>
                    @if($item->status == 'active')
                    <span class="badge rounded-pill bg-success">Active</span>
                    @else
                    <span class="badge rounded-pill bg-danger">InActive</span>
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
  </div> <!-- row -->

</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initial load - show all agents
    showAgentInfo('AllAgents');
    // Initial load - show all properties
    showPropertyInfo('AllProperties');

    // Add click event listeners to agent tabs
    const agentTabLinks = document.querySelectorAll('#agentTabs .nav-link');
    agentTabLinks.forEach(function(tabLink) {
      tabLink.addEventListener('click', function(event) {
        event.preventDefault();

        // Remove 'active' class from all agent tab links
        agentTabLinks.forEach(function(link) {
          link.classList.remove('active');
        });

        // Add 'active' class to the clicked agent tab link
        this.classList.add('active');

        const tab = this.getAttribute('data-tab');
        showAgentInfo(tab);
      });
    });

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

    // Function to show agent information based on selected tab
    function showAgentInfo(tab) {
      // Your logic to fetch and display agent information based on the selected tab
      let agentCount = 0; // Placeholder for agent count

      // Example logic to fetch agent count based on tab
      if (tab === 'AllAgents') {
        agentCount = <?php echo $allAgentsCount; ?>;
      } else if (tab === 'ActiveAgents') {
        agentCount = <?php echo $activeAgentsCount; ?>;
      } else if (tab === 'InactiveAgents') {
        agentCount = <?php echo $inactiveAgentsCount; ?>;
      }

      // Update the card text with the agent count
      const agentInfo = document.getElementById('agentInfo');
      agentInfo.textContent = ` ${tab.replace('Agents', '')} Agents: ${agentCount}`;
    }

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