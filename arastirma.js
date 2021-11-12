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

 
    var konu = Ext.data.Record.create([
           // the "name" below matches the tag name to read, except "availDate"
           // which is mapped to the tag "availability"
           {name: 'arastirmalar'},
           {name: 'projeler'},           
           {name: 'yayinlar'}           
      ]);


    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'arastirmalar'},
           {name: 'projeler'},           
           {name: 'yayinlar'}           
           
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
//    if (!yukseklik) yukseklik=600;
//    if (!genislik) genislik=850;
   
    var grid = new Ext.grid.EditorGridPanel({
        store: store,
        renderTo: 'grid-bolgesi',
        sm: sm,
        columns: [
            {header: "Araþtýrmalar", width: 250, sortable: true, dataIndex: 'arastirmalar', editor: new Ext.form.TextField({ allowBlank: true })},
            {header: "Projeler", width: 250, sortable: true,  dataIndex: 'projeler', editor: new Ext.form.TextField({ allowBlank: true })},
            {header: "Yayýnlar", width: 250, sortable: true,  dataIndex: 'yayinlar', editor: new Ext.form.TextField({ allowBlank: true })}
        ],
        stripeRows: true,
        height:yukseklik-30,
        width:genislik-20,
        clicksToEdit:1,
        title:' Rehberlik ve Psikolojik Danýþma Hizmetleri Servisi Tarafýndan Gerçekleþtirilen:',
        tbar: [{
            text: 'Konu Ekle',           
            iconCls:'add',            
            handler : function(){
                var knu= new konu({
                
                    arastirmalar: '',
                    projeler: '',
                    yayinlar: ''                    
                    
                });
                grid.stopEditing();
                store.insert(0, knu);
                grid.startEditing(0, 0);
                grid.getSelectionModel().selectFirstRow();
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
            
        },{
            text: 'Kaydet',
            iconCls:'save',
            handler : function(){
                                       //alert('ya Âlîm Allah');
                                  
                                  //alert( grid.getStore().getAt(1).get('etkinlikkonusu'));
                                  //alert(grid.getStore().getCount());
                                  // güvenlik denen birþey yok:)
                                  var satir=0;
                                  if (grid.getStore().getCount()==0) return;
                                  var sqlbaslangic='INSERT INTO `'+tablo+'`(`kurumkodu`, `arastirmalar`, `projeler`, `yayinlar`) VALUES';
                                  
                                  var sqlgovde="";
                                  while (satir< grid.getStore().getCount())
                                  {
                                        var gridsatir=grid.getStore().getAt(satir);
                                        var ekleneceksatir="("+kurumkodu+",'"+ 
                                        tem(gridsatir.get('arastirmalar'))+"','"+ 
                                        tem(gridsatir.get('projeler'))+"','"+ 
                                        tem(gridsatir.get('yayinlar'))+"'),\n";
                                        
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

   
});
   