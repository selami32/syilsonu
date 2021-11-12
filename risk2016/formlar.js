/*
 * Ext JS Library 2.2
 * Copyright(c) 2006-2008, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 */
  Ext.onReady(function(){
    // second tabs built from JS
  sayfaadres="<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='formlistesi.php?kurumkodu="+kurumkodu+"&ad="+adres+"'></iframe>";   
    tabs2 = new Ext.TabPanel({
        renderTo: document.body,
        id: 'tablar',
        activeTab:0,
        width:genislik,
        height:yukseklik-0,
        frame:true,
        split:true,
        enableTabScroll:true,
        animScroll:true,
        defaults:{autoScroll: true,autoHeight: true},
        items:[
            {
				
                title: 'Ana sayfa',
                html: sayfaadres,
                listeners: {
                  'activate' : function (obj){
                       obj.body.dom.innerHTML=sayfaadres;
                  }
                 }
                
            },{
                title: 'Anket - ��renci Bilgileri',
                id : 'ogrencibilgileri',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='ogrencibilgileri.php?kurumkodu="+kurumkodu+"&ad="+adres+"'></iframe>"
            },{
                title: 'Anket- Sorular',
                id : 'anketsorulari',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='anketsorulari.php?kurumkodu="+kurumkodu+"&ad="+adres+"'></iframe>"
            }
        ]
    });

    function handleActivate(tab){
       // alert(tab.title + ' was activated.');
       //tab.html("");
    }
});

/*
,{
                title: 'Ajax Tab 1',
                autoLoad:'http://www.google.com.tr'
            },{
                title: 'Ajax Tab 2',
               // autoLoad: {url: 'etkinlikler.php', params: ''}
            },{
                title: 'Event Tab',
               // listeners: {activate: handleActivate},
                html:"<iframe style='border:0;width:100%;height:100%' src='etkinlikler.php'></iframe> "
            },{
                title: 'Event Tab',
               // listeners: {activate: handleActivate},
                html:"<iframe style='border:0;width:100%;height:100%' src='etkinlikler.php'></iframe> "
            },{
                title: 'Disabled Tab',
                disabled:true,
                html: "Can't see me cause I'm disabled"
            }

*/