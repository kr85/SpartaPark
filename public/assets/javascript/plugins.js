// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

(function() {
    jQuery.fn.centerElement = function () {

        var $self = $(this), _self = this;
        var window_resize = function(){
            var window_obj = $(window);
            $self.css({
                "position": "absolute",
                "top": (( window_obj.height() - _self.outerHeight()) / 2.5),
                "left": (( window_obj.width() - _self.outerWidth()) / 2)
            });
        }
        $self.bind('centerit', window_resize).trigger('centerit');
        $(window).bind('resize', function(){
            $self.trigger('centerit');
        });
        return _self;

    }
}());

(function() {
    jQuery.fn.setFlipElements = function (elementOne, elementTwo, elementThree) {

        var $self = $(this),
            $elementOne = $(elementOne),
            $elementTwo = $(elementTwo),
            $elementThree = $(elementThree);

        $self
            .mouseenter(function() {
                $elementOne.removeClass('flipInY');
                $elementOne.addClass('flipOutY');

                $elementTwo.removeClass('flipInY');
                $elementTwo.addClass('flipOutY');

                $elementThree.removeClass('flipInY');
                $elementThree.addClass('flipOutY');

            })
            .mouseleave(function() {
                $elementOne.removeClass('flipOutY');
                $elementOne.addClass('flipInY');

                $elementTwo.removeClass('flipOutY');
                $elementTwo.addClass('flipInY');

                $elementThree.removeClass('flipOutY');
                $elementThree.addClass('flipInY');

            });
    }
}());

(function() {
    jQuery.fn.setDimElements = function (elementOne, elementTwo) {

        var $self = $(this),
            $elementOne = $(elementOne),
            $elementTwo = $(elementTwo);

        $self
            .mouseenter(function() {
                $elementOne.addClass('dim-black');
                $elementTwo.addClass('dim-black');
            })
            .mouseleave(function() {
                $elementOne.removeClass('dim-black');
                $elementTwo.removeClass('dim-black');
            });
    }
}());