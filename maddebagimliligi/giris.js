/*
 * Ext JS Library 2.2
 * Copyright(c) 2006-2008, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 */

Ext.onReady(function(){
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
                title: 'Rehber Öðretmen',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='rehberogretmen.php?kurumkodu="+kurumkodu+"'></iframe>"
                
            },{
                title: 'MADDE BAÐIMLILIÐI OKUL RAPORU',
                titlecolor:{"background-color":"red"},
                html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='etkinliklerv2.php?kurumkodu="+kurumkodu+"'></iframe>"
                
 
            }
        ]
    });

    function handleActivate(tab){
       // alert(tab.title + ' was activated.');
       //tab.html("");
    }
});