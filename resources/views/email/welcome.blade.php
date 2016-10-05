<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to labbs</title>
</head>
<body>
    <h3>Welcome to labbs {{ $user->name }}</h3>
    <a href="{{ url('/active').'?id='.$user->id.'&token='.$user->token }}">点击激活</a>
    <p>或使用此链接:
        <a href="{{ url('/active').'?id='.$user->id.'&token='.$user->token }}">
            {{ url('/active').'?id='.$user->id.'&token='.$user->token }}
        </a>
    </p>
</body>
</html>