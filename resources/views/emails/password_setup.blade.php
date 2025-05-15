<!DOCTYPE html>
<html>
<head>
    <title>Password Setup</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}</h1>
    <p>Your account has been created. Click the link below to set up your password:</p>
    <p><a href="{{ $resetLink }}">Set Up Password</a></p>
    <p>If you did not request this, please ignore this email.</p>
</body>
</html>
