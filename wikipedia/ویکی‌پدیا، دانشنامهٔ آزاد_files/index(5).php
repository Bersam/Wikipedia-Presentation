// <nowiki>
/*jslint indent: 2, browser: true*/
/*global jQuery, mediaWiki, insertTags*/
(function ($, mw) {
  'use strict';
  var wgNamespaceNumber = mw.config.get('wgNamespaceNumber'),
    wgAction = mw.config.get('wgAction'),
    wgTitle = mw.config.get('wgTitle');
  if (!((wgNamespaceNumber % 2 || wgNamespaceNumber === 4) && (wgAction === 'edit' || wgAction === 'submit'))) {
    return;
  }
  $(function () {
    var copywarn = $('#editpage-copywarn'), wpSave = $('#wpSave'), signLink;
    if (copywarn.length === 0 || wpSave.length === 0) {
      return;
    }
    // avoid warning on project pages blacklist
    if (wgNamespaceNumber === 4 && !wgTitle.match('^(درخواست|درخواست\u200cهای|میز کمک|میز مرجع|نظرخواهی|قهوه\u200cخانه|تابلوی)')) {
      return;
    }
    window.warningDone = false;
    signLink = $('<a>').html('~~~~').click(function (e) {
      e.preventDefault();
      insertTags(' ~~~~', '', '');
    });
    copywarn
      .html('لطفاً در صفحه\u200cهای بحث از امضا استفاده کنید ')
      .append(signLink)
      .css({
        padding: '2px',
        background: '#F7F7F7',
        border: '1px solid gray'
      });
    wpSave.click(function (e) {
      if (window.warningDone || $('#wpTextbox1').val().indexOf('~~~~') !== -1) { return; }
      e.preventDefault();
      window.warningDone = true;
      copywarn
        .html('')
        .append(
          'لطفاً با افزودن ',
          signLink,
          ' در انتهای پیام خود امضا کنید (',
          $('<a href="/wiki/ویکی\u200cپدیا:امضا" title="(لینک در صفحهٔ جدید باز خواهد شد)" target=_blank>اطلاعات بیشتر↗</a>'), //→ ↗
          ')'
        )
        .css({
          background: '#FFD080',
          border: '1px solid orange'
        });
    });
  });
}(jQuery, mediaWiki));