<h4 style="text-align: center">{{ $currentWeekNumber }}-th Week Predictions of Championship</h4>
<table class="table">
    @foreach($clubs as $club)
        <tr>
            <td> {{ $club->name }} </td>
            <td>{{ $club->chanceToWin }} % </td>
        </tr>
    @endforeach
</table>
