$(function() {
    if (!mw.config.get('wgArticleId'))
        return;
    var data = new Date();
    var meseCorrente = data.getMonth()+1;
    if (meseCorrente < 10)
        meseCorrente = '0' + meseCorrente;
    mw.util.addPortletLink('p-tb', 'http://stats.grok.se/fa/' + data.getFullYear() + meseCorrente + '/' + mw.config.get('wgPageName'),
                           'تعداد بازدید صفحه', 't-visitors', 'تعداد بازدید صفحه', '');
});