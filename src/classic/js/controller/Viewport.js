Ext.define('Ext.cmp.cmp_profile.controller.Viewport', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.cmp_profile_viewport',

    onResize: function( me, width, height, oldWidth, oldHeight, eOpts ){

    },
    onBoxReady: function(){
      this.load();
      var form = this.lookupReference('form');

      var panels = [];
      for(var className in Ext.ClassManager.classes){
        if (Ext.ClassManager.classes[className].showInProfileScreen===true){
          panels.push(className);
        }
      }

      panels.forEach( function(className){
        var aliases = Ext.ClassManager.getAliasesByName(className);
        if (aliases.length>0){
          var config = {
            defaults: {
              anchor: '100%',
              labelWidth: 200,
            },
            title: Ext.ClassManager.classes[className].profileScreenTitle,
            items: [
              {
                xtype: aliases[0].replace('widget.','')
              }
            ]
          };
          console.log(JSON.stringify(config,null,3));
          form.add(Ext.create('Ext.form.FieldSet',config));
        }
      } );
      console.log(panels);
    },
    load: function(){
      Tualo.Ajax.request({
        showWait: true,
        scope: this,
        url:'./profile/load',
        json: function(obj){
          if (obj.success){
            this.getViewModel().set(obj.data);
          }else{
            Ext.MessageBox.alert('Achtung',obj.msg);
          }
        }
      });
    },
    save: function(){
      var p = { };
      p = Ext.apply(p,this.lookupReference('form').getForm().getValues());
      Tualo.Ajax.request({
        url:'./profile/save',
        showWait: true,
        scope: this,
        params: p,
        json: function(obj){
          if (obj.success){
            this.getViewModel().set(obj.data);
            Ext.MessageBox.alert('Achtung','Änderung erfolgreich');
          }else{
            Ext.MessageBox.alert('Achtung',obj.msg);
          }
        }
      });
    }

});
