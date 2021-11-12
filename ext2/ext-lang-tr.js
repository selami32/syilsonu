/**
 * List compiled by mystix on the extjs.com forums.
 * Thank you Mystix!
 */

/**
 * Turkish translation by H�seyin T�fek�ilerli
 * 04-11-2007, 09:52 AM 
 */

Ext.UpdateManager.defaults.indicatorText = '<div class="loading-indicator">Y�kleniyor...</div>';

if(Ext.View){
   Ext.View.prototype.emptyText = "";
}

if(Ext.grid.Grid){
   Ext.grid.Grid.prototype.ddText = "{0} se�ili sat�r";
}

if(Ext.TabPanelItem){
   Ext.TabPanelItem.prototype.closeText = "Bu sekmeyi kapat";
}

if(Ext.form.Field){
   Ext.form.Field.prototype.invalidText = "Bu alandaki de�er ge�ersiz";
}

if(Ext.LoadMask){
    Ext.LoadMask.prototype.msg = "Y�kleniyor...";
}

Date.monthNames = [
   "Ocak",
   "�ubat",
   "Mart",
   "Nisan",
   "May�s",
   "Haziran",
   "Temmuz",
   "A�ustos",
   "Eyl�l",
   "Ekim",
   "Kas�m",
   "Aral�k"
];

Date.dayNames = [
   "Pazar",
   "Pazartesi",
   "Sal�",
   "�ar�amba",
   "Per�embe",
   "Cuma",
   "Cumartesi"
];

if(Ext.MessageBox){
   Ext.MessageBox.buttonText = {
      ok     : "Tamam",
      cancel : "�ptal",
      yes    : "Evet",
      no     : "Hay�r"
   };
}

if(Ext.util.Format){
   Ext.util.Format.date = function(v, format){
      if(!v) return "";
      if(!(v instanceof Date)) v = new Date(Date.parse(v));
      return v.dateFormat(format || "m/d/Y");
   };
}

if(Ext.DatePicker){
   Ext.apply(Ext.DatePicker.prototype, {
      todayText         : "Bug�n",
      minText           : "Bu tarih minimum tarihten �nce",
      maxText           : "Bu tarih maximum tarihten �nce",
      disabledDaysText  : "",
      disabledDatesText : "",
      monthNames		: Date.monthNames,
      dayNames			: Date.dayNames,
      nextText          : 'Sonraki ay (Ctrl+Sag)',
      prevText          : '�nceki ay (Ctrl+Sol)',
   	  monthYearText     : 'Bir ay se�in (Yillari de�i�tirmek i�in Ctrl+Yukar�/A�a��)',
      todayTip          : "{0} (Bosluk)",
      format            : "d/m/y",
      okText		: "Tamam",
      cancelText	: "&#160; �ptal &#160;&#160;",
      startDay		: 0
   });
}

if(Ext.PagingToolbar){
   Ext.apply(Ext.PagingToolbar.prototype, {
      beforePageText : "Sayfa",
      afterPageText  : " / {0}",
      firstText      : "�lk Sayfa",
      prevText       : "�nceki Sayfa",
      nextText       : "Sonraki Sayfa",
      lastText       : "Son Sayfa",
      refreshText    : "Yenile",
      displayMsg     : "{2} sat�rdan {0} - {1} aras� g�steriliyor",
      emptyMsg       : 'G�sterilecek veri yok'
   });
}

if(Ext.form.TextField){
   Ext.apply(Ext.form.TextField.prototype, {
      minLengthText : "Bu alan i�in minimum uzunluk {0}",
      maxLengthText : "Bu alan i�in maximum uzunluk {0}",
      blankText     : "Bu alan gerekli",
      regexText     : "",
      emptyText     : null
   });
}

if(Ext.form.NumberField){
   Ext.apply(Ext.form.NumberField.prototype, {
      minText : "Bu alan i�in minimum de�er {0}",
      maxText : "Bu alan i�in maximum de�er {0}",
      nanText : "{0} ge�erli bir say� de�il"
   });
}

if(Ext.form.DateField){
   Ext.apply(Ext.form.DateField.prototype, {
      disabledDaysText  : "Pasif",
      disabledDatesText : "Pasif",
      minText           : "Bu alana {0} tarihinden sonraki bir tarih girilmeli",
      maxText           : "Bu alana {0} tarihinden �nceki bir tarih girilmeli",
      invalidText       : "{0} ge�erli bir tarih de�il - {1} bi�iminde olmal�",
      format            : "d/m/y"
   });
}

if(Ext.form.ComboBox){
   Ext.apply(Ext.form.ComboBox.prototype, {
      loadingText       : "Y�kleniyor...",
      valueNotFoundText : undefined
   });
}

if(Ext.form.VTypes){
   Ext.apply(Ext.form.VTypes, {
      emailText    : 'Bu alan bir e-mail adresi bi�iminde olmal� "kullanici@alanadi.com"',
      urlText      : 'Bu alan bir URL bi�iminde olmalu "http:/'+'/www.alanadi.com"',
      alphaText    : 'Bu alan sadece harf ve _ i�ermeli',
	  alphanumText : 'Bu alan sadece harf, say� ve _ i�ermeli'
   });
}

if(Ext.form.HtmlEditor){
   Ext.apply(Ext.form.HtmlEditor.prototype, {
	 createLinkText : 'L�tfen link i�in URL giriniz:',
	 buttonTips : {
            bold : {
               title: 'Kal�n (Ctrl+B)',
               text: 'Se�ilen metni kal�n yap.',
               cls: 'x-html-editor-tip'
            },
            italic : {
               title: 'Yat�k (Ctrl+I)',
               text: 'Se�ilen metni yat�k yap.',
               cls: 'x-html-editor-tip'
            },
            underline : {
               title: 'Alt�izgi (Ctrl+U)',
               text: 'Se�ilen metnin alt�n� �iz.',
               cls: 'x-html-editor-tip'
           },
           increasefontsize : {
               title: 'Metni b�y�t',
               text: 'Yazi tipini b�y�t.',
               cls: 'x-html-editor-tip'
           },
           decreasefontsize : {
               title: 'Metni k���lt',
               text: 'Yazi tipini k���lt.',
               cls: 'x-html-editor-tip'
           },
           backcolor : {
               title: 'Metin arkaplan rengi',
               text: 'Se�ilen metnin arkaplan rengini de�i�tir.',
               cls: 'x-html-editor-tip'
           },
           forecolor : {
               title: 'Metin rengi',
               text: 'Se�ilen metnin rengini de�i�tir.',
               cls: 'x-html-editor-tip'
           },
           justifyleft : {
               title: 'Metni sola yasla',
               text: 'Metni sola yasla',
               cls: 'x-html-editor-tip'
           },
           justifycenter : {
               title: 'Metni ortala',
               text: 'Metni ortala',
               cls: 'x-html-editor-tip'
           },
           justifyright : {
               title: 'Metni sa�a yasla',
               text: 'Metni sa�a yasla',
               cls: 'x-html-editor-tip'
           },
           insertunorderedlist : {
               title: 'S�ras�z liste',
               text: 'S�ras�z liste ba�lat.',
               cls: 'x-html-editor-tip'
           },
           insertorderedlist : {
               title: 'S�ral� liste',
               text: 'S�ral� liste ba�lat',
               cls: 'x-html-editor-tip'
           },
           createlink : {
               title: 'Ba�lanti',
               text: 'Se�ilen yaz�ya ba�lant� ver.',
               cls: 'x-html-editor-tip'
           },
           sourceedit : {
               title: 'Kayna�� d�zenle',
               text: 'Kaynak d�zenle g�r�n�m�ne ge�.',
               cls: 'x-html-editor-tip'
           }
        }
   });
}

if(Ext.grid.GridView){
   Ext.apply(Ext.grid.GridView.prototype, {
      sortAscText  : "Artan s�ra",
      sortDescText : "Azalan s�ra",
      lockText     : "S�tunu kilitle",
      unlockText   : "S�tunun kilidini kald�r",
      columnsText  : "S�tunlar"
   });
}

if(Ext.grid.PropertyColumnModel){
   Ext.apply(Ext.grid.PropertyColumnModel.prototype, {
      nameText   : "Ad",
      valueText  : "De�er",
      dateFormat : "j/m/Y"
   });
}

if(Ext.layout.BorderLayout.SplitRegion){
   Ext.apply(Ext.layout.BorderLayout.SplitRegion.prototype, {
      splitTip            : "Boyutland�rmak i�in s�r�kleyin.",
      collapsibleSplitTip : "Boyutland�rmak i�in s�r�kleyin. Gizlemek i�in �ift t�klay�n."
   });
}

if(Ext.grid.GroupingView){
   Ext.apply(Ext.grid.GroupingView.prototype, {
      groupByText         : "Bu Alanla Grupland�r",
      showGroupsText	  : "Grupland�rarak G�ster"
   });
}
