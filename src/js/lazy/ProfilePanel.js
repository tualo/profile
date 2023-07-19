Ext.define('Tualo.profile.lazy.ProfilePanel', {
    extend: "Ext.panel.Panel",
    bodyPadding: 10,
    requires:[
        'Tualo.profile.lazy.controller.ProfilePanel',
        'Tualo.profile.lazy.models.ProfilePanel'
    ],
    bodyPadding: 10,
    listeners: {
        boxReady: 'boxready'
    },
    controller: 'cmp_profile_viewport',
	viewModel: {
		type: 'cmp_profile_viewport'
	},
    layout: 'fit',
    items: [
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
                        }, {
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
    ],
    bbar: [
        {
            text: 'Abmelden',
            handler: 'logout',
            bind: {
                disabled: '{cancelDisabled}'
            }
        },
        '->',
        {
            text: 'Abbrechen',
            handler: 'cancel',
            bind: {
                disabled: '{cancelDisabled}'
            }
        },/*
        {
            bind: {
                text: '{prevButtonText}',
                disabled: '{prevDisabled}'
            },
            handler: 'prev'
        },*/
        {
            bind: {
                text: 'Speichern',
                disabled: '{nextDisabled}'
            },
            handler: 'save'
        }   
    ]
});