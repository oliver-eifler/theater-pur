/**
 * Created by darkwolf on 12.11.2016.
 * The Header MainMenu based on GreedyNav by lukejacksonn (https://github.com/lukejacksonn/GreedyNav)
 */
!(function (win, doc) {


    var $nav = doc.querySelector('.nav');
    var $btn = $nav.querySelector('.nav-button'), btnWidth;
    var $vlinks = $nav.querySelector('.nav-links');
    var $hlinks = $nav.querySelector('.nav-hidden-links');

    var totalItems = 0;
    var breakWidths = [];

    function build() {
        //clone nodes
        totalItems = 0;
        for (var i = 0, node; i < $vlinks.children.length; i++) {
            node = $vlinks.children[i].cloneNode(true);
            node.classList.add('hidden');
            $hlinks.appendChild(node);
            totalItems++;
        }
        $btn.setAttribute('count', totalItems);
    }

    function measure() {
        // Get initial state
        var totalSpace=0;
        breakWidths=[];
        for (var i = 0; i < $vlinks.children.length; i++) {

            totalSpace += $vlinks.children[i].offsetWidth;
            breakWidths.push(totalSpace);
        }
        btnWidth = $btn.offsetWidth;
    }

    function showItem(i, bShow) {
        var v = $vlinks.children[i], h = $hlinks.children[i];
        if (bShow) {
            v.classList.remove('hidden');
            h.classList.add('hidden');
        } else {
            v.classList.add('hidden');
            h.classList.remove('hidden');
        }
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
            doc.addEventListener('click', onClickOutside, false);
        } else {
            doc.removeEventListener('click', onClickOutside, false);
        }

        return !$hlinks.classList.contains('hidden');
    }

    function check() {

        // Get instant state
        var visibleItems = totalItems,
            hiddenItems = 0,
            btnVisible = !($btn.classList.contains('hidden')),
            availableSpace = $vlinks.offsetWidth,
            maxSpace = availableSpace + (btnVisible?btnWidth:0),
            minSpace = maxSpace - btnWidth;

        /*Max Items*/
        while (visibleItems) {
            availableSpace = hiddenItems?minSpace:maxSpace;
            if (availableSpace < breakWidths[--visibleItems]) {
                showItem(visibleItems, false);
                hiddenItems++;
            } else {
                showItem(visibleItems, true);
            }
            //visibleItems--;
        }

        if (!hiddenItems) {
            $btn.classList.add('hidden');
        } else {
            $btn.setAttribute('count', hiddenItems);
            if ($btn.classList.contains('hidden')) {
                $btn.classList.remove('hidden');
            }
        }

    }

    build();
    measure();
    check();
    win.addEventListener('resize', check, false);
    $btn.addEventListener('click', function () {
        togglePulldown();
    }, false);

})(window, document);