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

Ext.QuickTips.init();
    // NOTE: This is an example showing simple state management. During development,
    // it is generally best to disable state management as dynamically-generated ids
    // can change across page loads, leading to unpredictable results.  The developer
    // should ensure that stable state ids are set for stateful components in real apps.
   // Ext.state.Manager.setProvider(new Ext.state.CookieProvider());

var store = new Ext.data.SimpleStore({
    fields: ['deger', 'isim'],
    data : [
        ["normal", "Normal"],
        ["ikili", "�kili"]        
    ]
});

/* store i�i iptal :

     // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
			{name:  'ili' },
			{name:  'ilcesi' },
			{name:  'okulunadi' },
			{name:  'ogrenimsekli' },
			{name:  'ogretimyili' },
			{name:  'adresi' },
			{name:  'telefonfaks' },
			{name:  'postakodu' },
			{name:  'internetadresi' },
			{name:  'eposta' },
			{name:  'ogrencisayisikiz' },
			{name:  'ogrencisayisierkek' },
			{name:  'ogrencisayisitoplam' },
			{name:  'rehberogretmensayisi' },
			{name:  'rehberogretmennorm' },          
        ]
    });
    store.loadData(myData);
$isimler=array("kurumkodu", "ili", "ilcesi", "okulunadi", "ogrenimsekli", "ogretimyili", "adresi", 
"telefonfaks", "postakodu", "internetadresi", "eposta", "ogrencisayisikiz", "ogrencisayisierkek", 
"ogrencisayisitoplam", "rehberogretmensayisi", "rehberogretmennorm");

*/

           
//formu olu�tur:
    var formum = new Ext.FormPanel({
		renderTo: 'grid-bolgesi',
        labelAlign: 'right',
         frame:true,
   //     url: 'gonder.php',
        title: '��renci Bilgileri',
        bodyStyle:'padding:5px 5px 0',
        width: 800,
		
        items: [
		{
        xtype: 'fieldset',
        title : '��renci say�lar�',
        layout:'column',
        columnWidth: 0.3,
        autoHeight:true,
        defaults: {anchor: '100%'},
        
            items:[{
                columnWidth:.3,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    enableKeyEvents: true,
                    fieldLabel: 'K�z',
                    id: 'CinsiyetKiz', 
                    selectOnFocus:true,                 
                    anchor:'65%',
                    listeners:{'keyup': function(obj) {
                               var gf=formum.getForm();
                               gf.findField("ogrencisayisitoplam").setValue(gf.findField("CinsiyetKiz").getValue()+gf.findField("CinsiyetErkek").getValue()) 
                              }
                    }
                    
                }]
            },{
              columnWidth:.3,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    enableKeyEvents: true,
                    fieldLabel: 'Erkek',
                    id: 'CinsiyetErkek', 
                    selectOnFocus:true,                 
                    anchor:'65%',
                    listeners:{'keyup': function(obj) {
                               var gf=formum.getForm();
                               gf.findField("ogrencisayisitoplam").setValue(gf.findField("CinsiyetKiz").getValue()+gf.findField("CinsiyetErkek").getValue()) 
                              }
                    },
                }]
            },{
              columnWidth:.3,
               layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Toplam',
                    id: 'ogrencisayisitoplam',                  
                    anchor:'65%',
                    readOnly: true
                }]
             }]
        },{
        xtype: 'fieldset',
        title : 'Nerede ve kiminle ya��yorsunuz? ',
        layout:'column',
        autoHeight:true,
        //defaults: {anchor: '100%'},
        
            items:[
			{
                columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Ailemle',
                    id: 'NeredevekiminleyasiyorsunuzAilemle',                  
                    anchor:'75%',
                    selectOnFocus:true
 
                    
                }]
            },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Akrabalar�mla',
                    id: 'NeredevekiminleyasiyorsunuzAkrabalarimla',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Arkada�lar�mla',
                    id: 'NeredevekiminleyasiyorsunuzArkadaslarimla',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Pansiyonda',
                    id: 'NeredevekiminleyasiyorsunuzPansiyonda',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Di�er',
                    id: 'NeredevekiminleyasiyorsunuzDiger',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              }]
			},{
			xtype: 'fieldset',
			title : 'Anne ve baban�z hayatta m�? ',
			layout:'column',
			autoHeight:true,
			//defaults: {anchor: '100%'},
        
            items:[
			{
                columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Anne hayatta',
                    id: 'AnnevebabanizhayattamiAnnehayatta',                  
                    anchor:'75%',
                    selectOnFocus:true
 
                    
                }]
            },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Baba Hayatta',
                    id: 'AnnevebabanizhayattamiBabaHayatta',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Anne Hayatta de�il',
                    id: 'AnnevebabanizhayattamiAnneHayattadegil',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Baba hayatta de�il',
                    id: 'AnnevebabanizhayattamiBabahayattadegil',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              }]
           },{
			xtype: 'fieldset',
			title : 'Anne ve baban�z beraber mi? ',
			layout:'column',
			autoHeight:true,
			//defaults: {anchor: '100%'},
        
            items:[
			{
                columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Ayr� ya��yorlar',
                    id: 'AnnevebabanizberabermiAyriyasiyorlar',                  
                    anchor:'75%',
                    selectOnFocus:true
 
                    
                }]
            },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Beraberler ya��yorlar',
                    id: 'AnnevebabanizberabermiBeraberleryasiyorlar',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              }]
            },{
        xtype: 'fieldset',
        title : 'Anne baban�z ayr� ya��yor ise kiminle kal�yorsunuz?',
        layout:'column',
        autoHeight:true,
        //defaults: {anchor: '100%'},
        
            items:[
			{
                columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Anne ile',
                    id: 'AnnebabanizayriyasiyorisekiminlekaliyorsunuzAnneile',                  
                    anchor:'75%',
                    selectOnFocus:true
 
                    
                }]
            },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Baba �le',
                    id: 'AnnebabanizayriyasiyorisekiminlekaliyorsunuzBabaile',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Akrabam ile',
                    id: 'AnnebabanizayriyasiyorisekiminlekaliyorsunuzAkrabamile',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Arkada�lar�mla',
                    id: 'AnnebabanizayriyasiyorisekiminlekaliyorsunuzArkadaslarimla',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Di�er',
                    id: 'AnnebabanizayriyasiyorisekiminlekaliyorsunuzDiger',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              }]
           },{
        xtype: 'fieldset',
        title : 'Annenizin E�itim D�zeyi',
        layout:'column',
        autoHeight:true,
        //defaults: {anchor: '100%'},
        
            items:[
			{
                columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Okuryazar de�il',
                    id: 'AnnenizinEgitimDuzeyiOkuryazardegil',                  
                    anchor:'75%',
                    selectOnFocus:true
 
                    
                }]
            },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: '�lkokul',
					LabelAlign: 'right',
                    id: 'AnnenizinEgitimDuzeyiilkokul',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Ortaokul',
                    id: 'AnnenizinEgitimDuzeyiOrtaokul',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Lise',
                    id: 'AnnenizinEgitimDuzeyiLise',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: '�niversite',
                    id: 'AnnenizinEgitimDuzeyiuniversite',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              }]
		     },{
        xtype: 'fieldset',
        title : 'Baban�z�n E�itim D�zeyi,',
        layout:'column',
        autoHeight:true,
        //defaults: {anchor: '100%'},
        
            items:[
			{
                columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Okuryazar de�il',
                    id: 'BabanizinEgitimDuzeyiOkuryazardegil',                  
                    anchor:'75%',
                    selectOnFocus:true
 
                    
                }]
            },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: '�lkokul',
					LabelAlign: 'right',
                    id: 'BabanizinEgitimDuzeyiilkokul',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Ortaokul',
                    id: 'BabanizinEgitimDuzeyiOrtaokul',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Lise',
                    id: 'BabanizinEgitimDuzeyiLise',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: '�niversite',
                    id: 'BabanizinEgitimDuzeyiuniversite',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              }]
		},{
        xtype: 'fieldset',
        title : 'Annenizin mesle�i',
        layout:'column',
        autoHeight:true,
        //defaults: {anchor: '100%'},
        
            items:[
			{
                columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Ev han�m�',
                    id: 'AnnenizinmeslegiEvhanimi',                  
                    anchor:'75%',
                    selectOnFocus:true
 
                    
                }]
            },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: '���i',
					LabelAlign: 'right',
                    id: 'Annenizinmeslegiisci',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Memur',
                    id: 'AnnenizinmeslegiMemur',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: '�ift�i',
                    id: 'Annenizinmeslegiciftci',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Serbest meslek',
                    id: 'AnnenizinmeslegiSerbestmeslek',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              }]	
		},{
        xtype: 'fieldset',
        title : 'Baban�z�n mesle�i',
        layout:'column',
        autoHeight:true,
        //defaults: {anchor: '100%'},
        
            items:[
			{
                columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: '���i',
                    id: 'Babanizinmeslegiisci',                  
                    anchor:'75%',
                    selectOnFocus:true
 
                    
                }]
            },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Memur',
					id: 'BabanizinmeslegiMemur',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: '�ift�i',
                    id: 'Babanizinmeslegiciftci',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Serbest meslek',
                    id: 'BabanizinmeslegiSerbestmeslek',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: '�al��m�yor',
                    id: 'Babanizinmeslegicalismiyor',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              }]	
		},{
        xtype: 'fieldset',
        title : 'Evinizde kimlerle beraber ya��yorsunuz?',
        layout:'column',
        autoHeight:true,
        //defaults: {anchor: '100%'},
        
            items:[
			{
                columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Anne',
                    id: 'EvinizdekimlerleberaberyasiyorsunuzAnne',                  
                    anchor:'75%',
                    selectOnFocus:true
 
                    
                }]
            },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Baba',
					id: 'EvinizdekimlerleberaberyasiyorsunuzBaba',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'B�y�k anne',
                    id: 'EvinizdekimlerleberaberyasiyorsunuzBuyukanne',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Dede',
                    id: 'EvinizdekimlerleberaberyasiyorsunuzDede',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Di�er',
                    id: 'EvinizdekimlerleberaberyasiyorsunuzDiger',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              }]	
		},{
        xtype: 'fieldset',
        title : 'Ailenizin ekonomik durumu',
        layout:'column',
        autoHeight:true,
        //defaults: {anchor: '100%'},
        
            items:[
			{
                columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'D���k',
                    id: 'AilenizinekonomikdurumuDusuk',                  
                    anchor:'75%',
                    selectOnFocus:true
 
                    
                }]
            },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Orta',
					id: 'AilenizinekonomikdurumuOrta',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'Y�ksek',
                    id: 'AilenizinekonomikdurumuYuksek',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              
              }]	

		},{
        xtype: 'fieldset',
        title : 'Oturdu�unuz yerle�im yeri',
        layout:'column',
        autoHeight:true,
        //defaults: {anchor: '100%'},
        
            items:[
			{
                columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: '�l merkezi',
                    id: 'Oturdugunuzyerlesimyeriilmerkezi',                  
                    anchor:'75%',
                    selectOnFocus:true
 
                    
                }]
            },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: '�l�e merkezi',
					id: 'Oturdugunuzyerlesimyeriilcemerkezi',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              },{
              columnWidth:.25,
                layout: 'form',
                items: [{
                    xtype:'numberfield',
                    fieldLabel: 'K�y',
                    id: 'OturdugunuzyerlesimyeriKoy',                  
                    anchor:'75%',
                    selectOnFocus:true
                    
                }]
              
              }]					  
           /* xtype:'htmleditor',
            id:'adresi',
            fieldLabel:'Biography',
            height:200,
            anchor:'98%'*/
    
        }],
        buttons: [{
            text: 'Kaydet',
            iconCls: 'save',
            handler: function() {
                var sqlbaslangic='insert into '+tablo+' (`kurumkodu`, `okulturu`, `CinsiyetKiz`,`CinsiyetErkek`,`NeredevekiminleyasiyorsunuzAilemle`,`NeredevekiminleyasiyorsunuzAkrabalarimla`,`NeredevekiminleyasiyorsunuzArkadaslarimla`,`NeredevekiminleyasiyorsunuzPansiyonda`,`NeredevekiminleyasiyorsunuzDiger`,`AnnevebabanizhayattamiAnnehayatta`,`AnnevebabanizhayattamiBabaHayatta`,`AnnevebabanizhayattamiAnneHayattadegil`,`AnnevebabanizhayattamiBabahayattadegil`,`AnnevebabanizberabermiAyriyasiyorlar`,`AnnevebabanizberabermiBeraberleryasiyorlar`,`AnnebabanizayriyasiyorisekiminlekaliyorsunuzAnneile`,`AnnebabanizayriyasiyorisekiminlekaliyorsunuzBabaile`,`AnnebabanizayriyasiyorisekiminlekaliyorsunuzAkrabamile`,`AnnebabanizayriyasiyorisekiminlekaliyorsunuzArkadaslarimla`,`AnnebabanizayriyasiyorisekiminlekaliyorsunuzDiger`,`AnnenizinEgitimDuzeyiOkuryazardegil`,`AnnenizinEgitimDuzeyiilkokul`,`AnnenizinEgitimDuzeyiOrtaokul`,`AnnenizinEgitimDuzeyiLise`,`AnnenizinEgitimDuzeyiuniversite`,`BabanizinEgitimDuzeyiOkuryazardegil`,`BabanizinEgitimDuzeyiilkokul`,`BabanizinEgitimDuzeyiOrtaokul`,`BabanizinEgitimDuzeyiLise`,`BabanizinEgitimDuzeyiuniversite`,`AnnenizinmeslegiEvhanimi`,`Annenizinmeslegiisci`,`AnnenizinmeslegiMemur`,`Annenizinmeslegiciftci`,`AnnenizinmeslegiSerbestmeslek`,`Babanizinmeslegiisci`,`BabanizinmeslegiMemur`,`Babanizinmeslegiciftci`,`BabanizinmeslegiSerbestmeslek`,`Babanizinmeslegicalismiyor`,`EvinizdekimlerleberaberyasiyorsunuzAnne`,`EvinizdekimlerleberaberyasiyorsunuzBaba`,`EvinizdekimlerleberaberyasiyorsunuzBuyukanne`,`EvinizdekimlerleberaberyasiyorsunuzDede`,`EvinizdekimlerleberaberyasiyorsunuzDiger`,`AilenizinekonomikdurumuDusuk`,`AilenizinekonomikdurumuOrta`,`AilenizinekonomikdurumuYuksek`,`Oturdugunuzyerlesimyeriilmerkezi`,`Oturdugunuzyerlesimyeriilcemerkezi`,`OturdugunuzyerlesimyeriKoy`) values(';
                var sqlorta="'"+kurumkodu+"','"+okulturu+"','";
                for (i=0;i<formum.getForm().items.length-1;i++){
                sqlorta=sqlorta+tem(formum.getForm().findField(isimler[i]).getValue())+"','";
                
                
                }
                sqlorta=sqlorta.substr(0,sqlorta.length-2)+")";
                
                var sqltamami=sqlbaslangic+sqlorta;
                alert(sqltamami);
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
											Ext.MessageBox.alert('Durum', sonuc);
                                        }
                                        
                 });
            }
        },{
            text: 'S�f�rla',
           
            handler: function(){ 
            //alert(myData["ogretimyili"]);
            //alert(formum.getForm().findField("ogrenimsekli").getValue());
            formum.getForm().reset();
            }
      },{
            text: 'Ana sayfa',
            iconCls : 'klasor',
            handler: function(){ 
              window.parent.tabs2.activate('0');
 
            }
        
        }]
    });



// B�LG�LER� Y�KLE:
//alert(formum.getForm().items.length+1);
for (i=0;i<formum.getForm().items.length;i++){
	  //alert(isimler[i]);
      formum.getForm().findField(isimler[i]).setValue(myData[isimler[i]]);
}
 
});



   