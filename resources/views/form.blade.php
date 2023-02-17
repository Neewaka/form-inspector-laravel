<?php
use Illuminate\Support\Facades\Blade;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Styles -->

</head>

<body class="antialiased">

    <form action="inspect" method="POST" id="form-input">
        @csrf
        <div class="m-4 container">
            <div class="row">
                <div class="col-4">
                    <div class="mb-3">
                        <input id="formInput" type="hidden" name="text">

                        <div id="inputText" class="form-control {{ $isInspected }}" contenteditable>
                            {!! $text !!}
                        </div>

                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary col-6 ml-2">Inspect</button>
                        <div class="col-6 text-center">
                            Current language is: {{ $language }}
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <h2>History of inspections:</h2>
                    @foreach ($history as $item)
                        <div class="row border p-2 m-2">
                            <div class="col-6">{!! $item->text !!}</div>
                            <div class="col-6">original language: {{ $item->language }}</div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
