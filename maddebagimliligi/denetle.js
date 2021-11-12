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
	    title:"Giri� Formu",
	    frame: true,
    	width:300,
    	labelAlign:"right",
    	renderTo:"formDiv",
    	buttonAlign:"center",
    	buttons:[{text:"Giri�",id:"giris",type:"submit",handler: hndLogin},{text:"�ifremi Unuttum",id:"unuttum"}],
	    items:[{
	        xtype:"textfield",
	        fieldLabel:"Kurumkodu",
	        blankText:"L�tfen kurum kodunu giriniz.",
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
	        fieldLabel:"�ifre",
	        inputType:"password",
	        blankText:"L�tfen �ifrenizi giriniz.",
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
							Ext.Msg.alert('Uyar�',json.error);
						}else{
							document.location='giris.php?kurumkodu='+Ext.getCmp('frmLogin').getForm().findField("kurumkodu").getValue()+"&k="+md5(Ext.getCmp('frmLogin').getForm().findField("sifre").getValue()+rsg);
						}
					}else{
						//updateKaptcha();
						Ext.Msg.alert('Hata','Sistem hatas�.L�tfen daha sonra tekrar deneyiniz.');
					}
				},
			failure:function(opt,resp) {
					var json = eval('('+resp.response.responseText+')');
					if(json.success=='true'){
						if(json.error){
						//	updateKaptcha();
							Ext.Msg.alert('Uyar�',json.error);
						}else{
							document.location='denetle.php';
						}
					}else{
					//	updateKaptcha();			
						if(json.error){
							Ext.Msg.alert('Uyar�',json.error);
						}else{
							Ext.Msg.alert('Hata','Sistem hatas�.L�tfen daha sonra tekrar deneyiniz.');
						}					
					}
			},
			
			waitTitle:'Sisteme Ba�lan�l�yor',
			waitMsg:'L�tfen Bekleyiniz...',
			method:'POST'
		});
	}
	
}

