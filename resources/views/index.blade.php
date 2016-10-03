<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
                overflow: hidden;
            }
            canvas {
                position: absolute;
                top: 0;
                left: 0;
                z-index: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
                -moz-user-select: none;
                -webkit-user-select:none;
                -ms-user-select:none;
                user-select:none;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;

            }
            a:hover{
                color: #f66;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Auth::guest())
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Labbs
                </div>

                <div class="links">
                    <a href="{{url('/article')}}">Home</a>
                    <span>|</span>
                    <a href="https://laravel.com/docs" target="_blank">Laravel</a>
                    <span>|</span>
                    <a href="https://github.com/deadalusmask/labbs" target="_blank">GitHub</a>
                </div>
            </div>
        </div>
        <canvas>
        </canvas>
        <script>
            document.addEventListener('touchmove', function (e) {
                e.preventDefault()
            })
            var c = document.getElementsByTagName('canvas')[0],
                    x = c.getContext('2d'),
                    pr = window.devicePixelRatio || 1,
                    w = window.innerWidth,
                    h = window.innerHeight,
                    f = 90,
                    q,
                    m = Math,
                    r = 0,
                    u = m.PI*2,
                    v = m.cos,
                    z = m.random
            c.width = w*pr
            c.height = h*pr
            x.scale(pr, pr)
            x.globalAlpha = 0.4
            function i(){
                x.clearRect(0,0,w,h)
                q=[{x:0,y:h*.6+f},{x:0,y:h*.6-f}]
                while(q[1].x<w+f) d(q[0], q[1])
            }
            function d(i,j){
                x.beginPath()
                x.moveTo(i.x, i.y)
                x.lineTo(j.x, j.y)
                var k = j.x + (z()*2-0.25)*f,
                        n = y(j.y)
                x.lineTo(k, n)
                x.closePath()
                r-=u/-50
                x.fillStyle = '#'+(v(r)*127+128<<16 | v(r+u/3)*127+128<<8 | v(r+u/3*2)*127+128).toString(16)
                x.fill()
                q[0] = q[1]
                q[1] = {x:k,y:n}
            }
            function y(p){
                var t = p + (z()*2-1.1)*f
                return (t>h||t<0) ? y(p) : t
            }
            document.onclick = i
            document.ontouchstart = i
            i()
        </script>
    </body>
</html>
