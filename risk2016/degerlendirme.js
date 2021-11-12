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


  Ext.grid.GroupSummary.Calculations['toplam'] = function(v, record, field){
        return record.data.etkinlikkatveli + record.data.etkinlikkatdiger;
    }




    
 
    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name:'oturum'},
          {name:'subesayisisinif4', type:'float'},
          {name:'subesayisisinif6', type:'float'},
          {name:'subesayisisinif9', type:'float'},
          {name:'kizsinif4', type:'float'},
          {name:'erkeksinif4', type:'float'},
          {name:'kizsinif6', type:'float'},
          {name:'erkeksinif6', type:'float'},
          {name:'kizsinif9', type:'float'},
          {name:'erkeksinif9', type:'float'},
          {name:'kiztoplam', type:'float'},
          {name:'erkektoplam', type:'float'}
          
          
        ]
    });
    store.loadData(myData);
    /*{name: 'lastChange', type: 'date', dateFormat: 'n/j h:ia'
renderer: 'usMoney'
/*renderer: Ext.util.Format.dateRenderer('m/d/Y'),*/
/*renderer: pctChange,*/ 
/*renderer: change,*/


          
    // create the Grid
    var sm = new Ext.grid.RowSelectionModel();
    
    Ext.grid.RowSelectionModel.override ({
    getSelectedIndex : function(){
        return this.grid.store.indexOf( this.selections.itemAt(0) );
    }
    });
//    if (!yukseklik) yukseklik=600;
//    if (!genislik) genislik=850;
   
    var grid = new Ext.grid.EditorGridPanel({
        store: store,
        renderTo: 'grid-bolgesi',
        sm: sm,
        colModel: new Ext.grid.ColumnModel({
         columns: [
              {header: 'Oturum', id:'oturum', width: 120, sortable: false, dataIndex: 'oturum'},
{header: '4.Sýnýf', width: 65, sortable: false,  dataIndex: 'subesayisisinif4', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: '6.Sýnýf', width: 65, sortable: false,  dataIndex: 'subesayisisinif6', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: '9.Sýnýf', width: 65, sortable: false,  dataIndex: 'subesayisisinif9', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'Kýz', width: 65, sortable: false,  dataIndex: 'kizsinif4', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'Erkek', width: 65, sortable: false,  dataIndex: 'erkeksinif4', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'Kýz', width: 65, sortable: false,  dataIndex: 'kizsinif6', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'Erkek', width: 65, sortable: false,  dataIndex: 'erkeksinif6', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'Kýz', width: 65, sortable: false,  dataIndex: 'kizsinif9', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'Erkek', width: 65, sortable: false,  dataIndex: 'erkeksinif9', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'Kýz', width: 65, sortable: false,  dataIndex: 'kiztoplam'},
{header: 'Erkek', width: 65, sortable: false,  dataIndex: 'erkektoplam'}
        ],
 				rows: [
          [
						{},
						{header: 'ÞUBE SAYISI', colspan:3, align: 'center'},
						{header: '4.SINIFLAR', colspan:2, align: 'center'},
						{header: '6.SINIFLAR', colspan:2, align: 'center'},
						{header: '9.SINIFLAR', colspan:2, align: 'center'},
						{header: 'TOPLAM', colspan:2, align: 'center'}
						
          ]
					
				]
        }),
        listeners: {
            afteredit : function(object) {
              //satirtoplam:
              var gridsatir=grid.getStore().getAt(object.row);
              var tsonucK=
              gridsatir.get('kizsinif4')	+
              gridsatir.get('kizsinif6')	+
              gridsatir.get('kizsinif9');              
              
              gridsatir.set('kiztoplam',tsonucK);

              var tsonucE=
              gridsatir.get('erkeksinif4')	+
              gridsatir.get('erkeksinif6')	+
              gridsatir.get('erkeksinif9');
              
              gridsatir.set('erkektoplam',tsonucE);
               //alt toplam
               var sinif4subetoplam=0; var sinif6subetoplam=0; var sinif9subetoplam=0;
               var sinif4kiztoplam=0; var sinif4erkektoplam=0; 
               var sinif6kiztoplam=0; var sinif6erkektoplam=0; 
               var sinif9kiztoplam=0; var sinif9erkektoplam=0; 
               var geneltoplamkiz=0; var geneltoplamerkek=0;
               
               
              toplamsatir=grid.getStore().getCount();
              for (i=0;i<toplamsatir-1;i++){
               sinif4subetoplam=sinif4subetoplam+grid.getStore().getAt(i).get('subesayisisinif4');
               sinif6subetoplam=sinif6subetoplam+grid.getStore().getAt(i).get('subesayisisinif6');
               sinif9subetoplam=sinif9subetoplam+grid.getStore().getAt(i).get('subesayisisinif9');
               
               sinif4kiztoplam=sinif4kiztoplam+grid.getStore().getAt(i).get('kizsinif4');
               sinif4erkektoplam=sinif4erkektoplam+grid.getStore().getAt(i).get('erkeksinif4');
               
               sinif6kiztoplam=sinif6kiztoplam+grid.getStore().getAt(i).get('kizsinif6');
               sinif6erkektoplam=sinif6erkektoplam+grid.getStore().getAt(i).get('erkeksinif6');
               
               sinif9kiztoplam=sinif9kiztoplam+grid.getStore().getAt(i).get('kizsinif9');
               sinif9erkektoplam=sinif9erkektoplam+grid.getStore().getAt(i).get('erkeksinif9');
               
               geneltoplamkiz=geneltoplamkiz+grid.getStore().getAt(i).get('kiztoplam');
               geneltoplamerkek=geneltoplamerkek+grid.getStore().getAt(i).get('erkektoplam');
               
               
               
              }
              
              var gridsatir=grid.getStore().getAt(toplamsatir-1);
              gridsatir.set('subesayisisinif4',sinif4subetoplam);
              gridsatir.set('subesayisisinif6',sinif6subetoplam);
              gridsatir.set('subesayisisinif9',sinif9subetoplam);
              
              gridsatir.set('kizsinif4',sinif4kiztoplam);
              gridsatir.set('erkeksinif4',sinif4erkektoplam);
              
              gridsatir.set('kizsinif6',sinif6kiztoplam);
              gridsatir.set('erkeksinif6',sinif6erkektoplam);
              
              gridsatir.set('kizsinif9',sinif9kiztoplam);
              gridsatir.set('erkeksinif9',sinif9erkektoplam);
              
              gridsatir.set('kiztoplam',geneltoplamkiz);
              gridsatir.set('erkektoplam',geneltoplamerkek);
              
              


              grid.getStore().commitChanges();
              
              
              }
        },
        stripeRows: true,
        height:yukseklik-470,
        width:genislik-20,
        clicksToEdit:1,
        enableColumnMove: false,
        viewConfig: {
            forceFit: true
        },
        plugins: [new Ext.ux.plugins.GroupHeaderGrid()],        
        title:'RÝSKLER VE BAÞETME BECERÝLERÝ OKUL PROJESÝ ÖÐRENCÝ OTURUMLARI VERÝLERÝ',
        tbar: [{          
            text: 'Kaydet',
            tooltip: 'Aþaðýdaki formlar da kayýt edilecektir',
            iconCls:'save',
            handler : function(){
                                       //alert('ya Âlîm Allah');
                                  
                                  //alert( grid.getStore().getAt(1).get('etkinlikkonusu'));
                                  //alert(grid.getStore().getCount());
                                  //GRID ÝÇÝN KAYIT:
                                  var satir=0;
                                  
                                  var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `okulturu`, `oturum`, `subesayisisinif4`, `subesayisisinif6`, `subesayisisinif9`, `kizsinif4`, `erkeksinif4`, `kizsinif6`, `erkeksinif6`, `kizsinif9`, `erkeksinif9`, `kiztoplam`, `erkektoplam`) VALUES';
                                  
                                  var sqlgovde="";
                                  while (satir< grid.getStore().getCount()){
                                        var gridsatir=grid.getStore().getAt(satir);
                                        var ekleneceksatir="("+kurumkodu+",'"+ 
                                        okulturu+"','"+
                                        gridsatir.get('oturum')+"','"+ 
                                        gridsatir.get('subesayisisinif4')	+"','"+
                                        gridsatir.get('subesayisisinif6')	+"','"+
                                        gridsatir.get('subesayisisinif9')	+"','"+
                                        gridsatir.get('kizsinif4')	+"','"+
                                        gridsatir.get('erkeksinif4')	+"','"+
                                        gridsatir.get('kizsinif6')	+"','"+
                                        gridsatir.get('erkeksinif6')	+"','"+
                                        gridsatir.get('kizsinif9')	+"','"+
                                        gridsatir.get('erkeksinif9')	+"','"+                                        
                                        gridsatir.get('kiztoplam')	+"','"+
                                        gridsatir.get('erkektoplam')+"'),\n";
                                        
                                        sqlgovde=sqlgovde+ekleneceksatir;
                                        satir++;
                                  }
                                  sqlgovde=sqlbaslangic+sqlgovde.substr(0,sqlgovde.length-2)+";";
                                  
                                  //alert(sqlgovde);
                                  Ext.Ajax.request({
                                        method: 'POST',
                                        url: 'gonder.php',                                        
                                        params: {
                                            ajax:'evet',
                                            kurumkodu: kurumkodu,
                                            gonderkutusu: sqlgovde,
                                            tablo: tablo
                                        },
                                        success: function(response,opts){
                                            var sonuc = response.responseText;
                                          //alert(Ext.decode(sonuc));
                                        Ext.MessageBox.alert('Durum', sonuc);
                                        }
                                        
                                    });
                              // Aile eðitiimi form için kayýt  
                                  var sqlbaslangic='INSERT INTO `'+tablo+'_aileegitimi` (`kurumkodu`, `AEegitimsayisi`, `AEkatilimcisayisi`) VALUES(';
                                  var sqlorta="'"+kurumkodu+"','";
                                  for (i=1;i<AEformum.getForm().items.length+1;i++){
                                    sqlorta=sqlorta+tem(AEformum.getForm().findField(AEisimler[i]).getValue())+"','";
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
                                        tablo: tablo + '_aileegitimi'
                                      },
                                      success: function(response,opts){
                                        var sonuc = response.responseText;
                                        //alert(Ext.decode(sonuc));
                                    //  Ext.MessageBox.alert('Durum', sonuc);
                                    }
                                    
                                });      
                                
                                
                                 // Yönetici öðretmen form için kayýt  
                                  var sqlbaslangic='INSERT INTO `'+tablo+'_yoneticiogretmen` (`kurumkodu`, `YOegitimsayisi`, `YOkatilimcisayisi`) VALUES(';
                                  var sqlorta="'"+kurumkodu+"','";
                                  for (i=1;i<YOformum.getForm().items.length+1;i++){
                                    sqlorta=sqlorta+tem(YOformum.getForm().findField(YOisimler[i]).getValue())+"','";
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
                                        tablo: tablo + '_yoneticiogretmen'
                                      },
                                      success: function(response,opts){
                                        var sonuc = response.responseText;
                                        //alert(Ext.decode(sonuc));
                                    //  Ext.MessageBox.alert('Durum', sonuc);
                                    }
                                    
                                });     
                                 
                                 
                                 // Deðerlendirme form için kayýt  
                                  var sqlbaslangic='INSERT INTO `'+tablo+'_aciklama` (`kurumkodu`, `aciklama`) VALUES(';
                                  var sqlorta="'"+kurumkodu+"','";
                                  for (i=1;i<Aformum.getForm().items.length+1;i++){
                                   
                                    sqlorta=sqlorta+tem(Aformum.getForm().findField(Aisimler[i]).getValue())+"','";
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
                                        tablo: tablo + '_aciklama'
                                      },
                                      success: function(response,opts){
                                        var sonuc = response.responseText;
                                        //alert(Ext.decode(sonuc));
                                    //  Ext.MessageBox.alert('Durum', sonuc);
                                    }
                                    
                                });        
                              }
            
       },{
         text : 'Ana sayfa',
         iconCls : 'klasor',
         handler : function (){
                 window.parent.tabs2.activate('0');

        }

      }]
    });
  var YOformum = new Ext.FormPanel({
        renderTo: 'YOform-bolgesi',
        labelAlign: 'left',
       //  title:'Okulda Yürütülen Rehberlik ve Psikolojik Danýþma Hizmetlerinin Deðerlendirilmesi',
         frame:true,
   //     url: 'gonder.php',
        title: 'YÖNETÝCÝ-ÖÐRETMEN OTURUMLARI VERÝLERÝ',
        //bodyStyle:'padding:5px 5px 0',
        width: genislik-220,
//       xtype: 'fieldset',
//        title : 'Öðrenci sayýlarý',
        layout:'column',
        columnWidth: 0.5,
        autoHeight:true,
        defaults: {anchor: '100%'},
        
            items:[{
                columnWidth:.5,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    enableKeyEvents: true,
                    fieldLabel: 'Eðitim Sayýsý',
                    id: 'YOegitimsayisi',                  
                    anchor:'50%',
                    
                }]
            },{
              columnWidth:.5,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    enableKeyEvents: true,
                    fieldLabel: 'Katýlýmcý Sayýsý',
                    id: 'YOkatilimcisayisi',                  
                    anchor:'50%',
 
                }]
            
             }]					
	
		
});  


//bilgileri yükle AE:
  for (i=1;i<YOformum.getForm().items.length+1;i++){
      YOformum.getForm().findField(YOisimler[i]).setValue(YOformData[YOisimler[i]]);
} 

 
var AEformum = new Ext.FormPanel({
        renderTo: 'AEform-bolgesi',
        labelAlign: 'left',
       //  title:'Okulda Yürütülen Rehberlik ve Psikolojik Danýþma Hizmetlerinin Deðerlendirilmesi',
         frame:true,
   //     url: 'gonder.php',
        title: 'AÝLE EÐÝTÝMÝ OTURUMLARI VERÝLERÝ',
        //bodyStyle:'padding:5px 5px 0',
        width: genislik-220,
//       xtype: 'fieldset',
//        title : 'Öðrenci sayýlarý',
        layout:'column',
        columnWidth: 0.5,
        autoHeight:true,
        defaults: {anchor: '100%'},
        
            items:[{
                columnWidth:.5,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    enableKeyEvents: true,
                    fieldLabel: 'Eðitim Sayýsý',
                    id: 'AEegitimsayisi',                  
                    anchor:'50%',
                    
                }]
            },{
              columnWidth:.5,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    enableKeyEvents: true,
                    fieldLabel: 'Katýlýmcý Sayýsý',
                    id: 'AEkatilimcisayisi',                  
                    anchor:'50%',
 
                }]
            
             }]					
	
		
});  


//bilgileri yükle YO:
  for (i=1;i<AEformum.getForm().items.length+1;i++){
      AEformum.getForm().findField(AEisimler[i]).setValue(AEformData[AEisimler[i]]);
} 
 



 
var Aformum = new Ext.FormPanel({
        renderTo: 'Aform-bolgesi',
        labelAlign: 'left',
       //  title:'Okulda Yürütülen Rehberlik ve Psikolojik Danýþma Hizmetlerinin Deðerlendirilmesi',
         frame:true,
   //     url: 'gonder.php',
        title: 'RÝSKLER VE BAÞETME BECERÝLERÝ OKUL PROJESÝ EÐÝTÝM ÇALIÞMALARININ DEÐERLENDÝRÝLMESÝ',
        //bodyStyle:'padding:5px 5px 0',
        width: genislik-20,
//       xtype: 'fieldset',
//        title : 'Öðrenci sayýlarý',
        layout:'form',
        
        autoHeight:true,
        defaults: {anchor: '100%'},        
        labelAlign: 'top',
            items:[{
                //columnWidth:.5,
                layout: 'form',
                items: [{
                    xtype: 'textarea',                     
                    enableKeyEvents: true,
                    fieldLabel: 'Bu bölümde Proje çalýþmalarý kapsamýnda yapýlan eðitim çalýþmalarýna öðretmen, öðrenci ve velilerin katýlým durumu, çalýþmada karþýlaþýlan güçlükler, çalýþmayla ilgili varsa öneriler, vb. yazýlacaktýr',
                    id: 'aciklama',                  
                    anchor:'100%',
                    
                    
                }]
            }]					
	
		
});  


//bilgileri yükle YO:
  for (i=1;i<Aformum.getForm().items.length+1;i++){
      Aformum.getForm().findField(Aisimler[i]).setValue(AformData[Aisimler[i]]);
} 
 

});
   