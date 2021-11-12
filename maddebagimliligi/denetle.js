/*
 * Ext JS Library 2.2
 * Copyright(c) 2006-2008, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 */

Ext.onReady(function(){
 Ext.QuickTips.init();
 
var extForm=new Ext.FormPanel({
		id:"frmLogin",
	    title:"Giriþ Formu",
	    frame: true,
    	width:300,
    	labelAlign:"right",
    	renderTo:"formDiv",
    	buttonAlign:"center",
    	buttons:[{text:"Giriþ",id:"giris",type:"submit",handler: hndLogin},{text:"Þifremi Unuttum",id:"unuttum"}],
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
      },

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
          },

	      }]
		});	


});
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
							document.location='giris.php?kurumkodu='+Ext.getCmp('frmLogin').getForm().findField("kurumkodu").getValue()+"&k="+md5(Ext.getCmp('frmLogin').getForm().findField("sifre").getValue()+rsg);
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
							document.location='denetle.php';
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

