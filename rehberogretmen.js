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
           {name: 'aldigiegitimler'}
  ]);
  
   var storegrid = new Ext.data.SimpleStore({
        fields: [
           {name: 'aldigiegitimler'}
           
        ]
    });

storegrid.loadData(storeData);         
 var sm = new Ext.grid.RowSelectionModel();
 
 var grid= new Ext.grid.EditorGridPanel({
                    store: storegrid,
                    sm:sm,
                    colModel: new Ext.grid.ColumnModel({
                    columns: [
                        {header: "Konular", id:'aldigiegitimler', width: 500, sortable: true, dataIndex: 'aldigiegitimler', editor: new Ext.form.TextField({ allowBlank: true })},
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
                                   aldigiegitimler:''   
                                  
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
     qtip: 'Açýlýr listeden kayýtlý rehber öðretmenleri seçebilirsiniz',
     qtitle: 'Rehber öðretmen adý soyadý',
     triggerAction: 'all',
     transform:'ogretmencombo',
     lazyRender:true,
     listClass: 'x-combo-list-small',
     listeners:{
         render: function(c){
              c.el.set({qtitle:c.qtitle});
              c.el.set({qtip:c.qtip});
              c.trigger.set({qtip:c.qtip});
        },

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

var bilgi="";


    var formum = new Ext.FormPanel({
		renderTo: 'grid-bolgesi',
        labelAlign: 'left',
         frame:true,
   //     url: 'gonder.php',
        title: 'Rehber Öðretmen Bilgileri',
        bodyStyle:'padding:5px 5px 0',
        width: 800,
        items: [{
            layout:'column',
            autoHeight:true,
            items:[{
                columnWidth:.5,
                layout: 'form',
                items: [{
                    xtype:'panel',
                    items : [ogretmencombo],
                    layout:'form',
                    autoWidth:true,
                    autoHeight:true,
                    anchor:'85%'
                  
                                  
                },{
                    xtype: 'combo',
                    fieldLabel: 'Cinsiyeti',
                    name: 'cinsiyeti',
                    id: 'cinsiyeti',
                    store:cinsiyetistore,
                    displayField:'isim',
                    valueField:'deger',
                    //typeAhead: true,
                    mode: 'local',
                    //forceSelection: true,
                    triggerAction: 'all',
                    //emptyText:'Select a state...',
                    //selectOnFocus:true,
                    editable: false,
                    anchor:'45%'
                },{
                    xtype:'datefield',
                    fieldLabel: 'Göreve Baþlama Tarihi',
                    id: 'gorevebaslamatarihi',
                    name: 'gorevebaslamatarihi',
                    format: 'd/m/Y',                    
                    anchor:'65%'
                },{
                    xtype:'datefield',
                    fieldLabel: 'Bu Okulda göreve Baþ. tarihi',
                    id: 'buokuldagorevebaslamatarihi',
                    name: 'buokuldagorevebaslamatarihi', 
                    format: 'd/m/Y',                   
                    anchor:'65%'
                },{
                   xtype: 'combo',
                    fieldLabel: 'Görev Türü',
                    name: 'gorevturu',
                    id: 'gorevturu',
                    store:gorevturustore,
                    displayField:'isim',
                    valueField:'deger',
                    mode: 'local',
                    triggerAction: 'all',
                    editable: false                
                    
                 }
                
                ]
            },{
                columnWidth:.5,
                layout: 'form',
                items: [{
                },{
                     xtype:'textarea',
                    fieldLabel: 'Mezun olduðu üniv. Fak. Program Bölüm',
                    name: 'mezunokul',
                    id: 'mezunokul',
                    anchor:'95%'
                },{
                    xtype:'textarea',
                    fieldLabel: 'Yüksek Lisans ve Doktora Tez konusu',
                    name: 'tezkonusu',
                    id: 'tezkonusu',
                   anchor:'95%'
                },{
                    xtype:'textfield',
                    fieldLabel: 'E-Posta',
                    id: 'eposta',
                    name: 'eposta', 
                     vtype: 'email',//Yâ Âlîm Allah                   
                    anchor:'65%'
                },{
                   
                    xtype:'textfield',
                    fieldLabel: 'Cep Telefonu',
                    name: 'ceptelefonu',
                    id: 'ceptelefonu',
                    anchor:'55%'
                }]   
                
            }]
        },{
        xtype: 'fieldset',
        title : 'Formatörlük eðitimi aldýðý hizmetiçi eðitim konularý',
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
            iconCls : 'save',
            handler: function() {
              // form kayýt:
                if (formum.getForm().findField('adisoyadi').getValue()=='') return;
                var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `adisoyadi`, `cinsiyeti`, `gorevebaslamatarihi`, `buokuldagorevebaslamatarihi`, `gorevturu`, `mezunokul`, `tezkonusu`, `eposta`, `ceptelefonu`) VALUES(';
    
                var sqlorta="'"+kurumkodu+"','";
                for (i=1;i<formum.getForm().items.length+1;i++){
                  var deger=formum.getForm().findField(isimler[i]).getValue();
                  if (Ext.isDate(deger)) deger=Ext.util.Format.date(deger, 'd/m/Y');
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
                                            adisoyadi: formum.getForm().findField("adisoyadi").getValue(),
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
                                  
                                  var sqlbaslangic='INSERT INTO `'+tablo+'_egitimler` (`adisoyadi`, `aldigiegitimler`) VALUES';
                                  
                                  var sqlgovde="";
                                  while (satir< grid.getStore().getCount())
                                  {
                                  var gridsatir=grid.getStore().getAt(satir);
                                  var ekleneceksatir="('"+formum.getForm().findField("adisoyadi").getValue()+"','"+ 
                                  tem(gridsatir.get('aldigiegitimler'))+"'),\n";
                                  
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
                                            kurumkodu: formum.getForm().findField("adisoyadi").getValue(),
                                            gonderkutusu: sqlgovde,
                                            tablo: tablo + '_egitimler'
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
                                        //alert (sonuc);
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
            tooltip : 'Yeni rehber öðretmen kayýt edilmesi için formu boþaltýr',
            handler: function(){ 
            //alert(myData["ogretimyili"]);
            //alert(formum.getForm().findField("ogrenimsekli").getValue());
            formum.getForm().reset();
            storegrid.loadData(bosdata);
            formum.getForm().findField("adisoyadi").focus();
            //bilgileriyukle(formum,isimler,myData);
            }
        },{
            text: 'Rehber Öðretmen sil',
            iconCls : 'remove',
            tooltip : 'Formda görülen rehber öðretmeni kayýtlardan siler',
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
                                            adisoyadi:"mevcutgetir"
                                           
                                        },
                                        success: function(response,opts){
                                            var sonuc = response.responseText;
                                          //alert(Ext.decode(sonuc));
                                            eval(sonuc);
                                             storegrid.loadData(storeData);
                                            bilgileriyukle(formum,isimler,myData);
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
                                    
            //formum.getForm().reset();
             
            }
        
      },{
         text : 'Ana sayfa',
         iconCls : 'klasor',
         handler : function (){
                 window.parent.tabs2.activate('0');

                  }
        
        }]
    });

if (rehberogretmensayisi>0){
  
  bilgi=formum.title+" (TOPLAM REHBER ÖÐRETMEN SAYISI: "+rehberogretmensayisi + ")";
    formum.setTitle(bilgi);
}



// BÝLGÝLERÝ YÜKLE:
function bilgileriyukle(formum,isimler,myData){
  for (i=1;i<formum.getForm().items.length+1;i++){
        formum.getForm().findField(isimler[i]).setValue(myData[isimler[i]]);
  }
}

bilgileriyukle(formum,isimler,myData); 
});



   