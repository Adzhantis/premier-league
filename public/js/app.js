$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    reloadClubTable();
    reloadPredictionsTable();
    nextWeekClickEvent();
});

function nextWeekClickEvent() {
    $(document).on('click', '#next-week', function () {
        playWeekGames();
    });
}

function reloadClubTable() {
    $.post('/league-table/clubs').then(response => {
        $('#club-data').html(response);
    }).catch(function (jqXHR) {
        alert(jqXHR.responseJSON.error);
    });
}

function reloadPredictionsTable() {
    $.post('/league-table/predictions').then(response => {
        $('#table-predictions').html(response);
    }).catch(function (jqXHR) {
        alert(jqXHR.responseJSON.error);
    });
}

function playWeekGames() {
    $.post('/league-table/play').then(response => {
        $('#match-results').html(response);
        reloadClubTable();
        reloadPredictionsTable();
    }).catch(function (jqXHR) {
        console.log(jqXHR.responseJSON);
        if (jqXHR.responseJSON.showResetBtn) {
            $('#next-week').hide();
            $('#reset').show();
        }
        if (jqXHR.responseJSON.hasOwnProperty('error')) {
            alert(jqXHR.responseJSON.error);
        }else if(jqXHR.responseJSON.hasOwnProperty('message')) {
            alert(jqXHR.responseJSON.message);
        }
    });
}
