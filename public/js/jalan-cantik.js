const month = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

function dateToLocaleString(date) {
    let d = new Date(date);
    return d == NaN
        ? "Tanggal tidak sesuai"
        : `${d.getDate()} ${month[d.getMonth()]} ${d.getFullYear()} | ${d.getHours()}:${d.getMinutes()}`
}

$(document).ready(function () {
    $('.show-on-scroll').each(function (i) {
        console.log(this)
        show(this)
    });
    /* Every time the window is scrolled ... */
    $(window).scroll(function () {
        /* Check the location of each desired element */
        $('.show-on-scroll').each(function (i) {
            show(this)
        });
    });

    function show(element) {
        let delay = $(element).attr('animate-delay') ?? 0;
        let duration = $(element).attr('animate-duration') ?? 600;

        var bottom_of_object = $(element).offset().top;
        var bottom_of_window = $(window).scrollTop() + $(window).height();

        /* If the object is completely visible in the window, fade it it */
        if (bottom_of_window > bottom_of_object) {
            $(element).delay(delay).queue(function (next) {
                $(element).css("transform", "translateY(0)")
                $(element).animate({ 'opacity': '1', }, duration);
                next(); 
            })
            
        }
    }
});