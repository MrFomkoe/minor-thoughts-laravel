@vite(['resources/scss/app.scss'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="login-page">
        <div class="errors">
            @foreach ($errors->all() as $message)
            <p>{{$message}}</p>
            @endforeach
        </div>
    
        <div class="login-form">
            <form action="/login" method="post">
                @csrf
                <input type="text" name="name" id="" placeholder="Username" value="{{old('name')}}">
                <input type="password" placeholder="Password" name="password">
                <button type="submit">Login</button>
                </form>
        </div>
    </div>
</body>
</html>