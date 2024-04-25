$(document).ready(function () {
    $('[data-dropdown-toggle]').on('click', function () {
        var dropdownId = $(this).data('dropdown-toggle');
        $('#dropdown_' + dropdownId).toggle();
    });
});