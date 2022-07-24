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
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            height: 100vh;
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            text-align: center;
        }

        a {
            text-decoration: none;
            color: #636b6f;
        }
        a:hover {
            color: #335eea;
        }

        #section-header {
            margin-top: -50%;
        }

        #section-header .text-brand {
            font-size: 80px;
            color: #335eea;
            font-weight: bold;
        }

        #section-header .text-slogan {
            font-size: 24px;
        }

        #section-body {
            margin-top: 30px;
            font-size: 18px;
        }

        #section-footer {
            margin-top: 40px;
        }

        #section-footer .part-copyright {
            font-size: 14px;
        }
    </style>
</head>
<body>
<div>
    <div id="section-header">
        <div class="text-brand">{{ config('app.name') }}</div>
        <div class="text-slogan">简单交流，十分美好</div>
    </div>

    <div id="section-body">
        <div>官方网站: <a target="_blank" href="https://www.heycommunity.com">www.heycommunity.com</a></div>
        <div>产品文档: <a target="_blank" href="https://www.heycommunity.com/docs">www.heycommunity.com/docs</a></div>
    </div>

    <div id="section-footer">
        <div class="part-copyright">
            <div>powered by <a target="_blank" href="https://www.heycommunity.com">HeyCommunity</a></div>
            <div>&copy;2016 - {{ date('Y') }}</div>
        </div>
    </div>
</div>
</body>
</html>
