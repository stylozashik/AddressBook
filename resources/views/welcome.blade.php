<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Full Stack Address Book</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script>

            (function() {
                window.Laravel = {
                    csrfToken: '{{ csrf_token() }}'
                };
            })();

        </script>

    </head>

    <body>
        <div id='app'>
            <mainapp></mainapp>
        </div>
    </body>

    <script src="{{mix('/js/app.js')}}"></script>

</html>
