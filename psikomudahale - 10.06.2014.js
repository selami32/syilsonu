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

  

    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'programturu'},
           {name: 'calismaanaokulu', type: 'float'},
           {name: 'calismailkokul', type: 'float'},
           {name: 'calismaortaokul', type: 'float'},
           {name: 'calismalise', type: 'float'},
           {name: 'calismaogretmen', type: 'float'},
           {name: 'calismayonetici', type: 'float'},
           {name: 'calismaogrenci', type: 'float'},
           {name: 'calismaveli', type: 'float'},
           {name: 'egitimekatilanpsiko', type: 'float'}
        ]
    });
    store.loadData(myData);

           
    // create the Grid
    var sm = new Ext.grid.RowSelectionModel();
    
    Ext.grid.RowSelectionModel.override ({
    getSelectedIndex : function(){
        return this.grid.store.indexOf( this.selections.itemAt(0) );
    }
    });
    
    var grid = new Ext.grid.EditorGridPanel({
        store: store,
        renderTo: 'grid-bolgesi',
        sm: sm,
        colModel: new Ext.grid.ColumnModel({
            columns: [
            {id:'programturu', header: "Program Türü", width: 275, dataIndex: 'programturu' },
            {header: 'Anaokulu', align: 'center', width: 55, sortable: false,  dataIndex:  'calismaanaokulu', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: 'Ýlkokul', align: 'center', width: 55, sortable: false,  dataIndex:  'calismailkokul', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: 'Ortaokul', align: 'center', width: 55, sortable: false,  dataIndex:  'calismaortaokul', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: 'Lise', align: 'center',width: 55, sortable: false,  dataIndex:  'calismalise', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: 'Öðretmen', align: 'center',width: 65, sortable: false,  dataIndex:  'calismaogretmen', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: 'Yönetici', align: 'center',width: 65, sortable: false,  dataIndex:  'calismayonetici', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: 'Çalýþma yap. öðrenci sayýsý', align: 'center',width: 65, sortable: false,  dataIndex:  'calismaogrenci', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: 'Çalýþma Yapýlan Veli Sayýsý', align: 'center',width: 65, sortable: false,  dataIndex:  'calismaveli', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: 'Eðitime Katýlan Psikolojik Dan. Sayýsý', align: 'center', width: 65, sortable: false,  dataIndex:  'egitimekatilanpsiko', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})}

            ],
            rows: [
                [
                    {},
                    {header: 'Çalýþma Yapýlan Okul', colspan: 4, align: 'center'},						
                    {header: 'Çalýþma Yapýlan Personel', colspan: 2, align: 'center'},						
                {},
                {},
                {}
                ],
         
                    
            ]
        }),        
        stripeRows: true,
       // autoExpandColumn: 'etkinlikturu',
        height:400,
        width:genislik-20,
        plugins: [new Ext.ux.plugins.GroupHeaderGrid()],
        clicksToEdit:1,        
        title:'Psikososyal Müdahale Hizmetleri',
        tbar: [{        
            text: 'Kaydet',
            iconCls:'save',
            handler : function(){
                                       //alert('ya Âlîm Allah');
                                  
                                  //alert( grid.getStore().getAt(1).get('etkinlikkonusu'));
                                  //alert(grid.getStore().getCount());
                                  
                                  var satir=0;
                                  
                                  var sqlbaslangic='INSERT INTO '+tablo+' (`kurumkodu`, `okulunadi`, `ilcesi`, `okulturu`, `anaokulupsikoegitim`, `ilkokulpsikoegitim`, `ortaokulpsikoegitim`, `lisepsikoegitim`, `ogretmenpsikoegitim`, `yoneticipsikoegitim`, `ogrencisayisipsikoegitim`, `velisayisipsikoegitim`, `psikolojikdanismanpsikoegitim`, `anaokulupsikolojikbilgilenidirme`, `ilkokulpsikolojikbilgilenidirme`, `ortaokulpsikolojikbilgilenidirme`, `lisepsikolojikbilgilenidirme`, `ogretmenpsikolojikbilgilenidirme`, `yoneticipsikolojikbilgilenidirme`, `ogrencisayisipsikolojikbilgilenidirme`, `velisayisipsikolojikbilgilenidirme`, `psikolojikdanismanpsikolojikbilgilenidirme`, `anaokulugruplapsikolojik`, `ilkokulgruplapsikolojik`, `ortaokulgruplapsikolojik`, `lisegruplapsikolojik`, `ogretmengruplapsikolojik`, `yoneticigruplapsikolojik`, `ogrencisayisigruplapsikolojik`, `velisayisigruplapsikolojik`, `psikolojikdanismangruplapsikolojik`, `anaokuluhayatasahipcikma`, `ilkokulhayatasahipcikma`, `ortaokulhayatasahipcikma`, `lisehayatasahipcikma`, `ogretmenhayatasahipcikma`, `yoneticihayatasahipcikma`, `ogrencisayisihayatasahipcikma`, `velisayisihayatasahipcikma`, `psikolojikdanismanhayatasahipcikma`, `anaokuluaileegitimi`, `ilkokulaileegitimi`, `ortaokulaileegitimi`, `liseaileegitimi`, `ogretmenaileegitimi`, `yoneticiaileegitimi`, `ogrencisayisiaileegitimi`, `velisayisiaileegitimi`, `psikolojikdanismanaileegitimi`, `anaokulutemelonleme`, `ilkokultemelonleme`, `ortaokultemelonleme`, `lisetemelonleme`, `ogretmentemelonleme`, `yoneticitemelonleme`, `ogrencisayisitemelonleme`, `velisayisitemelonleme`, `psikolojikdanismantemelonleme`) VALUES';
                                  
                                  var sqlgovde="";
                                  var ekleneceksatirorta="";
                                  var ekleneceksatirbas="("+kurumkodu+",'"+okulunadi+"','"+ilcesi+"','"+okulturu+"','";
                                  while (satir< grid.getStore().getCount()){
                                        var gridsatir=grid.getStore().getAt(satir);
                                        var ekleneceksatirorta=ekleneceksatirorta+ 
                                        gridsatir.get( 'calismaanaokulu')	+"','"+ 
                                        gridsatir.get( 'calismailkokul')	+"','"+ 
                                        gridsatir.get( 'calismaortaokul')	+"','"+ 
                                        gridsatir.get( 'calismalise')	+"','"+ 
                                        gridsatir.get( 'calismaogretmen')	+"','"+ 
                                        gridsatir.get( 'calismayonetici')	+"','"+ 
                                        gridsatir.get( 'calismaogrenci')	+"','"+ 
                                        gridsatir.get( 'calismaveli')	+"','"+ 
                                        gridsatir.get( 'egitimekatilanpsiko')	+"','";                                  
                                        satir++;
                                  }
                                  
                                  ekleneceksatirson=ekleneceksatirbas+ekleneceksatirorta;
                                  
                                  sqlgovde=ekleneceksatirson;

                                  
                                  sqlgovde=sqlbaslangic+sqlgovde.substr(0,sqlgovde.length-2)+");";
                                  
                                // document.write(sqlgovde);
                                  
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
                                            Ext.MessageBox.alert('Durum', sonuc);
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
    
    // grid.render();
    
         /*       grid.on('rowclick', function(grid, rowIndex, columnIndex, e) {
                //alert( rowIndex +" "+ columnIndex +" "+ e);
            }, this);*/

    //grid.render('document.body');

    grid.getSelectionModel().selectFirstRow();
 
});
   