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

              grid.getStore().commitChanges();
              }
        },
        stripeRows: true,
        height:yukseklik-500,
        width:genislik-20,
        clicksToEdit:1,
        enableColumnMove: false,
        viewConfig: {
            forceFit: true
        },
        plugins: [new Ext.ux.plugins.GroupHeaderGrid()],        
        title:'OKUL TOPLAM ÖÐRENCÝ SAYILARI',
        tbar: [{          
            text: 'Kaydet',
            tooltip: '',
            iconCls:'save',
            handler : function(){
                                       //alert('ya Âlîm Allah');
                                  
                                  //alert( grid.getStore().getAt(1).get('etkinlikkonusu'));
                                  //alert(grid.getStore().getCount());
                                  //GRID ÝÇÝN KAYIT:
                                  var satir=0;
                                  
                                  var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `okulturu`, `subesayisisinif4`, `subesayisisinif6`, `subesayisisinif9`, `kizsinif4`, `erkeksinif4`, `kizsinif6`, `erkeksinif6`, `kizsinif9`, `erkeksinif9`, `kiztoplam`, `erkektoplam`) VALUES';
                                  
                                  var sqlgovde="";
                                  while (satir< grid.getStore().getCount()){
                                        var gridsatir=grid.getStore().getAt(satir);
                                        var ekleneceksatir="("+kurumkodu+",'"+ 
                                        okulturu+"','"+                                        
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
   