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


  Ext.grid.GroupSummary.Calculations['toplam'] = function(v, record, field){
        return record.data.etkinlikkatveli + record.data.etkinlikkatdiger;
    }




    var summary = new Ext.grid.GroupSummary(); 

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
           {name: 'riskverisi'},
           {name: 'kiz',type: 'float'},
           {name: 'erkek', type: 'float'},
           {name: 'kizoran', type: 'float'},
           {name: 'erkekoran', type: 'float'},
           {name: 'okultoplam', type: 'float'},
           {name: 'okuloran', type: 'float'}

		   ]);


    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'riskverisi'},
           {name: 'kiz',type: 'float'},
           {name: 'erkek', type: 'float'},
           {name: 'kizoran', type: 'float'},
           {name: 'erkekoran', type: 'float'},
           {name: 'okultoplam', type: 'float'},
           {name: 'okuloran', type: 'float'}           
        ]
    });
    store.loadData(myData);
    /*{name: 'lastChange', type: 'date', dateFormat: 'n/j h:ia'
renderer: 'usMoney'
/*renderer: Ext.util.Format.dateRenderer('m/d/Y'),*/
/*renderer: pctChange,*/ 
/*renderer: change,*/

var sayieditor=new Ext.form.NumberField({
allowBlank: false,allowNegative: false, selectOnFocus:true, 
maxValue: 100000,
listeners: {
			'keyup' : function(object) {
			alert(object.row);
			
              //satirtoplam:
			  var okulsatir=grid.getStore().getAt(0);
			  var okultoplam=okulsatir.get('okultoplam');
			  
              var gridsatir=grid.getStore().getAt(object.row);
              //alert(gridsatir);
              var tsonuc=gridsatir.get('kiz')+gridsatir.get('erkek');  
			  
			  if(okultoplam > 0){
				  var kizoran=gridsatir.get('kiz') / okultoplam * 100;
				  var erkekoran=gridsatir.get('erkek') / okultoplam * 100;
				  var okuloran=gridsatir.get('okultoplam') / okultoplam * 100;
				  gridsatir.set('kizoran', kizoran);
				  gridsatir.set('erkekoran', erkekoran);
				  gridsatir.set('okuloran', okuloran);
				   grid.getStore().commitChanges(); 
			  }
			 
              gridsatir.set('okultoplam',tsonuc);
              grid.getStore().commitChanges(); 
			}
        }

})



           
    // create the Grid
    var sm = new Ext.grid.RowSelectionModel();
    
    Ext.grid.RowSelectionModel.override ({
    getSelectedIndex : function(){
        return this.grid.store.indexOf( this.selections.itemAt(0) );
    }
    });
//    if (!yukseklik) yukseklik=600;
//    if (!genislik) genislik=850;
   
    var grid = new Ext.grid.EditorGridPanel({
        store: store,
        renderTo: 'grid-bolgesi',
        sm: sm,
		plugins: [new Ext.ux.plugins.GroupHeaderGrid()],   
        colModel: new Ext.grid.ColumnModel({
         columns: [
            {header: "Risk ile ilgili veri", id:'riskverisi', width: 320, sortable: false, dataIndex: 'riskverisi'},
            {header: "Kýz öðrenci sayýsý", width: 55, sortable: false,  dataIndex: 'kiz',  editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Erkek öðrenci sayýsý", width: 55, sortable: false,  dataIndex: 'erkek', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Kýz öðrenci oraný %", width: 55, sortable: false, dataIndex: 'kizoran'},
            {header: "Erkek öðrenci oraný % ", width: 55, sortable: false, dataIndex: 'erkekoran'},
			{header: "Toplam öðrenci sayýsý", width: 55, sortable: false, dataIndex: 'okultoplam'},
			{header: "Okuldaki toplamýna oraný %", width: 55, sortable: false, dataIndex: 'okuloran'}
			],
			rows: [
					[
						{},							
						{header: 'Öðrenci Sayýlarý', colspan: 2, align: 'center'},
						{header: 'Oranlar yüzde olarak', colspan: 2, align: 'center'},	
						{header: 'Toplamlar', colspan: 2, align: 'center'},	
					]
				]
			}),
        stripeRows: true,
       // autoExpandColumn: 'etkinlikturu',
        height:yukseklik-80,
        width:genislik-20,
        clicksToEdit:1,
        enableColumnMove: false,
			viewConfig: {
				forceFit: true
			},
		     
		listeners: {
		
               
			afteredit : function(object) {
              
                    var toplamsatir=grid.getStore().getCount();
					var okulsatir=grid.getStore().getAt(0);
                    var gridsatir=grid.getStore().getAt(object.row);
                    var kiztoplam=0; var erkektoplam=0; var geneltoplam=0;

                     
                  
				  
					
                   //alert(toplamsatir);
				   
						//satir toplam:				   
					   var tsonuc=gridsatir.get('kiz')+gridsatir.get('erkek');  
					  gridsatir.set('okultoplam',tsonuc);
					   //grid.getStore().commitChanges();   
					   
					   
											  
						var kizoran=gridsatir.get('kiz') / tsonuc * 100;
						if (kizoran!=0) gridsatir.set('kizoran', kizoran.toFixed(2));
						if (isNaN(kizoran)) gridsatir.set('kizoran', '0');
						
							   
						var erkekoran=gridsatir.get('erkek') / tsonuc * 100;
						if (erkekoran!=0 ) gridsatir.set('erkekoran', erkekoran.toFixed(2));
						if (isNaN(kizoran)) gridsatir.set('erkekoran', '0');
						
						grid.getStore().commitChanges(); 
						
						var okultoplam=okulsatir.get('okultoplam');
						
							if (okultoplam >0 && tsonuc > 0  ){
							   //var okuloran=tsonuc/ okultoplam * 100;		  
							   
							   //gridsatir.set('okuloran', okuloran.toFixed(2));
							   
							   //grid.getStore().commitChanges(); 
							}  
						
					
					//sütun toplam
				  
					//for (i=0;i<toplamsatir-1;i++){
					//	kiztoplam=kiztoplam+grid.getStore().getAt(i).get('kiz');
					//	erkektoplam=erkektoplam+grid.getStore().getAt(i).get('erkek');
					//	geneltoplam=geneltoplam+grid.getStore().getAt(i).get('okultoplam');	
					//}
					var ustsatir=grid.getStore().getAt(0);
					//altsatir.set('kiz',kiztoplam);
					//altsatir.set('erkek',erkektoplam);
					//altsatir.set('okultoplam',geneltoplam);
					
					//altsatir oran
					var ustsonuc=ustsatir.get('kiz')+ustsatir.get('erkek');
					if (ustsonuc == 0) ustsonuc=1;
					var ustsonucoran=ustsonuc/ustsonuc * 100;
					//altsatir.set('okuloran', altsonucoran.toFixed(2));
					//altsatir.set('kizoran', (altsatir.get('kiz') / altsonuc * 100).toFixed(2));
					//altsatir.set('erkekoran', (altsatir.get('erkek')/altsonuc * 100).toFixed(2));
					
					for (i=0;i<toplamsatir;i++){
							var oranlar=grid.getStore().getAt(i);
							var kizerkektoplami=grid.getStore().getAt(i).get('kiz')+grid.getStore().getAt(i).get('erkek');						
							oranlar.set('okuloran', (kizerkektoplami / ustsonuc * 100).toFixed(2));
					}
					grid.getStore().commitChanges(); 
			}
        }, 
        title:'Risk faktörlerine göre öðrenci sayýlarý ve oranlarý',
             
           tbar: [{
           
      
            text: 'Kaydet',
            
            iconCls:'save',
            handler : function(){
                                       //alert('ya Âlîm Allah');
                                  
                                  //alert( grid.getStore().getAt(1).get('etkinlikkonusu'));
                                  //alert(grid.getStore().getCount());
                                  //GRID ÝÇÝN KAYIT:
                                var satir=0;
                                if (grid.getStore().getCount()==0) return;

                                var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `riskverisi`, `kiz`, `erkek`, `kizoran`, `erkekoran`, `okultoplam`, `okuloran`, `okulturu`) VALUES';
                                  
                                var sqlgovde="";
                                var eklendisatir=false;
                                while (satir< grid.getStore().getCount()){
									  var gridsatir=grid.getStore().getAt(satir);
									  //if (parseInt(gridsatir.get('okuloran'))!=0)  {
									  
                          var ekleneceksatir="("+kurumkodu+",'"+                          
                          tem(gridsatir.get('riskverisi'))+"','"+ 
                          gridsatir.get('kiz')+"','"+ 
                          gridsatir.get('erkek')+"','"+ 
						  gridsatir.get('kizoran')+"','"+ 
                          gridsatir.get('erkekoran')+"','"+
						  gridsatir.get('okultoplam')+"','"+
						  gridsatir.get('okuloran')+"','"+
                          okulturu+"'),\n";
                          
                          sqlgovde=sqlgovde+ekleneceksatir;
                          var eklendisatir=true;
									 // }
									  satir++;
                                }
                                if (eklendisatir==false) return;
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
                                    
                                   
                                           
                              }
            
     },{
         text : 'Ana sayfa',
         iconCls : 'klasor',
         handler : function (){
                 window.parent.tabs2.activate('0');

        }

    }]
});
    

 
 
 
});
   