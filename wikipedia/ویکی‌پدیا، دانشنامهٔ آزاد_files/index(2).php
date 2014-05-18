/**
 * خالی‌کردن میانگیر صفحه
 *
 * Dependencies: mediawiki.util
 *
 * @source www.mediawiki.org/wiki/Snippets/Purge_action
 * @revision 2014-05-14
 */
$( function () {
    if ( !$( '#ca-purge' ).length && mw.config.get( 'wgIsArticle' ) ) {
        mw.util.addPortletLink(
            'p-cactions',
            mw.util.wikiScript() + '?title=' + mw.util.wikiUrlencode( mw.config.get( 'wgPageName' ) ) + '&action=purge&forcelinkupdate=1',
            'خالی‌کردن کاشه',
            'ca-purge',
            'خالی‌کردن میانگیر صفحه',
            '*'
        );
    }
} );