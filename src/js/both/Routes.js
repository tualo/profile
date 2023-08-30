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


Ext.define('Tualo.routes.ProfileLogout',{
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