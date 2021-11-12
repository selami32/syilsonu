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

function testPause(Pause) {
  //alert('Hi there');
  setTimeout( function() {
    // code that must be executed after pause
 //   alert('Hi, I came after 2 seconds');
  }, Pause );
}



Ext.onReady(function(){

Ext.BLANK_IMAGE_URL = adres+'ext2/resources/images/default/s.gif';

    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'aciklama'},           
           {name: 'bilgivar'},
           {name: 'tablolar'}
        ]
    });
    store.loadData(myData);

          
  var sm = new Ext.grid.CheckboxSelectionModel({
        singleSelect: true,
        sortable: false,
        checkOnly: true
  });
 
  
  var grid = new Ext.grid.EditorGridPanel({
        store: store,
        renderTo: 'grid-bolgesi',
        sm: sm,
        colModel: new Ext.grid.ColumnModel({
          columns: [
           
            {header: "Bilgi girilecek form", width: 500, sortable: false, dataIndex: 'aciklama' },            
            {header: "Bilgi girilme durumu", width: 85, sortable: true,  dataIndex: 'bilgivar'},
            {header: "tablo ismi", width:65, sortable: true,  hidden:true, dataIndex: 'tablolar'}
          ],
        }),
        stripeRows: true,
        height:yukseklik-467,
        width:genislik-150,
        clicksToEdit:1,
        enableColumnMove: false,
        trackMouseOver:true,
        title: okulunadi,
        listeners:{
          'rowclick': function(grid, rowIndex, columnIndex, e){
           
           var record = grid.getSelectionModel().getSelected();
           if (record){
				var tabismi=record.get('tablolar');
				tabismi=tabismi.substr(onek.length,tabismi.length);				
                window.parent.tabs2.activate(tabismi);
              
           }
           
          }
        },
        viewConfig: {
            getRowClass: function(record, rowIndex, rp, ds){ 
              if(record.get('bilgivar') == 'Bilgi girildi'){
              //alert(rowIndex);
                  return 'green-row';
              } else {
                  return 'red-row';
              }
            }
          },
         tbar:[{
           text : 'Girilen bilgilerin raporunu al',
           iconCls : 'yazici',
           handler : function (){
            document.location.href="rapor.php?kurumkodu="+kurumkodu;
			}
		  },{
           text : 'Þifre deðiþtir',
           iconCls : 'anahtar',
           handler : function (){
						var ilksifre;
						//alert("Uyarý","")
						
						Ext.MessageBox.getDialog().body.child('input').dom.type='password';						
						var msgboxsifre = Ext.Msg.prompt('Þifre deðiþimi', 'Buraya gireceðiniz þifre rehberlik ve  araþtýrma <br> merkezi tarafýndan görülebilmektedir. <br> Lütfen her zaman kullandýðýnýz  özel þifreleri <br> burada kullanmayýnýz. <br><br> Lütfen yeni þifreyi girin:',function(btn,text){
						 ilksifre=text;
						if (btn=='ok' && text!=''){
							var msgboxtekrar = Ext.Msg.prompt('Þifre deðiþimi', 'Lütfen yeni þifreyi TEKRAR girin:',
												function(btn, text){
																																		
												if (ilksifre==text){
													Ext.Ajax.request({
													  method: 'POST',
													  url: 'gonder.php',                                        
													  params: {
														ajax:'evet',
														sifre: 'evet',
														kurumkodu: kurumkodu,
														gonderkutusu: text,
														tablo: onek + 'okullar'
													  },
													  success: function(response,opts){
														var sonuc = response.responseText;
														//alert(Ext.decode(sonuc));
													  Ext.MessageBox.alert('Durum', sonuc);
													  }
													  
														});
												}else{
													Ext.Msg.alert("Durum","Þifreler ayný deðildi");
												}
												}); 
						
						}
	
				}); 
				}
			
          }/*,{
          text : 'Bu yazýlým hakkýnda',
          iconCls: 'info',
			  handler : function (){
				Ext.Msg.alert("Hakkýnda","(c) 2011-2013 Yýl sonu raporu yazýlýmý v2.10.05.2013<br><span style='color:#dfe8f6'>Hazýrlayan: Ertan ÖZGÜR</span><br><br>Ordu Rehberlik ve Araþtýrma Merkezi katkýlarýyla <br> hazýrlanmýþtýr. Emeði geçen eski müdürümüz <br> Necmettin GÜNEY ve müdür Hasan TOMAKÝN'e <br>teþekkür ederiz.");
			  }
          
        }*/]
         
         
          
        
  });

/*           grid.on('rowclick', function(grid, rowIndex, columnIndex, e) {
                //var gridsatir=grid.getStore().getAt(rowIndex);
                
                window.parent.tabs2.setActiveTab(tablolar[rowIndex]);
                                       
               
               //window.parent.tabs2.activate(tablolar[rowIndex]);
                
            }, this);
  */            
Ext.QuickTips.init();  // grid.render();
    
         /*       grid.on('rowclick', function(grid, rowIndex, columnIndex, e) {
                //alert( rowIndex +" "+ columnIndex +" "+ e);
            }, this);*/

    //grid.render('document.body');

    //grid.getSelectionModel().selectFirstRow();
 
});
   