$(document).ready(function() {
    // loading data
    function loadTable() {
        $.ajax({
            url: 'load_data.php',
            type: 'POST',
            success: function(data) {
                $('#insert-table-data').html(data);
            }
        });
    }
    loadTable();
});