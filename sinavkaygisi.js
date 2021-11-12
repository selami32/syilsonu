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

    // NOTE: This is an example showing simple state management. During development,
    // it is generally best to disable state management as dynamically-generated ids
    // can change across page loads, leading to unpredictable results.  The developer
    // should ensure that stable state ids are set for stateful components in real apps.
   // Ext.state.Manager.setProvider(new Ext.state.CookieProvider());


  Ext.grid.GroupSummary.Calculations['toplam'] = function(v, record, field){
        return record.data.etkinlikkatveli + record.data.etkinlikkatdiger;
    }

    var summary = new Ext.grid.GroupSummary(); 

    // example of custom renderer function
    function ichange(val){
                if (isNaN(val)) val=0;
                return val;
    }
    function change(val){
        if(val > 0){
            return '<span style="color:green;">' + val + '</span>';
        }else if(val < 0){
            return '<span style="color:red;">' + val + '</span>';
        }
        return val;
    }

    // example of custom renderer function
    function pctChange(val){
        if(val > 0){
            return '<span style="color:green;">' + val + '%</span>';
        }else if(val < 0){
            return '<span style="color:red;">' + val + '%</span>';
        }
        return val;
    }


    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'calismakonusu'},
           {name: 'ogrencisayisi', type: 'float'},
           {name: 'ogretmensayisi', type: 'float'},
           {name: 'ailesayisi', type: 'float'},
           {name: 'mahallibasin', type: 'float'}
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
    
    var grid = new Ext.grid.EditorGridPanel({
        store: store,
        renderTo: 'grid-bolgesi',
        sm: sm,
         columns: [
            {id:'calismakonusu', header: "Yap�lan Bilgilendirme �al��malar�n�n Konusu", width: 290, dataIndex: 'calismakonusu' },
            {header: "��renci say�s�", width: 70, sortable: false,  dataIndex: 'ogrencisayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "��retmen say�s�", width:70, sortable: false,  dataIndex: 'ogretmensayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
        {header: "Aile say�s�", width:70, sortable: false,  dataIndex: 'ailesayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
        {header: "Mahalli bas�n", width:70, sortable: false,  dataIndex: 'mahallibasin', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})}
        ],
        stripeRows: true,
       // autoExpandColumn: 'etkinlikturu',
        height:300,
        width:600,
        clicksToEdit:1,        
        title:'S�navlar ve S�nav Kayg�s�na Y�nelik �al��malar:',
        tbar: [{        
            text: 'Kaydet',
            iconCls:'save',
            handler : function(){
                                       //alert('ya �l�m Allah');
                                  
                                  //alert( grid.getStore().getAt(1).get('etkinlikkonusu'));
                                  //alert(grid.getStore().getCount());
                                  
                                  var satir=0;
                                  
                                  var sqlbaslangic='INSERT INTO '+tablo+' (`kurumkodu`, `okulunadi`, `ilcesi`, `okulturu`, `sinavlarhkbilgiverilenilkogretimogrencisayisi`, `sinavlarhkbilgiverilenilkogretimogretmensayisi`, `sinavlarhkbilgiverilenilkogretimailesayisi`, `sinavlarhkbilgiverilenilkogretimmahallibasin`, `ustogretimhkbilgiverilenilkogretimogrencisayisi`, `ustogretimhkbilgiverilenilkogretimogretmensayisi`, `ustogretimhkbilgiverilenilkogretimailesayisi`, `ustogretimhkbilgiverilenilkogretimmahallibasin`, `sinavkaygisibilgiverilenilkogretimogrencisayisi`, `sinavkaygisibilgiverilenilkogretimogretmensayisi`, `sinavkaygisibilgiverilenilkogretimailesayisi`, `sinavkaygisibilgiverilenilkogretimmahallibasin`) VALUES';
                                  
                                  var sqlgovde="";
                                  var ekleneceksatirorta="";
                                  var ekleneceksatirbas="("+kurumkodu+",'"+okulunadi+"','"+ilcesi+"','"+okulturu+"','";
                                  while (satir< grid.getStore().getCount())
                                  {
                                  var gridsatir=grid.getStore().getAt(satir);
                                  var ekleneceksatirorta=ekleneceksatirorta+ 
                                  gridsatir.get('ogrencisayisi')+"','"+ 
                                  gridsatir.get('ogretmensayisi')+"','"+ 
                                  gridsatir.get('ailesayisi')+"','"+ 
                                  gridsatir.get('mahallibasin')+"','";
                                  
                                  satir++;
                                  }
                                  
                                  ekleneceksatirson=ekleneceksatirbas+ekleneceksatirorta;
                                  
                                  sqlgovde=ekleneceksatirson;

                                  
                                  sqlgovde=sqlbaslangic+sqlgovde.substr(0,sqlgovde.length-2)+");";
                                  
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
   