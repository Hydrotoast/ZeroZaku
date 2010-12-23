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
 * @param {a} first integer to compare
 * @param {b} second integer to compare
 */
function hcf(a, b){
    var gcd = 1;
    if (a > b) {
        a = a + b;
        b = a - b;
        a = a - b;
    }
    if ((b == (Math.round(b / a)) * a)) {
        gcd = a
    }
    else {
        for (var i = Math.round(a / 2); i > 1; i = i - 1) {
            if ((a == (Math.round(a / i)) * i)) 
                if ((b == (Math.round(b / i)) * i)) {
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
 * @param {obj} DOM element to find offset of
 */
function findPos (obj) {
    var curleft = 0,
        curtop = 0;

    if (obj.offsetParent) {
        do {
            curleft += obj.offsetLeft;
            curtop += obj.offsetTop;
        } while (obj = obj.offsetParent);

        return { x: curleft, y: curtop };
    }
}
