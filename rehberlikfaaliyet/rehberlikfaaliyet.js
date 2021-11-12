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


function ogretimyili(){
var d=new Date();
if (d.getMonth()<9) {
     return d.getFullYear()-1+"-"+d.getFullYear()     
}else{
     return d.getFullYear()+"-"+d.getFullYear()+1     
}

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
/*
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

*/

    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'yapilanfaaliyetinturu'},
           {name: 'ozelegitimogretmen',type: 'float'},
           {name: 'ozelegitimogrenci', type: 'float'},
           {name: 'ozelegitimveli', type: 'float'},
           {name: 'ilkokulogretmen',type: 'float'},
           {name: 'ilkokulogrenci', type: 'float'},
           {name: 'ilkokulveli', type: 'float'},
           {name: 'ortaokulogretmen',type: 'float'},
           {name: 'ortaokulogrenci', type: 'float'},
           {name: 'ortaokulveli', type: 'float'},
           {name: 'liseogretmen',type: 'float'},
           {name: 'liseogrenci', type: 'float'},
           {name: 'liseveli', type: 'float'},
           {name: 'toplamogretmen',type: 'float'},
           {name: 'toplamogrenci', type: 'float'},
           {name: 'toplamveli', type: 'float'}
           
           
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
//    if (!yukseklik) yukseklik=600;
//    if (!genislik) genislik=850;
   var baslik=ogretimyili()+" Eðitim-Öðretim Yýlý";
   
    var grid = new Ext.grid.EditorGridPanel({
        store: store,
        renderTo: 'grid-bolgesi',
        sm: sm,
		plugins: [new Ext.ux.plugins.GroupHeaderGrid()],   
        colModel: new Ext.grid.ColumnModel({
         columns: [
            {header: "Yapýlan Faaliyetin Türü", id:'yapilanfaaliyetinturu', width: 100, sortable: false, dataIndex: 'yapilanfaaliyetinturu'},
            {header: "Öðretmen", width: 70, sortable: false,  dataIndex: 'ozelegitimogretmen',  editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Öðrenci", width: 70, sortable: false,  dataIndex: 'ozelegitimogrenci', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Veli", width: 70, sortable: false, dataIndex: 'ozelegitimveli', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Öðretmen", width: 70, sortable: false,  dataIndex: 'ilkokulogretmen',  editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Öðrenci", width: 70, sortable: false,  dataIndex: 'ilkokulogrenci', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Veli", width: 70, sortable: false, dataIndex: 'ilkokulveli', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Öðretmen", width: 70, sortable: false,  dataIndex: 'ortaokulogretmen',  editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Öðrenci", width: 70, sortable: false,  dataIndex: 'ortaokulogrenci', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Veli", width: 70, sortable: false, dataIndex: 'ortaokulveli', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Öðretmen", width: 70, sortable: false,  dataIndex: 'liseogretmen',  editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Öðrenci", width: 70, sortable: false,  dataIndex: 'liseogrenci', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Veli", width: 70, sortable: false, dataIndex: 'liseveli', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Öðretmen", width: 70, sortable: false, dataIndex: 'toplamogretmen'},
            {header: "Öðrenci", width: 70, sortable: false, dataIndex: 'toplamogrenci'},
            {header: "Veli", width: 70, sortable: false, dataIndex: 'toplamveli'}
			
			],
			rows: [
					[
						{},
						{header: baslik, colspan: 12, align: 'center'},						
						{header: 'Toplam', colspan: 3, align: 'center'}						
					], [
						{},						
						{header: 'Özel Eðitim Okulu', colspan: 3, align: 'center'},
						{header: 'Ýlkokul', colspan: 3, align: 'center'},
						{header: 'Ortaokul', colspan: 3, align: 'center'},
						{header: 'Ortaöðretim', colspan: 3, align: 'center'},
						{},
						{},
						{}												
					]
				]
			}),
        stripeRows: true,
       // autoExpandColumn: 'etkinlikturu',
        height:yukseklik-80,
        width:genislik,
        clicksToEdit:1,
        enableColumnMove: false,
			viewConfig: {
				forceFit: true
			},
		     
		listeners: {
		
               
			afteredit : function(object) {
			// otomatik topla:
			var gridsatir=grid.getStore().getAt(object.row);
			var ogretmensonuc=gridsatir.get('ozelegitimogretmen')+gridsatir.get('ilkokulogretmen')+gridsatir.get('ortaokulogretmen')+gridsatir.get('liseogretmen');  
					  gridsatir.set('toplamogretmen',ogretmensonuc);
			var ogrencisonuc=gridsatir.get('ozelegitimogrenci')+gridsatir.get('ilkokulogrenci')+gridsatir.get('ortaokulogrenci')+gridsatir.get('liseogrenci');  
					  gridsatir.set('toplamogrenci',ogrencisonuc);
			var velisonuc=gridsatir.get('ozelegitimveli')+gridsatir.get('ilkokulveli')+gridsatir.get('ortaokulveli')+gridsatir.get('liseveli');  
					  gridsatir.set('toplamveli',velisonuc);
					  
					  grid.getStore().commitChanges();
             
			}
        }, 
        title:'Rehberlik Faaliyetleri Tablosu',
             
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

                                var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `yapilanfaaliyetinturu`, `ozelegitimogretmen`, `ozelegitimogrenci`, `ozelegitimveli`, `ilkokulogretmen`, `ilkokulogrenci`, `ilkokulveli`, `ortaokulogretmen`, `ortaokulogrenci`, `ortaokulveli`, `liseogretmen`, `liseogrenci`, `liseveli`, `toplamogretmen`, `toplamogrenci`, `toplamveli`) VALUES';
                                  
                                var sqlgovde="";
                                var eklendisatir=false;
                                while (satir< grid.getStore().getCount()){
									  var gridsatir=grid.getStore().getAt(satir);
									  //if (parseInt(gridsatir.get('okuloran'))!=0)  {
									  
                          var ekleneceksatir="("+kurumkodu+",'"+                          
                         tem(gridsatir.get('yapilanfaaliyetinturu'))+"','"+ 
                         gridsatir.get('ozelegitimogretmen')+"','"+ 
                         gridsatir.get('ozelegitimogrenci')+"','"+ 
                         gridsatir.get('ozelegitimveli')+"','"+ 
                         gridsatir.get('ilkokulogretmen')+"','"+ 
                         gridsatir.get('ilkokulogrenci')+"','"+ 
                         gridsatir.get('ilkokulveli')+"','"+ 
                         gridsatir.get('ortaokulogretmen')+"','"+ 
                         gridsatir.get('ortaokulogrenci')+"','"+ 
                         gridsatir.get('ortaokulveli')+"','"+ 
                         gridsatir.get('liseogretmen')+"','"+ 
                         gridsatir.get('liseogrenci')+"','"+ 
                         gridsatir.get('liseveli')+"','"+ 
                         gridsatir.get('toplamogretmen')+"','"+ 
                         gridsatir.get('toplamogrenci')+"','"+ 
                         gridsatir.get('toplamveli')+"'),\n";
                          
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
   