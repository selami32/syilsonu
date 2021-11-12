/*
 * Ext JS Library 2.2
 * Copyright(c) 2006-2008, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 */

//  objenin ozellikleri:



function ozellikgoster(obje){
    for (var name in obje) {
  if (obje.hasOwnProperty(name)) {
    alert(name);
  }
 }
}



 
Ext.onReady(function(){

Ext.QuickTips.init();
    // NOTE: This is an example showing simple state management. During development,
    // it is generally best to disable state management as dynamically-generated ids
    // can change across page loads, leading to unpredictable results.  The developer
    // should ensure that stable state ids are set for stateful components in real apps.
   // Ext.state.Manager.setProvider(new Ext.state.CookieProvider());

var store = new Ext.data.SimpleStore({
    fields: ['deger', 'isim'],
    data : [
        ["normal", "Normal"],
        ["ikili", "Ýkili"]        
    ]
});

/* store iþi iptal :

     // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
			{name:  'ili' },
			{name:  'ilcesi' },
			{name:  'okulunadi' },
			{name:  'ogrenimsekli' },
			{name:  'ogretimyili' },
			{name:  'adresi' },
			{name:  'telefonfaks' },
			{name:  'postakodu' },
			{name:  'internetadresi' },
			{name:  'eposta' },
			{name:  'ogrencisayisikiz' },
			{name:  'ogrencisayisierkek' },
			{name:  'ogrencisayisitoplam' },
			{name:  'rehberogretmensayisi' },
			{name:  'rehberogretmennorm' },          
        ]
    });
    store.loadData(myData);
$isimler=array("kurumkodu", "ili", "ilcesi", "okulunadi", "ogrenimsekli", "ogretimyili", "adresi", 
"telefonfaks", "postakodu", "internetadresi", "eposta", "ogrencisayisikiz", "ogrencisayisierkek", 
"ogrencisayisitoplam", "rehberogretmensayisi", "rehberogretmennorm");

*/

           
//formu oluþtur:
    var formum = new Ext.FormPanel({
		renderTo: 'grid-bolgesi',
        labelAlign: 'left',
         frame:true,
   //     url: 'gonder.php',
        title: 'Okul Bilgileri',
        bodyStyle:'padding:5px 5px 0',
        width: 800,
        items: [{
            layout:'column',
            autoHeight:true,
            items:[{
                columnWidth:.5,
                layout: 'form',
                items: [{
                    xtype:'textfield',
                    fieldLabel: 'Ýli',
                    id: 'ili',                  
                    name: 'ili',
                    valueField: 'ili',                    
                    anchor:'55%'
                    
                },{
                    xtype:'textfield',
                    fieldLabel: 'Okulu',
                    id: 'okulunadi',
                    name: 'okulunadi',                    
                    anchor:'95%'
                    
                },{
                    xtype:'textarea',
                    fieldLabel: 'Adres',
                    id: 'adresi',
                    name: 'adresi',                    
                    anchor:'95%'
                },{
                    xtype:'textfield',
                    fieldLabel: 'Ýnternet Adresi',                
                    id: 'internetadresi',
                    anchor:'95%'
                    
                }
                
                ]
            },{
                columnWidth:.5,
                layout: 'form',
                items: [{
                    xtype:'textfield',
                    fieldLabel: 'Ýlçesi',
                    name: 'ilcesi',
                    id: 'ilcesi',
                    anchor:'55%'
                },{
                    xtype: 'combo',
                    fieldLabel: 'Öðrenim Þekli',
                    name: 'ogrenimsekli',
                    id: 'ogrenimsekli',
                    store:store,
                    displayField:'isim',
                    valueField:'deger',
                    //typeAhead: true,
                    mode: 'local',
                    //forceSelection: true,
                    triggerAction: 'all',
                    //emptyText:'Select a state...',
                    //selectOnFocus:true,
                    editable: false
                },{
                    xtype:'textfield',
                    fieldLabel: 'Öðrenim Yýlý',
                    id: 'ogretimyili',
                    name: 'ogretimyili',
                    anchor:'55%'
                },{
                    xtype:'textfield',
                    fieldLabel: 'Telefon /Faks',
                    id: 'telefonfaks',
                    name: 'telefonfaks', 
                    anchor:'75%'
                },{
                    xtype:'textfield',
                    fieldLabel: 'Posta kodu',
                    id: 'postakodu',
                    name: 'postakodu',
                    anchor:'55%'
                },{
                    xtype:'textfield',
                    fieldLabel: 'E-Posta',
                    id: 'eposta',
                    vtype: 'email',//Yâ Âlîm Allah
                    anchor:'95%'
                }]   
                
            }]
        },{
        xtype: 'fieldset',
        title : 'Öðrenci sayýlarý',
        layout:'column',
        columnWidth: 0.3,
        autoHeight:true,
        defaults: {anchor: '100%'},
        
            items:[{
                columnWidth:.3,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    enableKeyEvents: true,
                    fieldLabel: 'Kýz',
                    id: 'ogrencisayisikiz', 
                    selectOnFocus:true,                 
                    anchor:'85%',
                    listeners:{'keyup': function(obj) {
                               var gf=formum.getForm();
                               gf.findField("ogrencisayisitoplam").setValue(gf.findField("ogrencisayisikiz").getValue()+gf.findField("ogrencisayisierkek").getValue()) 
                              }
                    }
                    
                }]
            },{
              columnWidth:.3,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    enableKeyEvents: true,
                    fieldLabel: 'Erkek',
                    id: 'ogrencisayisierkek', 
                    selectOnFocus:true,                 
                    anchor:'85%',
                    listeners:{'keyup': function(obj) {
                               var gf=formum.getForm();
                               gf.findField("ogrencisayisitoplam").setValue(gf.findField("ogrencisayisikiz").getValue()+gf.findField("ogrencisayisierkek").getValue()) 
                              }
                    },
                }]
            },{
              columnWidth:.3,
               layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Toplam',
                    id: 'ogrencisayisitoplam',                  
                    anchor:'85%',
                    readOnly: true
                }]
             }]
        },{
        xtype: 'fieldset',
        title : 'Rehber Öðretmen Sayýlarý',
        layout:'column',
        autoHeight:true,
        //defaults: {anchor: '100%'},
        
            items:[{
                columnWidth:.3,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Rehber Öðretmen Sayýsý',
                    id: 'rehberogretmensayisi',                  
                    anchor:'75%',
                    selectOnFocus:true
 
                    
                }]
            },{
              columnWidth:.3,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Rehber Öðretmen Normu',
                    id: 'rehberogretmennorm',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              }]
           
           
           
           /* xtype:'htmleditor',
            id:'adresi',
            fieldLabel:'Biography',
            height:200,
            anchor:'98%'*/
    
        }],
        buttons: [{
            text: 'Kaydet',
            iconCls: 'save',
            handler: function() {
                var sqlbaslangic='insert into '+tablo+' (`kurumkodu`,`okulturu`, `ili`, `ilcesi`, `okulunadi`, `ogrenimsekli`, `ogretimyili`, `adresi`, `telefonfaks`, `postakodu`, `internetadresi`, `eposta`, `ogrencisayisikiz`, `ogrencisayisierkek`, `ogrencisayisitoplam`, `rehberogretmensayisi`, `rehberogretmennorm`) values(';
                var sqlorta="'"+kurumkodu+"','"+okulturu+"','";
                for (i=1;i<formum.getForm().items.length+1;i++){
                sqlorta=sqlorta+tem(formum.getForm().findField(isimler[i]).getValue())+"','";
                
                
                }
                sqlorta=sqlorta.substr(0,sqlorta.length-2)+")";
                
                var sqltamami=sqlbaslangic+sqlorta;
                //alert(sqltamami);
                 Ext.Ajax.request({
                                        method: 'POST',
                                        url: 'gonder.php',                                        
                                        params: {
                                            ajax:'evet',
                                            kurumkodu: kurumkodu,
                                            gonderkutusu: sqltamami,
                                            tablo: tablo
                                        },
                                        success: function(response,opts){
                                            var sonuc = response.responseText;                                          
											Ext.MessageBox.alert('Durum', sonuc);
                                        }
                                        
                 });
            }
        },{
            text: 'Sýfýrla',
           
            handler: function(){ 
            //alert(myData["ogretimyili"]);
            //alert(formum.getForm().findField("ogrenimsekli").getValue());
            formum.getForm().reset();
            }
      },{
            text: 'Ana sayfa',
            iconCls : 'klasor',
            handler: function(){ 
              window.parent.tabs2.activate('0');
 
            }
        
        }]
    });



// BÝLGÝLERÝ YÜKLE:
for (i=1;i<formum.getForm().items.length+1;i++){
      formum.getForm().findField(isimler[i]).setValue(myData[isimler[i]]);
}
 
});



   