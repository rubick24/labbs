<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to labbs</title>
</head>
<body>
    <h3>Welcome to labbs {{ $user->name }}</h3>
    <a href="{{ url('/active').'?id='.$user->id.'&token='.$user->token }}">点击激活</a>
</body>
</html>