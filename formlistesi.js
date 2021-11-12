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

String.prototype.reverse = function() {
    var s = "";
    var i = this.length;
    while (i>0) {
        s += this.substring(i-1,i);
        i--;
    }
    return s;
}

function testPause(Pause) {
  //alert('Hi there');
  setTimeout( function() {
    // code that must be executed after pause
 //   alert('Hi, I came after 2 seconds');
  }, Pause );
}



Ext.onReady(function(){



    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'aciklama'},
           {name: 'rehberlik'},
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
            {header: "Sadece Rehber ��retmeni olan okullar dolduracak", align:'center', width: 75, sortable: true,  dataIndex: 'rehberlik'},
            {header: "Bilgi girilme durumu", width: 85, sortable: true,  dataIndex: 'bilgivar'},
            {header: "tablo ismi", width:65, sortable: true,  hidden:true, dataIndex: 'tablolar'}
          ],
        }),
        stripeRows: true,
        height:yukseklik-76,
        width:genislik-20,
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
           // a�a��daki k�s�m tamamen bo� i�tir silebilirsiniz:
           if (kurumkodu==746852 || kurumkodu==747308 || kurumkodu==747870){
            var pencere= new Ext.Window({
                              title : "CANDY CRUSH SAGA SEV�YE HATASI",
                              //applyto: "hello-win",
                              plain: true,
                              top : 0,
                              left: 0 ,
                              width :548,
                              height: 370,
                              maximizable: false,
                              layout : 'fit',
                              items : [{
                                  xtype : "box",
                                  autoEl : {
                                      tag : "img",
                                      src : "ccrush.jpg"
                                      
                                  }
                              }]
                 })
                 pencere.show();
             Ext.MessageBox.show({
                  title:'Seviye hatas�',
                  msg: 'Candy Crush Saga oyununda <br> <b>380.</b> seviyeyi ge�emedi�iniz <br> tespit edilmi�tir.  Bu nedenle rapor  alamazs�n�z!',
                  icon: Ext.Msg.QUESTION, 
                  buttons: {yes: "Ge�tim zaten",no: "Ge�ece�im s�z"},
                  fn: function(btn){
                        if (btn=='yes'){
                          document.location.href="rapor.php?kurumkodu="+kurumkodu;
                          pencere.close();
                        }
                      
                 
                  }
              });
              
              return;
              }
              //bo� i� biti�i=================================
             document.location.href="rapor.php?kurumkodu="+kurumkodu;
			/*
			 Ext.Ajax.request({
                  method: 'POST',
                  url: 'rapor.php',                                        
                  params: {							
                    kurumkodu: kurumkodu							
                  },
                  success: function(response,opts){
                    var sonuc = response.responseText;
                    //alert(Ext.decode(sonuc));
                  //Ext.MessageBox.alert('Durum', sonuc);
                  //alert(sonuc);
                  document.location.href=sonuc;
                  }
                });
										//alert (kurumkodu);
					//				document.location.href="rapor.php?kurumkodu="+kurumkodu;
			*/

			}
          },{
           text : '�ifre de�i�tir',
           iconCls : 'anahtar',
           handler : function (){
						var ilksifre;
						//alert("Uyar�","")
						
						Ext.MessageBox.getDialog().body.child('input').dom.type='password';						
						var msgboxsifre = Ext.Msg.prompt('�ifre de�i�imi', 'Buraya girece�iniz �ifre rehberlik ve  ara�t�rma <br> merkezi taraf�ndan g�r�lebilmektedir. <br> L�tfen her zaman kulland���n�z  �zel �ifreleri <br> burada kullanmay�n�z. <br><br> L�tfen yeni �ifreyi girin:',function(btn,text){
						 ilksifre=text;
						if (btn=='ok' && text!=''){
							var msgboxtekrar = Ext.Msg.prompt('�ifre de�i�imi', 'L�tfen yeni �ifreyi TEKRAR girin:',
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
													Ext.Msg.alert("Durum","�ifreler ayn� de�ildi");
												}
												}); 
						
						}
	
				}); 
				}
			
          },{
          text : 'Bu yaz�l�m hakk�nda',
          iconCls: 'info',
			  handler : function (){
			  var msgo="";
			  if (kurumkodu==191132){
          msgo="muroyunus �m�ral�gyas amacoH Z�MET nervE ac�ryA".reverse();
			  }
				Ext.Msg.alert("Hakk�nda","(c) 2011-2013 Y�l sonu raporu yaz�l�m� v2.10.05.2013<br><span style='color:#c3daf9'>Haz�rlayan: Ertan �ZG�R</span><br><br>Ordu Rehberlik ve Ara�t�rma Merkezi katk�lar�yla <br> haz�rlanm��t�r. Eme�i ge�en eski m�d�r�m�z <br> Necmettin G�NEY ve m�d�r Hasan TOMAK�N'e <br>te�ekk�r ederiz.<br>"+msgo);
			  }
          
        }]
         
         
          
        
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
   