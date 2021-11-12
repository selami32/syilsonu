/*
 * Ext JS Library 2.2
 * Copyright(c) 2006-2008, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 */

Ext.onReady(function(){
 Ext.QuickTips.init();
// deger k�sm� �n ek ile ayn� olmal� yoksa �al��maz:============================================
var store = new Ext.data.SimpleStore({
    fields: ['deger', 'isim'],
    data : [
        ["ys", "Y�l Sonu �al��ma Raporu"],
        ["siddet", "�iddetin �nlenmesi Veri Giri�i"],
        ["madde", "Madde ba��ml�l��� raporu giri�i"],      
		["risk", "Risk fakt�rleri belirleme anket raporu giri�i"],
		["risk2016", "Risk fakt�rleri belirleme anketi 2016"],
		["reh", "Rehberlik Faaliyetleri"]
	]
});

var extForm=new Ext.FormPanel({
		id:"frmLogin",
	    title:"<div style='text-align:center'>"+rehberlik+"</div>",
	    frame: true,
    	width:340,
    	labelAlign:"right",
    	renderTo:"formDiv",
    	buttonAlign:"center",
    	buttons:[
    	{text:"Giri�",id:"giris",type:"submit",handler: hndLogin},
    	{text:"�ifremi Unuttum",id:"unuttum", handler: fnunuttum},
    	{text:"A��klamalar",id:"aciklama", iconCls:'book', handler: fnAciklama}
    	],
	    items:[{
        xtype:"fieldset",
        title: "Rapor sistemi giri�",
        layout:'form',
        autoHeight:true,
        autoWidth:true,
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
          }
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
			}
		  },{
			xtype: 'combo',
			fieldLabel: 'Rapor Se�imi',
			labelStyle:" font-weight: bold;",
			name: 'raporsecim',
			id: 'raporsecim',
			store:store,
			displayField:'isim',
			valueField:'deger',
			value: 'ys',
			anchor: '98%',
			//typeAhead: true,
			mode: 'local',
			//forceSelection: true,
			triggerAction: 'all',
			//emptyText:'Select a state...',
			//selectOnFocus:true,
			listeners: {
                specialkey: function(field, e){
                    if (e.getKey() == e.ENTER) {
                        hndLogin();
                    }
                }
			},
			editable: false
         }]
      }]
		});	


});

function fnAciklama(){
 var pencere= new Ext.Window({
                              title : "A��klamalar",
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
                                      src : "aciklama.pdf",
                                      
                                  }
                              }]
               })
                 pencere.show();

}

function fnunuttum(){

  Ext.Msg.alert("�ifre", "L�tfen ba�l� oldu�unuz Rehberlik <br> ve Ara�t�rma Merkezini aray�n�z.");
 return 0;
}
function hndLogin() {
	if(Ext.getCmp('frmLogin').getForm().isValid()){
		Ext.getCmp('frmLogin').getForm().submit({
			url:'login.php?rp='+Ext.getCmp('frmLogin').getForm().findField('raporsecim').getValue(), 
			success:function(opt,resp) {
					var json = eval('('+resp.response.responseText+')');
					
					if(json.success=='true'){
						if(json.error){
							//updateKaptcha();
							Ext.Msg.alert('Uyar�',json.error);
						}else{
												
							switch (Ext.getCmp('frmLogin').getForm().findField('raporsecim').getValue()){								
								case 'siddet':
									document.location='siddetinonlenmesi/formlar.php?kurumkodu='+
									Ext.getCmp('frmLogin').getForm().findField("kurumkodu").getValue()+"&k="+
									md5(Ext.getCmp('frmLogin').getForm().findField("sifre").getValue()+rsg)+"&ad="+adres;
									break;
								case 'madde':
									document.location='maddebagimliligi/giris.php?kurumkodu='+
									Ext.getCmp('frmLogin').getForm().findField("kurumkodu").getValue()+"&k="+
									md5(Ext.getCmp('frmLogin').getForm().findField("sifre").getValue()+rsg);
									break;
								case 'risk':
									document.location='riskrapor/formlar.php?kurumkodu='+
									Ext.getCmp('frmLogin').getForm().findField("kurumkodu").getValue()+"&k="+
									md5(Ext.getCmp('frmLogin').getForm().findField("sifre").getValue()+rsg)+"&ad="+adres;
									break;
								case 'risk2016':
									document.location='risk2016/formlar.php?kurumkodu='+
									Ext.getCmp('frmLogin').getForm().findField("kurumkodu").getValue()+"&k="+
									md5(Ext.getCmp('frmLogin').getForm().findField("sifre").getValue()+rsg)+"&ad="+adres;
									break;
								case 'reh':
									document.location='rehberlikfaaliyet/formlar.php?kurumkodu='+
									Ext.getCmp('frmLogin').getForm().findField("kurumkodu").getValue()+"&k="+
									md5(Ext.getCmp('frmLogin').getForm().findField("sifre").getValue()+rsg)+"&ad="+adres;
									break;
								default:
									document.location='formlar.php?kurumkodu='
									+Ext.getCmp('frmLogin').getForm().findField("kurumkodu").getValue()+
									"&k="+md5(Ext.getCmp('frmLogin').getForm().findField("sifre").getValue()+rsg);									
									break;
							}
							
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
							document.location='giris.php';
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

