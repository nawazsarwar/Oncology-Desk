<?php

Route::view('/', 'welcome');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::post('permissions/parse-csv-import', 'PermissionsController@parseCsvImport')->name('permissions.parseCsvImport');
    Route::post('permissions/process-csv-import', 'PermissionsController@processCsvImport')->name('permissions.processCsvImport');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::post('roles/parse-csv-import', 'RolesController@parseCsvImport')->name('roles.parseCsvImport');
    Route::post('roles/process-csv-import', 'RolesController@processCsvImport')->name('roles.processCsvImport');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Patient Categories
    Route::delete('patient-categories/destroy', 'PatientCategoriesController@massDestroy')->name('patient-categories.massDestroy');
    Route::post('patient-categories/parse-csv-import', 'PatientCategoriesController@parseCsvImport')->name('patient-categories.parseCsvImport');
    Route::post('patient-categories/process-csv-import', 'PatientCategoriesController@processCsvImport')->name('patient-categories.processCsvImport');
    Route::resource('patient-categories', 'PatientCategoriesController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::post('countries/parse-csv-import', 'CountriesController@parseCsvImport')->name('countries.parseCsvImport');
    Route::post('countries/process-csv-import', 'CountriesController@processCsvImport')->name('countries.processCsvImport');
    Route::resource('countries', 'CountriesController');

    // Provinces
    Route::delete('provinces/destroy', 'ProvincesController@massDestroy')->name('provinces.massDestroy');
    Route::post('provinces/parse-csv-import', 'ProvincesController@parseCsvImport')->name('provinces.parseCsvImport');
    Route::post('provinces/process-csv-import', 'ProvincesController@processCsvImport')->name('provinces.processCsvImport');
    Route::resource('provinces', 'ProvincesController');

    // Patient Guardian Relationships
    Route::delete('patient-guardian-relationships/destroy', 'PatientGuardianRelationshipsController@massDestroy')->name('patient-guardian-relationships.massDestroy');
    Route::post('patient-guardian-relationships/parse-csv-import', 'PatientGuardianRelationshipsController@parseCsvImport')->name('patient-guardian-relationships.parseCsvImport');
    Route::post('patient-guardian-relationships/process-csv-import', 'PatientGuardianRelationshipsController@processCsvImport')->name('patient-guardian-relationships.processCsvImport');
    Route::resource('patient-guardian-relationships', 'PatientGuardianRelationshipsController');

    // Postal Codes
    Route::delete('postal-codes/destroy', 'PostalCodesController@massDestroy')->name('postal-codes.massDestroy');
    Route::post('postal-codes/parse-csv-import', 'PostalCodesController@parseCsvImport')->name('postal-codes.parseCsvImport');
    Route::post('postal-codes/process-csv-import', 'PostalCodesController@processCsvImport')->name('postal-codes.processCsvImport');
    Route::resource('postal-codes', 'PostalCodesController');

    // Occupations
    Route::delete('occupations/destroy', 'OccupationsController@massDestroy')->name('occupations.massDestroy');
    Route::post('occupations/parse-csv-import', 'OccupationsController@parseCsvImport')->name('occupations.parseCsvImport');
    Route::post('occupations/process-csv-import', 'OccupationsController@processCsvImport')->name('occupations.processCsvImport');
    Route::resource('occupations', 'OccupationsController');

    // Patient Education Levels
    Route::delete('patient-education-levels/destroy', 'PatientEducationLevelsController@massDestroy')->name('patient-education-levels.massDestroy');
    Route::post('patient-education-levels/parse-csv-import', 'PatientEducationLevelsController@parseCsvImport')->name('patient-education-levels.parseCsvImport');
    Route::post('patient-education-levels/process-csv-import', 'PatientEducationLevelsController@processCsvImport')->name('patient-education-levels.processCsvImport');
    Route::resource('patient-education-levels', 'PatientEducationLevelsController');

    // Patients Income Group
    Route::delete('patients-income-groups/destroy', 'PatientsIncomeGroupController@massDestroy')->name('patients-income-groups.massDestroy');
    Route::post('patients-income-groups/parse-csv-import', 'PatientsIncomeGroupController@parseCsvImport')->name('patients-income-groups.parseCsvImport');
    Route::post('patients-income-groups/process-csv-import', 'PatientsIncomeGroupController@processCsvImport')->name('patients-income-groups.processCsvImport');
    Route::resource('patients-income-groups', 'PatientsIncomeGroupController');

    // Salutations
    Route::delete('salutations/destroy', 'SalutationsController@massDestroy')->name('salutations.massDestroy');
    Route::post('salutations/parse-csv-import', 'SalutationsController@parseCsvImport')->name('salutations.parseCsvImport');
    Route::post('salutations/process-csv-import', 'SalutationsController@processCsvImport')->name('salutations.processCsvImport');
    Route::resource('salutations', 'SalutationsController');

    // Patients
    Route::delete('patients/destroy', 'PatientsController@massDestroy')->name('patients.massDestroy');
    Route::resource('patients', 'PatientsController');

    // Referring Physicians
    Route::delete('referring-physicians/destroy', 'ReferringPhysiciansController@massDestroy')->name('referring-physicians.massDestroy');
    Route::post('referring-physicians/parse-csv-import', 'ReferringPhysiciansController@parseCsvImport')->name('referring-physicians.parseCsvImport');
    Route::post('referring-physicians/process-csv-import', 'ReferringPhysiciansController@processCsvImport')->name('referring-physicians.processCsvImport');
    Route::resource('referring-physicians', 'ReferringPhysiciansController');

    // Facilities
    Route::delete('facilities/destroy', 'FacilitiesController@massDestroy')->name('facilities.massDestroy');
    Route::resource('facilities', 'FacilitiesController');

    // Modalities
    Route::delete('modalities/destroy', 'ModalitiesController@massDestroy')->name('modalities.massDestroy');
    Route::post('modalities/media', 'ModalitiesController@storeMedia')->name('modalities.storeMedia');
    Route::post('modalities/ckmedia', 'ModalitiesController@storeCKEditorImages')->name('modalities.storeCKEditorImages');
    Route::resource('modalities', 'ModalitiesController');

    // Appointments Statusses
    Route::delete('appointments-statusses/destroy', 'AppointmentsStatussesController@massDestroy')->name('appointments-statusses.massDestroy');
    Route::post('appointments-statusses/parse-csv-import', 'AppointmentsStatussesController@parseCsvImport')->name('appointments-statusses.parseCsvImport');
    Route::post('appointments-statusses/process-csv-import', 'AppointmentsStatussesController@processCsvImport')->name('appointments-statusses.processCsvImport');
    Route::resource('appointments-statusses', 'AppointmentsStatussesController');

    // Priority Levels
    Route::delete('priority-levels/destroy', 'PriorityLevelsController@massDestroy')->name('priority-levels.massDestroy');
    Route::post('priority-levels/parse-csv-import', 'PriorityLevelsController@parseCsvImport')->name('priority-levels.parseCsvImport');
    Route::post('priority-levels/process-csv-import', 'PriorityLevelsController@processCsvImport')->name('priority-levels.processCsvImport');
    Route::resource('priority-levels', 'PriorityLevelsController');

    // Studies
    Route::delete('studies/destroy', 'StudiesController@massDestroy')->name('studies.massDestroy');
    Route::resource('studies', 'StudiesController');

    // Appointments
    Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
    Route::post('appointments/media', 'AppointmentsController@storeMedia')->name('appointments.storeMedia');
    Route::post('appointments/ckmedia', 'AppointmentsController@storeCKEditorImages')->name('appointments.storeCKEditorImages');
    Route::resource('appointments', 'AppointmentsController');

    // Report Templates
    Route::delete('report-templates/destroy', 'ReportTemplatesController@massDestroy')->name('report-templates.massDestroy');
    Route::post('report-templates/media', 'ReportTemplatesController@storeMedia')->name('report-templates.storeMedia');
    Route::post('report-templates/ckmedia', 'ReportTemplatesController@storeCKEditorImages')->name('report-templates.storeCKEditorImages');
    Route::resource('report-templates', 'ReportTemplatesController');

    // Report Statusses
    Route::delete('report-statusses/destroy', 'ReportStatussesController@massDestroy')->name('report-statusses.massDestroy');
    Route::post('report-statusses/parse-csv-import', 'ReportStatussesController@parseCsvImport')->name('report-statusses.parseCsvImport');
    Route::post('report-statusses/process-csv-import', 'ReportStatussesController@processCsvImport')->name('report-statusses.processCsvImport');
    Route::resource('report-statusses', 'ReportStatussesController');

    // Tags
    Route::delete('tags/destroy', 'TagsController@massDestroy')->name('tags.massDestroy');
    Route::resource('tags', 'TagsController');

    // Reports
    Route::delete('reports/destroy', 'ReportsController@massDestroy')->name('reports.massDestroy');
    Route::post('reports/media', 'ReportsController@storeMedia')->name('reports.storeMedia');
    Route::post('reports/ckmedia', 'ReportsController@storeCKEditorImages')->name('reports.storeCKEditorImages');
    Route::resource('reports', 'ReportsController');

    // Comments
    Route::delete('comments/destroy', 'CommentsController@massDestroy')->name('comments.massDestroy');
    Route::post('comments/media', 'CommentsController@storeMedia')->name('comments.storeMedia');
    Route::post('comments/ckmedia', 'CommentsController@storeCKEditorImages')->name('comments.storeCKEditorImages');
    Route::resource('comments', 'CommentsController');

    // Transaction Types
    Route::delete('transaction-types/destroy', 'TransactionTypesController@massDestroy')->name('transaction-types.massDestroy');
    Route::post('transaction-types/parse-csv-import', 'TransactionTypesController@parseCsvImport')->name('transaction-types.parseCsvImport');
    Route::post('transaction-types/process-csv-import', 'TransactionTypesController@processCsvImport')->name('transaction-types.processCsvImport');
    Route::resource('transaction-types', 'TransactionTypesController');

    // Transactions
    Route::delete('transactions/destroy', 'TransactionsController@massDestroy')->name('transactions.massDestroy');
    Route::resource('transactions', 'TransactionsController');

    // Appointments Type
    Route::delete('appointments-types/destroy', 'AppointmentsTypeController@massDestroy')->name('appointments-types.massDestroy');
    Route::post('appointments-types/parse-csv-import', 'AppointmentsTypeController@parseCsvImport')->name('appointments-types.parseCsvImport');
    Route::post('appointments-types/process-csv-import', 'AppointmentsTypeController@processCsvImport')->name('appointments-types.processCsvImport');
    Route::resource('appointments-types', 'AppointmentsTypeController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Patient Categories
    Route::delete('patient-categories/destroy', 'PatientCategoriesController@massDestroy')->name('patient-categories.massDestroy');
    Route::resource('patient-categories', 'PatientCategoriesController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountriesController');

    // Provinces
    Route::delete('provinces/destroy', 'ProvincesController@massDestroy')->name('provinces.massDestroy');
    Route::resource('provinces', 'ProvincesController');

    // Patient Guardian Relationships
    Route::delete('patient-guardian-relationships/destroy', 'PatientGuardianRelationshipsController@massDestroy')->name('patient-guardian-relationships.massDestroy');
    Route::resource('patient-guardian-relationships', 'PatientGuardianRelationshipsController');

    // Postal Codes
    Route::delete('postal-codes/destroy', 'PostalCodesController@massDestroy')->name('postal-codes.massDestroy');
    Route::resource('postal-codes', 'PostalCodesController');

    // Occupations
    Route::delete('occupations/destroy', 'OccupationsController@massDestroy')->name('occupations.massDestroy');
    Route::resource('occupations', 'OccupationsController');

    // Patient Education Levels
    Route::delete('patient-education-levels/destroy', 'PatientEducationLevelsController@massDestroy')->name('patient-education-levels.massDestroy');
    Route::resource('patient-education-levels', 'PatientEducationLevelsController');

    // Patients Income Group
    Route::delete('patients-income-groups/destroy', 'PatientsIncomeGroupController@massDestroy')->name('patients-income-groups.massDestroy');
    Route::resource('patients-income-groups', 'PatientsIncomeGroupController');

    // Salutations
    Route::delete('salutations/destroy', 'SalutationsController@massDestroy')->name('salutations.massDestroy');
    Route::resource('salutations', 'SalutationsController');

    // Patients
    Route::delete('patients/destroy', 'PatientsController@massDestroy')->name('patients.massDestroy');
    Route::resource('patients', 'PatientsController');

    // Referring Physicians
    Route::delete('referring-physicians/destroy', 'ReferringPhysiciansController@massDestroy')->name('referring-physicians.massDestroy');
    Route::resource('referring-physicians', 'ReferringPhysiciansController');

    // Facilities
    Route::delete('facilities/destroy', 'FacilitiesController@massDestroy')->name('facilities.massDestroy');
    Route::resource('facilities', 'FacilitiesController');

    // Modalities
    Route::delete('modalities/destroy', 'ModalitiesController@massDestroy')->name('modalities.massDestroy');
    Route::post('modalities/media', 'ModalitiesController@storeMedia')->name('modalities.storeMedia');
    Route::post('modalities/ckmedia', 'ModalitiesController@storeCKEditorImages')->name('modalities.storeCKEditorImages');
    Route::resource('modalities', 'ModalitiesController');

    // Appointments Statusses
    Route::delete('appointments-statusses/destroy', 'AppointmentsStatussesController@massDestroy')->name('appointments-statusses.massDestroy');
    Route::resource('appointments-statusses', 'AppointmentsStatussesController');

    // Priority Levels
    Route::delete('priority-levels/destroy', 'PriorityLevelsController@massDestroy')->name('priority-levels.massDestroy');
    Route::resource('priority-levels', 'PriorityLevelsController');

    // Studies
    Route::delete('studies/destroy', 'StudiesController@massDestroy')->name('studies.massDestroy');
    Route::resource('studies', 'StudiesController');

    // Appointments
    Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
    Route::post('appointments/media', 'AppointmentsController@storeMedia')->name('appointments.storeMedia');
    Route::post('appointments/ckmedia', 'AppointmentsController@storeCKEditorImages')->name('appointments.storeCKEditorImages');
    Route::resource('appointments', 'AppointmentsController');

    // Report Templates
    Route::delete('report-templates/destroy', 'ReportTemplatesController@massDestroy')->name('report-templates.massDestroy');
    Route::post('report-templates/media', 'ReportTemplatesController@storeMedia')->name('report-templates.storeMedia');
    Route::post('report-templates/ckmedia', 'ReportTemplatesController@storeCKEditorImages')->name('report-templates.storeCKEditorImages');
    Route::resource('report-templates', 'ReportTemplatesController');

    // Report Statusses
    Route::delete('report-statusses/destroy', 'ReportStatussesController@massDestroy')->name('report-statusses.massDestroy');
    Route::resource('report-statusses', 'ReportStatussesController');

    // Tags
    Route::delete('tags/destroy', 'TagsController@massDestroy')->name('tags.massDestroy');
    Route::resource('tags', 'TagsController');

    // Reports
    Route::delete('reports/destroy', 'ReportsController@massDestroy')->name('reports.massDestroy');
    Route::post('reports/media', 'ReportsController@storeMedia')->name('reports.storeMedia');
    Route::post('reports/ckmedia', 'ReportsController@storeCKEditorImages')->name('reports.storeCKEditorImages');
    Route::resource('reports', 'ReportsController');

    // Comments
    Route::delete('comments/destroy', 'CommentsController@massDestroy')->name('comments.massDestroy');
    Route::post('comments/media', 'CommentsController@storeMedia')->name('comments.storeMedia');
    Route::post('comments/ckmedia', 'CommentsController@storeCKEditorImages')->name('comments.storeCKEditorImages');
    Route::resource('comments', 'CommentsController');

    // Transaction Types
    Route::delete('transaction-types/destroy', 'TransactionTypesController@massDestroy')->name('transaction-types.massDestroy');
    Route::resource('transaction-types', 'TransactionTypesController');

    // Transactions
    Route::delete('transactions/destroy', 'TransactionsController@massDestroy')->name('transactions.massDestroy');
    Route::resource('transactions', 'TransactionsController');

    // Appointments Type
    Route::delete('appointments-types/destroy', 'AppointmentsTypeController@massDestroy')->name('appointments-types.massDestroy');
    Route::resource('appointments-types', 'AppointmentsTypeController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
