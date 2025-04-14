<!DOCTYPE html>
<html>
<head>
    <title>New Audit Log</title>
</head>
<body>
    <h2>New Action Logged</h2>
    <p><strong>User ID:</strong> {{ $log['user_id'] }}</p>
    <p><strong>Action:</strong> {{ $log['action'] }}</p>
    <p><strong>Description:</strong> {{ $log['description'] }}</p>
</body>
</html>
