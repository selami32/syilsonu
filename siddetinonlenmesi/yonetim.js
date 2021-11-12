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


  
  var menu = new Ext.menu.Menu({
        id: 'Rapormenu',
        items: [{
                    text: 'Deneme',
                    iconCls: 'excel', 
                    id:'okuldurum',
                    handler : function() { 
                      alert('deneme');
                    }                  
                },{
                     text: 'Deneme',
                    iconCls: 'excel', 
                    id:'okullar',
                    handler : function() { 
                      alert('deneme');
                  }
                }
        ]
    });


    

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
           {name: 'girilentablo', type: 'float'}
      ]);


    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'kurumkodu'},
           {name: 'okulturu'},
           {name: 'okulunadi'},
           {name: 'ilcesi'},
           {name: 'parola'},
           {name: 'girilentablo', type: 'float'}           
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
var oncekideger = "";
var duzenlenmeyecek="";
var okulekle=false;
 var ilcesicombo=new Ext.form.ComboBox({typeAhead: true, autocomplete: true, editable:false, triggerAction: 'all',transform:'ilcesicombo',lazyRender:true,width:85,listClass: 'x-combo-list-small'}) ;

 var editcombo=new Ext.form.ComboBox({typeAhead: true, autocomplete: true, editable:false, triggerAction: 'all',
transform:'okulturucombo',lazyRender:true,listClass: 'x-combo-list-small'}) ;

var okulcombo=new Ext.form.ComboBox({typeAhead: true, autocomplete: true, editable:false, triggerAction: 'all',
transform:'okulcombo',lazyRender:true,width:85,listClass: 'x-combo-list-small'}) ;
   
    var grid = new Ext.grid.EditorGridPanel({
        store: store,
        renderTo: 'grid-bolgesi',
        sm: sm,
        colModel: new Ext.grid.ColumnModel({
         columns: [
            sm,
            {header: "Kurum kodu", id:'kurumkodu', width:65, sortable: true, dataIndex: 'kurumkodu', editor:  new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 10000000})},
            {header: "Okul türü", width: 105, sortable: true,  dataIndex: 'okulturu', editor: editcombo },
            {header: "Okulun adý", width:400, sortable: true,  dataIndex: 'okulunadi', editor: new Ext.form.TextField({ allowBlank: true })},
            {header: "Ýlçesi", width:95, sortable: true,  dataIndex: 'ilcesi', editor: new Ext.form.TextField({ allowBlank: true })},
            {header: "Parola", width: 65, sortable: true, dataIndex: 'parola', editor:  new Ext.form.TextField({ allowBlank: true })},
            {header: "Girilen Tablo", width: 45, sortable: true, dataIndex: 'girilentablo', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})}
        ],
			}),
        stripeRows: true,
       // autoExpandColumn: 'etkinlikturu',
        height:yukseklik-30,
        width:genislik-20,
        clicksToEdit:1,
        enableColumnMove: false,
        title:'Okul yönetimi ve raporlama',
        listeners: {
			beforeedit: function(object) {
						//ozellikgoster(object);
						//alert(object.record.set("kurumkodu",22));
						
			var gridsatir=grid.getStore().getAt(object.row);
              
              var kurumkodu=gridsatir.get("kurumkodu");
              oncekideger=kurumkodu;
           
              if (kurumkodu==1){              
                  duzenlenmeyecek="evet";
              }else{
                  duzenlenmeyecek="";
              }
              
			},
			afteredit : function(object) {			  
              
            var gridsatir=grid.getStore().getAt(object.row);
             var kurumkodu=gridsatir.get("kurumkodu");
               var p=myData.toString().search(kurumkodu);
               p=myData.toString().search(","+kurumkodu);
               p=myData.toString().search(","+kurumkodu+",");
              //ozellikgoster(myData);
              //ozellikgoster(object);
             // alert(object.field);
              //alert(object.value);
              if (object.field=='kurumkodu'){
                    if (p!=-1) {
                       
                       Ext.Msg.alert("Uyarý", "Yazmýþ olduðunuz "+ kurumkodu+ " kurum kodu zaten var. <br> lütfen farklý bir kurum kodu giriniz");                 
                       
                       object.record.set("kurumkodu", oncekideger);
                       
                       
                       
                    }
              }
				if (duzenlenmeyecek=="evet") {
						gridsatir.set('kurumkodu',1);
						grid.getStore().commitChanges(); 
				}
			  
			
			}
			
        },     
           tbar: [        
           {
            text: 'Okul Ekle',           
            iconCls:'add',            
            handler : function(){
                okulekle=true;
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
                grid.getSelectionModel().selectFirstRow();
                
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
									  Ext.Ajax.request({
											method: 'POST',
											url: 'gonder.php',                                        
											params: {
												ajax:'evet',
												kurumkodu: record.get('kurumkodu'),
												adisoyadi: record.get('okulunadi'),
												sifre: 'satirsil',												
												tablo: tablo
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
                                  
                                  var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `okulturu`, `okulunadi`, `ilcesi`, `parola`, `girilentablo`) VALUES';
                                  
                                  var sqlgovde="";
                                  while (satir< grid.getStore().getCount())
                                  {
                                  var gridsatir=grid.getStore().getAt(satir);
                            
                                  var ekleneceksatir="("+tem(gridsatir.get('kurumkodu'))+",'"+ 
                                  gridsatir.get('okulturu')+"','"+ 
                                  tem(gridsatir.get('okulunadi'))+"','"+
                                  tem(gridsatir.get('ilcesi'))+"','"+ 
                                  tem(gridsatir.get('parola'))+"','"+ 
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
												tablo: tablo
											},
											success: function(response,opts){
												var sonuc = response.responseText;
											  //alert(Ext.decode(sonuc));
											Ext.MessageBox.alert('Durum', sonuc);
											}
											
										});
                       if (okulekle==true) okulekle=false;           
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
                var pencere= new window.top.Ext.Window({
                              title : ookuladi,
                              //applyto: "hello-win",
                              plain: true,
                              top : 0,
                              left: 0 ,
                              width :850,
                              height: 650,
                              maximizable: true,
                              layout : 'fit',
                              items : [{
                                  xtype : "box",
                                  autoEl : {
                                      tag : "iframe",
                                       src : adres+"siddetinonlenmesi/formlar.php?kurumkodu="+kkurumkodu+"&ad="+adres
                                      
                                  }
                              }]
                              
                 });
                 pencere.show();
                }else{Ext.MessageBox.alert('Durum', 'Okul seçiniz') }     	
            }

      },
      '-',
      'Rapor kurum türü:',
      okulcombo,  
      'Rapor ilçesi:',
      ilcesicombo,
      {
            text: 'Sonuç Raporunu al',
            iconCls:'grid',
            handler : function(){
				document.location.href="siddet_rapor.php?ad="+adres+"&okulturu="+okulcombo.value+"&ilcesi="+ilcesicombo.value;
				return;
                
  			}
      },'-',
      {
		text : 'Bilgileri sil',
		iconCls: 'cross',
		handler : function (){
				Ext.MessageBox.show({
						title:'Bilgilerin silinmesi',
						msg: 'Bu iþlem yeni bilgilerin girilmesi amacýyla, <br> her yýl bir kere yapýlmalýdýr. <br> Bu iþlem geri alýnamaz! ',
						icon: Ext.Msg.QUESTION, 
						buttons: {yes: "Tamam",no: "Ýptal"},
							fn: function(btn){
								
								if (btn=='yes') {
									//alert('hoop');
									var msgbox = Ext.Msg.prompt('Pin numarasý', 
																'Lütfen pin no girin:',
																function(btn, text){
																	var adres=window.parent.location.href;																		
																	if (text==adres.substr(adres.length-4)){
                                                Ext.Ajax.request({
                                                  method: 'POST',
                                                  url: 'gonder.php',                                        
                                                  params: {
                                                    ajax:'evet',
                                                    kurumkodu: kurumkodu,
                                                    gonderkutusu: 'temizle',
                                                    tablo: tablo
                                                  },
                                                  success: function(response,opts){
                                                    var sonuc = response.responseText;
                                                    //alert(Ext.decode(sonuc));
                                                  Ext.MessageBox.alert('Durum', sonuc);
                                                  }
                                                  
                                                });
                                                //window.location.reload();
																	}
                  });
								}
								
							}
						});	
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
   