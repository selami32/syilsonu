/*
 * Ext JS Library 2.2
 * Copyright(c) 2006-2008, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 */

/*
CREATE TABLE IF NOT EXISTS `rehberogretmen` (
  `sn` int(11) NOT NULL AUTO_INCREMENT,
  `kurumkodu` int(11) NOT NULL,
  `tckimlik` int(11) NOT NULL,
  `adisoyadi` text,
  `eposta` text,
  `gorevunvani` text,
  `gorevyeri` text,
  `okulturu` text,
  `ceptelefonu` text,
  `ili` text,
  `ilcesi` text,
  `hizmetsuresi` text,
  `TKT-7-11` text,
  `TYT-6-8` text,
  `TKT-9-11` text,
  `risk` text,
  `psikososyal` text,
  `7-19aile` text,
  `diger` text,
  UNIQUE KEY `sn` (`sn`,`kurumkodu`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin5 AUTO_INCREMENT=1 ;

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
        ["ilkokul", "Ýlkokul"],
        ["ortaokul", "Ortaokul"],        
        ["lise", "Lise"],        
        ["meslekiveteknik", "Mesleki ve Teknik Eðitim"],        
        ["okuloncesi", "Okul Öncesi"]        
    ]
});

  var konu = Ext.data.Record.create([
           // the "name" below matches the tag name to read, except "availDate"
           // which is mapped to the tag "availability"
           {name: 'verebilecegiegitimler'}
  ]);
  
   var storegrid = new Ext.data.SimpleStore({
        fields: [
           {name: 'verebilecegiegitimler'}
           
        ]
    });

storegrid.loadData(storeData);         
 var sm = new Ext.grid.RowSelectionModel();
 
 var grid= new Ext.grid.EditorGridPanel({
                    store: storegrid,
                    sm:sm,
                    colModel: new Ext.grid.ColumnModel({
                    columns: [
                        {header: "Konular", id:'verebilecegiegitimler', width: 500, sortable: true, dataIndex: 'verebilecegiegitimler', editor: new Ext.form.TextField({ allowBlank: true })},
                    ]
                    }),
                    stripeRows: true,
                    height: 130,
                    width: 520,
                    clicksToEdit:1,
                    border:1,
                    tbar: [{
                          text: 'Konu Ekle',           
                          iconCls:'add',            
                          handler : function(){
                              var kon=new konu({
                                   verebilecegiegitimler:''   
                                  
                              });
                              grid.stopEditing();
                              storegrid.insert(0, kon);
                              grid.startEditing(0, 0);
                          }        
                    },{
                        text: 'Konu Sil',
                        iconCls:'remove',
                        handler : function(){
                      //  alert('ya Âlîm Allah');
                      // grid.getSelectionModel().selectRow(0);
                        var record = grid.getSelectionModel().getSelected();
                        if (record !== undefined) {
                        grid.store.remove(record); }
                        }     	
                        
                    },
                    ]
});
  
//formu oluþtur:
 
 var ogretmencombo=new CustomComboBox({
     typeAhead: true, 
     fieldLabel: 'Adý Soyadý',
     id:'adisoyadi',
     name:'adisoyadi',
     width: 250,
     autocomplete: true, 
     editable:true, 
     triggerAction: 'all',
     transform:'ogretmencombo',
     lazyRender:true,
     listClass: 'x-combo-list-small',
     listeners:{
        'select':function (obj, txt,e){
             Ext.Ajax.request({
                                        method: 'POST',
                                        url: 'rehberogretmen_getir.php',                                        
                                        params: {                                            
                                            kurumkodu: kurumkodu,
                                            adisoyadi:obj.value
                                           
                                        },
                                        success: function(response,opts){
                                            var sonuc = response.responseText;
                                          //alert(Ext.decode(sonuc));
                                        eval(sonuc);
                                        storegrid.loadData(storeData); 
                                        bilgileriyukle(formum,isimler,myData);
                                        }
                                        
                                    });
        }
     }
 }) ;
 
var bosdata=[];



/*var deneme=[
        ["ilkokul", "Ýlkokul"],
        ["ortaokul", "Ortaokul"],        
        ["lise", "Lise"],        
        ["meslekiveteknik", "Mesleki ve Teknik Eðitim"],        
        ["okuloncesi", "Okul Öncesi"]        

];
ogretmencombo.store.loadData(deneme);
//olcmecombo.store.data.items[1].data.value='selami';
//ozellikgoster(olcmecombo.store.data);*/
var bilgi="";
if (rehberogretmensayisi>0){
  
  bilgi="(TOPLAM REHBER ÖÐRETMEN SAYISI: "+rehberogretmensayisi + ")";
}
    var formum = new Ext.FormPanel({
		renderTo: 'grid-bolgesi',
        labelAlign: 'left',
         frame:true,
   //     url: 'gonder.php',
        title: 'Rehber Öðretmen Bilgileri '+bilgi,
        bodyStyle:'padding:5px 5px 0',
        width: 800,
        items: [{
            layout:'column',
            autoHeight:true,
            items:[{
                columnWidth:.5,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'T.c. Kimlik No',
                    id: 'tckimlik',                  
                    name: 'tckimlik',
                    valueField: 'tckimlik', 
                    //maxValue : 999999999999, 
                    autoCreate :  { //restricts user to 11 chars max, cannot enter 11st char
             								tag: "input", 
                            maxlength : 11, 
             								type: "text", 
             								size: "20", 
             								autocomplete: "off"}, 
                    maxLength: 11,                  
                    anchor:'55%'
                    
                },{
                    xtype:'panel',
                    items : [ogretmencombo],
                    layout:'form',
                    autoWidth:true,
                    autoHeight:true,
                    anchor:'85%'
                    
                },{
                    xtype:'textfield',
                    fieldLabel: 'E-Posta',
                    id: 'eposta',
                    name: 'eposta', 
                     vtype: 'email',//Yâ Âlîm Allah                   
                    anchor:'65%'
                    
                },{
                    xtype:'textfield',
                    fieldLabel: 'Görev Ünvaný',
                    id: 'gorevunvani',
                    name: 'gorevunvani',                    
                    anchor:'65%'
                },{
                    xtype:'textfield',
                    fieldLabel: 'Görev Yeri',                
                    id: 'gorevyeri',
                    name: 'gorevyeri',
                    anchor:'95%'
                    
                },{
                    xtype: 'combo',
                    fieldLabel: 'Okul türü',
                    name: 'okulturu',
                    id: 'okulturu',
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
                }
                
                ]
            },{
                columnWidth:.5,
                layout: 'form',
                items: [{
                    xtype:'textfield',
                    fieldLabel: 'Cep Telefonu',
                    name: 'ceptelefonu',
                    id: 'ceptelefonu',
                    anchor:'55%'
                },{
                     xtype:'textfield',
                    fieldLabel: 'Ýli',
                    name: 'ili',
                    id: 'ili',
                    anchor:'65%'
                },{
                    xtype:'textfield',
                    fieldLabel: 'Ýlçesi',
                    name: 'ilcesi',
                    id: 'ilcesi',
                   anchor:'65%'
                },{
                    xtype:'textfield',
                    fieldLabel: 'Hizmet Süresi',
                    id: 'hizmetsuresi',
                    name: 'hizmetsuresi',
                    anchor:'45%'
                }]   
                
            }]
        },{
        xtype: 'fieldset',
        title : 'Katýldýðý Eðitimler',
        layout:'column',
       // columnWidth: 0.3,
        //autoHeight:true,
        height: 120,
        //defaultType: 'checkbox',
        //defaults: {anchor: '100%'},
        
            items:[{
                 columnWidth: .3,
                //bodyStyle: 'padding-right:5px;',
                items:{
                     autoHeight: true,
                    defaultType: 'checkbox',  // each item will be a checkbox
                    items: [{
                         fieldLabel: '',
                        labelSeparator: '',
                        boxLabel: 'TKT-7-11',
                        name: 'TKT-7-11',
                        id: 'TKT-7-11'
                    },{
                        
                        fieldLabel: '',
                        labelSeparator: '',
                        boxLabel: 'TYT-6-8',
                        name: 'TYT-6-8',
                        id: 'TYT-6-8'
                    },{
                        
                        fieldLabel: '',
                        labelSeparator: '',
                        boxLabel: 'TKT 9-11',
                        name: 'TKT-9-11',
                        id: 'TKT-9-11'
                    }]
                }
            },{
                columnWidth: .3,
                //bodyStyle: 'padding-right:5px;',
                items:{
                     autoHeight: true,
                    defaultType: 'checkbox',  // each item will be a checkbox
                    items: [{
                         fieldLabel: '',
                        labelSeparator: '',
                        boxLabel: 'Risk Altýndaki Çocuklara Yaklaþým',
                        name: 'risk',
                        id: 'risk'
                    },{
                        
                        fieldLabel: '',
                        labelSeparator: '',
                        boxLabel: 'Psikososyal Müdahale Hizmetleri',
                        name: 'psikososyal',
                        id: 'psikososyal'
                    },{
                        
                        fieldLabel: '',
                        labelSeparator: '',
                        boxLabel: '7-19 Aile Eðitimi',
                        name: '7-19aile',
                        id: '7-19aile'
                    }]
                }
            },{
                   columnWidth: .3,
                //bodyStyle: 'padding-right:5px;',
                items:{
                     height: 90,
                    
                    //defaultType: 'checkbox',  // each item will be a checkbox
                    items: [{
                        xtype: 'fieldset',
                        border: true,
                        title : 'Diðer',
                        layout:'column',
                        autoHeight: true,
                        items:[{
                        columnWidth: 1,
                            items:[{    
                                  xtype:'textfield',
                                  autoWidth: true,
                                  fieldLabel: 'Diðer',
                                  id: 'diger',
                                  name: 'diger',
                                  anchor:'100%',
                                        autoCreate :  {
                                        tag: "input", 
                                        type: "text", 
                                        size: "35", 
                                        autocomplete: "off"} 
                                  }]
                              }]
                    }]
                }

             }]
 
        },{
        xtype: 'fieldset',
        title : 'Verebileceði Eðitim konularý',
        layout:'form',
        autoWidth:true,
       // columnWidth: 0.3,
        //autoHeight:true,
        height:160,
          items:[{
                
                //bodyStyle: 'padding-right:5px;',
                items: [grid]                
                
            }]
        }
        ],
        buttons: [{
            text: 'Kaydet',
            iconCls :'save',
            handler: function() {
              // form kayýt:
                var sqlbaslangic='INSERT INTO `'+onek+'rehberogretmen` (`kurumkodu`, `tckimlik`, `adisoyadi`, `eposta`, `gorevunvani`, `gorevyeri`, `okulturu`, `ceptelefonu`, `ili`, `ilcesi`, `hizmetsuresi`, `TKT-7-11`, `TYT-6-8`, `TKT-9-11`, `risk`, `psikososyal`, `7-19aile`, `diger`) VALUES(';
                if (formum.getForm().findField("tckimlik").getValue()=="") {
					Ext.MessageBox.alert("Eksik bilgi", "T.C Kimlik no girilmelidir");
					return;
					}
                var sqlorta="'"+kurumkodu+"','";
                for (i=1;i<formum.getForm().items.length+1;i++){
                sqlorta=sqlorta+tem(formum.getForm().findField(isimler[i]).getValue())+"','";
                
                
                }
                sqlorta=sqlorta.substr(0,sqlorta.length-2)+")";
                
                var sqltamami=sqlbaslangic+sqlorta;
               // alert(sqltamami);
                                    Ext.Ajax.request({
                                        method: 'POST',
                                        url: 'gonder.php',                                        
                                        params: {
                                            ajax:'evet',
                                            adisoyadi: formum.getForm().findField("adisoyadi").getValue(),
                                            kurumkodu: kurumkodu,
                                            gonderkutusu: sqltamami,
                                            tablo: onek+'rehberogretmen'
                                        },
                                        success: function(response,opts){
                                            var sonuc = response.responseText;
                                          //alert(Ext.decode(sonuc));
                                        Ext.MessageBox.alert('Durum', sonuc);
                                        }
                                        
                                    });
                                           

                 
                // alttaki verebileceði eðitimler kayýt:
                 var satir=0;
                                  //gonderp.src="gonder.php";
                                  
                                  var sqlbaslangic='INSERT INTO `'+onek+'rehberogretmen_egitimler` (`tckimlik`, `verebilecegiegitimler`) VALUES';
                                  
                                  var sqlgovde="";
                                  while (satir< grid.getStore().getCount())
                                  {
                                  var gridsatir=grid.getStore().getAt(satir);
                                  var ekleneceksatir="('"+formum.getForm().findField("tckimlik").getValue()+"','"+ 
                                  tem(gridsatir.get('verebilecegiegitimler'))+"'),\n";
                                  
                                  sqlgovde=sqlgovde+ekleneceksatir;
                                  satir++;
                                  }
                                  
                                  sqlgovde=sqlbaslangic+sqlgovde.substr(0,sqlgovde.length-2)+";";
                                  
                                 // alert(sqlgovde);
                                  
                                  //ozellikgoster(gonderp);
                                  if (satir>0){
                                    Ext.Ajax.request({
                                        method: 'POST',
                                        url: 'gonder.php',                                        
                                        params: {
                                            ajax: 'evet',
                                            kurumkodu: formum.getForm().findField("tckimlik").getValue(),
                                            gonderkutusu: sqlgovde,
                                            tablo: onek+'rehberogretmen_egitimler'
                                        },
                                        success: function(response){
                                            var sonuc = response.responseText;
                                        
                                         Ext.MessageBox.alert('Durum', sonuc);
 
                                        }
                                    });
                                   };
                                      
                                 // adý soyadý listesini doldur:
                                 Ext.Ajax.request({
                                        method: 'POST',
                                        url: 'rehberogretmen_getir.php',                                        
                                        params: {                                            
                                            kurumkodu: kurumkodu,
                                            adisoyadi:formum.getForm().findField("adisoyadi").getValue()
                                           
                                        },
                                        success: function(response,opts){
                                            var sonuc = response.responseText;
                                          //alert(Ext.decode(sonuc));
                                        eval(sonuc);
                                        ogretmencombo.store.loadData(olcmecombostore);
                                        var bilgi='';
                                        if (rehberogretmensayisi>0){
                                            bilgi="(TOPLAM REHBER ÖÐRETMEN SAYISI: "+rehberogretmensayisi + ")";
                                          }
                                          bilgi='Rehber Öðretmen Bilgileri '+bilgi
                                        formum.setTitle(bilgi);
 
                                        }
                                        
                                    });
     
                
               

            }
        },{
            text: 'Rehber Öðretmen Ekle',
            iconCls : 'add',
            handler: function(){ 
            //alert(myData["ogretimyili"]);
            //alert(formum.getForm().findField("ogrenimsekli").getValue());
            formum.getForm().reset();
            storegrid.loadData(bosdata);
            }
        },{
            text: 'Rehber Öðretmen sil',
            iconCls : 'remove',
            handler: function(){ 
            //alert(myData["ogretimyili"]);
            //alert(formum.getForm().findField("ogrenimsekli").getValue());
                if (formum.getForm().findField("adisoyadi").getValue()=='') return;       
                                   Ext.Ajax.request({
                                        method: 'POST',
                                        url: 'rehberogretmen_getir.php',                                        
                                        params: {                                            
                                            kurumkodu: kurumkodu,
                                            adisoyadi:formum.getForm().findField("adisoyadi").getValue(),
                                            silinecek: 'evet'
                                        },
                                        success: function(response,opts){
                                            var sonuc = response.responseText;
                                          //alert(Ext.decode(sonuc));
                                       Ext.MessageBox.alert('Durum', sonuc);
                                       
                                        }
                                        
                                    });
                                    
                                    // öðretmen listesini doldur
                                     Ext.Ajax.request({
                                        method: 'POST',
                                        url: 'rehberogretmen_getir.php',                                        
                                        params: {                                            
                                            kurumkodu: kurumkodu,
                                            adisoyadi:formum.getForm().findField("adisoyadi").getValue()
                                           
                                        },
                                        success: function(response,opts){
                                            var sonuc = response.responseText;
                                          //alert(Ext.decode(sonuc));
                                        eval(sonuc);
                                        ogretmencombo.store.loadData(olcmecombostore);
                                        var bilgi='';
                                        if (rehberogretmensayisi>0){
                                            bilgi="(TOPLAM REHBER ÖÐRETMEN SAYISI: "+rehberogretmensayisi + ")";
                                          }
                                          bilgi='Rehber Öðretmen Bilgileri '+bilgi
                                        formum.setTitle(bilgi);
                                        //formum.getForm().title=';
                                        }
                                        
                                    });
                                    
            formum.getForm().reset();
            storegrid.loadData(bosdata);

            }
        
      },{
            text: 'Rehber Öðretmen Rapor',
            iconCls:'icon-grid',
            handler : function(){
            document.location.href="rehberogretmen_rapor.php?kurumkodu="+kurumkodu+"&okulunadi="+gorevyeri;

            }
       }]
       
    
    });



// BÝLGÝLERÝ YÜKLE:
function bilgileriyukle(formum,isimler,myData){
  for (i=1;i<formum.getForm().items.length+1;i++){
        formum.getForm().findField(isimler[i]).setValue(myData[isimler[i]]);
  }
}

bilgileriyukle(formum,isimler,myData);
});



   