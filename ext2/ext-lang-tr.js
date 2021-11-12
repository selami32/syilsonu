/**
 * List compiled by mystix on the extjs.com forums.
 * Thank you Mystix!
 */

/**
 * Turkish translation by Hüseyin Tüfekçilerli
 * 04-11-2007, 09:52 AM 
 */

Ext.UpdateManager.defaults.indicatorText = '<div class="loading-indicator">Yükleniyor...</div>';

if(Ext.View){
   Ext.View.prototype.emptyText = "";
}

if(Ext.grid.Grid){
   Ext.grid.Grid.prototype.ddText = "{0} seçili satýr";
}

if(Ext.TabPanelItem){
   Ext.TabPanelItem.prototype.closeText = "Bu sekmeyi kapat";
}

if(Ext.form.Field){
   Ext.form.Field.prototype.invalidText = "Bu alandaki deðer geçersiz";
}

if(Ext.LoadMask){
    Ext.LoadMask.prototype.msg = "Yükleniyor...";
}

Date.monthNames = [
   "Ocak",
   "Þubat",
   "Mart",
   "Nisan",
   "Mayýs",
   "Haziran",
   "Temmuz",
   "Aðustos",
   "Eylül",
   "Ekim",
   "Kasým",
   "Aralýk"
];

Date.dayNames = [
   "Pazar",
   "Pazartesi",
   "Salý",
   "Çarþamba",
   "Perþembe",
   "Cuma",
   "Cumartesi"
];

if(Ext.MessageBox){
   Ext.MessageBox.buttonText = {
      ok     : "Tamam",
      cancel : "Ýptal",
      yes    : "Evet",
      no     : "Hayýr"
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
      todayText         : "Bugün",
      minText           : "Bu tarih minimum tarihten önce",
      maxText           : "Bu tarih maximum tarihten önce",
      disabledDaysText  : "",
      disabledDatesText : "",
      monthNames		: Date.monthNames,
      dayNames			: Date.dayNames,
      nextText          : 'Sonraki ay (Ctrl+Sag)',
      prevText          : 'Önceki ay (Ctrl+Sol)',
   	  monthYearText     : 'Bir ay seçin (Yillari deðiþtirmek için Ctrl+Yukarý/Aþaðý)',
      todayTip          : "{0} (Bosluk)",
      format            : "d/m/y",
      okText		: "Tamam",
      cancelText	: "&#160; Ýptal &#160;&#160;",
      startDay		: 0
   });
}

if(Ext.PagingToolbar){
   Ext.apply(Ext.PagingToolbar.prototype, {
      beforePageText : "Sayfa",
      afterPageText  : " / {0}",
      firstText      : "Ýlk Sayfa",
      prevText       : "Önceki Sayfa",
      nextText       : "Sonraki Sayfa",
      lastText       : "Son Sayfa",
      refreshText    : "Yenile",
      displayMsg     : "{2} satýrdan {0} - {1} arasý gösteriliyor",
      emptyMsg       : 'Gösterilecek veri yok'
   });
}

if(Ext.form.TextField){
   Ext.apply(Ext.form.TextField.prototype, {
      minLengthText : "Bu alan için minimum uzunluk {0}",
      maxLengthText : "Bu alan için maximum uzunluk {0}",
      blankText     : "Bu alan gerekli",
      regexText     : "",
      emptyText     : null
   });
}

if(Ext.form.NumberField){
   Ext.apply(Ext.form.NumberField.prototype, {
      minText : "Bu alan için minimum deðer {0}",
      maxText : "Bu alan için maximum deðer {0}",
      nanText : "{0} geçerli bir sayý deðil"
   });
}

if(Ext.form.DateField){
   Ext.apply(Ext.form.DateField.prototype, {
      disabledDaysText  : "Pasif",
      disabledDatesText : "Pasif",
      minText           : "Bu alana {0} tarihinden sonraki bir tarih girilmeli",
      maxText           : "Bu alana {0} tarihinden önceki bir tarih girilmeli",
      invalidText       : "{0} geçerli bir tarih deðil - {1} biçiminde olmalý",
      format            : "d/m/y"
   });
}

if(Ext.form.ComboBox){
   Ext.apply(Ext.form.ComboBox.prototype, {
      loadingText       : "Yükleniyor...",
      valueNotFoundText : undefined
   });
}

if(Ext.form.VTypes){
   Ext.apply(Ext.form.VTypes, {
      emailText    : 'Bu alan bir e-mail adresi biçiminde olmalý "kullanici@alanadi.com"',
      urlText      : 'Bu alan bir URL biçiminde olmalu "http:/'+'/www.alanadi.com"',
      alphaText    : 'Bu alan sadece harf ve _ içermeli',
	  alphanumText : 'Bu alan sadece harf, sayý ve _ içermeli'
   });
}

if(Ext.form.HtmlEditor){
   Ext.apply(Ext.form.HtmlEditor.prototype, {
	 createLinkText : 'Lütfen link için URL giriniz:',
	 buttonTips : {
            bold : {
               title: 'Kalýn (Ctrl+B)',
               text: 'Seçilen metni kalýn yap.',
               cls: 'x-html-editor-tip'
            },
            italic : {
               title: 'Yatýk (Ctrl+I)',
               text: 'Seçilen metni yatýk yap.',
               cls: 'x-html-editor-tip'
            },
            underline : {
               title: 'Altçizgi (Ctrl+U)',
               text: 'Seçilen metnin altýný çiz.',
               cls: 'x-html-editor-tip'
           },
           increasefontsize : {
               title: 'Metni büyüt',
               text: 'Yazi tipini büyüt.',
               cls: 'x-html-editor-tip'
           },
           decreasefontsize : {
               title: 'Metni küçült',
               text: 'Yazi tipini küçült.',
               cls: 'x-html-editor-tip'
           },
           backcolor : {
               title: 'Metin arkaplan rengi',
               text: 'Seçilen metnin arkaplan rengini deðiþtir.',
               cls: 'x-html-editor-tip'
           },
           forecolor : {
               title: 'Metin rengi',
               text: 'Seçilen metnin rengini deðiþtir.',
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
               title: 'Metni saða yasla',
               text: 'Metni saða yasla',
               cls: 'x-html-editor-tip'
           },
           insertunorderedlist : {
               title: 'Sýrasýz liste',
               text: 'Sýrasýz liste baþlat.',
               cls: 'x-html-editor-tip'
           },
           insertorderedlist : {
               title: 'Sýralý liste',
               text: 'Sýralý liste baþlat',
               cls: 'x-html-editor-tip'
           },
           createlink : {
               title: 'Baðlanti',
               text: 'Seçilen yazýya baðlantý ver.',
               cls: 'x-html-editor-tip'
           },
           sourceedit : {
               title: 'Kaynaðý düzenle',
               text: 'Kaynak düzenle görünümüne geç.',
               cls: 'x-html-editor-tip'
           }
        }
   });
}

if(Ext.grid.GridView){
   Ext.apply(Ext.grid.GridView.prototype, {
      sortAscText  : "Artan sýra",
      sortDescText : "Azalan sýra",
      lockText     : "Sütunu kilitle",
      unlockText   : "Sütunun kilidini kaldýr",
      columnsText  : "Sütunlar"
   });
}

if(Ext.grid.PropertyColumnModel){
   Ext.apply(Ext.grid.PropertyColumnModel.prototype, {
      nameText   : "Ad",
      valueText  : "Deðer",
      dateFormat : "j/m/Y"
   });
}

if(Ext.layout.BorderLayout.SplitRegion){
   Ext.apply(Ext.layout.BorderLayout.SplitRegion.prototype, {
      splitTip            : "Boyutlandýrmak için sürükleyin.",
      collapsibleSplitTip : "Boyutlandýrmak için sürükleyin. Gizlemek için çift týklayýn."
   });
}

if(Ext.grid.GroupingView){
   Ext.apply(Ext.grid.GroupingView.prototype, {
      groupByText         : "Bu Alanla Gruplandýr",
      showGroupsText	  : "Gruplandýrarak Göster"
   });
}
