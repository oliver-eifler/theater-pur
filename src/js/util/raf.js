/**
 * Olli Lib
 * This file is part of the Olli-Framework
 * Copyright (c) 2012-2015 Oliver Jean Eifler
 *
 * @version 0.0.1
 * @link http://www.oliver-eifler.info/
 * @author Oliver Jean Eifler <oliver.eifler@gmx.de>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 *
 * RequestAnimationFrame & Polyfill
 */
import {win,VENDOR_PREFIXES} from "../globals.js";

    var raf = win.requestAnimationFrame,
        caf = win.cancelAnimationFrame,
        fastRaf,
        lastTime = 0;
    if (!(raf && caf))
    {
        VENDOR_PREFIXES.forEach(function(prefix) {
            prefix = prefix.toLowerCase();

            raf = raf || win[prefix + "RequestAnimationFrame"];
            caf = caf || win[prefix + "CancelAnimationFrame"] || win[prefix + "CancelRequestAnimationFrame"];
        });
    }
    fastRaf = raf;
    if (!raf || !caf) {
      raf = function(callback) {
        var currTime = new Date().getTime();
        var timeToCall = Math.max(0, 16 - (currTime - lastTime));
        lastTime = currTime + timeToCall;
        return win.setTimeout(function() {callback(currTime + timeToCall);}, timeToCall);
      };
      caf = function(id) {
        win.clearTimeout(id);
      };
    }
    fastRaf = fastRaf || raf;

    export {raf,caf,fastRaf};