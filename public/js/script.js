document.onkeydown = function (e) {

    e = e || window.event;

    if (e.keyCode == 112) {
        e.preventDefault()

        window.open('/companies/create', 'new', 'width=550,height=200')
    } else if (e.keyCode == 27) {
        window.close()
    }
}