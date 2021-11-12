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
/*
    var konu = Ext.data.Record.create([
           // the "name" below matches the tag name to read, except "availDate"
           // which is mapped to the tag "availability"
           {name: 'riskverisi'},
           {name: 'kiz',type: 'float'},
           {name: 'erkek', type: 'float'},
           {name: 'kizoran', type: 'float'},
           {name: 'erkekoran', type: 'float'},
           {name: 'okultoplam', type: 'float'},
           {name: 'okuloran', type: 'float'}

		   ]);

*/
    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'programicerigimadde'},
           {name: 'cokyararli',type: 'float'},
           {name: 'yararli', type: 'float'},
           {name: 'yararliolmadi', type: 'float'},
           {name: 'hicyararliolmadi', type: 'float'},
           {name: 'toplam', type: 'float'}
           
        ]
    });
    store.loadData(myData);
    /*{name: 'lastChange', type: 'date', dateFormat: 'n/j h:ia'
renderer: 'usMoney'
/*renderer: Ext.util.Format.dateRenderer('m/d/Y'),*/
/*renderer: pctChange,*/ 
/*renderer: change,*/

var sayieditor=new Ext.form.NumberField({
allowBlank: false,allowNegative: false, selectOnFocus:true, 
maxValue: 100000,
listeners: {
			'keyup' : function(object) {
			alert(object.row);
			
              //satirtoplam:
			  var okulsatir=grid.getStore().getAt(0);
			  var okultoplam=okulsatir.get('okultoplam');
			  
              var gridsatir=grid.getStore().getAt(object.row);
              //alert(gridsatir);
              var tsonuc=gridsatir.get('kiz')+gridsatir.get('erkek');  
			  
			  if(okultoplam > 0){
				  var kizoran=gridsatir.get('kiz') / okultoplam * 100;
				  var erkekoran=gridsatir.get('erkek') / okultoplam * 100;
				  var okuloran=gridsatir.get('okultoplam') / okultoplam * 100;
				  gridsatir.set('kizoran', kizoran);
				  gridsatir.set('erkekoran', erkekoran);
				  gridsatir.set('okuloran', okuloran);
				   grid.getStore().commitChanges(); 
			  }
			 
              gridsatir.set('okultoplam',tsonuc);
              grid.getStore().commitChanges(); 
			}
        }

})



           
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
		plugins: [new Ext.ux.plugins.GroupHeaderGrid()],   
        colModel: new Ext.grid.ColumnModel({
         columns: [
            {header: "Program Ýçeriðinde Yer Verilen Bilgiler", id:'programicerigimadde', width: 320, sortable: false, dataIndex: 'programicerigimadde'},
            {header: "Çok Yararlý Oldu", width: 45, sortable: false,  dataIndex: 'cokyararli',  editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Yararlý Oldu", width: 45, sortable: false,  dataIndex: 'yararli', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Yararlý olmadý", width: 45, sortable: false, dataIndex: 'yararliolmadi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Hiç Yararlý olmadý", width: 45, sortable: false, dataIndex: 'hicyararliolmadi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
			{header: "Toplam", width: 45, sortable: false, dataIndex: 'toplam'}
			
			],
			rows: [
					[
						{},							
						{header: 'Ýþaretlenen Maddelerin Toplam Sayýsý', colspan: 4, align: 'center'},
						{},	
						
					]
				]
			}),
        stripeRows: true,
       // autoExpandColumn: 'etkinlikturu',
        height:yukseklik-80,
        width:genislik-20,
        clicksToEdit:1,
        enableColumnMove: false,
			viewConfig: {
				forceFit: true
			},
		     
		listeners: {
		
               
			afteredit : function(object) {
			// otomatik topla:
			var gridsatir=grid.getStore().getAt(object.row);
			var tsonuc=gridsatir.get('cokyararli')+gridsatir.get('yararli')+gridsatir.get('yararliolmadi')+gridsatir.get('hicyararliolmadi');  
					  gridsatir.set('toplam',tsonuc);
					  grid.getStore().commitChanges();
             
			}
        }, 
        title:'Riskler ve Baþetme Becerileri Okul Projesi Aile Eðitimi Programý  Deðerlendirme Sonuçlarý Tablosu (Eðitimler tamamlandýktan sonra aþaðýdaki tabloya Ailelere uygulanan Deðerlendirme Formlarýndan (Ek-3) elde edilen sayýsal verilerin toplamý girilecektir. )',
             
           tbar: [{
           
      
            text: 'Kaydet',
            
            iconCls:'save',
            handler : function(){
                                       //alert('ya Âlîm Allah');
                                  
                                  //alert( grid.getStore().getAt(1).get('etkinlikkonusu'));
                                  //alert(grid.getStore().getCount());
                                  //GRID ÝÇÝN KAYIT:
                                var satir=0;
                                if (grid.getStore().getCount()==0) return;

                                var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `programicerigimadde`, `cokyararli`, `yararli`, `yararliolmadi`, `hicyararliolmadi`, `toplam`, `okulturu`) VALUES';
                                  
                                var sqlgovde="";
                                var eklendisatir=false;
                                while (satir< grid.getStore().getCount()){
									  var gridsatir=grid.getStore().getAt(satir);
									  //if (parseInt(gridsatir.get('okuloran'))!=0)  {
									  
                          var ekleneceksatir="("+kurumkodu+",'"+                          
                         tem(gridsatir.get('programicerigimadde'))+"','"+ 
                         gridsatir.get('cokyararli')+"','"+ 
                         gridsatir.get('yararli')+"','"+ 
                         gridsatir.get('yararliolmadi')+"','"+ 
                         gridsatir.get('hicyararliolmadi')+"','"+
					gridsatir.get('toplam')+"','"+					
                          okulturu+"'),\n";
                          
                          sqlgovde=sqlgovde+ekleneceksatir;
                          var eklendisatir=true;
									 // }
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
   