/**
 * Aspect Debugger (aDbg)
 */
var A = function(obj) {
    /**
     * Hooks a function before another
     * @param {fname} object method that is being hooked
     * @param {fn_before} function called before fname
     */
    this.before = function(fname, fn_before) {
        var fn_old = obj[fname];
        obj[fname] = function() {
            return fn_old.apply(this, fn_before.call(this, arguments, fn_old));
        };
    };

    /**
     * Hooks a function after another
     * @param {fname} object method that is being hooked
     * @param {fn_after} function called after fname
     */
    this.after = function(fname, fn_after) {
        var fn_old = obj[fname];
        obj[fname] = function() {
            return fn_after.apply(this, fn_old.call(this, arguments), arguments, fn_old);
        };
    };

    /**
     * Hooks a function with respect to another
     * @param {fname} object method that is being hooked
     * @param {fn_around} function called around fname
     */
    this.around = function(fname, fn_around) {
        var fn_old = obj[fname];
        obj[fname] = function() {
            return fn_around.call(this, arguments, fn_old);
        };
    };

    return this;
};