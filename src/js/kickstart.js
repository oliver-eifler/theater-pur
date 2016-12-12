/**
 * Created by darkwolf on 18.06.2016.
 * feature detection
 */
import {doc, win, html} from './globals'
import loadJS from './util/loadjs'
import supports from './util/checkstyle'

var kickstart = function () {
        /* Here comes the sloth code */
    }, s = (doc.body || html).style,
    /*Feature detection*/
    querySelectorAll = !!doc.querySelectorAll,
    classList = ("classList" in html),
    svg = !!document.createElementNS && !!document.createElementNS("http://www.w3.org/2000/svg", "svg").createSVGRect,
    flexbox = (s.flexBasis !== undefined || s.msFlexPack !== undefined),
    hasClass, addClass, removeClass,setClass;

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
setClass=function(c,set) {
    if (set)
        addClass(c);
    else
        removeClass(c);
};

var sClass = ['js'
,(svg ? "" : "no-") + "svg"
,(flexbox ? "" : "no-") + "flex"
];

html.className = html.className.replace('no-js', sClass.join(' '));

kickstart.i/*nit*/ = function (filelist) {

    if (querySelectorAll && classList && flexbox) {
        var className = "ext",
            finish = function(success) {
            clearTimeout( fallback );
            setClass(className,success);
        }
        addClass(className);
        var fallback = setTimeout(finish, 8000 );
        loadJS(filelist["nav.js"],finish);
    }

};

export default kickstart;