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
           {name:'siniflar'},
          {name:'zihinkiz', type:'float'},
          {name:'zihinerkek', type:'float'},
          {name:'gormekiz', type:'float'},
          {name:'gormeerkek', type:'float'},
          {name:'isitmekiz', type:'float'},
          {name:'isitmeerkek', type:'float'},
          {name:'ortopedikiz', type:'float'},
          {name:'ortopedierkek', type:'float'},
          {name:'otistikkiz', type:'float'},
          {name:'otistikerkek', type:'float'},
          {name:'ustunozelerkek', type:'float'},
          {name:'ustunozelkiz', type:'float'},
          {name:'bagimliocemkiz', type:'float'},
          {name:'bagimliocemerkek', type:'float'},
          {name:'toplamkiz', type:'float'},
          {name:'toplamerkek', type:'float'}
          
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
              {header: 'Sýnýflar', id:'siniflar', width: 120, sortable: false, dataIndex: 'siniflar'},
{header: 'K', width: 65, sortable: false,  dataIndex: 'zihinkiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'E', width: 65, sortable: false,  dataIndex: 'zihinerkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'K', width: 65, sortable: false,  dataIndex: 'gormekiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'E', width: 65, sortable: false,  dataIndex: 'gormeerkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'K', width: 65, sortable: false,  dataIndex: 'isitmekiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'E', width: 65, sortable: false,  dataIndex: 'isitmeerkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'K', width: 65, sortable: false,  dataIndex: 'ortopedikiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'E', width: 65, sortable: false,  dataIndex: 'ortopedierkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'K', width: 65, sortable: false,  dataIndex: 'otistikkiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'E', width: 65, sortable: false,  dataIndex: 'otistikerkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'K', width: 65, sortable: false,  dataIndex: 'ustunozelerkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'E', width: 65, sortable: false,  dataIndex: 'ustunozelkiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'K', width: 65, sortable: false,  dataIndex: 'bagimliocemkiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'E', width: 65, sortable: false,  dataIndex: 'bagimliocemerkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
{header: 'K', width: 65, sortable: false,  dataIndex: 'toplamkiz'},
{header: 'E', width: 65, sortable: false,  dataIndex: 'toplamerkek'}
        ],
 				rows: [
          [
						{},
						{header: 'YETERSÝZLÝK ALANLARI', colspan:10, align: 'center'},
						{header: '', colspan:2, align: 'center'},
						{header: '', colspan:2, align: 'center'},
						{header: '', colspan:2, align: 'center'}
						
          ],[
						{},
						{header: 'Zihinsel Engelliler', colspan:2, align: 'center'},						
						{header: 'Görme Engelli', colspan:2, align: 'center'},						
						{header: 'Ýþitme Engelli', colspan:2, align: 'center'},						
						{header: 'Ortopedik Engelli', colspan:2, align: 'center'},						
						{header: 'Otistik', colspan:2, align: 'center'},						
            {header: 'Üstün Yetenekliler Sýnýfý', colspan:2, align: 'center'},
            {header: 'Baðýmlý Oçem Sýnýfý', colspan:2, align: 'center'},
            {header: 'Toplam', colspan:2, align: 'center'},

					],
					
				]
        }),
        listeners: {
            afteredit : function(object) {
              //satirtoplam:
              var gridsatir=grid.getStore().getAt(object.row);
              var tsonucE=
              gridsatir.get('zihinerkek')	+
              gridsatir.get('gormeerkek')	+
              gridsatir.get('isitmeerkek')	+
              gridsatir.get('ortopedierkek')	+
              gridsatir.get('otistikerkek')	+
              gridsatir.get('ustunozelerkek')	+
              gridsatir.get('bagimliocemerkek');              
              
              gridsatir.set('toplamerkek',tsonucE);

              var tsonucK=
              gridsatir.get('zihinkiz')	+
              gridsatir.get('gormekiz')	+
              gridsatir.get('isitmekiz')	+
              gridsatir.get('ortopedikiz')	+
              gridsatir.get('otistikkiz')	+
              gridsatir.get('ustunozelkiz')	+
              gridsatir.get('bagimliocemkiz');
              
              gridsatir.set('toplamkiz',tsonucK);

              grid.getStore().commitChanges();
              }
        },
        stripeRows: true,
        height:yukseklik-250,
        width:genislik-20,
        clicksToEdit:1,
        enableColumnMove: false,
        viewConfig: {
            forceFit: true
        },
        plugins: [new Ext.ux.plugins.GroupHeaderGrid()],        
        title:'Özel Eðitim Sýnýflarý:',
        tbar: [{          
            text: 'Kaydet',
            tooltip: 'Aþaðýdaki toplamlar da kayýt edilecektir',
            iconCls:'save',
            handler : function(){
                                       //alert('ya Âlîm Allah');
                                  
                                  //alert( grid.getStore().getAt(1).get('etkinlikkonusu'));
                                  //alert(grid.getStore().getCount());
                                  //GRID ÝÇÝN KAYIT:
                                  var satir=0;
                                  
                                  var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `siniflar`, `zihinkiz`, `zihinerkek`, `gormekiz`, `gormeerkek`, `isitmekiz`, `isitmeerkek`, `ortopedikiz`, `ortopedierkek`, `otistikkiz`, `otistikerkek`, `ustunozelerkek`, `ustunozelkiz`, `bagimliocemkiz`, `bagimliocemerkek`, `toplamkiz`, `toplamerkek`) VALUES';
                                  
                                  var sqlgovde="";
                                  while (satir< grid.getStore().getCount()){
                                        var gridsatir=grid.getStore().getAt(satir);
                                        var ekleneceksatir="("+kurumkodu+",'"+ 
                                        gridsatir.get('siniflar')+"','"+ 
                                        gridsatir.get('zihinkiz')	+"','"+
                                        gridsatir.get('zihinerkek')	+"','"+
                                        gridsatir.get('gormekiz')	+"','"+
                                        gridsatir.get('gormeerkek')	+"','"+
                                        gridsatir.get('isitmekiz')	+"','"+
                                        gridsatir.get('isitmeerkek')	+"','"+
                                        gridsatir.get('ortopedikiz')	+"','"+
                                        gridsatir.get('ortopedierkek')	+"','"+
                                        gridsatir.get('otistikkiz')	+"','"+
                                        gridsatir.get('otistikerkek')	+"','"+
                                        gridsatir.get('ustunozelkiz')	+"','"+
                                        gridsatir.get('ustunozelerkek')	+"','"+
                                        gridsatir.get('bagimliocemkiz')	+"','"+
                                        gridsatir.get('bagimliocemerkek')	+"','"+
                                        gridsatir.get('toplamkiz')	+"','"+
                                        gridsatir.get('toplamerkek')+"'),\n";
                                        
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
                              // alttaki form için kayýt  
                                  var sqlbaslangic='INSERT INTO `'+tablo+'_ekbilgi` (`kurumkodu`, `sinifsayisi`, `ogretmensayisi`) VALUES(';
                                  var sqlorta="'"+kurumkodu+"','";
                                  for (i=1;i<formum.getForm().items.length+1;i++){
                                    sqlorta=sqlorta+tem(formum.getForm().findField(Fisimler[i]).getValue())+"','";
                                  }
                                  sqlorta=sqlorta.substr(0,sqlorta.length-2)+")";
                                  var sqltamami=sqlbaslangic+sqlorta;
                                  Ext.Ajax.request({
                                      method: 'POST',
                                      url: 'gonder.php',                                        
                                      params: {
                                        ajax:'evet',
                                        kurumkodu: kurumkodu,
                                        gonderkutusu: sqltamami,
                                        tablo: tablo + '_ekbilgi'
                                      },
                                      success: function(response,opts){
                                        var sonuc = response.responseText;
                                        //alert(Ext.decode(sonuc));
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
  var formum = new Ext.FormPanel({
        renderTo: 'form-bolgesi',
        labelAlign: 'left',
       //  title:'Okulda Yürütülen Rehberlik ve Psikolojik Danýþma Hizmetlerinin Deðerlendirilmesi',
         frame:true,
   //     url: 'gonder.php',
        title: 'Toplam',
        //bodyStyle:'padding:5px 5px 0',
        width: genislik-20,
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
                    fieldLabel: 'Sýnýf Sayýsý',
                    id: 'sinifsayisi',                  
                    anchor:'50%',
                    
                }]
            },{
              columnWidth:.5,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    enableKeyEvents: true,
                    fieldLabel: 'Öðretmen Sayýsý',
                    id: 'ogretmensayisi',                  
                    anchor:'50%',
 
                }]
            
             }]					
	
		
});  

//bilgileri yükle:
  for (i=1;i<formum.getForm().items.length+1;i++){
      formum.getForm().findField(Fisimler[i]).setValue(formData[Fisimler[i]]);
} 

 
 
 
});
   