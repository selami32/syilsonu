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

Ext.BLANK_IMAGE_URL = adres+'ext2/resources/images/default/s.gif';

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
           {name: 'konu'},
           {name: 'ilkogretimuyarma',type: 'float'},
           {name: 'ilkogretimkinama', type: 'float'},
           {name: 'ilkogretimokuldeg', type: 'float'},
           {name: 'ortaogretimmahrukinama', type: 'float'},
           {name: 'ortaogretimkisauzak', type: 'float'},
           {name: 'ortaogretimtasdikname', type: 'float'} ,   
           {name: 'ortaogretimorgunegitimdisi', type: 'float'}    
      ]);


    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'konu'},
           {name: 'ilkogretimuyarma', type: 'float'},
           {name: 'ilkogretimkinama', type: 'float'},
           {name: 'ilkogretimokuldeg', type: 'float'},
           {name: 'ortaogretimmahrukinama', type: 'float'},
           {name: 'ortaogretimkisauzak', type: 'float'},
           {name: 'ortaogretimtasdikname', type: 'float'} ,   
           {name: 'ortaogretimorgunegitimdisi', type: 'float'}    
           
        ]
    });
    store.loadData(myData);
    /*{name: 'lastChange', type: 'date', dateFormat: 'n/j h:ia'
renderer: 'usMoney'
/*renderer: Ext.util.Format.dateRenderer('m/d/Y'),*/
/*renderer: pctChange,*/ 
/*renderer: change,*/


var editcombo=new Ext.form.ComboBox({
typeAhead: true, 
autocomplete: true, 
editable:false, 
triggerAction: 'all',
transform:'davraniscombo',
lazyRender:true,
listClass: 'x-combo-list-small',
listeners:{
	beforeselect: function(combo, record, index){
		return ("" != record.data.value);
		//alert(record.data.value);
	}
	},
}) ;
           
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
            {header: "Konu", id:'konu', width: 320, sortable: true, dataIndex: 'konu', editor: editcombo},
            {header: "Uyarma", width: 65, sortable: true,  dataIndex: 'ilkogretimuyarma', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Kýnama", width: 65, sortable: true,  dataIndex: 'ilkogretimkinama', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Okul Deðiþtirme", width: 65, sortable: true, dataIndex: 'ilkogretimokuldeg', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Uyarma Mahrumiyet Kýnama", width: 65, sortable: true, dataIndex: 'ortaogretimmahrukinama', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Okuldan Kýsa Süreli Uzaklaþtýrma", width:65, sortable: true, dataIndex: 'ortaogretimkisauzak', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Okuldan Tasdikname ile Uzaklaþtýrma", width:75, sortable: true, dataIndex: 'ortaogretimtasdikname', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Örgün Eðitim Dýþýna Çýkarma", width:55, sortable:false, dataIndex: 'ortaogretimorgunegitimdisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})}
        ],
 				rows: [
					[
						{},
						{header: 'Verilen Cezalar', colspan: 7, align: 'center'}			
												
					], [
						{},
						{header: 'Ýlkokul-Ortaokul', colspan: 3, align: 'center'},
						{header: 'Lise', colspan: 4, align: 'center'}						
					]
				]
			}),
        stripeRows: true,
       // autoExpandColumn: 'etkinlikturu',
        height:yukseklik-30,
        width:genislik-20,
        clicksToEdit:1,
        enableColumnMove: false,
			viewConfig: {
				forceFit: true
			},
		plugins: [new Ext.ux.plugins.GroupHeaderGrid()],        
        title:'Disiplin Suçlarý',
             
           tbar: [{
            text: 'Konu Ekle',           
            iconCls:'add',            
            handler : function(){
                var kon= new konu({
                
                    konu: '',
                    ilkogretimuyarma:0,
                    ilkogretimkinama:0,
                    ilkogretimokuldeg:0,
                    ortaogretimmahrukinama:0,
                    ortaogretimkisauzak:0,
                    ortaogretimtasdikname:0,
                    ortaogretimorgunegitimdisi: 0
                    
                });
                grid.stopEditing();
                store.insert(0, kon);
                grid.startEditing(0, 0);
                grid.getSelectionModel().selectFirstRow();
            }
        },
        {
            text: 'Konu Sil',
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
                                  var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`,`okulturu`, `konu`, `ilkogretimuyarma`, `ilkogretimkinama`, `ilkogretimokuldeg`, `ortaogretimmahrukinama`, `ortaogretimkisauzak`, `ortaogretimtasdikname`, `ortaogretimorgunegitimdisi`) VALUES';
                                  
                                  var sqlgovde="";
                                  while (satir< grid.getStore().getCount())
                                  {
                                  var gridsatir=grid.getStore().getAt(satir);
                                  var ekleneceksatir="("+kurumkodu+",'"+ 
                                  okulturu+"','"+ 
                                  tem(gridsatir.get('konu'))+"','"+ 
                                  gridsatir.get('ilkogretimuyarma')+"','"+
                                  gridsatir.get('ilkogretimkinama')+"','"+ 
                                  gridsatir.get('ilkogretimokuldeg')+"','"+ 
                                  gridsatir.get('ortaogretimmahrukinama')+"','"+ 
                                  gridsatir.get('ortaogretimkisauzak')+"','"+ 
                                  gridsatir.get('ortaogretimtasdikname')+"','"+ 
                                  gridsatir.get('ortaogretimorgunegitimdisi')+"'),\n";
                                  
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
   