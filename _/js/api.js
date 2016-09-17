$(".active").removeClass("active");
$("a[href=\"api.php\"]").parent().addClass("active");

$('.panel').on('show.bs.collapse', function (event) {
    console.log($(event.target));
    $(event.target).prev().addClass('active');
});

$('.panel').on('hide.bs.collapse', function (event) {
    $(event.target).prev().removeClass('active');
});