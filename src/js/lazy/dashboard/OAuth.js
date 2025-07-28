Ext.define('Tualo.profile.lazy.dashboard.OAuth', {
    requires: [
        // 'Ext.chart.CartesianChart'
    ],
    extend: 'Ext.dashboard.Part',
    alias: 'part.tualodashboard_profile_oauth',


    viewTemplate: {
        title: 'Open Authentication',

        items: [
            {
                xtype: 'panel',
                layout: 'fit',
                items: [],
                listeners: {
                    boxready: function (me) {
                        var elem = Ext.create('Tualo.DataSets.dsview.View_session_oauth');
                        me.add(elem);
                    }
                }
            }
        ]
    }
});