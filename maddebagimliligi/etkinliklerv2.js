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
           {name: 'etkinlikadi'},
           {name: 'etkinliksayisi',type: 'float'},
           {name: 'katilanyonetici', type: 'float'},
           {name: 'katilanogretmen', type: 'float'},
           {name: 'katilanrehberogretmen', type: 'float'},
           {name: 'katilanogrenciilkogretim', type: 'float'},
           {name: 'katilanogrenciortaogretim', type: 'float'} ,   
           {name: 'katilanaile', type: 'float'},    
           {name: 'katilandiger', type: 'float'}    
      ]);


    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'etkinlikadi'},
           {name: 'etkinliksayisi',type: 'float'},
           {name: 'katilanyonetici', type: 'float'},
           {name: 'katilanogretmen', type: 'float'},
           {name: 'katilanrehberogretmen', type: 'float'},
           {name: 'katilanogrenciilkogretim', type: 'float'},
           {name: 'katilanogrenciortaogretim', type: 'float'} ,   
           {name: 'katilanaile', type: 'float'},    
           {name: 'katilandiger', type: 'float'}    
           
        ]
    });
    store.loadData(myData);
    /*{name: 'lastChange', type: 'date', dateFormat: 'n/j h:ia'
renderer: 'usMoney'
/*renderer: Ext.util.Format.dateRenderer('m/d/Y'),*/
/*renderer: pctChange,*/ 
/*renderer: change,*/


var editcombo=new CustomComboBox({typeAhead: true, autocomplete: true, editable:true, triggerAction: 'all',transform:'etkinlikcombo',lazyRender:true,listClass: 'x-combo-list-small'}) ;
           
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
            {header: "Adý", id:'etkinlikadi', width: 320, sortable: true, dataIndex: 'etkinlikadi', editor: editcombo},
            {header: "Sayýsý", width: 65, sortable: true,  dataIndex: 'etkinliksayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Yönetici", width: 65, sortable: true,  dataIndex: 'katilanyonetici', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Öðretmen", width: 65, sortable: true, dataIndex: 'katilanogretmen', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Rehber Öðretmen", width: 65, sortable: true, dataIndex: 'katilanrehberogretmen', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Ýlköðretim", width: 65, sortable: true, dataIndex: 'katilanogrenciilkogretim', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Ortaöðretim", width:65, sortable: true, dataIndex: 'katilanogrenciortaogretim', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Aile", width:75, sortable: true, dataIndex: 'katilanaile', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Diðer", width:55, sortable:false, dataIndex: 'katilandiger', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})}
        ],
 				rows: [
					[
						{header: 'Gerçekleþtirilen Etkinlik ve Programlarýn', colspan: 2, align: 'center'},
						{header: 'Etkinliklere Katýlanlarla Ýlgili Sayýsal Durum', colspan: 7, align: 'center'}			
												
					], [
						{},
						{},
						{},						
						{},
						{},							
						{header: 'Öðrenci Sayýsý', colspan: 2, align: 'center'},
						{},
						{}
						
					]
				]
			}),
        stripeRows: true,
       // autoExpandColumn: 'etkinlikturu',
        height:yukseklik-400,
        width:genislik-20,
        clicksToEdit:1,
        enableColumnMove: false,
			viewConfig: {
				forceFit: true
			},
		plugins: [new Ext.ux.plugins.GroupHeaderGrid()],        
        title:'MADDE BAÐIMLILIÐI OKUL RAPORU',
             
           tbar: [{
            text: 'Konu Ekle',           
            iconCls:'add',            
            handler : function(){
                var kon= new konu({
                
                    etkinlikadi: '',
                    etkinliksayisi:0,
                    katilanyonetici:0,
                    katilanogretmen:0,
                    katilanrehberogretmen:0,
                    katilanogrenciilkogretim:0,
                    katilanogrenciortaogretim:0,
                    katilanaile: 0,
                    katilandiger: 0
                    
                });
                grid.stopEditing();
                store.insert(0, kon);
                grid.startEditing(0, 0);
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
                                  //GRID ÝÇÝN KAYIT:
                                  var satir=0;
                                  
                                  var sqlbaslangic='INSERT INTO `'+onek+'etkinliklerv2` (`kurumkodu`, `etkinlikadi`, `etkinliksayisi`, `katilanyonetici`, `katilanogretmen`, `katilanrehberogretmen`, `katilanogrenciilkogretim`, `katilanogrenciortaogretim`, `katilanaile`, `katilandiger`) VALUES';
                                  
                                  var sqlgovde="";
                                  while (satir< grid.getStore().getCount())
                                  {
                                  var gridsatir=grid.getStore().getAt(satir);
                                  var ekleneceksatir="("+kurumkodu+",'"+ 
                                  tem(gridsatir.get('etkinlikadi'))+"','"+ 
                                  gridsatir.get('etkinliksayisi')+"','"+
                                  gridsatir.get('katilanyonetici')+"','"+ 
                                  gridsatir.get('katilanogretmen')+"','"+ 
                                  gridsatir.get('katilanrehberogretmen')+"','"+ 
                                  gridsatir.get('katilanogrenciilkogretim')+"','"+ 
                                  gridsatir.get('katilanogrenciortaogretim')+"','"+ 
                                  gridsatir.get('katilanaile')+"','"+ 
                                  gridsatir.get('katilandiger')+"'),\n";
                                  
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
                                            tablo: onek+'etkinliklerv2'
                                        },
                                        success: function(response,opts){
                                            var sonuc = response.responseText;
                                          //alert(Ext.decode(sonuc));
                                        Ext.MessageBox.alert('Durum', sonuc);
                                        }
                                        
                                    });
                                    
                                    //alttaki kisim için kayit:
									var sqlbaslangic='INSERT INTO `'+onek+'etkinliklerv2_ekbilgi` (`kurumkodu`, `isbirligi`, `eylemguclukler`, `uygulamaguclukler`, `gorusoneriler`) VALUES(';
									var sqlorta="'"+kurumkodu+"','";
									for (i=1;i<formum.getForm().items.length+1;i++){
										sqlorta=sqlorta+tem(formum.getForm().findField(Fisimler[i]).getValue())+"','";
									}
									sqlorta=sqlorta.substr(0,sqlorta.length-2)+")";
									var sqltamami=sqlbaslangic+sqlorta;
														Ext.Ajax.request({
															method: 'POST',
															url: 'gonder.php',                                        
															params: {
																ajax:'evet',
																kurumkodu: kurumkodu,
																gonderkutusu: sqltamami,
																tablo: onek+'etkinliklerv2_ekbilgi'
															},
															success: function(response,opts){
																var sonuc = response.responseText;
															  //alert(Ext.decode(sonuc));
															Ext.MessageBox.alert('Durum', sonuc);
															}
															
														});
                                           
                              }
            
        },{
            text: 'Rapor Al',
            iconCls:'icon-grid ',
            handler : function(){
                 document.location.href="etkinliklerv2_rapor.php?kurumkodu="+kurumkodu+"&okulunadi="+okulunadi;
          //  alert('ya Âlîm Allah');
          // grid.getSelectionModel().selectRow(0);


            }     	
        }]
    });
    
   var formum = new Ext.FormPanel({
		renderTo: 'form-bolgesi',
        labelAlign: 'left',
         frame:true,
   //     url: 'gonder.php',
        //title: 'Rehber Öðretmen Bilgileri',
        //bodyStyle:'padding:5px 5px 0',
        width: genislik-20,
        items: [{
                layout:'form',
                labelAlign:'top',
				autoHeight:true,
				items:[{
					layout: 'form',
					items:[{
						xtype:'textarea',
						fieldLabel: 'Ýþ birliði yapýlan kurum ve kuruluþlar',
						id: 'isbirligi',
						name: 'isbirliði',
						valuefield: 'isbirligi',
						anchor:'90%'
					},{
						xtype:'textarea',
						
						fieldLabel: 'Eylem Planýnýn Gerçekleþtirilmesinde Yaþanan Fýrsatlar ve Güçlükler',
						id: 'eylemguclukler',
						name: 'eylemguclukler',
						valuefield: 'eylemguclukler',
						anchor:'90%'
					},{
						xtype:'textarea',
						fieldLabel: 'Programlarýn Uygulanmasýnda ve Eðitimlere Ýliþkin Olumlu Yanlar ve Varsa Karþýlaþýlan Güçlükler',
						id: 'uygulamaguclukler',
						name: 'uygulamaguclukler',
						valuefield: 'uygulamaguclukler',
						anchor:'90%'
					},{
						xtype:'textarea',
						fieldLabel: 'Görüþ ve öneriler',
						id: 'gorusoneriler',
						name: 'gorusoneriler',
						valuefield: 'gorusoneriler',
						anchor:'90%'
					}
					]
				}]
			}]
		
});
//bilgileri yükle:
  for (i=1;i<formum.getForm().items.length+1;i++){
      formum.getForm().findField(Fisimler[i]).setValue(formData[Fisimler[i]]);
} 
    grid.getSelectionModel().selectFirstRow();
 
 
 
});
   