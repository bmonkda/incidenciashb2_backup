<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form action="{{ route('login') }}" method="post">
        @csrf
        
        <label for="">
            <input type="email" name="email" id="" placeholder="Email...">
        </label>

        <label for="">
            <input type="password" name="password" id="" placeholder="Password...">
        </label>

        <input type="submit" value="Login">

    </form>
</body>
</html>