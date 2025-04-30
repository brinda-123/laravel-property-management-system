<!DOCTYPE html>
<html>
<head>
    <title>New Property Submission</title>
</head>
<body>
    <h2>New Property Submission</h2>

    <p><strong>Submitted by:</strong> {{ $sellerName }}</p>
    <p><strong>Property Title:</strong> {{ $propertyData['property_title'] }}</p>
    <p><strong>Description:</strong> {{ $propertyData['property_description'] }}</p>
    <p><strong>Price:</strong> ₹{{ number_format($propertyData['property_price'], 2) }}</p>
</body>
</html>
