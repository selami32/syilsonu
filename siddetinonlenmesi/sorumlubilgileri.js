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

Ext.BLANK_IMAGE_URL = adres+'ext2/resources/images/default/s.gif';

Ext.QuickTips.init();
    // NOTE: This is an example showing simple state management. During development,
    // it is generally best to disable state management as dynamically-generated ids
    // can change across page loads, leading to unpredictable results.  The developer
    // should ensure that stable state ids are set for stateful components in real apps.
   // Ext.state.Manager.setProvider(new Ext.state.CookieProvider());

var cinsiyetistore = new Ext.data.SimpleStore({
    fields: ['deger', 'isim'],
    data : [
        ["Bay", "Bay"],
        ["Bayan", "Bayan"]        
    ]
});

var gorevturustore = new Ext.data.SimpleStore({
    fields: ['deger', 'isim'],
    data : [
        ["Kadrolu", "Kadrolu"],
        ["Görevlendirme", "Görevlendirme"]        
    ]
});

  var konu = Ext.data.Record.create([
           // the "name" below matches the tag name to read, except "availDate"
           // which is mapped to the tag "availability"
           {name: 'adisoyadi'},
		   {name: 'kurumu'},
		   {name: 'unvani'},
		   {name: 'telefon'},
		   {name: 'faks'},
		   {name: 'eposta'}
  ]);
  
   var storegrid = new Ext.data.SimpleStore({
        fields: [
           {name: 'adisoyadi'},
           {name: 'kurumu'},
		   {name: 'unvani'},
		   {name: 'telefon'},
		   {name: 'faks'},
		   {name: 'eposta'}
        ]
		
    });

storegrid.loadData(storeData);         
 var sm = new Ext.grid.RowSelectionModel();
 
 var grid= new Ext.grid.EditorGridPanel({
                    store: storegrid,
                    sm:sm,
					id:'tablo',
					name: 'tablo',
                    colModel: new Ext.grid.ColumnModel({
                    columns: [
                        {header: "Adý Soyadý", id:'adisoyadi', width: 150, sortable: true, dataIndex: 'adisoyadi', editor: new Ext.form.TextField({ allowBlank: true })},
						{header: "Kurumu", id:'kurumu', width: 190, sortable: true, dataIndex: 'kurumu', editor: new Ext.form.TextField({ allowBlank: true })},
						{header: "Ünvaný", id:'unvani', width: 120, sortable: true, dataIndex: 'unvani', editor: new Ext.form.TextField({ allowBlank: true })},
						{header: "Telefon no", id:'telefon', width: 90, sortable: true, dataIndex: 'telefon', editor: new Ext.form.TextField({ allowBlank: true })},
						{header: "Faks", id:'faks', width: 90, sortable: true, dataIndex: 'faks', editor: new Ext.form.TextField({ allowBlank: true })},
						{header: "E-Posta", id:'eposta', width: 110, sortable: true, dataIndex: 'eposta', editor: new Ext.form.TextField({ allowBlank: true, vtype: 'email' })}

                    ]
                    }),
                    stripeRows: true,
                    height: 230,
                    width: 760,
                    clicksToEdit:1,
                    border:0,
                    tbar: [{
                          text: 'Üye Ekle',           
                          iconCls:'add',            
                          handler : function(){
                              var kon=new konu({
								adisoyadi:'',
								kurumu:'',
								unvani:'',
								telefon:'',
								faks:'',
								eposta:''
                                  
                              });
                              grid.stopEditing();
                              storegrid.insert(0, kon);
                              grid.startEditing(0, 0);
                          }        
                    },{
                        text: 'Üye Sil',
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

 
var bosdata=[];

var bilgi="";


    var formum = new Ext.FormPanel({
		renderTo: 'grid-bolgesi',
        labelAlign: 'left',
         frame:true,
   //     url: 'gonder.php',
        title: 'Sorumlu Müdür Yardýmcýsý Bilgileri',
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
                    fieldLabel: 'Adý Soyadý',
                    name: 'adisoyadi',
                    id: 'adisoyadi',                  
                    anchor:'100%'
                  
                                  
                },{
                    xtype:'textfield',
                    fieldLabel: 'Telefon no',
                    name: 'telefon',
                    id: 'telefon',                  
                    anchor:'65%'
                },{
                     xtype:'textfield',
                    fieldLabel: 'Faks no',
                    name: 'faks',
                    id: 'faks',                  
                    anchor:'65%'
 
                },{
					xtype:'textfield',
                    fieldLabel: 'E-Posta',
                    id: 'eposta',
                    name: 'eposta', 
                     vtype: 'email',//Yâ Âlîm Allah                   
                    anchor:'80%'
                }
                
                ]
            },{
                columnWidth:.5,
                layout: 'form'//,
                //items: []   
                
            }]
        },{
        xtype: 'fieldset',
        title : 'Okul Yürütme Kurulu Üyelerine Ýliþkin Bilgiler ',
        layout:'form',
        autoWidth:true,
       // columnWidth: 0.3,
        //autoHeight:true,
        height:260,
          items:[{
                
                //bodyStyle: 'padding-right:5px;',
                items: [grid]                
                
            }]
        }
        ],
        buttons: [{
            text: 'Kaydet',
            iconCls : 'save',
            handler: function() {
              // form kayýt:
               
                var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `adisoyadi`, `telefon`, `faks`, `eposta`) VALUES(';
    
                var sqlorta="'"+kurumkodu+"','";
                for (i=1;i<formum.getForm().items.length+1;i++){
                  var deger=formum.getForm().findField(isimler[i]).getValue();
                  //if (Ext.isDate(deger)) deger=Ext.util.Format.date(deger, 'd/m/Y');
                  sqlorta=sqlorta+tem(deger)+"','";
                
                }
                sqlorta=sqlorta.substr(0,sqlorta.length-2)+")";
                
                var sqltamami=sqlbaslangic+sqlorta;
               // alert(sqltamami);
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
                                          //alert(Ext.decode(sonuc));
                                        Ext.MessageBox.alert('Durum', sonuc);
                                        }
                                        
                                    });
                                           

                 
                // alttaki verebileceði eðitimler kayýt:
                 var satir=0;
                                  //gonderp.src="gonder.php";
                                  
                                  var sqlbaslangic='INSERT INTO `'+tablo+'_uyeler` (`kurumkodu`, `adisoyadi`, `kurumu`, `unvani`, `telefon`,  `faks`,  `eposta`) VALUES';
                                  
                                  var sqlgovde="";
                                  while (satir< grid.getStore().getCount())
                                  {
                                  var gridsatir=grid.getStore().getAt(satir);
                                  var ekleneceksatir="('"+
								  kurumkodu+"','"+ 
                                  tem(gridsatir.get('adisoyadi'))+"','"+
                                  tem(gridsatir.get('kurumu'))+"','"+
                                  tem(gridsatir.get('unvani'))+"','"+
                                  tem(gridsatir.get('telefon'))+"','"+
                                  tem(gridsatir.get('faks'))+"','"+
                                  tem(gridsatir.get('eposta'))+"'),\n";
                                  
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
                                            kurumkodu: kurumkodu,
                                            gonderkutusu: sqlgovde,
                                            tablo: tablo + '_uyeler'
                                        },
                                        success: function(response){
                                            var sonuc = response.responseText;
                                        
                                            Ext.MessageBox.alert('Durum', sonuc);
 
                                        }
                                    });
                                   };
                                 

            }
       
      },{
         text : 'Ana sayfa',
         iconCls : 'klasor',
         handler : function (){
                 window.parent.tabs2.activate('0');

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

storegrid.loadData(storeData); 
//ozellikgoster(grid.store.reader);
//grid.store.reload();

});

   