<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>表单填写</title>
    <style>
        .head{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: end;
            margin-top: 1.5em;
            margin-bottom: 3em;
        }
        .head img{
            width: 5em;
            height: 5em;
            border-radius: 50%;
        }
        .head p{
            font-size: 1.7em;
            font-weight: bolder;
        }
        .form-cell{
            font-size: 18px;
            display: flex;
            margin: 1em 0;
            justify-content: center;
            font-weight: bolder;

        }
        .form-cell label{
            width: 5em;
            text-align-last: justify;
        }
        .form-cell label::after{
            content: ":";
        }
        .form-cell input{
            border-style: solid;
            border-width: 0 0 0.1em 0;
            padding: 0.1em 0.5em;
            width: 10em;
            outline: none;
            background: transparent;
        }
        .submit-container{
            margin-top: 5em;
            text-align: center;
        }
        .submit-container a{
            text-decoration: none;
            font-size: 0.9em;
        }
        .submit{
            border: 0.2em solid black;
            background: transparent;
            padding: 0.1em 2em;
            font-weight: bolder;
            font-size: 1.3em;
        }
    </style>
</head>
<body>
@if(auth()->check())
<div class="head">
    <img src="/img/sust.jpg" alt="">
   <p>
       图书捐赠登记表
   </p>
</div>
<div id="app">
    <form action="/order/add" method="POST" @submit="onSubmit">
    {{ csrf_field() }}
    <div class="container">
        <div class="form-cell">
            <label>
                姓名
            </label>
            <input type="text" v-model="form.name" name="name">
        </div>

        <div class="form-cell">
            <label for="">
                邮箱
            </label>
            <input type="email" v-model="form.email" name="email">
        </div>

        <div class="form-cell">
            <label for="">
                捐书数目
            </label>
            <input type="number" min="1" v-model="form.count" name="count" pattern="\d+">
        </div>

        <div class="form-cell">
            <label for="">
                捐赠时间
            </label>
            <input type="text" value="{{  date("Y-m-d H:i")}}" disabled>
        </div>

        <div class="submit-container">
            <button type="submit" class="submit">提交</button>
        </div>
    </div>
    </form>

</div>
    @else
<div class="">
    未登录
    <p>
        <a href="/yiban/auth">点击登录</a>
    </p>
    @endif
</div>
</body>
</html>
