<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .content {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="full-height">
    <div class="content">
        <div class="title" style="padding-top:14%; font-size:120px;">
            {{ config('app.name') }}
        </div>
        <div style="padding-top:30px; color:#AAA;">
            <div>
                powered by <a target="_blank" href="https://www.heycommunity.com" style="color:#AAA;">HeyCommunity</a>
            </div>
            <div style="padding-top:6px;">&copy;2021</div>
        </div>
    </div>
</div>
</body>
</html>
