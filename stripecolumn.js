Ext.namespace("Ext.ux.plugins");

Ext.ns('Ext.ux.plugins.grid');

Ext.ux.plugins.grid.stripeCols = Ext.extend( Ext.util.Observable, {
    init:        function(grid) {
        grid.getView().afterRender = grid.getView().afterRender.createSequence( this.setCss );
        grid.getView().on('rowsinserted', this.setCss.createDelegate(grid.getView()));
        grid.getView().on('rowremoved', this.setCss.createDelegate(grid.getView()));
        grid.getColumnModel().on('columnmoved', this.setCss.createDelegate(grid.getView()));
        grid.getColumnModel().on('hiddenchange', this.setCss.createDelegate(grid.getView()));
        grid.getView().on('refresh', this.setCss.createDelegate(grid.getView()));
    }
    ,setCss:    function() {
        for(var j = 0; j < this.grid.getStore().getCount(); j++) {
            var markop = 1;
            var r = this.getRow(j);
            if( r ) {
                for(var i = 0; i < this.grid.getColumnModel().getColumnCount(); i++) {
                    var c = this.getCell(j,i);
                    if( this.grid.stripeCols && i % 2 == markop  && ( ! this.grid.excludeCStripe || this.grid.excludeCStripe.indexOf(this.grid.getColumnModel().getDataIndex(i)) == -1 ) ) {
                        if( this.grid.getColumnModel().isHidden(i) || this.grid.skipCStripe && this.grid.skipCStripe.indexOf(this.grid.getColumnModel().getDataIndex(i)) != -1 )
                        {
                            markop ^= 1;
                        } else {
                            if( Ext.Element.get(c) ) {
                                Ext.Element.get(c).addClass('x-grid3-col-alt');
                            }
                        }
                    } else {
                        if( Ext.Element.get(c) ) {
                            Ext.Element.get(c).removeClass('x-grid3-col-alt');
                        }
                    }
                }
            }
        }
    }
});