<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>提交成功</title>
    <style>
        body{
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100vh;
        }
        .success{
            width: 90vw;
            margin: auto;
            text-align: center;
            font-weight: bolder;
        }

        .right{
            display: flex;
            align-items: flex-end;
            justify-content: center;
            color: black;
        }
        .right::before,.right::after{
            background: currentColor;
        }
        .right::before{
            content: "";
            width: 1em;
            height: 3em;
            transform-origin: bottom right;
            transform: rotate(-45deg);
        }
        .right::after{
            content: "";
            width: 1em;
            height: 5em;
            transform-origin: bottom left;
            transform: rotate(45deg) translate(-1em,1em);
        }
        .success-text{
            margin-top: 50px;
            font-size: 1.3em;

        }
    </style>
</head>
<body>
<div class="success">
    <div class="right"></div>
    <p class="success-text">提交成功,感谢参与</p>
</div>

</body>
</html>
