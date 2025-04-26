<!DOCTYPE html>
<html>
<head>
    <title>Seller Registration</title>
</head>
<body>
<h2>Seller Registration</h2>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('seller.register.submit') }}">
    @csrf

    <label for="name">Name</label>
    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
    @error('name')
        <p>{{ $message }}</p>
    @enderror

    <label for="email">Email Address</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
    @error('email')
        <p>{{ $message }}</p>
    @enderror

    <label for="password">Password</label>
    <input id="password" type="password" name="password" required>
    @error('password')
        <p>{{ $message }}</p>
    @enderror

    <label for="password_confirmation">Confirm Password</label>
    <input id="password_confirmation" type="password" name="password_confirmation" required>

    <button type="submit">Register</button>
</form>

<p>Already registered? <a href="{{ route('seller.login') }}">Login here</a></p>

</body>
</html>
