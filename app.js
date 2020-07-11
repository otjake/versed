$(function () {
SyntaxHighlighter.all();
});
$(window).load(function () {
$('.flexslider').flexslider({
    animation:"slider",
    start:function (slider) {
        $('body').removeClass('loading');
    }
});
});