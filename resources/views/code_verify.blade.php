<!-- resources/views/auth/verify-code.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Code</title>
</head>
<body>
    <h1>Enter Verification Code</h1>
    <form action="{{ route('auth.verify.code') }}" method="POST">
        @csrf
        <label for="code">Verification Code:</label>
        <input type="text" name="code" id="code" required>
        <button type="submit">Submit</button>   
    </form>
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
</body>
</html>
