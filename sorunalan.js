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

    var etkinlik = Ext.data.Record.create([
           // the "name" below matches the tag name to read, except "availDate"
           // which is mapped to the tag "availability"
           {name: 'aciklama'},
           {name: 'kizogrencisayisi', type: 'float'},
           {name: 'erkekogrencisayisi', type: 'float'},
           {name: 'toplam', type: 'float'},
      ]);


    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'aciklama'},
           {name: 'kizogrencisayisi', type: 'float'},
           {name: 'erkekogrencisayisi', type: 'float'},
           {name: 'toplam', type: 'float'},
          
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
            {id:'aciklama', header: "��renci G�r��melerinin Sorun Alanlar�na G�re Da��l�m�", width: 290, dataIndex: 'aciklama' },
            {header: "K�z", width: 55, sortable: false,  dataIndex: 'kizogrencisayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Erkek", width:55, sortable: false,  dataIndex: 'erkekogrencisayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Toplam", width: 55, sortable: false, dataIndex: 'toplam'},
        ],
        stripeRows: true,
        height:250,
        width:550,
        clicksToEdit:1,        
        title:'Sorun Alanlar�n�n De�erlendirilmesi:',
        listeners: {
            afteredit : function(object) {
              //satirtoplam:
              var gridsatir=grid.getStore().getAt(object.row);
              var tsonuc=gridsatir.get('kizogrencisayisi')+
              gridsatir.get('erkekogrencisayisi');              
              gridsatir.set('toplam',tsonuc);
              grid.getStore().commitChanges();
              
 
              //s�tuntplam:
              //alert(object.column);
              var kiztoplam=0; var erkektoplam=0; var geneltoplam=0;
              toplamsatir=grid.getStore().getCount();
              for (i=0;i<toplamsatir-1;i++){
               kiztoplam=kiztoplam+grid.getStore().getAt(i).get('kizogrencisayisi');
               erkektoplam=erkektoplam+grid.getStore().getAt(i).get('erkekogrencisayisi');
               geneltoplam=geneltoplam+grid.getStore().getAt(i).get('toplam');
              }
              
              var gridsatir=grid.getStore().getAt(toplamsatir-1);
              gridsatir.set('kizogrencisayisi',kiztoplam);
              gridsatir.set('erkekogrencisayisi',erkektoplam);
              gridsatir.set('toplam',geneltoplam);
              //alert(geneltoplam);
              grid.getStore().commitChanges();
             
              
 

            }
        },  
        tbar: [{        
            text: 'Kaydet',
            iconCls:'save',
            handler : function(){
                                       //alert('ya �l�m Allah');
                                  
                                  //alert( grid.getStore().getAt(1).get('etkinlikkonusu'));
                                  //alert(grid.getStore().getCount());
                                  
                                  var satir=0;
                                  
                                  var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `okulunadi`, `ilcesi`, `okulturu`, `sagliksorunlarikiz`, `sagliksorunlarierkek`, `sagliksorunlaritoplam`, `okullailgilisorunlarkiz`, `okullailgilisorunlarerkek`, `okullailgilisorunlartoplam`, `aileilgilisorunlarkiz`, `aileilgilisorunlarerkek`, `aileilgilisorunlartoplam`, `kisiselsorunlarkiz`, `kisiselsorunlarerkek`, `kisiselsorunlartoplam`, `arkadasliksorunlarikiz`, `arkadasliksorunlarierkek`, `arkadasliksorunlaritoplam`, `sosyoekonomiksorunlarkiz`, `sosyoekonomiksorunlarerkek`, `sosyoekonomiksorunlartoplam`, `digerkiz`, `digererkek`, `digertoplam`, `kiztoplam`, `erkektoplam`, `geneltoplam`, `digeraciklama`) VALUES';
                                  
                                  var sqlgovde="";
                                  var ekleneceksatirorta="";
                                  var ekleneceksatirbas="("+kurumkodu+",'"+okulunadi+"','"+ilcesi+"','"+okulturu+"','";
                                  while (satir< grid.getStore().getCount())
                                  {
                                  var gridsatir=grid.getStore().getAt(satir);
                                  var ekleneceksatirorta=ekleneceksatirorta+ 
                                  gridsatir.get('kizogrencisayisi')+"','"+ 
                                  gridsatir.get('erkekogrencisayisi')+"','"+
                                  gridsatir.get('toplam')+"','";
                                  
                                  satir++;
                                  }
                                  
                                  ekleneceksatirson=ekleneceksatirbas+ekleneceksatirorta+"'),\n";
                                  
                                  sqlgovde=ekleneceksatirson;

                                  
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
   