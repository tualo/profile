Ext.define('Ext.cmp.cmp_profile.Viewport', {
  extend: 'Ext.panel.Panel',
  requires: [
    'Ext.cmp.cmp_profile.models.Viewport',
    'Ext.cmp.cmp_profile.controller.Viewport'

  ],
  layout: 'fit',
  listeners: {
    boxReady: 'onBoxReady',
    resize: 'onResize'
  },
  controller: 'cmp_profile_viewport',
  viewModel: {
      type: 'cmp_profile_viewport'
  },
  title: 'Profil',
  buttons:[
    {
      text: 'Speichern',
      handler: 'save',
      bind: {
        disabled: '{notsaveable}'
      }
    }
  ],
  items: [
    /*
    {
      xtype: 'tualowizzard'
    },
    */
    {
      xtype: 'form',
      reference: 'form',
      bodyPadding: 25,
      defaults: {
        anchor: '100%',
        labelWidth: 200,
      },
      scrollable: 'y',
      items: [
        {
          xtype: 'fieldset',
          defaults: {
            anchor: '100%',
            labelWidth: 200,
          },
          title: 'Allgemeine Informationen',
          items: [
            {
              xtype: 'textfield',
              bind: '{login}',
              name: 'login',
              readOnly: true,
              fieldLabel: 'Login'
            },{
              xtype: 'textfield',
              bind: '{vorname}',
              name: 'vorname',
              fieldLabel: 'Vorname'
            },
            {
              xtype: 'textfield',
              bind: '{nachname}',
              name: 'nachname',
              fieldLabel: 'Nachname'
            },
            {
              xtype: 'textfield',
              bind: '{email}',
              name: 'email',
              vtype: 'email',
              fieldLabel: 'E-Mail'
            },
            {
              xtype: 'textfield',
              bind: '{telefon}',
              name: 'telefon',
              //vtype: 'phone',
              fieldLabel: 'Telefon'
            },
            {
              xtype: 'textfield',
              bind: '{fax}',
              name: 'fax',
              fieldLabel: 'Fax'
            },
            {
              xtype: 'textfield',
              bind: '{mobile}',
              name: 'mobile',
              fieldLabel: 'Mobiltelefon'
            },
            {
              xtype: 'textfield',
              bind: '{zeichen}',
              name: 'zeichen',
              fieldLabel: 'Zeichen Text'
            }
          ]
        },
        {
          xtype: 'fieldset',
          title: 'Kennwort',
          defaults: {
            anchor: '100%',
            labelWidth: 200,
          },
          items: [
            {
              xtype: 'textfield',
              fieldLabel: 'altes Kennwort',
              bind: '{old_password}',
              name: 'old_password',
              inputType: 'password'
            },
            {
              xtype: 'textfield',
              fieldLabel: 'neues Kennwort',
              bind: '{new_password}',
              name: 'new_password',
              inputType: 'password'
            },
            {
              xtype: 'textfield',
              fieldLabel: 'neues Kennwort (wdh.)',
              bind: '{new_password_rep}',
              name: 'new_password_rep',
              inputType: 'password'
            }
          ]
        }
      ]
    }
  ]
});

/*
Ext.define('Ext.tualo.form.PersonalData', {
	extend: 'Ext.form.Panel',
  title: 'Persönlische Informationen',
	bodyPadding: 25,
  items: [
    {
      xtype: 'textfield',
      name: 'vorname',
      fieldLabel: 'Vorname'
    },
    {
      xtype: 'textfield',
      name: 'nachname',
      fieldLabel: 'Nachname'
    },
    {
      xtype: 'textfield',
      name: 'email',
      vtype: 'email',
      fieldLabel: 'E-Mail'
    }
  ]
})
*/
