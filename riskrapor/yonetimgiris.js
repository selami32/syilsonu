/*
 * Ext JS Library 2.2
 * Copyright(c) 2006-2008, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 */

Ext.onReady(function(){
Ext.BLANK_IMAGE_URL = adres+'ext2/resources/images/default/s.gif';
	
    // second tabs built from JS
    var tabs2 = new Ext.TabPanel({
        renderTo: document.body,
        activeTab:0,
        width:genislik,
        height:yukseklik,
        frame:true,
        split:true,
        enableTabScroll:true,
        animScroll:true,
        defaults:{autoScroll: true,autoHeight: true},
        items:[
            {
                title: 'Yönetim',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='yonetim.php?kurumkodu="+kurumkodu+"&ad="+adres+"'></iframe>"
            }
        ]
    });

    function handleActivate(tab){
       // alert(tab.title + ' was activated.');
       //tab.html("");
    }
});