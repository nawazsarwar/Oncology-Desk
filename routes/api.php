<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Patient Categories
    Route::apiResource('patient-categories', 'PatientCategoriesApiController');

    // Countries
    Route::apiResource('countries', 'CountriesApiController');

    // Provinces
    Route::apiResource('provinces', 'ProvincesApiController');

    // Patient Guardian Relationships
    Route::apiResource('patient-guardian-relationships', 'PatientGuardianRelationshipsApiController');

    // Postal Codes
    Route::apiResource('postal-codes', 'PostalCodesApiController');

    // Occupations
    Route::apiResource('occupations', 'OccupationsApiController');

    // Patient Education Levels
    Route::apiResource('patient-education-levels', 'PatientEducationLevelsApiController');

    // Patients Income Group
    Route::apiResource('patients-income-groups', 'PatientsIncomeGroupApiController');

    // Salutations
    Route::apiResource('salutations', 'SalutationsApiController');

    // Patients
    Route::apiResource('patients', 'PatientsApiController');

    // Referring Physicians
    Route::apiResource('referring-physicians', 'ReferringPhysiciansApiController');

    // Facilities
    Route::apiResource('facilities', 'FacilitiesApiController');

    // Modalities
    Route::post('modalities/media', 'ModalitiesApiController@storeMedia')->name('modalities.storeMedia');
    Route::apiResource('modalities', 'ModalitiesApiController');

    // Appointments Statusses
    Route::apiResource('appointments-statusses', 'AppointmentsStatussesApiController');

    // Priority Levels
    Route::apiResource('priority-levels', 'PriorityLevelsApiController');

    // Studies
    Route::apiResource('studies', 'StudiesApiController');

    // Appointments
    Route::post('appointments/media', 'AppointmentsApiController@storeMedia')->name('appointments.storeMedia');
    Route::apiResource('appointments', 'AppointmentsApiController');

    // Report Templates
    Route::post('report-templates/media', 'ReportTemplatesApiController@storeMedia')->name('report-templates.storeMedia');
    Route::apiResource('report-templates', 'ReportTemplatesApiController');

    // Report Statusses
    Route::apiResource('report-statusses', 'ReportStatussesApiController');

    // Tags
    Route::apiResource('tags', 'TagsApiController');

    // Reports
    Route::post('reports/media', 'ReportsApiController@storeMedia')->name('reports.storeMedia');
    Route::apiResource('reports', 'ReportsApiController');

    // Comments
    Route::post('comments/media', 'CommentsApiController@storeMedia')->name('comments.storeMedia');
    Route::apiResource('comments', 'CommentsApiController');

    // Transaction Types
    Route::apiResource('transaction-types', 'TransactionTypesApiController');

    // Transactions
    Route::apiResource('transactions', 'TransactionsApiController');

    // Appointments Type
    Route::apiResource('appointments-types', 'AppointmentsTypeApiController');
});
