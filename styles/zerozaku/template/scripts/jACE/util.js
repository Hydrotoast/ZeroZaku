function Queue(nodeLength) {
	this.nodes = [ null, null, null ];
	this.head = 0;
	this.tail = 0;
}

Queue.prototype = {
	dequeue : function() {
		var node = null;
		if (this.head !== this.tail) {
			node = this.nodes[this.head++];
			this.nodes[this.head - 1] = null;
		}
		this.head %= this.nodes.length;
		return node;
	},
	enqueue : function(item) {
		this.nodes[this.tail++] = item;
		this.tail %= this.nodes.length;
	},
	peek : function() {
		return this.nodes[this.head];
	},
	empty : function() {
		return this.head === this.tail;
	},
	full : function() {
		return this.tail + 1 === this.head;
	}
};

/**
 * Find GCF of two integers
 * @param {p_a} first integer to compare
 * @param {p_b} second integer to compare
 */
function hcf(p_a, p_b){
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
}

/**
 * Locate the real position of an element,
 * relative to its parent's offsets
 * @param {p_obj} DOM element to find offset of
 */
function findPos(p_obj) {
    var curleft = 0,
        curtop = 0;

    if (p_obj.offsetParent) {
        do {
            curleft += p_obj.offsetLeft;
            curtop += p_obj.offsetTop;
        } while (p_obj = p_obj.offsetParent);

        return { x: curleft, y: curtop };
    }
}

/**
 * Create an RGBA color string
 * @param {p_rgb} RGB values for the color
 * @param {p_opacity} opacity of the color
 * @return RGBA color string
 */
function color(p_rgb, p_opacity) {
	return 'rgba(' + p_rgb + ', ' + (p_opacity ? p_opacity : 1) + ')';
}
