<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
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