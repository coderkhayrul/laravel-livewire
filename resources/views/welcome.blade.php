<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Liveware</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
{{--    @livewireStyles--}}
    <livewire:styles/>
</head>
<body>

    <div class="container">
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <h1 class="text-red-600">Laravel Livewire</h1>--}}
{{--                <hr>--}}
{{--                @livewire('counter')--}}
{{--            </div>--}}
{{--        </div>--}}

        <livewire:comments/>
    </div>
    <livewire:scripts/>
</body>
</html>
