$(document).ready(function(){
    function mq(){
        var event = $(".calendar_event");
        var icon_event = $(".calendar_icon");
        var mq = window.matchMedia( "(min-width: 768px)" );
        if (mq.matches) {
            event.show();
            icon_event.hide();
        }
        else{
            event.hide();
            icon_event.css('display', 'block');
        }
    }
    window.addEventListener('resize', mq, false);
})