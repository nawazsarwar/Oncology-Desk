<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'patients_master_access',
            ],
            [
                'id'    => 20,
                'title' => 'patient_category_create',
            ],
            [
                'id'    => 21,
                'title' => 'patient_category_edit',
            ],
            [
                'id'    => 22,
                'title' => 'patient_category_show',
            ],
            [
                'id'    => 23,
                'title' => 'patient_category_delete',
            ],
            [
                'id'    => 24,
                'title' => 'patient_category_access',
            ],
            [
                'id'    => 25,
                'title' => 'setting_access',
            ],
            [
                'id'    => 26,
                'title' => 'country_create',
            ],
            [
                'id'    => 27,
                'title' => 'country_edit',
            ],
            [
                'id'    => 28,
                'title' => 'country_show',
            ],
            [
                'id'    => 29,
                'title' => 'country_delete',
            ],
            [
                'id'    => 30,
                'title' => 'country_access',
            ],
            [
                'id'    => 31,
                'title' => 'province_create',
            ],
            [
                'id'    => 32,
                'title' => 'province_edit',
            ],
            [
                'id'    => 33,
                'title' => 'province_show',
            ],
            [
                'id'    => 34,
                'title' => 'province_delete',
            ],
            [
                'id'    => 35,
                'title' => 'province_access',
            ],
            [
                'id'    => 36,
                'title' => 'patient_guardian_relationship_create',
            ],
            [
                'id'    => 37,
                'title' => 'patient_guardian_relationship_edit',
            ],
            [
                'id'    => 38,
                'title' => 'patient_guardian_relationship_show',
            ],
            [
                'id'    => 39,
                'title' => 'patient_guardian_relationship_delete',
            ],
            [
                'id'    => 40,
                'title' => 'patient_guardian_relationship_access',
            ],
            [
                'id'    => 41,
                'title' => 'postal_code_create',
            ],
            [
                'id'    => 42,
                'title' => 'postal_code_edit',
            ],
            [
                'id'    => 43,
                'title' => 'postal_code_show',
            ],
            [
                'id'    => 44,
                'title' => 'postal_code_delete',
            ],
            [
                'id'    => 45,
                'title' => 'postal_code_access',
            ],
            [
                'id'    => 46,
                'title' => 'occupation_create',
            ],
            [
                'id'    => 47,
                'title' => 'occupation_edit',
            ],
            [
                'id'    => 48,
                'title' => 'occupation_show',
            ],
            [
                'id'    => 49,
                'title' => 'occupation_delete',
            ],
            [
                'id'    => 50,
                'title' => 'occupation_access',
            ],
            [
                'id'    => 51,
                'title' => 'patient_education_level_create',
            ],
            [
                'id'    => 52,
                'title' => 'patient_education_level_edit',
            ],
            [
                'id'    => 53,
                'title' => 'patient_education_level_show',
            ],
            [
                'id'    => 54,
                'title' => 'patient_education_level_delete',
            ],
            [
                'id'    => 55,
                'title' => 'patient_education_level_access',
            ],
            [
                'id'    => 56,
                'title' => 'patients_income_group_create',
            ],
            [
                'id'    => 57,
                'title' => 'patients_income_group_edit',
            ],
            [
                'id'    => 58,
                'title' => 'patients_income_group_show',
            ],
            [
                'id'    => 59,
                'title' => 'patients_income_group_delete',
            ],
            [
                'id'    => 60,
                'title' => 'patients_income_group_access',
            ],
            [
                'id'    => 61,
                'title' => 'salutation_create',
            ],
            [
                'id'    => 62,
                'title' => 'salutation_edit',
            ],
            [
                'id'    => 63,
                'title' => 'salutation_show',
            ],
            [
                'id'    => 64,
                'title' => 'salutation_delete',
            ],
            [
                'id'    => 65,
                'title' => 'salutation_access',
            ],
            [
                'id'    => 66,
                'title' => 'patient_create',
            ],
            [
                'id'    => 67,
                'title' => 'patient_edit',
            ],
            [
                'id'    => 68,
                'title' => 'patient_show',
            ],
            [
                'id'    => 69,
                'title' => 'patient_delete',
            ],
            [
                'id'    => 70,
                'title' => 'patient_access',
            ],
            [
                'id'    => 71,
                'title' => 'modalities_master_access',
            ],
            [
                'id'    => 72,
                'title' => 'referring_physician_create',
            ],
            [
                'id'    => 73,
                'title' => 'referring_physician_edit',
            ],
            [
                'id'    => 74,
                'title' => 'referring_physician_show',
            ],
            [
                'id'    => 75,
                'title' => 'referring_physician_delete',
            ],
            [
                'id'    => 76,
                'title' => 'referring_physician_access',
            ],
            [
                'id'    => 77,
                'title' => 'facility_create',
            ],
            [
                'id'    => 78,
                'title' => 'facility_edit',
            ],
            [
                'id'    => 79,
                'title' => 'facility_show',
            ],
            [
                'id'    => 80,
                'title' => 'facility_delete',
            ],
            [
                'id'    => 81,
                'title' => 'facility_access',
            ],
            [
                'id'    => 82,
                'title' => 'modality_create',
            ],
            [
                'id'    => 83,
                'title' => 'modality_edit',
            ],
            [
                'id'    => 84,
                'title' => 'modality_show',
            ],
            [
                'id'    => 85,
                'title' => 'modality_delete',
            ],
            [
                'id'    => 86,
                'title' => 'modality_access',
            ],
            [
                'id'    => 87,
                'title' => 'appointments_master_access',
            ],
            [
                'id'    => 88,
                'title' => 'appointments_statuss_create',
            ],
            [
                'id'    => 89,
                'title' => 'appointments_statuss_edit',
            ],
            [
                'id'    => 90,
                'title' => 'appointments_statuss_show',
            ],
            [
                'id'    => 91,
                'title' => 'appointments_statuss_delete',
            ],
            [
                'id'    => 92,
                'title' => 'appointments_statuss_access',
            ],
            [
                'id'    => 93,
                'title' => 'reporting_master_access',
            ],
            [
                'id'    => 94,
                'title' => 'priority_level_create',
            ],
            [
                'id'    => 95,
                'title' => 'priority_level_edit',
            ],
            [
                'id'    => 96,
                'title' => 'priority_level_show',
            ],
            [
                'id'    => 97,
                'title' => 'priority_level_delete',
            ],
            [
                'id'    => 98,
                'title' => 'priority_level_access',
            ],
            [
                'id'    => 99,
                'title' => 'study_create',
            ],
            [
                'id'    => 100,
                'title' => 'study_edit',
            ],
            [
                'id'    => 101,
                'title' => 'study_show',
            ],
            [
                'id'    => 102,
                'title' => 'study_delete',
            ],
            [
                'id'    => 103,
                'title' => 'study_access',
            ],
            [
                'id'    => 104,
                'title' => 'appointment_create',
            ],
            [
                'id'    => 105,
                'title' => 'appointment_edit',
            ],
            [
                'id'    => 106,
                'title' => 'appointment_show',
            ],
            [
                'id'    => 107,
                'title' => 'appointment_delete',
            ],
            [
                'id'    => 108,
                'title' => 'appointment_access',
            ],
            [
                'id'    => 109,
                'title' => 'report_template_create',
            ],
            [
                'id'    => 110,
                'title' => 'report_template_edit',
            ],
            [
                'id'    => 111,
                'title' => 'report_template_show',
            ],
            [
                'id'    => 112,
                'title' => 'report_template_delete',
            ],
            [
                'id'    => 113,
                'title' => 'report_template_access',
            ],
            [
                'id'    => 114,
                'title' => 'report_statuss_create',
            ],
            [
                'id'    => 115,
                'title' => 'report_statuss_edit',
            ],
            [
                'id'    => 116,
                'title' => 'report_statuss_show',
            ],
            [
                'id'    => 117,
                'title' => 'report_statuss_delete',
            ],
            [
                'id'    => 118,
                'title' => 'report_statuss_access',
            ],
            [
                'id'    => 119,
                'title' => 'tag_create',
            ],
            [
                'id'    => 120,
                'title' => 'tag_edit',
            ],
            [
                'id'    => 121,
                'title' => 'tag_show',
            ],
            [
                'id'    => 122,
                'title' => 'tag_delete',
            ],
            [
                'id'    => 123,
                'title' => 'tag_access',
            ],
            [
                'id'    => 124,
                'title' => 'report_create',
            ],
            [
                'id'    => 125,
                'title' => 'report_edit',
            ],
            [
                'id'    => 126,
                'title' => 'report_show',
            ],
            [
                'id'    => 127,
                'title' => 'report_delete',
            ],
            [
                'id'    => 128,
                'title' => 'report_access',
            ],
            [
                'id'    => 129,
                'title' => 'comment_create',
            ],
            [
                'id'    => 130,
                'title' => 'comment_edit',
            ],
            [
                'id'    => 131,
                'title' => 'comment_show',
            ],
            [
                'id'    => 132,
                'title' => 'comment_delete',
            ],
            [
                'id'    => 133,
                'title' => 'comment_access',
            ],
            [
                'id'    => 134,
                'title' => 'accounting_access',
            ],
            [
                'id'    => 135,
                'title' => 'transaction_type_create',
            ],
            [
                'id'    => 136,
                'title' => 'transaction_type_edit',
            ],
            [
                'id'    => 137,
                'title' => 'transaction_type_show',
            ],
            [
                'id'    => 138,
                'title' => 'transaction_type_delete',
            ],
            [
                'id'    => 139,
                'title' => 'transaction_type_access',
            ],
            [
                'id'    => 140,
                'title' => 'transaction_create',
            ],
            [
                'id'    => 141,
                'title' => 'transaction_edit',
            ],
            [
                'id'    => 142,
                'title' => 'transaction_show',
            ],
            [
                'id'    => 143,
                'title' => 'transaction_delete',
            ],
            [
                'id'    => 144,
                'title' => 'transaction_access',
            ],
            [
                'id'    => 145,
                'title' => 'appointments_type_create',
            ],
            [
                'id'    => 146,
                'title' => 'appointments_type_edit',
            ],
            [
                'id'    => 147,
                'title' => 'appointments_type_show',
            ],
            [
                'id'    => 148,
                'title' => 'appointments_type_delete',
            ],
            [
                'id'    => 149,
                'title' => 'appointments_type_access',
            ],
            [
                'id'    => 150,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
