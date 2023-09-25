<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li>
                    <select class="searchable-field form-control">

                    </select>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('patients_master_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/patients*") ? "menu-open" : "" }} {{ request()->is("admin/occupations*") ? "menu-open" : "" }} {{ request()->is("admin/patient-education-levels*") ? "menu-open" : "" }} {{ request()->is("admin/patients-income-groups*") ? "menu-open" : "" }} {{ request()->is("admin/patient-guardian-relationships*") ? "menu-open" : "" }} {{ request()->is("admin/patient-categories*") ? "menu-open" : "" }} {{ request()->is("admin/salutations*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/patients*") ? "active" : "" }} {{ request()->is("admin/occupations*") ? "active" : "" }} {{ request()->is("admin/patient-education-levels*") ? "active" : "" }} {{ request()->is("admin/patients-income-groups*") ? "active" : "" }} {{ request()->is("admin/patient-guardian-relationships*") ? "active" : "" }} {{ request()->is("admin/patient-categories*") ? "active" : "" }} {{ request()->is("admin/salutations*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-bed">

                            </i>
                            <p>
                                {{ trans('cruds.patientsMaster.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('patient_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.patients.index") }}" class="nav-link {{ request()->is("admin/patients") || request()->is("admin/patients/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bed">

                                        </i>
                                        <p>
                                            {{ trans('cruds.patient.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('occupation_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.occupations.index") }}" class="nav-link {{ request()->is("admin/occupations") || request()->is("admin/occupations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fab fa-servicestack">

                                        </i>
                                        <p>
                                            {{ trans('cruds.occupation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('patient_education_level_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.patient-education-levels.index") }}" class="nav-link {{ request()->is("admin/patient-education-levels") || request()->is("admin/patient-education-levels/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-book">

                                        </i>
                                        <p>
                                            {{ trans('cruds.patientEducationLevel.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('patients_income_group_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.patients-income-groups.index") }}" class="nav-link {{ request()->is("admin/patients-income-groups") || request()->is("admin/patients-income-groups/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-dollar-sign">

                                        </i>
                                        <p>
                                            {{ trans('cruds.patientsIncomeGroup.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('patient_guardian_relationship_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.patient-guardian-relationships.index") }}" class="nav-link {{ request()->is("admin/patient-guardian-relationships") || request()->is("admin/patient-guardian-relationships/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.patientGuardianRelationship.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('patient_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.patient-categories.index") }}" class="nav-link {{ request()->is("admin/patient-categories") || request()->is("admin/patient-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bed">

                                        </i>
                                        <p>
                                            {{ trans('cruds.patientCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('salutation_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.salutations.index") }}" class="nav-link {{ request()->is("admin/salutations") || request()->is("admin/salutations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-secret">

                                        </i>
                                        <p>
                                            {{ trans('cruds.salutation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('appointments_master_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/appointments*") ? "menu-open" : "" }} {{ request()->is("admin/appointments-statusses*") ? "menu-open" : "" }} {{ request()->is("admin/appointments-types*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/appointments*") ? "active" : "" }} {{ request()->is("admin/appointments-statusses*") ? "active" : "" }} {{ request()->is("admin/appointments-types*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-calendar-check">

                            </i>
                            <p>
                                {{ trans('cruds.appointmentsMaster.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('appointment_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.appointments.index") }}" class="nav-link {{ request()->is("admin/appointments") || request()->is("admin/appointments/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-calendar-check">

                                        </i>
                                        <p>
                                            {{ trans('cruds.appointment.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('appointments_statuss_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.appointments-statusses.index") }}" class="nav-link {{ request()->is("admin/appointments-statusses") || request()->is("admin/appointments-statusses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-check-double">

                                        </i>
                                        <p>
                                            {{ trans('cruds.appointmentsStatuss.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('appointments_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.appointments-types.index") }}" class="nav-link {{ request()->is("admin/appointments-types") || request()->is("admin/appointments-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-check-double">

                                        </i>
                                        <p>
                                            {{ trans('cruds.appointmentsType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('reporting_master_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/priority-levels*") ? "menu-open" : "" }} {{ request()->is("admin/reports*") ? "menu-open" : "" }} {{ request()->is("admin/comments*") ? "menu-open" : "" }} {{ request()->is("admin/report-templates*") ? "menu-open" : "" }} {{ request()->is("admin/report-statusses*") ? "menu-open" : "" }} {{ request()->is("admin/tags*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/priority-levels*") ? "active" : "" }} {{ request()->is("admin/reports*") ? "active" : "" }} {{ request()->is("admin/comments*") ? "active" : "" }} {{ request()->is("admin/report-templates*") ? "active" : "" }} {{ request()->is("admin/report-statusses*") ? "active" : "" }} {{ request()->is("admin/tags*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-file-contract">

                            </i>
                            <p>
                                {{ trans('cruds.reportingMaster.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('priority_level_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.priority-levels.index") }}" class="nav-link {{ request()->is("admin/priority-levels") || request()->is("admin/priority-levels/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-list-ol">

                                        </i>
                                        <p>
                                            {{ trans('cruds.priorityLevel.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('report_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.reports.index") }}" class="nav-link {{ request()->is("admin/reports") || request()->is("admin/reports/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-contract">

                                        </i>
                                        <p>
                                            {{ trans('cruds.report.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('comment_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.comments.index") }}" class="nav-link {{ request()->is("admin/comments") || request()->is("admin/comments/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-comment-dots">

                                        </i>
                                        <p>
                                            {{ trans('cruds.comment.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('report_template_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.report-templates.index") }}" class="nav-link {{ request()->is("admin/report-templates") || request()->is("admin/report-templates/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-copy">

                                        </i>
                                        <p>
                                            {{ trans('cruds.reportTemplate.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('report_statuss_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.report-statusses.index") }}" class="nav-link {{ request()->is("admin/report-statusses") || request()->is("admin/report-statusses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-check-double">

                                        </i>
                                        <p>
                                            {{ trans('cruds.reportStatuss.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tags.index") }}" class="nav-link {{ request()->is("admin/tags") || request()->is("admin/tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tags">

                                        </i>
                                        <p>
                                            {{ trans('cruds.tag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('accounting_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/transaction-types*") ? "menu-open" : "" }} {{ request()->is("admin/transactions*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/transaction-types*") ? "active" : "" }} {{ request()->is("admin/transactions*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-chart-line">

                            </i>
                            <p>
                                {{ trans('cruds.accounting.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('transaction_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.transaction-types.index") }}" class="nav-link {{ request()->is("admin/transaction-types") || request()->is("admin/transaction-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-hand-holding-usd">

                                        </i>
                                        <p>
                                            {{ trans('cruds.transactionType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('transaction_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.transactions.index") }}" class="nav-link {{ request()->is("admin/transactions") || request()->is("admin/transactions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.transaction.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('modalities_master_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/modalities*") ? "menu-open" : "" }} {{ request()->is("admin/studies*") ? "menu-open" : "" }} {{ request()->is("admin/referring-physicians*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/modalities*") ? "active" : "" }} {{ request()->is("admin/studies*") ? "active" : "" }} {{ request()->is("admin/referring-physicians*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fab fa-accessible-icon">

                            </i>
                            <p>
                                {{ trans('cruds.modalitiesMaster.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('modality_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.modalities.index") }}" class="nav-link {{ request()->is("admin/modalities") || request()->is("admin/modalities/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fab fa-accessible-icon">

                                        </i>
                                        <p>
                                            {{ trans('cruds.modality.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('study_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.studies.index") }}" class="nav-link {{ request()->is("admin/studies") || request()->is("admin/studies/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-solar-panel">

                                        </i>
                                        <p>
                                            {{ trans('cruds.study.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('referring_physician_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.referring-physicians.index") }}" class="nav-link {{ request()->is("admin/referring-physicians") || request()->is("admin/referring-physicians/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-md">

                                        </i>
                                        <p>
                                            {{ trans('cruds.referringPhysician.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }} {{ request()->is("admin/audit-logs*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('setting_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/facilities*") ? "menu-open" : "" }} {{ request()->is("admin/countries*") ? "menu-open" : "" }} {{ request()->is("admin/provinces*") ? "menu-open" : "" }} {{ request()->is("admin/postal-codes*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/facilities*") ? "active" : "" }} {{ request()->is("admin/countries*") ? "active" : "" }} {{ request()->is("admin/provinces*") ? "active" : "" }} {{ request()->is("admin/postal-codes*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.setting.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('facility_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.facilities.index") }}" class="nav-link {{ request()->is("admin/facilities") || request()->is("admin/facilities/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-x-ray">

                                        </i>
                                        <p>
                                            {{ trans('cruds.facility.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('country_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.countries.index") }}" class="nav-link {{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-flag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.country.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('province_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.provinces.index") }}" class="nav-link {{ request()->is("admin/provinces") || request()->is("admin/provinces/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-compass">

                                        </i>
                                        <p>
                                            {{ trans('cruds.province.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('postal_code_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.postal-codes.index") }}" class="nav-link {{ request()->is("admin/postal-codes") || request()->is("admin/postal-codes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-envelope">

                                        </i>
                                        <p>
                                            {{ trans('cruds.postalCode.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route("admin.systemCalendar") }}" class="nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "active" : "" }}">
                        <i class="fas fa-fw fa-calendar nav-icon">

                        </i>
                        <p>
                            {{ trans('global.systemCalendar') }}
                        </p>
                    </a>
                </li>
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>