/**
 * Created by darkwolf on 12.11.2016.
 * The Header MainMenu based on GreedyNav by lukejacksonn (https://github.com/lukejacksonn/GreedyNav)
 */
import {doc, win} from '../globals';
import fastdom from '../util/fastdom';
import resizeObserver from '../event/resize-observer';
import fontsizeObserver from '../event/fontsize-observer';



export default (function() {


    var $nav,$btn,$vlinks,$hlinks,
        btnWidth,
        totalItems = 0,
        vItems=[],
        hItems=[],
        breakWidths = [],
        isVisible = [],
        bBusy=false,bTrigger=false,bFontSizeChanged=false;

    function init() {
        $nav = doc.querySelector('.nav');
        $btn = $nav.querySelector('.nav-button');
        $vlinks = $nav.querySelector('.nav-links');
        $hlinks = $nav.querySelector('.nav-hidden-links');

        build();
        measure();
        check();
        //win.addEventListener('resize', check, false);
        $btn.addEventListener('click', function () {
            togglePulldown();
        }, false);
        resizeObserver.bind("mainmenu",function() {
            onResize();
        });
        fontsizeObserver.bind("mainmenu",function() {
            bFontSizeChanged=true;
            onResize();
        });
    }
    function onResize() {
        if (!bBusy) {
            check();
        } else {
            bTrigger = true;
        }
    }

    function build() {
        //clone nodes
        totalItems = 0;
        vItems = [].slice.call($vlinks.children);
        vItems.forEach(function(item) {
            var node = item.cloneNode(true);
            node.classList.add('hidden');
            //node.styles.display = 'none';
            $hlinks.appendChild(node);
            totalItems++;
        });
        hItems = [].slice.call($hlinks.children);
        $btn.setAttribute('count', totalItems);
    }

    function measure() {
        // Get initial state
        var totalSpace=0;
        breakWidths=[];
        isVisible=[];
        vItems.forEach(function(item) {

            totalSpace += item.offsetWidth;
            breakWidths.push(totalSpace);
            isVisible.push(null);
        });
        btnWidth = $btn.offsetWidth;
    }

    function showItem(i, bShow) {
        if (isVisible[i] === bShow)
            return;
        var v = vItems[i], h = hItems[i];
        fastdom.mutate(function(){
        if (bShow) {
            v.classList.remove('hidden');
            //v.styles.display = 'flex';
            h.classList.add('hidden');
            //h.styles.display = 'node';
        } else {
            v.classList.add('hidden');
            //v.styles.display = 'node';
            h.classList.remove('hidden');
            //h.styles.display = 'block';
        }
        isVisible[i] = bShow;
        });
    }

    function onClickOutside(event) {
        var isClickInside = $btn.contains(event.target) || $hlinks.contains(event.target);
        if (!isClickInside) {
            togglePulldown(false);
            /* force hide*/
        }
    }
    function togglePulldown(bForce) {
        if (bForce === true)
            $hlinks.classList.remove('hidden');
        else if (bForce === false)
            $hlinks.classList.add('hidden');
        else
            $hlinks.classList.toggle('hidden');

        if (!$hlinks.classList.contains('hidden')) {
            $btn.classList.add('active');
            doc.addEventListener('click', onClickOutside, false);
        } else {
            $btn.classList.remove('active');
            doc.removeEventListener('click', onClickOutside, false);
        }

        return !$hlinks.classList.contains('hidden');
    }

    function check() {

        // Get instant state
        bBusy = true;
        fastdom.measure(function(){
            if (bFontSizeChanged==true) {
                measure();
                bFontSizeChanged = false;
            }
            var visibleItems = totalItems,
                hiddenItems = 0,
                btnVisible = !($btn.classList.contains('hidden')),
                availableSpace = $vlinks.offsetWidth,
                maxSpace = availableSpace + (btnVisible ? btnWidth : 0),
                minSpace = maxSpace - btnWidth;

            /*Max Items*/
                while (visibleItems) {
                    availableSpace = hiddenItems ? minSpace : maxSpace;
                    if (availableSpace < breakWidths[--visibleItems]) {
                        showItem(visibleItems, false);
                        hiddenItems++;
                    } else {
                        showItem(visibleItems, true);
                    }
                    //visibleItems--;
                }
            fastdom.mutate(function(){
                if (!hiddenItems) {
                    btnVisible && $btn.classList.add('hidden');
                } else {
                    $btn.setAttribute('count', hiddenItems);
                        !btnVisible && $btn.classList.remove('hidden');
                }

            if (bTrigger)
                check();
                bBusy = false;
                bTrigger = false;
            });
        });
    }

    return {
        init: init,
        togglePulldown: togglePulldown
    }
})();