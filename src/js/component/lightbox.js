/**
 * Created by darkwolf on 18.02.2017.
 * Lightbox
 */
import {doc, win} from '../globals';
import resizeObserver from '../event/resize-observer';
import fastdom from '../util/fastdom';

import cross from '../resource/cross.svg';
import lbstyle from '../resource/lightbox.css';


export default (function() {
    //private member
    var _node,_inner,_close;

    function $lightBox() {
        var $this = this;
        if (!_node) {
            _node = doc.createElement("div");
            _node.classList.add("lightbox");
            _node.setAttribute("hidden", "true");
            _node.innerHTML = "<style>"+lbstyle+"</style>";

            _inner = doc.createElement("div");
            _inner.classList.add("lightbox-inner");
            _inner.classList.add("card-2");
            //_inner.innerHTML = "<p>LIGHTBOX</p>";
            _node.appendChild(_inner);

            _close = doc.createElement("button");
            _close.classList.add("lightbox-close");
            _close.innerHTML = cross;
            _node.appendChild(_close);


            _node.addEventListener("click",clickHandler.bind($this),false);
            doc.body.insertBefore(_node, doc.body.firstChild);
            console.log("lightbox created");
        }
        console.log("new instance from lightbox");
    }
    function clickHandler(event) {
        if (_inner.contains(event.target))
            return;
        this.close();
    }

    var fn = $lightBox.prototype;
    Object.defineProperty(fn, 'version', {value: "0.0.1"});
    fn.init = function () {
        var $this = this;
        $this.onopen = function () {
            return true;
        };
        $this.onclose = function () {
            return true;
        };


    }
    fn.open = function () {
        var $this = this;
        if (_node.hasAttribute("hidden") && $this.onopen.call($this)) {
            _node.removeAttribute("hidden");
            console.log("lightbox opend");
        }
    };
    fn.close = function () {
        var $this = this;
        if (!_node.hasAttribute("hidden") && $this.onclose.call($this)) {
            resizeObserver.unbind("lightbox");
            _node.setAttribute("hidden", "true");
            while (_inner.firstChild) {
                _inner.removeChild(_inner.firstChild);
            }
            console.log("lightbox closed");
        }
    };
    fn.create = function(source) {
        if (!source)
            return;
        var type = source.getAttribute("data-type");
        switch(type) {
            case "youtube": {
                return insertYouTube(source);
            }
        }
        return false;
    };
    /*private*/function insertYouTube(source) {
        var options = {width:1280,height:720,id:null,flags:""};
        var param = {};
        if (source.hasAttribute("data-param")) {
            param = JSON.parse(source.getAttribute("data-param"));
        }
        for (var i in param) {
            if (param.hasOwnProperty(i)) {
                options[i] = param[i];
            }
        }
        if (!options.id)
            return false;



        var node,pad,frame,src;

        node = doc.createElement("div");
        node.classList.add("video");
        videoFit(win.innerWidth,win.innerHeight);
        node.innerHTML = "<div class='video-text'>Video wird geladen...</div>";
        pad = doc.createElement("div");
        pad.style.paddingBottom = ""+(options.height*100/options.width)+"%";

        frame=doc.createElement("iframe");
        src = "https://www.youtube.com/embed/" + options.id + options.flags;
        frame.classList.add("video-player");
        frame.setAttribute("src",src);
        frame.setAttribute("frameborder",'0');
        frame.setAttribute("width",""+options.width);
        frame.setAttribute("width",""+options.height);
        frame.setAttribute("frameborder",'0');

        node.appendChild(pad);
        node.appendChild(frame);
        _inner.appendChild(node);

        function videoFit(width,height) {
            var videoWidth = options.width,ratio = options.height/options.width;
            width *= 0.9;
            height *= 0.9;
            if (width * ratio > height) {
                videoWidth = parseInt(height/ratio);
            }
            node.style.width = ""+videoWidth+"px";
        }
        resizeObserver.bind("lightbox",function(w,h){
            fastdom.mutate(function() {
                videoFit(w,h);
            })
        });
        return true;
    }

    var $instance = null;
    return function () {
        if (!$instance)
            $instance = new $lightBox();
        $instance.init();
        return $instance;
    }
}());


