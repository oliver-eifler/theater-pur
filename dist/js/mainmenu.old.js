/**
 * Created by darkwolf on 12.11.2016.
 * The Header MainMenu based on GreedyNav by lukejacksonn (https://github.com/lukejacksonn/GreedyNav)
 */
!(function(win,doc) {


    var $nav = doc.querySelector('nav.greedy');
    var $btn = $nav.querySelector('button');
    var $vlinks = $nav.querySelector('.links');
    var $hlinks = $nav.querySelector('.hidden-links');

    var numOfItems = 0;
    var totalSpace = 0;
    var breakWidths = [];

    // Get initial state
    for (var i=0;i<$vlinks.children.length;i++) {

        totalSpace += $vlinks.children[i].offsetWidth;
        numOfItems += 1;
        breakWidths.push(totalSpace);
    };

    function check() {

        // Get instant state
        availableSpace = $vlinks.offsetWidth;
        numOfVisibleItems = $vlinks.children.length;
        requiredSpace = breakWidths[numOfVisibleItems - 1];
        if ($btn.classList.contains('hidden'))
            availableSpace -= $btn.offsetWidth;
        /*
         Check if there is not enough space for the visible links or
         if there is space available for the hidden link
         */
        if (availableSpace < breakWidths[numOfVisibleItems - 1]) {
            if ($btn.classList.contains('hidden')) {
                $btn.classList.remove('hidden');
                //availableSpace = $vlinks.offsetWidth;
            }

            while (availableSpace < breakWidths[numOfVisibleItems - 1]) {
                $hlinks.insertBefore($vlinks.children[numOfVisibleItems - 1], $hlinks.firstChild);
                numOfVisibleItems--;
            }
        } else if (availableSpace > breakWidths[numOfVisibleItems]) {
            while (availableSpace > breakWidths[numOfVisibleItems]) {
                $vlinks.appendChild($hlinks.removeChild($hlinks.firstChild));
                numOfVisibleItems++;
            }
        }

        if (true) {
            $btn.setAttribute('count', $hlinks.children.length);
            if (!$hlinks.children.length) {
                $btn.classList.add('hidden');
            }
        }
    }





    check();
    window.addEventListener('resize', check);
    $btn.addEventListener('click',function() {
        $hlinks.classList.toggle('hidden');
    })


})(window,document);