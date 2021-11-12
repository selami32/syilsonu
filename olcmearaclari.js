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

    var konu = Ext.data.Record.create([
           // the "name" below matches the tag name to read, except "availDate"
           // which is mapped to the tag "availability"
           {name: 'olcmearaci'},
           {name: 'subesayisi',type: 'float'},
           {name: 'kiz', type: 'float'},
           {name: 'erkek', type: 'float'},
           {name: 'toplam', type: 'float'}
           
      ]);


    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'olcmearaci'},
           {name: 'subesayisi',type: 'float'},
           {name: 'kiz', type: 'float'},
           {name: 'erkek', type: 'float'},
           {name: 'toplam', type: 'float'}           
        ]
    });
    store.loadData(myData);
    /*{name: 'lastChange', type: 'date', dateFormat: 'n/j h:ia'
renderer: 'usMoney'
/*renderer: Ext.util.Format.dateRenderer('m/d/Y'),*/
/*renderer: pctChange,*/ 
/*renderer: change,*/


var olcmecombo=new CustomComboBox({typeAhead: true, autocomplete: true, editable:true, triggerAction: 'all',transform:'olcmecombo',lazyRender:true,listClass: 'x-combo-list-small'}) ;
           
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
            {header: "Uygulanan Ölçme Aracý", id:'olcmearaci', width: 320, sortable: true, dataIndex: 'olcmearaci', editor: olcmecombo},
            {header: "Þube sayýsý", width: 65, sortable: true,  dataIndex: 'subesayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Kýz", width: 65, sortable: true,  dataIndex: 'kiz', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Erkek", width: 65, sortable: true, dataIndex: 'erkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Toplam", width: 65, sortable: true, dataIndex: 'toplam'}
        ],
 				rows: [
					[
						{},
						{},
						
						{header: 'Uygulama Sayýsý', colspan: 3, align: 'center'},						
					]
				]
			}),
        stripeRows: true,
       // autoExpandColumn: 'etkinlikturu',
        height:yukseklik-50,
        width:genislik-20,
        clicksToEdit:1,
        enableColumnMove: false,
			viewConfig: {
				forceFit: true
			},
		plugins: [new Ext.ux.plugins.GroupHeaderGrid()],        
		listeners: {
			afteredit : function(object) {
              //satirtoplam:
              var gridsatir=grid.getStore().getAt(object.row);
              //alert(gridsatir);
              var tsonuc=gridsatir.get('kiz')+
              gridsatir.get('erkek');              
              gridsatir.set('toplam',tsonuc);
              grid.getStore().commitChanges(); 
			}
        }, 
        title:'Rehberlik Ve Psikolojik Danýþma Hizmetleri Amacýyla Kullanýlan Ölçme Araçlarý',
             
           tbar: [{
           
            text: 'Ölçme Aracý Ekle',           
            iconCls:'add',            
            handler : function(){
                var kon= new konu({
                
                    olcmearaci: '',
                    subesayisi:0,
                    kiz:0,
                    erkek:0,
                    toplam:0                    
                    
                });
                grid.stopEditing();
                store.insert(0, kon);
                grid.startEditing(0, 0);
                grid.getSelectionModel().selectFirstRow();
            }
        },{
            text: 'Ölçme Aracý Sil',
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
                                  //GRID ÝÇÝN KAYIT:
                                var satir=0;
                                if (grid.getStore().getCount()==0) return;

                                var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `okulturu`, `olcmearaci`, `subesayisi`, `kiz`, `erkek`, `toplam`) VALUES';
                                  
                                var sqlgovde="";
                                var eklendisatir=false;
                                while (satir< grid.getStore().getCount()){
									  var gridsatir=grid.getStore().getAt(satir);
									  if (gridsatir.get('subesayisi')!=0) {
									  
                          var ekleneceksatir="("+kurumkodu+",'"+
                          okulturu +"','"+  
                          tem(gridsatir.get('olcmearaci'))+"','"+ 
                          gridsatir.get('subesayisi')+"','"+
                          gridsatir.get('kiz')+"','"+ 
                          gridsatir.get('erkek')+"','"+ 
                          gridsatir.get('toplam')+"'),\n";
                          
                          sqlgovde=sqlgovde+ekleneceksatir;
                          var eklendisatir=true;
									  }
									  satir++;
                                }
                                if (eklendisatir==false) return;
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
   