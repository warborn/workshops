<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.3.1/css/bulma.min.css" type="text/css">
        <link rel="stylesheet" href="/css/app.css" type="text/css">
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://unpkg.com/vue@2.1.10/dist/vue.js"></script>
        <script>window.Event = new Vue();</script>
        <script src="/js/errors.js"></script>
        <script src="/js/form.js"></script>
        <script src="/js/app.js"></script>
        @stack('vue')
    </body>
</html>
