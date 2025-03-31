@extends('agent.agent_dashboard')
@section('agent')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb"></ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Schedule Request All</h6>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>SR. No.</th>
                                    <th>User</th>
                                    <th>Property</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usermsg as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ optional($item->user)->name }}</td>
                                        <td>{{ optional($item->property)->property_name }}</td>
                                        <td>{{ $item->tour_date }}</td>
                                        <td>{{ $item->tour_time }}</td>
                                        <td>
                                            <span class="badge rounded-pill {{ $item->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $item->status == 1 ? 'Confirm' : 'Pending' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('agent.details.schedule', $item->id) }}" class="btn btn-inverse-info" title="Details">
                                                <i data-feather="eye"></i>
                                            </a>

                                            <form action="{{ route('agent.delete.property', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-inverse-danger" onclick="return confirm('Are you sure?')" title="Delete">
                                                    <i data-feather="trash-2"></i>
                                                </button>
                                            </form>
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

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTableExample').DataTable();
    });
</script>
@endpush

@endsection
