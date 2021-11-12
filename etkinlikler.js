/*
 * Ext JS Library 2.2
 * Copyright(c) 2006-2008, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 */
/*
CREATE TABLE IF NOT EXISTS `etkinlikler` (
`sn` INT NOT NULL AUTO_INCREMENT,
`kurumkodu` INT NOT NULL ,
`etkinlikturu` TEXT NULL , 
`etkinlikkonusu` TEXT NULL ,
`etkinliksayisi` TEXT NULL , 
`etkinlikkatogretmen` TEXT NULL ,
`etkinlikkatogrenci` TEXT NULL , 
`etkinlikkatveli` TEXT NULL , 
`etkinlikkatdiger` TEXT NULL , 
`etkinlikkattoplam` TEXT NULL ,
UNIQUE (
`sn`, `kurumkodu` 
)
) ENGINE = MYISAM DEFAULT CHARSET=latin5;*/
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
           {name: 'etkinlikturu'},
           {name: 'etkinlikkonusu'},
           {name: 'etkinliksayisi', type: 'float'},
           {name: 'etkinlikkatogretmen', type: 'float'},
           {name: 'etkinlikkatogrenci', type: 'float'},
           {name: 'etkinlikkatveli', type: 'float'},
           {name: 'etkinlikkatdiger', type: 'float'},
           {name: 'etkinlikkattoplam', type: 'float'}    
      ]);


    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'etkinlikturu'},
           {name: 'etkinlikkonusu'},
           {name: 'etkinliksayisi', type: 'float'},
           {name: 'etkinlikkatogretmen', type: 'float'},
           {name: 'etkinlikkatogrenci', type: 'float'},
           {name: 'etkinlikkatveli', type: 'float'},
           {name: 'etkinlikkatdiger', type: 'float'},
           {name: 'etkinlikkattoplam', type: 'float'}           
           
        ]
    });
    store.loadData(myData);
    /*{name: 'lastChange', type: 'date', dateFormat: 'n/j h:ia'
renderer: 'usMoney'
/*renderer: Ext.util.Format.dateRenderer('m/d/Y'),*/
/*renderer: pctChange,*/ 
/*renderer: change,*/


var editcombo=new Ext.form.ComboBox({typeAhead: true, autocomplete: true, editable:false, triggerAction: 'all',transform:'etkinlikturucombo',lazyRender:true,listClass: 'x-combo-list-small'}) ;

var etkinlikcombo=new Ext.form.ComboBox({typeAhead: true, autocomplete: true, editable:true, triggerAction: 'all',transform:'etkinlikcombo',lazyRender:true,listClass: 'x-combo-list-small'}) ;
           
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
            {header: "Etkinlik Türü", id:'etkinlikturu', header: " ", width: 90, sortable: true, dataIndex: 'etkinlikturu', editor: editcombo},
            {header: "Etkinlik Konusu", width: 210, sortable: true,  dataIndex: 'etkinlikkonusu', editor: etkinlikcombo},
            {header: "Etkinlik Sayýsý", width: 85, sortable: true,  dataIndex: 'etkinliksayisi', editor:  new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Katýlan öðretmen", width: 90, sortable: true, dataIndex: 'etkinlikkatogretmen', editor:  new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Katýlan Öðrenci", width: 85, sortable: true, dataIndex: 'etkinlikkatogrenci', editor:  new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Katýlan veli", width:65, sortable: true, dataIndex: 'etkinlikkatveli', editor:  new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Katýlan Diðer", width:75, sortable: true, dataIndex: 'etkinlikkatdiger', editor:   new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Toplam", width:55, sortable:false, dataIndex: 'etkinlikkattoplam',  name: 'etkinlikkattoplam' }
        ],
 
        stripeRows: true,
       // autoExpandColumn: 'etkinlikturu',
        height:yukseklik-30,
        width:genislik-20,
        clicksToEdit:1,
        
        title:'Rehberlik Servisince Düzenlenlenen Etkinlikler',
        listeners: {
          afteredit : function(object) {
              //alert(object.column);
              var gridsatir=grid.getStore().getAt(object.row);
              var tsonuc=
              gridsatir.get('etkinlikkatogretmen')+
              gridsatir.get('etkinlikkatogrenci')+
              gridsatir.get('etkinlikkatveli')+
              gridsatir.get('etkinlikkatdiger');
              
              gridsatir.set('etkinlikkattoplam',tsonuc);
              grid.getStore().commitChanges();
          }
          },  
           tbar: [{
            text: 'Etkinlik Ekle',           
            iconCls:'add',            
            handler : function(){
                var etk= new etkinlik({
                
                    etkinlikturu: 'Konferans',
                    etkinlikkonusu: '',
                    etkinliksayisi:0,
                    etkinlikkatogretmen:0,
                    etkinlikkatogrenci:0,
                    etkinlikkatveli:0,
                    etkinlikkatdiger:0,
                    etkinlikkattoplam: 0
                    
                });
                grid.stopEditing();
                store.insert(0, etk);
                grid.startEditing(0, 0);
                grid.getSelectionModel().selectFirstRow();
            }
        },
        {
            text: 'Etkinlik Sil',
            iconCls:'remove',
            handler : function(){
          //  alert('ya Âlîm Allah');
          // grid.getSelectionModel().selectRow(0);
            var record = grid.getSelectionModel().getSelected();
            if (record !== undefined) {
            grid.store.remove(record); }
            }     	
            
        },
        {
            text: 'Kaydet',
            iconCls:'save',
            handler : function(){
                                       //alert('ya Âlîm Allah');
                                  
                                  //alert( grid.getStore().getAt(1).get('etkinlikkonusu'));
                                  //alert(grid.getStore().getCount());
                                  
                                  var satir=0;
                                  if (grid.getStore().getCount()==0) return;
                                  var sqlbaslangic='INSERT INTO `'+tablo+'`(`kurumkodu`, `etkinlikturu`, `etkinlikkonusu`, `etkinliksayisi`, `etkinlikkatogretmen`, `etkinlikkatogrenci`, `etkinlikkatveli`,`etkinlikkatdiger`, `etkinlikkattoplam`) VALUES';
                                  
                                  var sqlgovde="";
                                  while (satir< grid.getStore().getCount())
                                  {
                                  var gridsatir=grid.getStore().getAt(satir);
                                  var ekleneceksatir="("+kurumkodu+",'"+ 
                                  gridsatir.get('etkinlikturu')+"','"+ 
                                  tem(gridsatir.get('etkinlikkonusu'))+"','"+
                                  gridsatir.get('etkinliksayisi')+"','"+ 
                                  gridsatir.get('etkinlikkatogretmen')+"','"+ 
                                  gridsatir.get('etkinlikkatogrenci')+"','"+ 
                                  gridsatir.get('etkinlikkatveli')+"','"+ 
                                  gridsatir.get('etkinlikkatdiger')+"','"+ 
                                  gridsatir.get('etkinlikkattoplam')+"'),\n";
                                  
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

    grid.getSelectionModel().selectFirstRow();
 
});
   