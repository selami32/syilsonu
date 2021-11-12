/*
 * Ext JS Library 2.2
 * Copyright(c) 2006-2008, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 */

/*
CREATE TABLE IF NOT EXISTS `etkinliklerv2` (
  `sn` int(11) NOT NULL AUTO_INCREMENT,
  `kurumkodu` int(11) NOT NULL,
  `etkinlikadi` text,
  `etkinliksayisi` text,
  `katilanyonetici` text,
  `katilanogretmen` text,
  `katilanrehberogretmen` text,
  `katilanogrenciilkogretim` text,
  `katilanogrenciortaogretim` text,
  `katilanaile` text,
  `katilandiger` text,
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
           {name:'zihinerkek',type:'float'},
           {name:'dehbkiz',type:'float'},
           {name:'dehberkek',type:'float'},
           {name:'ustunkiz',type:'float'},
           {name:'ustunerkek',type:'float'},
           {name:'gormekiz',type:'float'},
           {name:'gormeerkek',type:'float'},
           {name:'ozgulkiz',type:'float'},
           {name:'ozgulerkek',type:'float'},
           {name:'isitmekiz',type:'float'},
           {name:'isitmeerkek',type:'float'},
           {name:'ortopedikiz',type:'float'},
           {name:'ortopedierkek',type:'float'},
           {name:'konusmakiz',type:'float'},
           {name:'konusmaerkek',type: 'float'},
           {name:'spastikkiz',type:'float'},
           {name:'spastikerkek',type:'float'},
           {name:'otistikkiz',type:'float'},
           {name:'otistikerkek',type:'float'},
           {name:'birdenfazlakiz',type:'float'},
           {name:'birdenfazlaerkek',type:'float'}
          
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
              {header: 'K', width: 60, sortable: false,  dataIndex: 'zihinkiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'E', width: 60, sortable: true,  dataIndex: 'zihinerkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'K', width: 60, sortable: true,  dataIndex: 'dehbkiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'E', width: 60, sortable: true,  dataIndex: 'dehberkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'K', width: 60, sortable: true,  dataIndex: 'ustunkiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'E', width: 60, sortable: true,  dataIndex: 'ustunerkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'K', width: 60, sortable: true,  dataIndex: 'gormekiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'E', width: 60, sortable: true,  dataIndex: 'gormeerkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'K', width: 60, sortable: true,  dataIndex: 'ozgulkiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'E', width: 60, sortable: true,  dataIndex: 'ozgulerkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'K', width: 60, sortable: true,  dataIndex: 'isitmekiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'E', width: 60, sortable: true,  dataIndex: 'isitmeerkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'K', width: 60, sortable: true,  dataIndex: 'ortopedikiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'E', width: 60, sortable: true,  dataIndex: 'ortopedierkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'K', width: 60, sortable: true,  dataIndex: 'konusmakiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'E', width: 60, sortable: true,  dataIndex: 'konusmaerkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'K', width: 60, sortable: true,  dataIndex: 'spastikkiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'E', width: 60, sortable: true,  dataIndex: 'spastikerkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'K', width: 60, sortable: true,  dataIndex: 'otistikkiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'E', width: 60, sortable: true,  dataIndex: 'otistikerkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'K', width: 60, sortable: true,  dataIndex: 'birdenfazlakiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
              {header: 'E', width: 60, sortable: true,  dataIndex: 'birdenfazlaerkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})}
        ],
        
 				rows: [
          [
						{},
						{header: 'YETERSÝZLÝK ALANLARI', colspan:22, align: 'center'},						
          ],[
						{},
						{header: 'Zihinsel Engelliler', colspan:2, align: 'center'},						
						{header: 'DEHB', colspan:2, align: 'center'},						
						{header: 'Üstün Yetenekli', colspan:2, align: 'center'},						
						{header: 'Görme Engelli', colspan:2, align: 'center'},						
						{header: 'Özgül Öðrenme Güçlüðü', colspan:2, align: 'center'},						
						{header: 'Ýþitme Engelli', colspan:2, align: 'center'},						
						{header: 'Ortopedik Engelli', colspan:2, align: 'center'},						
						{header: 'Konuþma Engelli', colspan:2, align: 'center'},						
						{header: 'Spastik Engelli', colspan:2, align: 'center'},						
						{header: 'Otistik', colspan:2, align: 'center'},						
						{header: 'Birden fazla engeli olan', colspan:2, align: 'center'}
					]
				]
        }),
        stripeRows: true,
        height:yukseklik-20,
        width:genislik-5,
        clicksToEdit:1,
        enableColumnMove: false,
        viewConfig: {
            forceFit: true
        },
        plugins: [new Ext.ux.plugins.GroupHeaderGrid()],        
        title:'Kaynaþtýrma Eðitimi:',
        tbar: [{          
            text: 'Kaydet',
            iconCls:'save',
            handler : function(){
                                       //alert('ya Âlîm Allah');
                                  
                                  //alert( grid.getStore().getAt(1).get('etkinlikkonusu'));
                                  //alert(grid.getStore().getCount());
                                  //GRID ÝÇÝN KAYIT:
                                  var satir=0;
                                  
                                  var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `siniflar`, `zihinkiz`, `zihinerkek`, `dehbkiz`, `dehberkek`, `ustunkiz`, `ustunerkek`, `gormekiz`, `gormeerkek`, `ozgulkiz`, `ozgulerkek`, `isitmekiz`, `isitmeerkek`, `ortopedikiz`, `ortopedierkek`, `konusmakiz`, `konusmaerkek`, `spastikkiz`, `spastikerkek`, `otistikkiz`, `otistikerkek`, `birdenfazlakiz`, `birdenfazlaerkek`) VALUES';
                                  
                                  var sqlgovde="";
                                  while (satir< grid.getStore().getCount()){
                                        var gridsatir=grid.getStore().getAt(satir);
                                        var ekleneceksatir="("+kurumkodu+",'"+ 
                                        gridsatir.get('siniflar')+"','"+ 
                                        gridsatir.get('zihinkiz')	+"','"+
                                        gridsatir.get('zihinerkek')	+"','"+
                                        gridsatir.get('dehbkiz')	+"','"+
                                        gridsatir.get('dehberkek')	+"','"+
                                        gridsatir.get('ustunkiz')	+"','"+
                                        gridsatir.get('ustunerkek')	+"','"+
                                        gridsatir.get('gormekiz')	+"','"+
                                        gridsatir.get('gormeerkek')	+"','"+
                                        gridsatir.get('ozgulkiz')	+"','"+
                                        gridsatir.get('ozgulerkek')	+"','"+
                                        gridsatir.get('isitmekiz')	+"','"+
                                        gridsatir.get('isitmeerkek')	+"','"+
                                        gridsatir.get('ortopedikiz')	+"','"+
                                        gridsatir.get('ortopedierkek')	+"','"+
                                        gridsatir.get('konusmakiz')	+"','"+
                                        gridsatir.get('konusmaerkek')	+"','"+
                                        gridsatir.get('spastikkiz')	+"','"+
                                        gridsatir.get('spastikerkek')	+"','"+
                                        gridsatir.get('otistikkiz')	+"','"+
                                        gridsatir.get('otistikerkek')	+"','"+
                                        gridsatir.get('birdenfazlakiz')	+"','"+
                                        gridsatir.get('birdenfazlaerkek')	+"'),\n";
                                        
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
                                    
                                   
                                           
                              }
            
       },{
         text : 'Ana sayfa',
         iconCls : 'klasor',
         handler : function (){
                 window.parent.tabs2.activate('0');

        }

      }]
    });
    

 
 
 
});
   