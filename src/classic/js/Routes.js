Ext.define('Tualo.routes.Profile',{
    url: 'profile',
    handler: {
        action: function(type,tablename){
            var view = Ext.getApplication().addView('Ext.cmp.cmp_profile.Viewport'),
        },
            
        before: function (type,tablename,action) {
            action.resume();
            
        }
        
    },
    
    
});