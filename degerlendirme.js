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



   var formum = new Ext.FormPanel({
		renderTo: 'form-bolgesi',
        labelAlign: 'left',
         title:'Okulda Yürütülen Rehberlik ve Psikolojik Danýþma Hizmetlerinin Deðerlendirilmesi',
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
						fieldLabel: 'Sorunlar',
						id: 'sorunlar',
						name: 'sorunlar',
						valuefield: 'sorunlar',
						anchor:'90%'
					},{
						xtype:'textarea',
						
						fieldLabel: 'Öneriler',
						id: 'oneriler',
						name: 'oneriler',
						valuefield: 'oneriler',
						anchor:'90%'					
					}
					]
				}]
			}],
			buttons: [{
					text: 'Kaydet',
					iconCls:'save',
					handler: function() {
					
						var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `sorunlar`, `oneriler`) VALUES(';
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
//bilgileri yükle:
  for (i=1;i<formum.getForm().items.length+1;i++){
      formum.getForm().findField(Fisimler[i]).setValue(formData[Fisimler[i]]);
} 
     
 
});
   