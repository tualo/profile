Ext.define('Tualo.profile.lazy.models.ProfilePanel', {
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
    }
});