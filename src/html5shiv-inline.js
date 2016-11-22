(function(){
if(!('hidden' in document.createElement('a'))){
'abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output picture progress section summary template time video'.replace(/\w+/g, function(elem){
document.createElement(elem);
});
}
})();
(function(createElement){
    if(!('hidden' in createElement('a'))){
        'abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output picture progress section summary template time video'.replace(/\w+/g, function(elem){
            createElement(elem);
        });

        var p = createElement('p');
        var parent = document.getElementsByTagName('head')[0] || document.documentElement;

        p.innerHTML = 'x<style>' +
            'article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block} ' +
            'mark{background:#FF0;color:#000} template{display:none}' +
            '</style>';
        parent.insertBefore(p.lastChild, parent.firstChild);
    }
})(document.createElement);