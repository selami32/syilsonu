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



 var formum = new Ext.FormPanel({
        renderTo: 'form-bolgesi',	
        labelAlign: 'top',
        frame:true,
        width: genislik-20,
        layout:'form',
        title:'Rehberlik ve Psikolojik Danýþma Hizmetleri Okul Yürütme Komisyon Toplantýlarý:',
        bodyStyle:'padding:5px 5px 0',
        width: 800,
        items: [{
            layout: 'column',
            autoHeight:true,

            items:[{
                columnWidth:.3,
                layout: 'form',
                title: 'Toplantý Tarihleri:',
                items: [{
                    xtype:'datefield',
                    fieldLabel: 'Birinci Yarýyýl Toplantý Tarihi',
                    id: 'toplantitarihibirinciyariyil',                  
                    name: 'toplantitarihibirinciyariyil',
                    valueField: 'toplantitarihibirinciyariyil',                    
                    anchor:'85%',
                    format: 'd/m/Y',
                    startDay : 1,
                    
                },{
                    xtype:'datefield',
                    fieldLabel: 'Ýkinci Yarýyýl Toplantý Tarihi',
                    id: 'toplantitarihiikinciyariyil',                  
                    name: 'toplantitarihiikinciyariyil',
                    valueField: 'toplantitarihiikinciyariyil',                    
                    anchor:'85%',
                    format: 'd/m/Y',
                    startDay : 1,
                    
                },{
                    xtype:'datefield',
                    fieldLabel: 'Yýlsonu Toplantý Tarihi',
                    id: 'toplantitarihiyilsonu',                  
                    name: 'toplantitarihiyilsonu',
                    valueField: 'toplantitarihiyilsonu',                    
                    anchor:'85%',
                    format: 'd/m/Y',
                    startDay : 1,

                }]
            },{
                columnWidth:.7,
                layout: 'form',
                title: 'Alýnan Kararlar:',
                labelAlign: 'top',
                items: [{
                    xtype:'textarea',                    
                    fieldLabel: 'Birinci Yarýyýl toplantýsý alýnan kararlar',
                    name: 'birinciyariyilalinankararlar',
                    id: 'birinciyariyilalinankararlar',
                    ValueField: 'birinciyariyilalinankararlar',
                    anchor:'95%',
                },{
                    xtype:'textarea',                    
                    fieldLabel: 'Ýkinci Yarýyýl toplantýsý alýnan kararlar',
                    name: 'ikinciyariyilalinankararlar',
                    id: 'ikinciyariyilalinankararlar',
                    ValueField: 'ikinciyariyilalinankararlar',
                    anchor:'95%',
                },{
                    xtype:'textarea',                    
                    fieldLabel: 'Yýlsonu toplantýsý alýnan kararlar',
                    name: 'yilsonualinankararlar',
                    id: 'yilsonualinankararlar',
                    ValueField: 'yilsonualinankararlar',
                    anchor:'95%',
                }]   
                
            }]
        }],
			buttons: [{
					text: 'Kaydet',
					iconCls: 'save',
					handler: function() {
					
						var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `toplantitarihibirinciyariyil`, `birinciyariyilalinankararlar`, `toplantitarihiikinciyariyil`, `ikinciyariyilalinankararlar`, `toplantitarihiyilsonu`, `yilsonualinankararlar`) VALUES(';
									var sqlorta="'"+kurumkodu+"','";
									for (i=1;i<formum.getForm().items.length+1;i++){
                     var deger=formum.getForm().findField(Fisimler[i]).getValue();
                     if (Ext.isDate(deger)) deger=Ext.util.Format.date(deger, 'd/m/Y');
                      sqlorta=sqlorta+tem(deger)+"','";
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
   