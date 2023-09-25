<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.home') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if(Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('frontend.profile.index') }}">{{ __('My profile') }}</a>

                                    @can('patients_master_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.patientsMaster.title') }}
                                        </a>
                                    @endcan
                                    @can('patient_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.patients.index') }}">
                                            {{ trans('cruds.patient.title') }}
                                        </a>
                                    @endcan
                                    @can('occupation_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.occupations.index') }}">
                                            {{ trans('cruds.occupation.title') }}
                                        </a>
                                    @endcan
                                    @can('patient_education_level_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.patient-education-levels.index') }}">
                                            {{ trans('cruds.patientEducationLevel.title') }}
                                        </a>
                                    @endcan
                                    @can('patients_income_group_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.patients-income-groups.index') }}">
                                            {{ trans('cruds.patientsIncomeGroup.title') }}
                                        </a>
                                    @endcan
                                    @can('patient_guardian_relationship_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.patient-guardian-relationships.index') }}">
                                            {{ trans('cruds.patientGuardianRelationship.title') }}
                                        </a>
                                    @endcan
                                    @can('patient_category_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.patient-categories.index') }}">
                                            {{ trans('cruds.patientCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('salutation_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.salutations.index') }}">
                                            {{ trans('cruds.salutation.title') }}
                                        </a>
                                    @endcan
                                    @can('appointments_master_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.appointmentsMaster.title') }}
                                        </a>
                                    @endcan
                                    @can('appointment_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.appointments.index') }}">
                                            {{ trans('cruds.appointment.title') }}
                                        </a>
                                    @endcan
                                    @can('appointments_statuss_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.appointments-statusses.index') }}">
                                            {{ trans('cruds.appointmentsStatuss.title') }}
                                        </a>
                                    @endcan
                                    @can('appointments_type_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.appointments-types.index') }}">
                                            {{ trans('cruds.appointmentsType.title') }}
                                        </a>
                                    @endcan
                                    @can('reporting_master_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.reportingMaster.title') }}
                                        </a>
                                    @endcan
                                    @can('priority_level_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.priority-levels.index') }}">
                                            {{ trans('cruds.priorityLevel.title') }}
                                        </a>
                                    @endcan
                                    @can('report_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.reports.index') }}">
                                            {{ trans('cruds.report.title') }}
                                        </a>
                                    @endcan
                                    @can('comment_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.comments.index') }}">
                                            {{ trans('cruds.comment.title') }}
                                        </a>
                                    @endcan
                                    @can('report_template_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.report-templates.index') }}">
                                            {{ trans('cruds.reportTemplate.title') }}
                                        </a>
                                    @endcan
                                    @can('report_statuss_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.report-statusses.index') }}">
                                            {{ trans('cruds.reportStatuss.title') }}
                                        </a>
                                    @endcan
                                    @can('tag_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.tags.index') }}">
                                            {{ trans('cruds.tag.title') }}
                                        </a>
                                    @endcan
                                    @can('accounting_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.accounting.title') }}
                                        </a>
                                    @endcan
                                    @can('transaction_type_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.transaction-types.index') }}">
                                            {{ trans('cruds.transactionType.title') }}
                                        </a>
                                    @endcan
                                    @can('transaction_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.transactions.index') }}">
                                            {{ trans('cruds.transaction.title') }}
                                        </a>
                                    @endcan
                                    @can('modalities_master_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.modalitiesMaster.title') }}
                                        </a>
                                    @endcan
                                    @can('modality_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.modalities.index') }}">
                                            {{ trans('cruds.modality.title') }}
                                        </a>
                                    @endcan
                                    @can('study_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.studies.index') }}">
                                            {{ trans('cruds.study.title') }}
                                        </a>
                                    @endcan
                                    @can('referring_physician_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.referring-physicians.index') }}">
                                            {{ trans('cruds.referringPhysician.title') }}
                                        </a>
                                    @endcan
                                    @can('user_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.userManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('permission_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.permissions.index') }}">
                                            {{ trans('cruds.permission.title') }}
                                        </a>
                                    @endcan
                                    @can('role_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.roles.index') }}">
                                            {{ trans('cruds.role.title') }}
                                        </a>
                                    @endcan
                                    @can('user_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.users.index') }}">
                                            {{ trans('cruds.user.title') }}
                                        </a>
                                    @endcan
                                    @can('setting_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.setting.title') }}
                                        </a>
                                    @endcan
                                    @can('facility_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.facilities.index') }}">
                                            {{ trans('cruds.facility.title') }}
                                        </a>
                                    @endcan
                                    @can('country_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.countries.index') }}">
                                            {{ trans('cruds.country.title') }}
                                        </a>
                                    @endcan
                                    @can('province_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.provinces.index') }}">
                                            {{ trans('cruds.province.title') }}
                                        </a>
                                    @endcan
                                    @can('postal_code_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.postal-codes.index') }}">
                                            {{ trans('cruds.postalCode.title') }}
                                        </a>
                                    @endcan

                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(session('message'))
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                        </div>
                    </div>
                </div>
            @endif
            @if($errors->count() > 0)
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <ul class="list-unstyled mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('scripts')

</html>