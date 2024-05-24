Ext.define('Tualo.profile.lazy.controller.ProfilePanel', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.cmp_profile_viewport',
    boxready: function(){
        var me = this;
        me.query();
    },
    query: async function(){
        let res= await Tualo.Fetch.post('./profile/read',{ });
        this.getView().down('form').getForm().setValues(res.data);
        return res;
    },
    cancel: function(){
        window.history.back();
    },
    logout: function(){
        let fn = async function(){
            let res = await fetch('./logout');
            let o = await res.json();
            if (o.success){
                window.location.replace(  window.location.origin+window.location.pathname );
            }
        }
        fn();
    },
    save: async function(){
        let res= await Tualo.Fetch.post('./profile/save', this.getView().down('form').getForm().getValues() );
        console.log(res);
        if (res.success){
            Ext.toast({
                html: res.msg,
                title: 'OK',
                width: 400,
                align: 't'
            });
        }else{
            Ext.toast({
                html: res.msg,
                title: 'Fehler',
                width: 400,
                align: 't'
            });
        }
        
        return res;
    }

});
