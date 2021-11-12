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

Ext.BLANK_IMAGE_URL = adres+'ext2/resources/images/default/s.gif';






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
           {name: 'konu'},
           {name: 'olaysayisi',type: 'float'},
           {name: 'karisanogrencisayisi', type: 'float'},
           {name: 'yapilancalismalar'}
       ]);


    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'konu'},
           {name: 'olaysayisi',type: 'float'},
           {name: 'karisanogrencisayisi', type: 'float'},
           {name: 'yapilancalismalar'}
           
        ]
    });
    store.loadData(myData);
    /*{name: 'lastChange', type: 'date', dateFormat: 'n/j h:ia'
renderer: 'usMoney'
/*renderer: Ext.util.Format.dateRenderer('m/d/Y'),*/
/*renderer: pctChange,*/ 
/*renderer: change,*/
var texta= new Ext.grid.GridEditor(new Ext.form.TextArea(), {
	listeners: {
		render: function(ed) {
			ed.resizer = new Ext.Resizable(ed.el.dom, {
				listeners: {
					resize: function(r, w, h, e) {
						ed.field.setSize(w, h);
					}
				}
			});
		},
		show: function(ed) {
			ed.field.setHeight(50);
			var e = ed.field.el;
			ed.resizer.resizeTo(e.getWidth(), e.getHeight());
		}
	}
});

var editcombo=new CustomComboBox({
  typeAhead: true, 
  autocomplete: true, 
  editable:false, 
  triggerAction: 'all',
  transform:'davraniscombo',
  lazyRender:true,
  listClass: 'x-combo-list-small'
}) ;
           
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
            {header: "Konu", id:'konu', width: 110, sortable: true, dataIndex: 'konu', editor: editcombo},
            {header: "Olay sayýsý", width: 20, sortable: true,  dataIndex: 'olaysayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Karýþan öðrenci sayýsý", width: 25, sortable: true,  dataIndex: 'karisanogrencisayisi', editor: new Ext.form.NumberField({allowBlank: false,allowNegative: false, selectOnFocus:true, maxValue: 100000})},
            {header: "Yapýlan çalýþmalar", width: 250, sortable: true, dataIndex: 'yapilancalismalar', editor: texta}

        ]}),
        stripeRows: true,
        height:yukseklik-30,
        width:genislik-20,
        clicksToEdit:1,
        enableColumnMove: true,
        viewConfig: {
        forceFit: true
        },
        title:'Okulda Meydana Gelen Þiddet Olaylarý ve Yapýlan Çalýþmalar',
        tbar: [{
            text: 'Konu Ekle',           
            iconCls:'add',            
            handler : function(){
                var kon= new konu({
                
                    konu: '',
                    olaysayisi:0,
                    karisanogrencisayisi:0,
                    yapilancalismalar:''
                    
                });
                grid.stopEditing();
                store.insert(0, kon);
                grid.startEditing(0, 0);
                grid.getSelectionModel().selectFirstRow();
            }
        },
        {
            text: 'Konu Sil',
            iconCls:'remove',
            handler : function(){
          //  alert('ya Âlîm Allah');
          // grid.getSelectionModel().selectRow(0);
            var record = grid.getSelectionModel().getSelected();
            if (record !== undefined) {
            grid.store.remove(record); }
            }     	
            
        },
        {
            text: 'Kaydet',
            iconCls:'save',
            handler : function(){
                                       //alert('ya Âlîm Allah');
                                  
                                  
                                  var satir=0;
                                  if (grid.getStore().getCount()==0) return;
                                  var sqlbaslangic='INSERT INTO `'+tablo+'` (`kurumkodu`, `konu`, `olaysayisi`, `karisanogrencisayisi`, `yapilancalismalar`) VALUES';
                                  
                                  var sqlgovde="";
                                  while (satir< grid.getStore().getCount())
                                  {
                                  var gridsatir=grid.getStore().getAt(satir);
                                  var ekleneceksatir="("+kurumkodu+",'"+ 
                                  
                                  tem(gridsatir.get('konu'))+"','"+ 
                                  gridsatir.get('olaysayisi')+"','"+
                                  gridsatir.get('karisanogrencisayisi')+"','"+ 
                                  tem(gridsatir.get('yapilancalismalar'))+"'),\n";
                                  
                                  sqlgovde=sqlgovde+ekleneceksatir;
                                  satir++;
                                  }
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
                                            Ext.MessageBox.alert('Durum', sonuc);
                                        }
                                        
								});

                              }
            
    },{
         text : 'Ana sayfa',
         iconCls : 'klasor',
         handler : function (){
                 window.parent.tabs2.activate(0);

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
   