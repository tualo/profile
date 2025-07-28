delimiter ;

insert
    ignore into dashboard_available_types (xtype, classname, description)
values
    (
        'tualodashboard_profile_oauth',
        'Tualo.profile.lazy.dashboard.OAuth',
        ''
    );

insert
    ignore into dashboard (id, title, dashboard_type, position, configuration)
values
    (
        'tualodashboard_profile_oauth',
        'Open Authentication',
        'tualodashboard_profile_oauth',
        10,
        '{}'
    );