<!DOCTYPE html>
<html>
<head>
    <title>Seller Dashboard</title>
</head>
<body>
    <h2>Seller Dashboard</h2>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <h3>Inform Agent - I have a property that I want to sell</h3>

    <form method="POST" action="{{ route('seller.property.submit') }}">
        @csrf

        <label for="property_title">Property Title</label>
        <input id="property_title" type="text" name="property_title" value="{{ old('property_title') }}" required>
        @error('property_title')
            <p>{{ $message }}</p>
        @enderror

        <label for="property_description">Property Description</label>
        <textarea id="property_description" name="property_description" rows="4" required>{{ old('property_description') }}</textarea>
        @error('property_description')
            <p>{{ $message }}</p>
        @enderror

        <label for="property_price">Property Price</label>
        <input id="property_price" type="number" step="0.01" name="property_price" value="{{ old('property_price') }}" required>
        @error('property_price')
            <p>{{ $message }}</p>
        @enderror

        <label for="agent_id">Select Agent</label>
        <select id="agent_id" name="agent_id" required>
            <option value="">-- Select Agent --</option>
            @foreach($agents as $agent)
                <option value="{{ $agent->id }}" {{ old('agent_id') == $agent->id ? 'selected' : '' }}>{{ $agent->name }} ({{ $agent->email }})</option>
            @endforeach
        </select>
        @error('agent_id')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">Submit Property</button>
    </form>
</body>
</html>
