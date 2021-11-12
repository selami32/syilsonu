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

    var konu = Ext.data.Record.create([
           // the "name" below matches the tag name to read, except "availDate"
           // which is mapped to the tag "availability"
           {name: 'kurumkodu'},
           {name: 'okulturu'},
           {name: 'okulunadi'},
           {name: 'ilcesi'},
           {name: 'parola'},
           {name: 'girilentablo'}
      ]);


    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'kurumkodu'},
           {name: 'okulturu'},
           {name: 'okulunadi'},
           {name: 'ilcesi'},
           {name: 'parola'},
           {name: 'girilentablo'}           
        ]
    });
    store.loadData(myData);
    /*{name: 'lastChange', type: 'date', dateFormat: 'n/j h:ia'
renderer: 'usMoney'
/*renderer: Ext.util.Format.dateRenderer('m/d/Y'),*/
/*renderer: pctChange,*/ 
/*renderer: change,*/


          
    // create the Grid
 //var sm = new Ext.grid.CheckboxSelectionModel();
 var sm = new Ext.grid.CheckboxSelectionModel({
        singleSelect: true,
        sortable: false,
        checkOnly: true
    });
 
/*   var sm = new Ext.grid.RowSelectionModel();
 
    Ext.grid.CheckboxSelectionModel.override ({
    getSelectedIndex : function(){
      return this.grid.store.indexOf( this.selections.itemAt(0) );
  }
  });
*/
//    if (!yukseklik) yukseklik=600;
//    if (!genislik) genislik=850;
 var editcombo=new Ext.form.ComboBox({typeAhead: true, autocomplete: true, editable:false, triggerAction: 'all',transform:'okulturucombo',lazyRender:true,listClass: 'x-combo-list-small'}) ;
   
    var grid = new Ext.grid.EditorGridPanel({
        store: store,
        renderTo: 'grid-bolgesi',
        sm: sm,
        colModel: new Ext.grid.ColumnModel({
         columns: [
            sm,
            {header: "Kurum kodu", id:'kurumkodu', width: 100, sortable: true, dataIndex: 'kurumkodu', editor:  new Ext.form.TextField({ allowBlank: true })},
            {header: "Okul türü", width: 65, sortable: true,  dataIndex: 'okulturu', editor: editcombo },
            {header: "Okulun adý", width:360, sortable: true,  dataIndex: 'okulunadi', editor: new Ext.form.TextField({ allowBlank: true })},
            {header: "Ýlçesi", width:110, sortable: true,  dataIndex: 'ilcesi', editor: new Ext.form.TextField({ allowBlank: true })},
            {header: "Parola", width: 65, sortable: true, dataIndex: 'parola', editor:  new Ext.form.TextField({ allowBlank: true })},
            {header: "Girilen Tablo", width: 65, sortable: true, dataIndex: 'girilentablo', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})}
        ],
			}),
        stripeRows: true,
       // autoExpandColumn: 'etkinlikturu',
        height:yukseklik-30,
        width:genislik-20,
        clicksToEdit:1,
        enableColumnMove: false,
        title:'Okul yönetimi ve raporlama',
             
           tbar: [{
            text: 'Okul Ekle',           
            iconCls:'add',            
            handler : function(){
                var kon= new konu({
                
                    kurumkodu: 0,
                    okulturu:'',
                    okulunadi:'',
                    ilcesi:'',
                    parola:'',
                    girilentablo:0
            
                    
                });
                grid.stopEditing();
                store.insert(0, kon);
                grid.startEditing(0, 0);
            }
        },
        {
            text: 'Okul Sil',
            iconCls:'remove',
            handler : function(){
          //  alert('ya Âlîm Allah');
          // grid.getSelectionModel().selectRow(0);
            var record = grid.getSelectionModel().getSelected();
            if (record !== undefined) {
            	Ext.MessageBox.show({
						title:'Okul silinmesi',
						msg: '"'+record.get('okulunadi')+'" silinecek',
						icon: Ext.Msg.QUESTION, 
						buttons: {yes: "Evet",no: "Hayýr"},
							fn: function(btn){
								
								if (btn=='yes') {
								  if (record.get('kurumkodu')=='1') {Ext.Msg.alert('Durum', 'Kendi kurumunuzu silerseniz üzülürsünüz.'); return;}
									grid.store.remove(record); 
								}
								
							}
						});
						return;
            
            
				}     	
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
                                  
                                  var sqlbaslangic='INSERT INTO `frm_okullar` (`kurumkodu`, `okulturu`, `okulunadi`, `ilcesi`, `parola`, `girilentablo`) VALUES';
                                  
                                  var sqlgovde="";
                                  while (satir< grid.getStore().getCount())
                                  {
                                  var gridsatir=grid.getStore().getAt(satir);
                            
                                  var ekleneceksatir="("+gridsatir.get('kurumkodu')+",'"+ 
                                  gridsatir.get('okulturu')+"','"+ 
                                  gridsatir.get('okulunadi')+"','"+
                                  gridsatir.get('ilcesi')+"','"+ 
                                  gridsatir.get('parola')+"','"+ 
                                  gridsatir.get('girilentablo')+"'),\n";
                                   
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
												tablo: 'frm_okullar'
											},
											success: function(response,opts){
												var sonuc = response.responseText;
											  //alert(Ext.decode(sonuc));
											Ext.MessageBox.alert('Durum', sonuc);
											}
											
										});
                                  
                              }
            
      },
     {
            text: 'Okulun formunu aç',
            iconCls:'grid',
            handler : function(){
            
            var record = grid.getSelectionModel().getSelected();
                if (record !== undefined) {
                var kkurumkodu=record.get('kurumkodu');
                var ookuladi=record.get('okulunadi');
                 delete pencere;
                var pencere= new window.parent.Ext.Window({
                              title : ookuladi,
                              //applyto: "hello-win",
                              plain: true,
                              top : 0,
                              left: 0 ,
                              width : 830,
                              height: 650,
                              layout : 'fit',
                              items : [{
                                  xtype : "box",
                                  autoEl : {
                                      tag : "iframe",
                                      src : "giris.php?kurumkodu="+kkurumkodu,
                                      
                                  }
                              }]
                 })
                 pencere.show();
                }else{Ext.MessageBox.alert('Durum', 'Okul seçiniz') }     	
            }

      },{
            text: 'MADDE BAÐIMLILIÐI OKUL RAPORU',
            iconCls:'grid',
            handler : function(){
				document.location.href="etkinliklerv2_rapor.php";
				
                /*Ext.Ajax.request({
                  method: 'POST',
                  url: 'etkinliklerv2_rapor.php',                                        
                  params: {							
                    kurumkodu: kurumkodu							
                  },
                  success: function(response,opts){
                    var sonuc = response.responseText;
                    //alert(Ext.decode(sonuc));
                  //Ext.MessageBox.alert('Durum', sonuc);
                  document.body.innerHTML=sonuc;
                 // document.location.href=sonuc;
                  }
                });     	*/
  			}
      },{
            text: 'Rehber Öðretmen Rapor',
            iconCls:'grid',
            handler : function(){
				document.location.href="rehberogretmen_rapor.php";
				/*
                Ext.Ajax.request({
                  method: 'POST',
				  waitTitle:'Sisteme Baðlanýlýyor',
				  waitMsg:'Lütfen Bekleyiniz...',
                  url: 'rehberogretmen_rapor.php',                                        
                  params: {							
                    kurumkodu: kurumkodu							
                  },
                  success: function(response,opts){
                    var sonuc = response.responseText;
                    //alert(Ext.decode(sonuc));
                  //Ext.MessageBox.alert('Durum', sonuc);
                  document.location.href=sonuc;
                  }
                });     	*/
       
            }     	
            
        },{
            text: 'Bilgileri temizle',
            iconCls:'cross',
            handler : function(){
					var record = grid.getSelectionModel().getSelected();
					if (record !== undefined) {
						Ext.MessageBox.show({
						title:'Okulun bilgilerinin silinmesi',
						msg: '"'+record.get('okulunadi')+'" girdiði bilgiler silinecek',
						icon: Ext.Msg.QUESTION, 
						buttons: {yes: "Evet",no: "Hayýr"},
							fn: function(btn){
								
								if (btn=='yes') {
									Ext.Ajax.request({
											method: 'POST',
											url: 'gonder.php',                                        
											params: {
												ajax:'evet',
												kurumkodu: record.get("kurumkodu"),
												gonderkutusu: 'okulbilgisil',
												sifre :'frm_rehberogretmen, frm_etkinliklerv2, frm_etkinliklerv2_ekbilgi',
												tablo: 'frm_okullar'
											},
											success: function(response,opts){
												var sonuc = response.responseText;
											  //alert(Ext.decode(sonuc));
											Ext.MessageBox.alert('Durum', sonuc);
											}
											
										});
									
								}
								
							}
						});
					}

			}
        }]
    });
    
    // grid.render();
    
         /*       grid.on('rowclick', function(grid, rowIndex, columnIndex, e) {
                //alert( rowIndex +" "+ columnIndex +" "+ e);
            }, this);*/

    //grid.render('document.body');

    //grid.getSelectionModel().selectFirstRow();
 
});
   