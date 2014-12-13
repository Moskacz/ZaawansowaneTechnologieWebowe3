
/**
 * Created by michalmoskala on 12/12/14.
 */

function insertDatesIntoDatabase() {
    var datePickerFrom = document.getElementById('date_from');
    var datePickerTo = document.getElementById('date_to');
    var parameters = {'from': datePickerFrom.value, 'to': datePickerTo.value};

    $.ajax({
        type: "POST",
        data: parameters,
        url: "datesInserter.php",
        async: false
    });
}
