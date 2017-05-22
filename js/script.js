$('.show_popup').click(function() {
    var popup_id =$(this).attr("href");
	//var date =$(this).attr("data-date");
    $(popup_id).show();
    $('.overlay_popup').show();
})
$('.modal_close').click(function() {
    $('.overlay_popup, .popup').hide();
})



