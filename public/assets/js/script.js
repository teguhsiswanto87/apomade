$(document).ready(function () {
    $('.ui.dropdown').dropdown();
    $('.sidebar-menu-toggler').on('click', function () {
        var target = $(this).data('target');
        $(target)
            .sidebar({
                dinPage: true,
                transition: 'overlay',
                mobileTransition: 'overlay'
            })
            .sidebar('toggle');
    });
});

// message box
$('.message .close')
    .on('click', function () {
        $(this)
            .closest('.message')
            .transition('fade');
    });
