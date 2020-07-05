<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>证书</title>
    <style>
        .certificate{
            background: url("/img/book.png");
            background-size: contain;
            background-repeat: no-repeat;
            width: 800px;
            height: 650px;
            position: relative;
            margin: auto;
        }
        .certificate .text{
            text-indent: 2em;
            text-align: justify;
            font-size: 1.7em;
            font-weight: bolder;
            position: absolute;
            top: 5.5em;
            padding: 2em;
            line-height: 1.6em;
        }
        .certificate .text b{
            font-size: 1.3em;
            margin: 0.2em;
        }
        .certificate .code{
            position: absolute;
            text-align: justify;
            bottom: 0.2em;
            right: 0.2em;
            padding: 1.2em;
            font-size: 1.3em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="text">
            尊敬的 <b>{{ $order->name }}</b> 同学, 感谢您于 {{  $order->created_at->toDateString() }}  通过易班平台捐赠 <b>{{ $order->count }}</b> 本图书，
            我们将会妥善安排您捐赠的图书。
        </div>
        <div class="code">

        </div>
    </div>
</body>
</html>
