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


Ext.QuickTips.init();




    // example of custom renderer function
 

    var konu = Ext.data.Record.create([
           // the "name" below matches the tag name to read, except "availDate"
           // which is mapped to the tag "availability"
           {name: 'yasanansorunlar'},
           {name: 'cozumonerileri'}
       ]);


    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'yasanansorunlar'},
           {name: 'cozumonerileri'}
           
        ]
    });
    store.loadData(myData);

		var states = new Ext.data.SimpleStore({
			fields: ['yasanansorun'],
			data: [
			['Zararlý madde kullanýmý'],
			['Öfke kontrolü problemleri'],
			['Okul arkadaþlarý ve öðretmenleri ile uyum problemleri '],
			['Lakap takma'],
			['Aile içi Þiddet'],
			['Fiziksel þiddet uygulama'],
			['Öðrenci giriþ ve çýkýþlarýnýn yeterince kontrol edilememesi.'],
			['Çatýþma ve problem çözmede yetersizlikler'],
			['Okul ile ilgisi olmayan bireylerin okula gelmesi'],
			['Öðrencilerin zamanýnda okula gelmemesi'],
			['Sýnýf disiplinini bozacak davranýþlar'],
			['Alay etme'],
			['Çeteleþme'],
			['Küfür etme'],
			['Ýletiþim sorunlarý'],
			['Zorbalýk '],
			['Aþýrý baskýcý tutarsýz anne baba tutumlarý'],
			['Akranlarý tarafýndan reddedilme, dýþlanma'],
			['Okuldan kaçma'],
			['Dikkat Eksikliði ve Hiperaktivite'],
			['Ekonomik problemler'],
			['Okul içi ve bahçesinde disiplinin saðlanamamasý'],
			['Akademik yetersizlikler'],
			['Ýhmal ve Ýstismar ile karþýlaþýlmasý.'],
			['Öðrencide Ruhsal sorunlar'],
			['Öðretmen öðrenci iletiþim problemleri.'],
			['Sosyal etkinliklere yeterince zaman ayrýlamamasý'],
			['Öðretmenler arasýndaki davranýþ ve tutum farklýlýklarý.'],
			['Okul idaresinin cezalandýrýcý ve katý tutumlarý'],
			['Okul idaresinin gevþek, umursamaz disiplin anlayýþý'],
			['Öðrenciler arasýndaki guruplaþmalar.'],
			['Öðrenciler arasý duygusal iliþkilerden kaynaklý sorunlar'],
			['Okul kurallarýna uymama']	],
			sortInfo: {field: 'yasanansorun', direction: 'ASC'}
		});
		

		var secimler = new Ext.ux.BoxSelect({
			fieldLabel: 'Secimler',
			editable: false,
			resizable: true,
			name: 'secim',
			anchor:'100%',
			store: states,
			mode: 'local',
			displayField: 'yasanansorun',
			displayFieldTpl: '{yasanansorun}',
			valueField: 'yasanansorun',
			addUniqueValues: false,
			value: " "
			//value: ['AL', 'NY', 'MN']
			//value: 'AL, NY, MN'
		});

var texta= new Ext.grid.GridEditor(new Ext.form.TextArea(), {
	listeners: {
		render: function(ed) {
			ed.resizer = new Ext.Resizable(ed.el.dom, {
				listeners: {
					resize: function(r, w, h, e) {
						ed.field.setSize(w, h);
					}
				}
			});
		},
		show: function(ed) {
			ed.field.setHeight(50);
			var e = ed.field.el;
			ed.resizer.resizeTo(e.getWidth(), e.getHeight());
		}
	}
});

		
           
    // create the Grid
    var sm = new Ext.grid.RowSelectionModel();
    
    Ext.grid.RowSelectionModel.override ({
        getSelectedIndex : function(){
            return this.grid.store.indexOf( this.selections.itemAt(0) );
        }
    });
   var yasanansorcombo=new Ext.form.ComboBox({typeAhead: true, autocomplete: true, editable:false, triggerAction: 'all',transform:'yasanansoruncombo',lazyRender:true,listClass: 'x-combo-list-small'}) ;
   
    var grid = new Ext.grid.EditorGridPanel({
        store: store,
        renderTo: 'grid-bolgesi',
        sm: sm,
        colModel: new Ext.grid.ColumnModel({
        columns: [
            {header: "Yaþanan sorunlar", id:'yasanansorunlar', width: 150, sortable: true, dataIndex: 'yasanansorunlar', editor: yasanansorcombo },
            {header: "Olasý çözüm önerileri", width: 250, sortable: true, dataIndex: 'cozumonerileri', editor: texta}

        ]}),
        stripeRows: true,
        height:yukseklik-30,
        width:genislik-20,
        clicksToEdit:1,
        enableColumnMove: true,
        viewConfig: {
        forceFit: true
        },
        title:'Yaþanan Sorunlar ve Çözüm Önerileri(Bu bölümde, planlanan ya da gerçekleþtirilen çalýþmalara yönelik yaþanan sorunlara ve söz konusu sorunlara yönelik sunulabilecek olasý çözüm önerilerine yer verilecektir)',
        tbar: [{
            text: 'Sorun Ekle',           
            iconCls:'add',            
            handler : function(){
                var kon= new konu({
                
                    yasanansorunlar: '',
                    cozumonerileri:''
                    
                });
                grid.stopEditing();
                store.insert(0, kon);
                grid.startEditing(0, 0);
                grid.getSelectionModel().selectFirstRow();
            }
        },
        {
            text: 'Sorun Sil',
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
                                  
                                  
                                  var satir=0;
                                  if (grid.getStore().getCount()==0) return;
                                  var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `yasanansorunlar`, `cozumonerileri`) VALUES';
                                  
                                  var sqlgovde="";
                                  while (satir< grid.getStore().getCount())
                                  {
                                      var gridsatir=grid.getStore().getAt(satir);
                                      var ekleneceksatir="("+kurumkodu+",'"+ 
                                      
                                      tem(gridsatir.get('yasanansorunlar'))+"','"+ 
                                      tem(gridsatir.get('cozumonerileri'))+"'),\n";
                                      
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
                 window.parent.tabs2.activate(0);

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
   