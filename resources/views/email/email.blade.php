<!DOCTYPE html>
<html>

<head>
    <title>Welcome Email</title>
</head>

<body>
    <h1>Welcome to Our Website</h1>
    <p>Thank you for signing up!</p>
    {{ $user->name }} <br>
    {{ $user->email }} <br>
    {{ $user->des }}
</body>

</html>
