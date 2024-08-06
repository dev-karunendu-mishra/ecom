$(document).ready(function () {
    new DataTable('#example', {
        layout: {
            topStart: {
                //buttons: ['copy', 'excel', 'pdf', 'colvis']
                buttons: ['copy', 'excel', 'pdf']
            }
        }
    });
});