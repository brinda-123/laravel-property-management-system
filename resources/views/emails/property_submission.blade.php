<!DOCTYPE html>
<html>
<head>
    <title>New Property Submission</title>
</head>
<body>
    <h2>New Property Submission from Seller: {{ $sellerName }}</h2>
    <p><strong>Property Title:</strong> {{ $propertyData['property_title'] }}</p>
    <p><strong>Property Description:</strong> {{ $propertyData['property_description'] }}</p>
    <p><strong>Property Price:</strong> {{ $propertyData['property_price'] }}</p>
</body>
</html>
