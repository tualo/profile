Ext.Loader.setPath('Tualo.profile.lazy', './jsprofile');
Ext.define('Tualo.routes.Profile',{
    url: 'profile',
    handler: {
        action: function( ){
            var view = Ext.getApplication().addView('Tualo.profile.lazy.ProfilePanel')
        },
            
        before: function ( action) {
            action.resume();
            
        }
        
    },
    
    
});