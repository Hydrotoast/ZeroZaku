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
function roundRect(ctx, x, y, width, height, radius, fill, stroke) {
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
}

function circle(ctx, radius, stroke) {
	ctx.beginPath();
	ctx.arc(0, 0, radius, 0, Math.PI * 2, false);
	ctx.closePath();
	
	if (stroke === true) {
		ctx.stroke();
	} else {
		ctx.fill();
	}
}


function Player(ctx, stroke) {
	
	// Base
    ctx.save();
    ctx.translate(-22.5, -24.875);
	    ctx.beginPath();
	    ctx.moveTo(28.0, 5.9);
	    ctx.bezierCurveTo(38.3, 8.0, 46.0, 17.1, 46.0, 28.1);
	    ctx.bezierCurveTo(46.0, 40.7, 35.9, 50.9, 23.5, 50.9);
	    ctx.bezierCurveTo(11.1, 50.9, 1.0, 40.7, 1.0, 28.1);
	    ctx.bezierCurveTo(1.0, 17.2, 8.7, 8.0, 19.0, 5.9);
	    ctx.fillStyle = color(config.fgColor);
	    ctx.fill();
	    ctx.lineWidth = 2.0;
	    if (stroke === true) {
		    ctx.strokeStyle = color(config.hlColor);
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
	    ctx.fillStyle = color(config.hlColor);
	    ctx.fill();
	    ctx.strokeStyle = color(config.hlColor);
	    ctx.stroke();
    ctx.restore();
}