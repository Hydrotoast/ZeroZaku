var $ = jACE_config;
(function(ulib) {
    /**
     * Draws a rounded rectangle using the current state of the canvas.
     * If you omit the last three params, it will draw a rectangle
     * outline with a 5 pixel border radius
     * @param {CanvasRenderingContext2D} ctx
     * @param {Number} x The top left x coordinate
     * @param {Number} y The top left y coordinate
     * @param {Number} width The width of the rectangle
     * @param {Number} height The height of the rectangle
     * @param {Number} radius The corner radius. Defaults to 5;
     * @param {Boolean} fill Whether to fill the rectangle. Defaults to false.
     * @param {Boolean} stroke Whether to stroke the rectangle. Defaults to true.
     */
    ulib.RoundRect = function(ctx, x, y, width, height, radius, fill, stroke) {
        if (typeof stroke == "undefined" ) {
            stroke = true;
        }
        if (typeof radius === "undefined") {
            radius = 5;
        }
        ctx.beginPath();
        ctx.moveTo(x + radius, y);
        ctx.lineTo(x + width - radius, y);
        ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
        ctx.lineTo(x + width, y + height - radius);
        ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
        ctx.lineTo(x + radius, y + height);
        ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
        ctx.lineTo(x, y + radius);
        ctx.quadraticCurveTo(x, y, x + radius, y);
        ctx.closePath();
        if (stroke) {
            ctx.stroke();
        }
        if (fill) {
            ctx.fill();
        }
    };

    ulib.Circle = function(ctx, radius, stroke) {
        ctx.beginPath();
        ctx.arc(0, 0, radius, 0, Math.PI * 2, false);
        ctx.closePath();

        if (stroke === true) {
            ctx.stroke();
        } else {
            ctx.fill();
        }
    };


    ulib.Player = function(ctx, stroke) {

        // Base
        ctx.save();
        ctx.translate(-22.5, -24.875);
            ctx.beginPath();
            ctx.moveTo(28.0, 5.9);
            ctx.bezierCurveTo(38.3, 8.0, 46.0, 17.1, 46.0, 28.1);
            ctx.bezierCurveTo(46.0, 40.7, 35.9, 50.9, 23.5, 50.9);
            ctx.bezierCurveTo(11.1, 50.9, 1.0, 40.7, 1.0, 28.1);
            ctx.bezierCurveTo(1.0, 17.2, 8.7, 8.0, 19.0, 5.9);
            ctx.fillStyle = $.color(localplayer.nodeColor);
            ctx.fill();
            ctx.lineWidth = 2.0;
            if (stroke === true) {
                ctx.strokeStyle = $.color($.hlColor);
                ctx.stroke();
            }
        ctx.restore();

        // Arrowhead
        ctx.save();
        ctx.translate(-22.5, -24.875);
            ctx.beginPath();
            ctx.moveTo(23.5, 1.1);
            ctx.lineTo(18.3, 11.6);
            ctx.lineTo(23.5, 8.1);
            ctx.lineTo(28.8, 11.6);
            ctx.lineTo(23.5, 1.1);
            ctx.closePath();
            ctx.fillStyle = $.color($.hlColor);
            ctx.fill();
            ctx.strokeStyle = $.color($.hlColor);
            ctx.stroke();
        ctx.restore();
    };

    /**
    * Find GCF of two integers
    * @param {p_a} first integer to compare
    * @param {p_b} second integer to compare
    */
    ulib.hcf = function(p_a, p_b) {
        var gcd = 1;
        if (p_a > p_b) {
            p_a = p_a + p_b;
            p_b = p_a - p_b;
            p_a = p_a - p_b;
        }
        if ((p_b == (Math.round(p_b / p_a)) * p_a)) {
            gcd = p_a
        }
        else {
            for (var i = Math.round(p_a / 2); i > 1; i = i - 1) {
                if ((p_a == (Math.round(p_a / i)) * i))
                    if ((p_b == (Math.round(p_b / i)) * i)) {
                        gcd = i;
                        i = -1;
                    }
            }
        }
        return gcd;
    };

    /**
    * Locate the real position of an element,
    * relative to its parent's offsets
    * @param {p_obj} DOM element to find offset of
    */
    ulib.findPos = function(p_obj) {
        var curleft = 0,
            curtop = 0;

        if (p_obj.offsetParent) {
            do {
                curleft += p_obj.offsetLeft;
                curtop += p_obj.offsetTop;
            } while (p_obj = p_obj.offsetParent);

            return { x: curleft, y: curtop };
        }
    };

    /**
    * Create an RGBA color string
    * @param {p_rgb} RGB values for the color
    * @param {p_opacity} opacity of the color
    * @return RGBA color string
    */
    ulib.color = function(p_rgb, p_opacity) {
        if (p_rgb.match(/#[0-9A-Fa-f]{6}/i)) {
            return p_rgb;
        } else {
            return 'rgba(' + p_rgb + ', ' + (p_opacity ? p_opacity : 1) + ')';
        }
    };
})($)