<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <x-includes.css />

        <title>{{ config('app.name') }} | {{ $title }}</title>
    </head>
    <body>
        <x-includes.navbar />
        
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-3">
                    {{ $rightSection }}
                </div>
                <div class="col-md-6">
                    {{ $mainSection }}
                </div>
                <div class="col-md-3">
                    {{ $leftSection }}
                </div>
            </div>
        </div>
        <x-includes.js />
    </body>
</html>