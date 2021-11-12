Ext.namespace("Ext.ux.plugins");
Ext.ns('Ext.ux.form');

Ext.DatePicker.override({
            update : Ext.DatePicker.prototype.update.createSequence(function(){
                var w = 190;
                this.el.setWidth(w + this.el.getBorderWidth("lr"));
                Ext.fly(this.el.dom.firstChild).setWidth(w);
            })
        });

var localDayNames = ['P','P','S','C','P','C','C'];
var localMonthNames = ['Ocak','Þubat','Mart','Nisan','Mayýs','Haziran','Temmuz','Aðustos','Eyl&#252;l','Ekim','Kasým','Aralýk'];

Ext.override(Ext.DatePicker, {
      todayText : 'Bug&#252;n',
      minText : 'Minimum Tarih',
      maxText : 'Maksimum Tarih',
      disabledDaysText : '',
      disabledDatesText : '',
      monthNames : localMonthNames,
      dayNames : localDayNames,
      nextText : 'Sonraki Ay',
      prevText : '&#214;nceki Ay',
      monthYearText : 'Ay ve Yýl',
      todayTip : '{0} (spacebar)',
      okText : 'Tamam',
      cancelText : 'Ýptal',
      format : 'd/m/Y',
      startDay : 1
});

Ext.ux.form.XDateField = Ext.extend(Ext.form.DateField, {
     submitFormat:'d/m/Y'
    ,onRender:function() {

        // call parent
        Ext.ux.form.XDateField.superclass.onRender.apply(this, arguments);

        var name = this.name || this.el.dom.name;
        this.hiddenField = this.el.insertSibling({
             tag:'input'
            ,type:'hidden'
            ,name:name
            ,value:this.formatHiddenDate(this.parseDate(this.value))
        });
        this.hiddenName = name; // otherwise field is not found by BasicForm::findField
        this.el.dom.removeAttribute('name');
        this.el.on({
             keyup:{scope:this, fn:this.updateHidden}
            ,blur:{scope:this, fn:this.updateHidden}
        }, Ext.isIE ? 'after' : 'before');

        this.setValue = this.setValue.createSequence(this.updateHidden);

    } // eo function onRender

    ,onDisable: function(){
        // call parent
        Ext.ux.form.XDateField.superclass.onDisable.apply(this, arguments);
        if(this.hiddenField) {
            this.hiddenField.dom.setAttribute('disabled','disabled');
        }
    } // of function onDisable

    ,onEnable: function(){
        // call parent
        Ext.ux.form.XDateField.superclass.onEnable.apply(this, arguments);
        if(this.hiddenField) {
            this.hiddenField.dom.removeAttribute('disabled');
        }
    } // eo function onEnable

    ,formatHiddenDate : function(date){
        // return Ext.util.Format.date(date, this.submitFormat);
        if(!Ext.isDate(date)) {
            //return date;
            
            return Ext.util.Format.date(date, this.submitFormat);
            
        }
        if('timestamp' === this.submitFormat) {
            return date.getTime()/1000;
        }
        else {
            return Ext.util.Format.date(date, this.submitFormat);
        }
    }

    ,updateHidden:function() {
        this.hiddenField.dom.value = this.formatHiddenDate(this.getValue());
    } // eo function updateHidden

}); // end of extend

// register xtype
Ext.reg('xdatefield', Ext.ux.form.XDateField);
