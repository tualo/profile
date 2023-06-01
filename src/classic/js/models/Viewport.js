Ext.define('Ext.cmp.cmp_profile.models.Viewport', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.cmp_profile_viewport',
    data: {
      login: '',
      vorname: '',
      nachname: '',
      fax: '',
      telefon: '',
      email: '',
      kundenberater: '',
      mobile: '',
      aktiv: '',
      zeichen: '',

      new_password_rep: '',
      new_password: '',
      old_password: ''
    },
    formulas: {
      notsaveable: {

        bind: {
          new_password_rep: '{new_password_rep}',
          new_password: '{new_password}',
          old_password: '{old_password}',
          vorname: '{vorname}',
          nachname: '{nachname}',
          fax: '{fax}',
          telefon: '{telefon}',
          email: '{email}',
          mobile: '{mobile}'
        },

        get: function (data) {
          var b=this.getView().lookupReference('form').getForm().isDirty();
          if (data.new_password_rep !=data.new_password ){
            b=false;
          }
          return !b;
        }

      }
    }
});
