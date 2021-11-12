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


    var konu = Ext.data.Record.create([
           // the "name" below matches the tag name to read, except "availDate"
           // which is mapped to the tag "availability"
		   {name: 'yonlendirilenokul'},
		   {name: 'ogrencisayisikiz', type: 'float'},
		   {name: 'ogrencisayisierkek', type: 'float'},
		   {name: 'ogrencisayisitoplam', type: 'float'},
		   {name: 'okultipi'}
           
      ]);


    // create the data store
var reader = new Ext.data.ArrayReader({}, [
       {name: 'yonlendirilenokul'},
       {name: 'ogrencisayisikiz', type: 'float'},
       {name: 'ogrencisayisierkek', type: 'float'},
       {name: 'ogrencisayisitoplam', type: 'float'},
       {name: 'okultipi'}
    ]);
//    store.loadData(myData);
    /*{name: 'lastChange', type: 'date', dateFormat: 'n/j h:ia'
renderer: 'usMoney'
/*renderer: Ext.util.Format.dateRenderer('m/d/Y'),*/
/*renderer: pctChange,*/ 
/*renderer: change,*/
var duzenleyici=new Ext.form.TextField({ allowBlank: true});
var oncekideger="";
var modullericinokultipi='Mesleki ve teknik Eðitimde Modüller Arasý Geçiþler (Yatay Geçiþler)';
           
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
        store:
         new Ext.data.GroupingStore({
            reader: reader,
            data: myData,
            remoteGroup:true,
            remoteSort: true, 
            sortInfo:{field: 'okultipi', direction: "DESC"},
            groupField:'okultipi'
        }), //Yâ Âlîm Yâ Allah.
		colModel: new Ext.grid.ColumnModel({
        columns: [
            {id:'yonlendirilenokul',header: " ", width: 50, sortable: false, dataIndex: 'yonlendirilenokul', editor: duzenleyici},
            {header: "Kýz Öðrenci", width: 10, sortable: false,  dataIndex: 'ogrencisayisikiz',editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Erkek öðrenci", width: 10, sortable: false,  dataIndex: 'ogrencisayisierkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Toplam Öðrenci", width: 10, sortable: false, dataIndex: 'ogrencisayisitoplam'},
            {header: "okultipi", width: 20, hidden:true, sortable: true, dataIndex: 'okultipi'}
        ]}),

        view: new Ext.grid.GroupingView({
            forceFit:true,
            //groupTextTpl: '{text} ({[values.rs.length]} {[values.rs.length > 1 ? "Items" : "Item"]})'
            groupTextTpl: '{[ values.rs[0].data["okultipi"] ]}'
        }),
        renderTo: 'grid-bolgesi',
        sm: sm,        
        stripeRows: true,       
        height:yukseklik-20,
        width:genislik-20,
        clicksToEdit:1,
        enableColumnMove: false,
			viewConfig: {
				forceFit: true
			},		
		listeners: {			
			beforeedit: function(object){
			  var gridsatir=grid.getStore().getAt(object.row);
			  var grubu=gridsatir.get("okultipi");
			  //sadece yeni eklenen satýr baþlýklarýnýn deðiþtirilmesini engellemek için önce deðiþkene atýyoruz:
			  if (grubu!=modullericinokultipi){
				
				oncekideger=gridsatir.get('yonlendirilenokul');
				
			  }
			},
			afteredit : function(object) {
			  
              //satirtoplam:
              var gridsatir=grid.getStore().getAt(object.row);
              
              
			  
              //alert(gridsatir);
              var tsonuc=gridsatir.get('ogrencisayisikiz')+
              gridsatir.get('ogrencisayisierkek');              
              gridsatir.set('ogrencisayisitoplam',tsonuc);
                            
              var grubu=gridsatir.get("okultipi");
			  ////sadece yeni eklenen satýr baþlýklarýnýn deðiþtirilmesini engellemek için deðiþkendeki bilgiyi geri atýyoruz:
			  if (grubu!=modullericinokultipi){
				gridsatir.set('yonlendirilenokul',oncekideger);
				
			  }
			  grid.getStore().commitChanges(); 
			}
        }, 
        title:'Mesleki Rehberlik ve Yöneltme Hizmetleri',
             
           tbar: [{
           
            text: 'Devam-Geçiþ Modül adý ekle',           
            iconCls:'add', 
            tooltip: 'Ekleme iþlemini sadece mesleki ve teknik eðitim kurumlarý Devam edilen veya geçiþ yapýlan modüller için yapmalýdýr',           
            handler : function(){
                var kon= new konu({
                
                    yonlendirilenokul: '',                    
                    ogrencisayisikiz:0,
                    ogrencisayisierkek:0,
                    ogrencisayisitoplam:0,
                    okultipi: modullericinokultipi                    
                    
                });
                
                //alert(grid.getColumnModel().columns[0].dataIndex);
                
                grid.stopEditing();
                grid.store.insert(0, kon);
                grid.startEditing(0, 0);
                grid.getSelectionModel().selectFirstRow();
            }
        },{
            text: 'Modül adý sil',
            iconCls:'remove',
            tooltip: 'Silme iþlemini sadece mesleki ve teknik eðitim kurumlarý Devam edilen veya geçiþ yapýlan modüller için yapmalýdýr',           
            handler : function(){
          //  alert('ya Âlîm Allah');
          // grid.getSelectionModel().selectRow(0);
            var record = grid.getSelectionModel().getSelected();
          
            if (record !== undefined && record.get('okultipi')==modullericinokultipi) {
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

                                var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `yonlendirilenokul`, `kiz`, `erkek`, `toplam`, `grubu`) VALUES';
                                  
                                var sqlgovde="";
                                while (satir< grid.getStore().getCount()){
									  var gridsatir=grid.getStore().getAt(satir);
									  var ekleneceksatir="("+kurumkodu+",'"+ 
									  tem(gridsatir.get('yonlendirilenokul'))+"','"+ 									  
									  gridsatir.get('ogrencisayisikiz')+"','"+ 
									  gridsatir.get('ogrencisayisierkek')+"','"+ 
									  gridsatir.get('ogrencisayisitoplam')+"','"+ 
									  gridsatir.get('okultipi')+"'),\n";
									  
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

//grid.startEditing(0, 0);
grid.getSelectionModel().selectFirstRow();
 
 
});
   