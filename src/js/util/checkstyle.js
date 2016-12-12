/**
 * Created by darkwolf on 07.12.2016.
 */
import {doc, win, html} from '../globals'
export default (function(undefined) {
    var element,
        nativeSupport = (function() {
            if ('CSS' in win && 'supports' in win.CSS) {
                return win.CSS.supports;
            }
            // Check Opera's native method
            if('supportsCSS' in win){
                return win.supportsCSS;
            }
            return function() {return false};
        }());

    return function(prop,value) {
        value = arguments.length === 2 ? value : 'inherit';
        // Try the native standard method first
        var support = nativeSupport(prop,value);
        if (support)
            return support;

        // Convert to camel-case for DOM interactions
        var camel = prop.replace(/-([a-z]|[0-9])/ig, function(all, letter) {
            return (letter + '').toUpperCase();
        });
        element = element||doc.createElement('div');

        support = camel in element.style;
        if (value === 'inherit') {
            return support;
        }

        element.style.cssText = prop + ':' + value;
        console.log(prop+" "+element.style[camel]+" "+support+" "+(element.style[camel] === value));
        return (support && element.style[camel] === value);
    }


})();
