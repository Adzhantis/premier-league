<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Premier League</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <!-- JS only -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>

    <div class="table-responsive col-12">
            <h1 style="text-align: center">League Table</h1>
            <table class="table">
                <thead>
                <tr>
                    <th class="text-centre"><div class="thFull">Position</div></th>
                    <th class="team">Club</th>
                    <th scope="col">Played</th>
                    <th scope="col">Won</th>
                    <th scope="col">Drawn</th>
                    <th scope="col">Lost</th>
                    <th scope="col">GD</th>
                    <th scope="col">Points</th>
                </tr>
                </thead>
                <tbody id="club-data"></tbody>
            </table>
        </div>

        <div class="col-12">
            <div class="table-responsive wrapper col-md-6" style="float: left">
                <div id="match-results"></div>
                <button id="next-week" class="btn btn-danger" style="float: right">
                    Next week
                </button>
                <a class="btn btn-success" href="{{ url('reset') }}" id="reset" style="float: right;display: none">
                    Go to next League
                </a>
            </div>
            <div id="table-predictions" class="table-responsive wrapper col-md-5" style="float: right"></div>
        </div>
    </body>
</html>
