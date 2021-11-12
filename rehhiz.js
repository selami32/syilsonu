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



    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'aciklama'},
			{name:  'ogrencigorusmeleri', type: 'float'},
			{name:  'veligorusmeleri', type: 'float'},
			{name:  'aileveliziyaretleri', type: 'float'},
			{name:  'bireyselpsikolojikdanisma', type: 'float'},
			{name:  'bireyselegitselrehberlik', type: 'float'},
			{name:  'bireyselmeslekirehberlik', type: 'float'},
			{name:  'gruplapsikolojikdanismagrupsayisi', type: 'float'},
			{name:  'gruplapsikolojikdanismaogrencisayisi', type: 'float'},
			{name:  'gruplaegitselrehberlikgrupsayisi', type: 'float'},
			{name:  'gruplaegitselrehberlikogrencisayisi', type: 'float'},
			{name:  'gruplameslekirehberlikgrupsayisi', type: 'float'},
			{name:  'gruplameslekirehberlikogrencisayisi', type: 'float'},			
        ]
    });
    store.loadData(myData);
    /*{name: 'lastChange', type: 'date', dateFormat: 'n/j h:ia'
renderer: 'usMoney'
/*renderer: Ext.util.Format.dateRenderer('m/d/Y'),*/
/*renderer: pctChange,*/ 
/*renderer: change,*/


           
    // create the Grid
    var sm = new Ext.grid.RowSelectionModel();
    
    Ext.grid.RowSelectionModel.override ({
    getSelectedIndex : function(){
        return this.grid.store.indexOf( this.selections.itemAt(0) );
    }
    });
    
    var grid = new Ext.grid.EditorGridPanel({
        store: store,
        renderTo: 'grid-bolgesi',
        sm: sm,
        colModel: new Ext.grid.ColumnModel({
         columns: [
            {id:'aciklama', header: " ", width: 150, dataIndex: 'aciklama' },
            {header:  'Öðrenci \nGörüþmeleri', width: 70, sortable: false,  dataIndex: 'ogrencigorusmeleri', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
			{header: 'Veli görüþmeleri', width: 70, sortable: false,  dataIndex:'veligorusmeleri', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
			{header: 'Aile Veli Ziyaretleri', width: 70, sortable: false,  dataIndex:'aileveliziyaretleri', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
			{header: 'Bireysel Psikolojik Danýþma', width: 65, sortable: false,  dataIndex:'bireyselpsikolojikdanisma', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
			{header: 'Bireysel Eðitsel Rehberlik', width: 65, sortable: false,  dataIndex:'bireyselegitselrehberlik', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
			{header: 'Bireysel Mesleki Rehberlik', width: 65, sortable: false,  dataIndex:'bireyselmeslekirehberlik', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
			{header: 'Grup Sayýsý', width: 55, sortable: false,  dataIndex:'gruplapsikolojikdanismagrupsayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
			{header: 'Öðrenci Sayýsý', width: 55, sortable: false,  dataIndex:'gruplapsikolojikdanismaogrencisayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
			{header: 'Grup Sayýsý', width: 55, sortable: false,  dataIndex:'gruplaegitselrehberlikgrupsayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
			{header: 'Öðrenci Sayýsý', width: 55, sortable: false,  dataIndex:'gruplaegitselrehberlikogrencisayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
			{header: 'Grup Sayýsý', width: 55, sortable: false,  dataIndex:'gruplameslekirehberlikgrupsayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
			{header: 'Öðrenci Sayýsý', width: 55, sortable: false,  dataIndex:'gruplameslekirehberlikogrencisayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},

        ],
        defaultSortable: true,        
				rows: [
					[
						{},
						{},						
						{},						
						{},						
						{header: 'Bireysel Rehberlik Hizmetleri', colspan: 3, align: 'center'},						
						{header: 'Grupla Rehberlik Hizmetleri', colspan: 6, align: 'center'}						
					], [
						{},
						{},
						{},
						{},
						{},
						{},
						{},
						{header: 'Grupla Psikolojik Danýþma', colspan: 2, align: 'center'},
						{header: 'Grupla Eðitsel Rehberlik', colspan: 2, align: 'center'},
						{header: 'Grupla Mesleki Rehberlik', colspan: 2, align: 'center'}
					]
				]
			}),
        stripeRows: true,
       // autoExpandColumn: 'etkinlikturu',
        height:300,
        width:genislik,
        clicksToEdit:1,        
        title:'Rehberlik ve Psikolojik Danýþma Hizmeti Verilen Öðrenci veya Bireylere Ýliþkin Hizmetler:',
        enableColumnMove: false,
			viewConfig: {
				forceFit: true
			},
		plugins: [new Ext.ux.plugins.GroupHeaderGrid()],
        tbar: [{        
            text: 'Kaydet',
            iconCls:'save',
            handler : function(){
                                       //alert('ya Âlîm Allah');
                                  
                                  //alert( grid.getStore().getAt(1).get('etkinlikkonusu'));
                                  //alert(grid.getStore().getCount());
                                  
                                  var satir=0;
                                  
                                  var sqlbaslangic='insert into '+tablo+'(`kurumkodu`, `okulunadi`, `ilcesi`, `ogrencigorusmelerianaokulu`, `veligorusmelerianaokulu`, `aileveliziyaretlerianaokulu`, `bireyselpsikolojikdanismaanaokulu`, `bireyselegitselrehberlikanaokulu`, `bireyselmeslekirehberlikanaokulu`, `gruppsikolojigrupsayisianaokulu`, `gruppsikolojiogrencisayisianaokulu`, `gruplaegitselgrupsayisianaokulu`, `gruplaegitselogrencisayisianaokulu`, `gruplameslekigrupsayisianaokulu`, `gruplameslekiogrencisayisianaokulu`, `ogrencigorusmeleriilkokul`, `veligorusmeleriilkokul`, `aileveliziyaretleriilkokul`, `bireyselpsikolojikdanismailkokul`, `bireyselegitselrehberlikilkokul`, `bireyselmeslekirehberlikilkokul`, `gruppsikolojigrupsayisiilkokul`, `gruppsikolojiogrencisayisiilkokul`, `gruplaegitselgrupsayisiilkokul`, `gruplaegitselogrencisayisiilkokul`, `gruplameslekigrupsayisiilkokul`, `gruplameslekiogrencisayisiilkokul`, `ogrencigorusmeleriortaokul`, `veligorusmeleriortaokul`, `aileveliziyaretleriortaokul`, `bireyselpsikolojikdanismaortaokul`, `bireyselegitselrehberlikortaokul`, `bireyselmeslekirehberlikortaokul`, `gruppsikolojigrupsayisiortaokul`, `gruppsikolojiogrencisayisiortaokul`, `gruplaegitselgrupsayisiortaokul`, `gruplaegitselogrencisayisiortaokul`, `gruplameslekigrupsayisiortaokul`, `gruplameslekiogrencisayisiortaokul`, `ogrencigorusmelerilise`, `veligorusmelerilise`, `aileveliziyaretlerilise`, `bireyselpsikolojikdanismalise`, `bireyselegitselrehberliklise`, `bireyselmeslekirehberliklise`, `gruppsikolojigrupsayisilise`, `gruppsikolojiogrencisayisilise`, `gruplaegitselgrupsayisilise`, `gruplaegitselogrencisayisilise`, `gruplameslekigrupsayisilise`, `gruplameslekiogrencisayisilise`) values';
                                  
                                  var sqlgovde="";
                                  var ekleneceksatirorta="";
                                  var ekleneceksatirbas="("+kurumkodu+",'"+okulunadi+"','"+ilcesi+"','";
                                  while (satir< grid.getStore().getCount())
                                  {
                                  var gridsatir=grid.getStore().getAt(satir);
                                  var ekleneceksatirorta=ekleneceksatirorta+ 
                                gridsatir.get( 'ogrencigorusmeleri')+"','"+ 
								gridsatir.get('veligorusmeleri')+"','"+ 
								gridsatir.get('aileveliziyaretleri')+"','"+ 
								gridsatir.get('bireyselpsikolojikdanisma')+"','"+ 
								gridsatir.get('bireyselegitselrehberlik')+"','"+ 
								gridsatir.get('bireyselmeslekirehberlik')+"','"+ 
								gridsatir.get('gruplapsikolojikdanismagrupsayisi')+"','"+ 
								gridsatir.get('gruplapsikolojikdanismaogrencisayisi')+"','"+ 
								gridsatir.get('gruplaegitselrehberlikgrupsayisi')+"','"+ 
								gridsatir.get('gruplaegitselrehberlikogrencisayisi')+"','"+ 
								gridsatir.get('gruplameslekirehberlikgrupsayisi')+"','"+ 
								gridsatir.get('gruplameslekirehberlikogrencisayisi')+"','"; 
                                  
                                  satir++;
                                  }
                                  
                                  ekleneceksatirson=ekleneceksatirbas+ekleneceksatirorta;
                                  
                                  sqlgovde=ekleneceksatirson;

                                  
                                  sqlgovde=sqlbaslangic+sqlgovde.substr(0,sqlgovde.length-3)+"');\n";
                                  
                                // alert(sqlgovde);
                                  
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
    
    // grid.render();
    
         /*       grid.on('rowclick', function(grid, rowIndex, columnIndex, e) {
                //alert( rowIndex +" "+ columnIndex +" "+ e);
            }, this);*/

    //grid.render('document.body');

    grid.getSelectionModel().selectFirstRow();
 
});
   