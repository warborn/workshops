<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"> -->
        <!-- <link rel="stylesheet" href="/vendor/css/font-awesome.min.css" type="text/css"> -->
        <link rel="stylesheet" href="/vendor/css/bulma.min.css" type="text/css">
        <link rel="stylesheet" href="/css/app.css?v=1" type="text/css">
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
        <script src="/vendor/js/axios.min.js"></script>
        <script src="/vendor/js/vue.min.js"></script>
        <script src="/vendor/js/thenby.min.js"></script>
        <script>
            window.Event = new Vue();

            var lists = { 
                teachers: [],
                courses: [],
                classrooms: []
            };

            String.prototype.to12 = function() {
                // Check correct time format and split into components
               time = this.match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [this];
               if (time.length > 1) { // If time format correct
                 time = time.slice (1, time.length - 1);  // Remove full string match value
                 time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM
                 time[0] = +time[0] % 12 || 12; // Adjust hours
               }
               return time.join (''); // return adjusted time or original string
            }
        </script>
        <script src="/js/errors.js"></script>
        <script src="/js/form.js?v=1"></script>
        @stack('vue')
    </body>
</html>
