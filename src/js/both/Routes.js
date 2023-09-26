Ext.Loader.setPath('Tualo.profile.lazy', './jsprofile');
Ext.define('Tualo.routes.Profile',{
    statics: {
        load: async function() {
            return [
                {
                    name: 'profile',
                    path: '#profile'
                }
            ]
        }
    }, 
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


Ext.define('Tualo.routes.ProfileLogout',{
    statics: {
        load: async function() {
            return [
                {
                    name: 'profile/logout',
                    path: '#profile/logout'
                }
            ]
        }
    },
    url: 'profile/logout',
    handler: {
        action: function( ){

            
              
            let fn = async function(){
                try{
                    let res = await fetch('./logout');
                    let o = await res.json();
                    if (o.success){
                        window.location.replace(  window.location.origin+window.location.pathname );
                    }
                }catch(e){

                }
            }
            fn();
        },
            
        before: function ( action) {
            action.resume();
            
        }
        
    },
    
    
});