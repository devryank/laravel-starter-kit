function darkModeOff() {
    $('a, button, html').css({
        'filter': '',
    })
}
function darkModeOn() {
    $('a, button, html').css({
        'filter': 'invert(1) hue-rotate(180deg)',
    })
}

let DarkMode = localStorage.getItem('DarkMode');
if (DarkMode == "false") {
    darkModeOff();
    localStorage.setItem('DarkMode', false);
    $('#mode').addClass('fa-toggle-off');
} else {
    darkModeOn();
    localStorage.setItem('DarkMode', true);
    $('#mode').addClass('fa-toggle-on');
}

$('#change-mode').click(function () {
    if ($(this).find('i').hasClass('fa-toggle-off')) {
        darkModeOn();
        DarkMode = true;
        localStorage.setItem('DarkMode', true)
        console.log(DarkMode);
    } else {
        darkModeOff();
        DarkMode = false;
        localStorage.setItem('DarkMode', false)
        console.log(DarkMode);
    }
    $(this).find('i').toggleClass('fa-toggle-off fa-toggle-on')
})