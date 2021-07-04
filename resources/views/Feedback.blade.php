<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400;500;600&display=swap" />
    <title>
        การตอบกลับ ()</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Prompt', sans-serif !important;
    }
    body{
        background: rgb(58, 58, 58);
    }
</style>

<body>
    <div id="app">
        <feedback-component success={{route('success')}} save={{route('savefeedback')}} question={{route('getquestion')}} token="{{$token}}" club="{{$club}}"></feedback-component>
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>
