$('.show_popup').click(function() {
    var popup_id =$(this).attr("href");
	//var date =$(this).attr("data-date");
    $(popup_id).show();
    $('.overlay_popup').show();
})
$('.modal_close').click(function() {
    $('.overlay_popup, .popup').hide();
})
 // Slider - owl carousel plugin
 control = $(".owl-dot"),
 control_active = $(".owl-dot.active");

$('.owl-carousel').owlCarousel({
    items:1,
    loop:true,
    margin:10,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true
  });
