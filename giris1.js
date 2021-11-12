/*
 * Ext JS Library 2.2
 * Copyright(c) 2006-2008, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 */

Ext.onReady(function(){
 Ext.QuickTips.init();

var store = new Ext.data.SimpleStore({
    fields: ['deger', 'isim'],
    data : [
        ["yilsonu", "Yýl Sonu Çalýþma Raporu"],
        ["siddet", "Þiddetin Önlenmesi Veri Giriþi"]        
    ]
});

var extForm=new Ext.FormPanel({
		id:"frmLogin",
	    title:"Yýl Sonu Raporu Giriþ",
	    frame: true,
    	width:300,
    	labelAlign:"right",
    	renderTo:"formDiv",
    	buttonAlign:"center",
    	buttons:[{text:"Giriþ",id:"giris",type:"submit",handler: hndLogin},{text:"Þifremi Unuttum",id:"unuttum", handler: fnunuttum}],
	    items:[{
	        xtype:"textfield",
	        fieldLabel:"Kurumkodu",
	        blankText:"Lütfen kurum kodunu giriniz.",
	        id:"kurumkodu",
	        allowBlank:false,
	        labelStyle:" font-weight: bold;",
          listeners: {
                specialkey: function(field, e){
                    if (e.getKey() == e.ENTER) {
                        hndLogin();
                    }
                }
          }
	      },{
	        xtype:"textfield",
	        fieldLabel:"Þifre",
	        inputType:"password",
	        blankText:"Lütfen þifrenizi giriniz.",
	        id:"sifre",
	        allowBlank:false,
	        labelStyle:" font-weight: bold;",
			listeners: {
                specialkey: function(field, e){
                    if (e.getKey() == e.ENTER) {
                        hndLogin();
                    }
                }
				}
		  }/*,{
			xtype: 'combo',
			fieldLabel: 'Rapor Seçimi',
			labelStyle:" font-weight: bold;",
			name: 'raporsecim',
			id: 'raporsecim',
			store:store,
			displayField:'isim',
			valueField:'deger',
			value: 'yilsonu',
			//typeAhead: true,
			mode: 'local',
			//forceSelection: true,
			triggerAction: 'all',
			//emptyText:'Select a state...',
			//selectOnFocus:true,
			editable: false

	      }*/]
		});	


});

function fnunuttum(){

  Ext.Msg.alert("Þifre", "Lütfen baðlý olduðunuz Rehberlik <br> ve Araþtýrma Merkezini arayýnýz.");
 return 0;
}
function hndLogin() {
	if(Ext.getCmp('frmLogin').getForm().isValid()){
		Ext.getCmp('frmLogin').getForm().submit({
			url:'login.php', 
			success:function(opt,resp) {
					var json = eval('('+resp.response.responseText+')');
					
					if(json.success=='true'){
						if(json.error){
							//updateKaptcha();
							Ext.Msg.alert('Uyarý',json.error);
						}else{
						document.location='formlar.php?kurumkodu='
									+Ext.getCmp('frmLogin').getForm().findField("kurumkodu").getValue()+
									"&k="+md5(Ext.getCmp('frmLogin').getForm().findField("sifre").getValue()+rsg);
						/*
							switch (Ext.getCmp('frmLogin').getForm().findField('raporsecim').getValue()){								
								case 'siddet':
									document.location='siddetinonlenmesi/formlar.php?kurumkodu='+
									Ext.getCmp('frmLogin').getForm().findField("kurumkodu").getValue()+"&k="+
									md5(Ext.getCmp('frmLogin').getForm().findField("sifre").getValue()+rsg)+"&ad="+adres;
									break;
								default:
									
									break;
							}
							*/
						}
					}else{
						//updateKaptcha();
						Ext.Msg.alert('Hata','Sistem hatasý.Lütfen daha sonra tekrar deneyiniz.');
					}
				},
			failure:function(opt,resp) {
					var json = eval('('+resp.response.responseText+')');
					if(json.success=='true'){
						if(json.error){
						//	updateKaptcha();
							Ext.Msg.alert('Uyarý',json.error);
						}else{
							document.location='giris.php';
						}
					}else{
					//	updateKaptcha();			
						if(json.error){
							Ext.Msg.alert('Uyarý',json.error);
						}else{
							Ext.Msg.alert('Hata','Sistem hatasý.Lütfen daha sonra tekrar deneyiniz.');
						}					
					}
			},
			
			waitTitle:'Sisteme Baðlanýlýyor',
			waitMsg:'Lütfen Bekleyiniz...',
			method:'POST'
		});
	}
	
}

