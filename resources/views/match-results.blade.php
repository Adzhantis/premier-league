<h2 style="text-align: center">Match Results</h2>
<h6 style="text-align: center">{{ $currentWeekNumber }}-th Week Match Result:</h6>
<table class="table" id="match-results">
    @foreach($games as $game)
        <tr>
            <td>{{ $game->firstClub->name }}</td>
            <td>{{ $game->firstClub->currentGoalsFor }} : {{ $game->secondClub->currentGoalsFor }}</td>
            <td>{{ $game->secondClub->name }}</td>
        </tr>
    @endforeach
</table>
