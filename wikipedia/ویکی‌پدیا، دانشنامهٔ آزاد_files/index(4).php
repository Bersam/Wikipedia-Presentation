// دکمهٔ اضافه‌کردن بحث جدید را کنار دکمهٔ ویرایش آخرین بخش یک صفحهٔ بحث اضافه می‌کند
/*global $*/
/*Maintainer: User:Ebraminio*/
$(function () {
    'use strict';
    if ($("#ca-addsection").length === 0) {
        return; // never mind
    }
    var lastButton = $("#mw-content-text h2:last .mw-editsection"),
        addButton = lastButton.clone(),
        addLinkElement = $("#ca-addsection a").clone(),
        addTitle = addLinkElement.attr('title').replace(/\s\[[a-zA-Z+\-\s]*\]/, '');
    $("a", addButton).replaceWith(addLinkElement.attr('title', addTitle).html(addTitle));
    lastButton.after(addButton);
});