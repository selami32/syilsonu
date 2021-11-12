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


		var faaliyetler = new Ext.data.SimpleStore({
			fields: ['sorunayonelikcalismalar'],
			data: [
				['Sosyo ekonomik s�k�nt� i�indeki ��rencilerin belirlenmesi ve ihtiya�lar�n�n giderilmesi'],
				['Aile g�r��meleri,'],
				[' Sportif ve Sanatsal kurslar a��lmas�.'],
				['Akademik ba�ar�s� d���k ��rencilerin tespit edilmesi ve destekleyici �al��malar  yap�lmas�'],
				['Sa�l��a zararl� al��kanl�klar konusunda ��rencilerin bilgilendirilmeleri. '],
				['�fke y�netimi konusunda ��rencilerin bilgilendirilmesi'],
				['Okul i�i yar��malar�n ve etkinlikler d�zenlenmesi'],
				['Okul personelinin problem ve �at��malara m�dahale y�ntemleri konusunda e�itim almalar�'],
				['Okul personeline anket ve envanter uygulanarak sorunlar�n tespit edilmesi'],
				['Okul servis g�venli�inin artt�r�lmas� okul bah�esi kontrollerin s�kla�t�r�lmas�'],
				['Veli ileti�im bilgileri �zerinden ��renci devams�zl�klar�n�n telefon ile bildirilmesi. '],
				['��renci ko�lu�u sisteminin uygulanmas�'],
				['Ailelere anket ve envanter uygulanarak sorunlar�n tespit edilmesi'],
				['Aile E�itimi'],
				['B�lten haz�rlama'],
				['Okul bah�esi ile alakal� d�zenlemeler yap�lmas�'],
				['Bireysel g�r��meler'],
				['Sosyal kul�plerin aktif �ekilde �al��mas�n�n sa�lanmas�'],
				['Pano �al��mas�n�n yap�lmas�'],
				['Grup rehberli�i �al��malar�'],
				['Ailelere y�nelik olarak okul i�i sanatsal ve sportif faaliyetlerin d�zenlenmesi'],
				['�iddeti �nleme ve azaltmaya y�nelik proje �al��mas� yap�lmas�'],
				['Psikolojik Dan��ma (Psikolojik Dan��man� olan okullar)'],
				['Grupla psikolojik Dan��ma (Psikolojik Dan��man� olan okullar)'],
				['Psikoe�itim �al��mas� (Psikolojik Dan��man� olan okullar)'],
			],
			sortInfo: {field: 'sorunayonelikcalismalar', direction: 'ASC'}
		});
		

		var sorunayoncalismalar = new Ext.ux.BoxSelect({
			fieldLabel: 'sorunayonelikcalismalar',
			editable: false,
			resizable: true,
			name: 'sorunayonelik',
			anchor:'100%',
			store: faaliyetler,
			mode: 'local',
			displayField: 'sorunayonelikcalismalar',
			displayFieldTpl: '{sorunayonelikcalismalar}',
			valueField: 'sorunayonelikcalismalar',
			addUniqueValues: false,
			value: ""
		});



    var konu = Ext.data.Record.create([
           // the "name" below matches the tag name to read, except "availDate"
           // which is mapped to the tag "availability"
           {name: 'yasanansorun'},
           {name: 'sorunayonelikcalismalar'},
           {name: 'gerceklestirenkurum'},
           {name: 'ogrencisayisi', type: 'float'},
           {name: 'annebabasayisi', type: 'float'},
           {name: 'personelsayisi', type: 'float'}
      ]);


    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'yasanansorun'},
           {name: 'sorunayonelikcalismalar'},
           {name: 'gerceklestirenkurum'},
           {name: 'ogrencisayisi', type: 'float'},
           {name: 'annebabasayisi', type: 'float'},
           {name: 'personelsayisi', type: 'float'}        
        ]
    });
    store.loadData(myData);
//Y� �l�m Y� Allah

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

var yasanansorcombo=new Ext.form.ComboBox({
	typeAhead: true, 
	autocomplete: true, 
	editable:false, 
	triggerAction: 'all',
	transform:'yasanansoruncombo',
	lazyRender:true,
	listClass: 'x-combo-list-small'
}) ;

var gerceklestirenkurcombo=new Ext.form.ComboBox({
	typeAhead: true, 
	autocomplete: true, 
	editable:false, 
	triggerAction: 'all',
	transform:'gerceklestirenkurumcombo',
	lazyRender:true,
	listClass: 'x-combo-list-small'
}) ;
           
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
        colModel: new Ext.grid.ColumnModel({
         columns: [
            {header: "Ya�anan Sorun", width: 150, sortable: true,  dataIndex: 'yasanansorun', editor:  yasanansorcombo },
            {header: "Soruna Y�nelik Ger�ekle�tirilen �al��malar/Al�nan Tedbirler", width: 300, sortable: true,  dataIndex: 'sorunayonelikcalismalar', editor: sorunayoncalismalar},
            {header: "Ger�ekle�tiren kurum", width: 150, sortable: true,  dataIndex: 'gerceklestirenkurum', editor: gerceklestirenkurcombo},
            {header: "��renci say�s�", width: 45, sortable: true, dataIndex: 'ogrencisayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Ebeveyn say�s�", width:45, sortable: true, dataIndex: 'annebabasayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Personel say�s�", width: 45, sortable: true, dataIndex: 'personelsayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})}
        ],
 				rows: [
					[
						{},
						{},
						{},
						{header: '�al��ma Sonras�nda Ula��lan Bireylere �li�kin Say�sal Veriler', colspan: 3, align: 'center'}						
					]
				]
			}),
      stripeRows: true,
      height:yukseklik-30,
      width:genislik-10,
      clicksToEdit:1,
      enableColumnMove: false,
			viewConfig: {
				forceFit: true
			},
		plugins: [new Ext.ux.plugins.GroupHeaderGrid()],        
        title:'�l Eylem Plan� Kapsam�nda Ger�ekle�tirilen �al��malar(Bu b�l�mde, il eylem plan� kapsam�nda ger�ekle�tirilen �al��malara sat�r say�s� artt�r�lmak suretiyle ayr� ayr� yer verilecektir)',
             
           tbar: [{
            text: 'Konu Ekle',           
            iconCls:'add',            
            handler : function(){
                var kon= new konu({
                
                    
                    yasanansorun:'',
                    sorunayonelikcalismalar:'',
					gerceklestirenkurum: '',
                    ogrencisayisi:0,
                    annebabasayisi:0,
                    personelsayisi:0
                    
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
          //  alert('ya �l�m Allah');
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
                                       //alert('ya �l�m Allah');
                                  
                                  //alert( grid.getStore().getAt(1).get('etkinlikkonusu'));
                                  //alert(grid.getStore().getCount());
                                  
                                  var satir=0;
                                  if (grid.getStore().getCount()==0) return;
                                  var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `yasanansorun`, `sorunayonelikcalismalar`, `gerceklestirenkurum`, `ogrencisayisi`, `annebabasayisi`, `personelsayisi`) VALUES';
                                  
                                  var sqlgovde="";
                                  while (satir< grid.getStore().getCount())
                                  {
                                  var gridsatir=grid.getStore().getAt(satir);
                                  var ekleneceksatir="("+kurumkodu+",'"+ 
                                  tem(gridsatir.get('yasanansorun'))+"','"+
                                  tem(gridsatir.get('sorunayonelikcalismalar'))+"','"+ 
                                  tem(gridsatir.get('gerceklestirenkurum'))+"','"+ 
                                  tem(gridsatir.get('ogrencisayisi'))+"','"+ 
                                  tem(gridsatir.get('annebabasayisi'))+"','"+ 
                                  tem(gridsatir.get('personelsayisi'))+"'),\n";
                                  
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
   