var AplombApp = function () {
    "use strict";
    var e = $(window),
        n = $("body"),
        t = $(document),
        o = $(".body-content"),
        c = $("#wrapper"),
        l = $("#sidebar-main"),
        i = $("#status"),
        u = $("#preloader"),
        a = $(".button-menu-mobile"),
        r = $("#btn-fullscreen"),
        s = $("#sidebar-menu a"),
        d = $(".has_sub"),
        m = function () {
            d.each(function () {
                var e = $(this);
                e.hasClass("nav-active") && e.find("> ul").slideUp(300, function () { e.removeClass("nav-active") })
            })
        },
        f = function () { var e = t.height(); e > o.height() && o.height(e) }, h = function (e) { i.fadeOut(), u.delay(350).fadeOut("slow"), n.delay(350).css({ overflow: "visible" }) }, p = function (e) { $('[data-toggle="tooltip"]').tooltip(), $('[data-toggle="popover"]').popover(), l.slimscroll({ height: "auto", position: "right", size: "8px", color: "#9ea5ab" }), a.on("click", function (e) { return e.preventDefault(), n.toggleClass("fixed-left-void"), c.toggleClass("enlarged"), !1 }), s.on("click", function (e) { var t = $(this).parent(), c = t.find("> ul"); n.hasClass("sidebar-collapsed") || (c.is(":visible") ? c.slideUp(300, function () { t.removeClass("nav-active"), o.css({ height: "" }), f() }) : (m(), t.addClass("nav-active"), c.slideDown(300, function () { f() }))) }), s.each(function () { this.href == window.location.href && ($(this).addClass("active"), $(this).parent().addClass("active"), $(this).parent().parent().prev().addClass("active"), $(this).parent().parent().parent().addClass("active"), $(this).parent().parent().prev().click()) }), r.on("click", function (e) { return e.preventDefault(), document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement ? document.cancelFullScreen ? document.cancelFullScreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitCancelFullScreen && document.webkitCancelFullScreen() : document.documentElement.requestFullscreen ? document.documentElement.requestFullscreen() : document.documentElement.mozRequestFullScreen ? document.documentElement.mozRequestFullScreen() : document.documentElement.webkitRequestFullscreen && document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT), !1 }) }; return { init: function () { t.ready(p), e.on("load", h) } }
}();
!function (e) { 
    "use strict";
    AplombApp.init() }
    (window.jQuery), $(document).keydown(function (e) { return 123 != e.keyCode && (!(e.ctrlKey && e.shiftKey && 73 == e.keyCode || e.ctrlKey && e.shiftKey && 74 == e.keyCode) && void 0) });
var isCtrl = !1;