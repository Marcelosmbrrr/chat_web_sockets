<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/style.css')}}">
    @vite('resources/js/app.js')
    <title>{{ env('APP_NAME'); }}</title>
</head>

<body>

    <div class="container">
        <section class="top">
            <h1>Chat with Pusher + Laravel Echo</h1>
        </section>
        <section id="output">
            <!-- <div class='message own'><textarea disabled rows='1'>You: ${value}</textarea></div> -->
            <ul id="messages_list">
            </ul>
        </section>
        <section class="footer">
            <div class="top">
                <input type="text" placeholder="Type your message and press Enter"
                    style="width: 100%; background-color: #F6F6F6;" id="username" />
            </div>
        </section>
    </div>

</body>
</html>