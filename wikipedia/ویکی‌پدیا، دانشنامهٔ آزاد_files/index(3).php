/**
 * Below code given from: https://dotnettipsrepository.svn.codeplex.com/svn/Trunk/ASP.NET/YeKe/jquery.yeke.js
 * The dotnettipsrepository codes released under MIT License per: http://dotnettipsrepository.codeplex.com/license
 * we modified it a bit for using here ;)
 */
function substituteCharInFireFox(charCode, e) {
    var keyEvt = document.createEvent("KeyboardEvent");
    keyEvt.initKeyEvent("keypress", true, true, null, false, false, false, false, 0, charCode);
    e.target.dispatchEvent(keyEvt);
    e.preventDefault();
}

function substituteCharInChrome(charCode, e) {
    //it does not work yet! /*$.browser.webkit*/
    //https://bugs.webkit.org/show_bug.cgi?id=16735
    var keyEvt = document.createEvent("KeyboardEvent");
    keyEvt.initKeyboardEvent("keypress", true, true, null, false, false, false, false, 0, charCode);
    e.target.dispatchEvent(keyEvt);
    e.preventDefault();
}

function insertAtCaret(myValue, e) {
    var obj = e.target;
    var startPos = obj.selectionStart;
    var endPos = obj.selectionEnd;
    var scrollTop = obj.scrollTop;
    obj.value = obj.value.substring(0, startPos) + myValue + obj.value.substring(endPos, obj.value.length);
    obj.focus();
    obj.selectionStart = startPos + myValue.length;
    obj.selectionEnd = startPos + myValue.length;
    obj.scrollTop = scrollTop;
    e.preventDefault();
}

$(document).ready(function () {
    var arabicYeCharCode = 1610;
    var arabicAlefMaghsooreCharCode = 1609;
    var persianYeCharCode = 1740;
    var arabicKeCharCode = 1603;
    var persianKeCharCode = 1705;

    $(document).keypress(function (e) {
        var keyCode = e.keyCode ? e.keyCode : e.which;

        if ($.browser.msie) {
            switch (keyCode) {
                case arabicYeCharCode:
                    event.keyCode = persianYeCharCode;
                    showCharWarning();
                    break;
                case arabicAlefMaghsooreCharCode:
                    event.keyCode = persianYeCharCode;
                    showCharWarning();
                    break;
                case arabicKeCharCode:
                    event.keyCode = persianKeCharCode;
                    showCharWarning();
                    break;
            }
        }
        else if ($.browser.mozilla) {
            switch (keyCode) {
                case arabicYeCharCode:
                    substituteCharInFireFox(persianYeCharCode, e);
                    showCharWarning();
                    break;
                case arabicAlefMaghsooreCharCode:
                    substituteCharInFireFox(persianYeCharCode, e);
                    showCharWarning();
                    break;
                case arabicKeCharCode:
                    substituteCharInFireFox(persianKeCharCode, e);
                    showCharWarning();
                    break;
            }
        }
        else {
            switch (keyCode) {
                case arabicYeCharCode:
                    insertAtCaret(String.fromCharCode(persianYeCharCode), e);
                    showCharWarning();
                    break;
                case arabicAlefMaghsooreCharCode:
                    insertAtCaret(String.fromCharCode(persianYeCharCode), e);
                    showCharWarning();
                    break;
                case arabicKeCharCode:
                    insertAtCaret(String.fromCharCode(persianKeCharCode), e);
                    showCharWarning();
                    break;
            }
        }
    });

 /* اتفاقاً این مورد پایین اگر فعال نباشد بهتر است تا نقض حق تکثیر پنهان نشود
    $('input,textarea').bind('paste', function (e) {
        var el = $(this);
        //we need to wait about 100ms for the paste value to actually change the val()
        setTimeout(function () {
            var text = $(el).val();
            $(el).val(text.replace(new RegExp(String.fromCharCode(arabicYeCharCode), "g"), String.fromCharCode(persianYeCharCode))
                          .replace(new RegExp(String.fromCharCode(arabicKeCharCode), "g"), String.fromCharCode(persianKeCharCode)));
        }, 100);
    }); */
});

function showCharWarning(){
  return; // غیرفعالش کردم
  if ($("#yekewarning").length === 0){
    $('body').append("<div id='yekewarning'><p>لطفاً با استفاده از راهنمای <a style='color:blue;' href='//fa.wikipedia.org/wiki/%D9%88%DB%8C%DA%A9%DB%8C%E2%80%8C%D9%BE%D8%AF%DB%8C%D8%A7:%D9%81%D8%A7%D8%B1%D8%B3%DB%8C%E2%80%8C%D9%86%D9%88%DB%8C%D8%B3%DB%8C'>فارسی‌نویسی</a> صفحه‌کلید استاندارد فارسی را نصب کنید و نویسه‌های <big><big>ي</big></big> و <big><big>ك</big></big> را به کار نبرید.</p></div>");
    mw.loader.using( 'jquery.ui.dialog', function() {
      $("#yekewarning").dialog();
    });
  }
}