/**
 * Created by darkwolf on 18.06.2016.
 * feature detection
 */
import {doc, win, html} from './globals'
import loadJS from './util/loadjs'
import createCmdQueue from './util/ready'
import loadCSS from './util/loadCSS';
import './util/cssrelpreload'

var kickstart = function () {
        /* Here comes the sloth code */
    }, s = (doc.body || html).style,
    /*Feature detection*/
    querySelectorAll = !!doc.querySelectorAll,
    classList = ("classList" in html),
    svg = !!document.createElementNS && !!document.createElementNS("http://www.w3.org/2000/svg", "svg").createSVGRect,
    flexbox = (s.flexBasis !== undefined || s.msFlexPack !== undefined),
    cookie = navigator.cookieEnabled,
    hasClass, addClass, removeClass, setClass;

function classReg(className) {
    return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
}

if (classList) {
    hasClass = function (c) {
        return html.classList.contains(c);
    };
    addClass = function (c) {
        html.classList.add(c);
    };
    removeClass = function (c) {
        html.classList.remove(c);
    };
}
else {
    hasClass = function (c) {
        return classReg(c).test(html.className);
    };
    addClass = function (c) {
        if (!hasClass(c)) {
            html.className = html.className + ' ' + c;
        }
    };
    removeClass = function (c) {
        html.className = html.className.replace(classReg(c), ' ');
    };
}
setClass = function (c, set) {
    if (set)
        addClass(c);
    else
        removeClass(c);
};

var sClass = ['js'
    , (svg ? "" : "no-") + "svg"
    , (flexbox ? "" : "no-") + "flex"
    , (cookie ? "" : "no-") + "cookie"

];

html.className = html.className.replace('no-js', sClass.join(' '));

kickstart.ready = createCmdQueue();
kickstart.loadCSS = loadCSS;
kickstart.i/*nit*/ = function (filelist) {

    if (querySelectorAll && classList && flexbox) {
        var className = "ext",
            finish = function (success) {
                clearTimeout(fallback);
                setClass(className, success);
            }
        addClass(className);
        var fallback = setTimeout(finish, 8000);
        loadJS(filelist["nav.js"], finish);
    }
    /*
    kickstart.cache = function () {
        if (cookie) {
            loadCSS(filelist["critical.css"], false, 'hidden', function () {
                console.log(this.href + " loaded");
            })
        }
    }
    */
    //µ.ready(function(){µ.loadCSS('@1',false,'hidden',function(){document.cookie=encodeURIComponent('@2');});});

};
export default kickstart;

