/*
 * Ext JS Library 2.2
 * Copyright(c) 2006-2008, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 */
  Ext.onReady(function(){
    // second tabs built from JS
  sayfaadres="<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='formlistesi.php?kurumkodu="+kurumkodu+"'></iframe>";   

    tabs2 = new Ext.TabPanel({
        renderTo: document.body,
        id: 'tablar',
        activeTab:0,
        width:genislik,
        height:yukseklik-20,
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
                title: 'Okul Bilgileri',
                id : 'okulbilgileri',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='okulbilgileri.php?kurumkodu="+kurumkodu+"'></iframe>"
                
            },{
                title: 'Psikolojik Danışman',
                id :'rehberogretmen',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='rehberogretmen.php?kurumkodu="+kurumkodu+"'></iframe>"                
            },{
                title: 'Rehberlik servisi',
                id :'rehberlikservisi',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='rehberlikservisi.php?kurumkodu="+kurumkodu+"'></iframe>"                
            },{
                title: 'Toplantılar',
                id :'toplanti',
                
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='toplanti.php?kurumkodu="+kurumkodu+"'></iframe>"                
            },{
                title: 'Rehberlik Hiz.',
                id: 'rehhiz',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='rehhiz.php?kurumkodu="+kurumkodu+"'></iframe>"
                
            },{
                title: 'Sorun Alanları',
                id:'sorunalan',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='sorunalan.php?kurumkodu="+kurumkodu+"'></iframe>"
                
			},{
                title: 'Mesleki Rehberlik',
                id: 'meslekirehberlik',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='meslekirehberlik.php?kurumkodu="+kurumkodu+"'></iframe>"                
            },{
                title: 'Ziyaret Ed. Üst Okullar',
                id: 'okulisyeriziyaret',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='okulisyeriziyaret.php?kurumkodu="+kurumkodu+"'></iframe>"                

            },{
                title: 'Sınav Kaygısı',
                id :'sinavkaygisi',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='sinavkaygisi.php?kurumkodu="+kurumkodu+"'></iframe>"                
            },{
                title: 'Ölçme araçları',
                id : 'olcmearaclari',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='olcmearaclari.php?kurumkodu="+kurumkodu+"'></iframe>"                
            
            },{
                title: 'Etkinlikler',
                id :'etkinlikler',
                titlecolor:{"background-color":"red"},
                html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='etkinlikler.php?kurumkodu="+kurumkodu+"'></iframe>"
                
            },{
                title: 'Araştırma Yayın',
                id :'arastirma',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='arastirma.php?kurumkodu="+kurumkodu+"'></iframe>"                

            },{
                title: 'İşbirliği Yapılan',
                id :'isbirligi',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='isbirligi.php?kurumkodu="+kurumkodu+"'></iframe>"
            },{
                title: 'Hizmetiçi',
                id :'hizmetici',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='hizmetici.php?kurumkodu="+kurumkodu+"'></iframe>"                
             },{
                title: 'Psikosos. mudahale Hiz.',
                id :'psikomudahale',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='psikomudahale.php?kurumkodu="+kurumkodu+"'></iframe>"                

            },{
                title: 'Kaynaştırma',
                id:'kaynastirma',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='kaynastirma.php?kurumkodu="+kurumkodu+"'></iframe>"                
            },{
                title: 'Özel Eğt.Sınıfları',
                id:'ozelegitim',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='ozelegitim.php?kurumkodu="+kurumkodu+"'></iframe>"                
            },{
                title: 'Değerlendirme',
                id :'degerlendirme',
                 html: "<iframe style='border:0;margin-top:0;width:"+genislik+"px;height:"+yukseklik+"px' src='degerlendirme.php?kurumkodu="+kurumkodu+"'></iframe>"                
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