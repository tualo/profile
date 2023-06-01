Ext.define('Ext.cmp.cmp_profile.views.SetupAuthToken', {
    statics: {
      showInProfileScreen: false,
      profileScreenTitle: 'tualo office apps'
    },
      extend: 'Ext.panel.Panel',
    alias: 'widget.cmp_profile_setupauthtoken',
    listeners: {
      boxReady: function(me){
        Tualo.Ajax.request({
          showWait: true,
          url: './profile/currentclient/oauth',
          scope: this,
          json: function(o){
            this.getComponent('qrp').getComponent('qr').setValue(JSON.stringify({
              url:  window.location.protocol+'//'+ window.location.hostname+''+window.location.pathname,
              token: o.token,
              client: o.client,
              clients: o.clients
            },null,0));
  
          }
        })
      }
    },
    layout: {
      type: 'vbox',
      pack: 'start',
      align: 'stretch'
    },
    items:[
      {
        xtype: 'label',
        html: 'Scannen Sie diesen Code mit Ihrer tualo office app<br>Dieser Code is maximal eine Stunde gültig.'
      },
      {
        xtype: 'panel',
        itemId: 'qrp',
        layout: {
            type: 'hbox',
            pack: 'start',
            align: 'stretch'
        },
        items:[
          {
            itemId: 'qr',
            bodyPadding: '5px',
            xtype: 'tualoqrcode',
            width: 200,
            value: ''
          },
          {
  
            xtype: 'panel',
            html: ''
          }
        ]
  
      }
    ]
  })
  