<?php
/**
* OpenEyes.
*
* (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
* (C) OpenEyes Foundation, 2011-2013
* This file is part of OpenEyes.
* OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
* OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.
* You should have received a copy of the GNU Affero General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
*
* @link http://www.openeyes.org.uk
*
* @author OpenEyes <info@openeyes.org.uk>
* @copyright Copyright (c) 2011-2013, OpenEyes Foundation
* @license http://www.gnu.org/licenses/agpl-3.0.html The GNU Affero General Public License V3.0
*/

if (file_exists('/etc/openeyes/db.conf')) {
    $db = parse_ini_file('/etc/openeyes/db.conf');
} else {
    $db = array(
        'host' => getenv('DATABASE_HOST') ? getenv('DATABASE_HOST') : '127.0.0.1',
        'port' => getenv('DATABASE_PORT') ? getenv('DATABASE_PORT') : '3306',
        'dbname' => getenv('DATABASE_NAME') ? getenv('DATABASE_NAME') : 'openeyes',
        'username' => getenv('DATABASE_USER') ? getenv('DATABASE_USER') : 'openeyes',
        'password' => getenv('DATABASE_PASS') ? getenv('DATABASE_PASS') : 'openeyes',
    );
}

$config = array(
    'components' => array(
        'db' => array(
            'connectionString' => "mysql:host={$db['host']};port={$db['port']};dbname={$db['dbname']}",
            'username' => $db['username'],
            'password' => $db['password'],
        ),
        'session' => array(
            'timeout' => 86400,
        ),
        'mailer' => array(
            // Setting the mailer mode to null will suppress email
            //'mode' => null
            // Mail can be diverted by setting the divert array
            //'divert' => array('foo@example.org', 'bar@example.org')
        ),
        /*
        'cacheBuster' => array(
            'time' => '2013062101',
        ),
        'log' => array(
            'routes' => array(
                 // SQL logging
                'system' => array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'trace, info, warning, error',
                    'categories' => 'system.db.CDbCommand',
                    'logFile' => 'sql.log',
                ),
                // System logging
                'system' => array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'trace, info, warning, error',
                    'categories' => 'system.*',
                    'logFile' => 'system.log',
                ),
                // Profiling
                'profile' => array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'profile',
                    'logFile' => 'profile.log',
                ),
                // User activity logging
                'user' => array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'user',
                    'logfile' => 'user.log',
                    'filter' => array(
                        'class' => 'CLogFilter',
                        'prefixSession' => false,
                        'prefixUser' => true,
                        'logUser' => true,
                        'logVars' => array('_GET','_POST'),
                    ),
                ),
                // Log to browser
                'browser' => array(
                    'class' => 'CWebLogRoute',
                ),
            ),
        ),
        */
    ),

    'modules' => array(
        'eyedraw',
        'OphCiExamination' => array('class' => '\OEModule\OphCiExamination\OphCiExaminationModule'),
        'OphCoCorrespondence',
        'OphCiPhasing',
        'OphTrIntravitrealinjection',
        'OphCoTherapyapplication',
        'OphDrPrescription',
        'OphTrConsent',
        'OphTrOperationnote',
        'OphTrOperationbooking',
        'OphTrLaser',
        'PatientTicketing' => array('class' => '\OEModule\PatientTicketing\PatientTicketingModule'),
        'OphInVisualfields',
        'OphInBiometry',
        'OphCoMessaging' => array('class' => '\OEModule\OphCoMessaging\OphCoMessagingModule'),
        'OphInLabResults',
        'OphCoCvi' => array('class' => '\OEModule\OphCoCvi\OphCoCviModule'),
        // Uncomment next section if you want to use the genetics module
        // 'OphInDnasample',
        // 'OphInDnaextraction',
        // 'OphInGeneticresults',
        'OphCoDocument',
        'OECaseSearch',
        'OETrial',
        'OphCiDidNotAttend',
    ),

    'params' => array(
        //'pseudonymise_patient_details' => false,
        //'ab_testing' => false,
        'auth_source' => 'BASIC',    // BASIC or LDAP
        // This is used in contact page
        'ldap_server' => 'ldap.example.com',
        //'ldap_port' => '',
        'ldap_admin_dn' => 'CN=openeyes,CN=Users,dc=example,dc=com',
        'ldap_password' => '',
        'ldap_dn' => 'CN=Users,dc=example,dc=com',
        'environment' => 'live',
        'google_analytics_account' => '',
        'local_users' => array('admin', 'username'),
        //'log_events' => true,
        'institution_code' => 'CERA',
        'specialty_codes' => array(130),
        //'default_site_code' => '',
        'specialty_sort' => array(130, 'SUP'),
        'OphCoTherapyapplication_sender_email' => array('email@example.com' => 'Test'),
        // flag to turn on drag and drop sorting for dashboards
        // 'dashboard_sortable' => true
        'event_print_method' => 'pdf',
        'wkhtmltopdf_nice_level' => 19,
        // default start time used for automatic worklist definitions
        //'worklist_default_start_time' => 'H:i',
        // default end time used for automatic worklist definitions
        //'worklist_default_end_time' => 'H:i',
        // number of patients to show on each worklist dashboard render
        //'worklist_default_pagination_size' => int,
        // number of days in the future to retrieve worklists for the automatic dashboard render
        //'worklist_dashboard_future_days' => int,
        // days of the week to be ignored when determining which worklists to render - Mon, Tue etc
        'worklist_dashboard_skip_days' => array('NONE'),
        //how far in advance worklists should be generated for matching
        //'worklist_default_generation_limit' => interval string (e.g. 3 months)
        // override edit checks on definitions so they can always be edited (use at own peril)
        //'worklist_always_allow_definition_edit' => bool
        // whether we should render empty worklists in the dashboard or not
        //'worklist_show_empty' => bool
        // allow duplicate entries on an automatic worklist for a patient
        //'worklist_allow_duplicate_patients' => bool
        // any appointments sent in before this date will not trigger errors when sent in
        //'worklist_ignore_date => 'Y-m-d',
        'portal' => array(
            'uri' => 'http://api.localhost:8000',
            'frontend_url' => 'https://localhost:8000/', #url for the optom portal (read by patient shourtcode [pul])
            'endpoints' => array(
                'auth' => '/oauth/access',
                'examinations' => '/examinations/searches',
                'signatures' => '/signatures/searches'
            ),
            'credentials' => array(
                'username' => 'user@example.com',
                'password' => 'apipass',
                'grant_type' => 'password',
                'client_id' => 'f3d259ddd3ed8ff3843839b',
                'client_secret' => '4c7f6f8fa93d59c45502c0ae8c4a95b',
            ),
        ),
        'signature_app_url' => 'https://dev.oesign.uk',
        'docman_export_dir' => '/tmp/docman',
        'docman_login_url' => 'http://localhost/site/login',
        'docman_user' => 'admin',
        'docman_password' => 'speech advice advantage somehow',
        'docman_print_url' => 'http://localhost/OphCoCorrespondence/default/PDFprint/',
        // possible values:
        // none => XML output is suppressed
        // format1 => OPENEYES_<eventId>_<randomInteger>.pdf [current format, default if parameter not specified]
        // format2 => <hosnum>_<yyyyMMddhhmm>_<eventId>.pdf
        // format3 => <hosnum>_edtdep-OEY_yyyyMMdd_hhmmss_<eventId>.pdf
        'docman_filename_format' => 'format1',
        // set this to none if you want to suppress XML output
        'docman_xml_format' => 'none',
        'contact_labels' => array(
                        'Staff',
                        'Consultant Ophthalmologist',
                        'Other specialist',
                ),
        'general_practitioner_label' => "Referring Practitioner",
        'nhs_num_label' => 'Medicare ID',
        'hos_num_label' => 'CERA ID',
        'pad_hos_num' => '%00s',
        'patient_identifiers' => array(
            'RVEEH_UR' => array(
                'code' => 'RVEEH_UR',
                'label' => 'RVEEH UR',
                'unique' => true,
            )
        ),
        'default_country' => 'Australia',
        'canViewSummary' => true,
        'gp_label' => 'Referring Practitioner',
        'default_patient_import_context' => 'Historic Data Entry',
        'default_patient_import_subspecialty' => 'GL',
        // Copied the menu_bar_items array from core and added the restricted parameter for worklist and analytics because it is not required for CERA.
        'menu_bar_items' => array(
            'admin' => array(
                'title' => 'Admin',
                'uri' => 'admin',
                'position' => 1,
                'restricted' => array('admin'),
            ),
            'audit' => array(
                'title' => 'Audit',
                'uri' => 'audit',
                'position' => 2,
                'restricted' => array('TaskViewAudit'),
            ),
            'reports' => array(
                'title' => 'Reports',
                'uri' => 'report',
                'position' => 3,
                'restricted' => array('Report'),
                'userrule' => 'isSurgeon',
            ),
            'cataract' => array(
                'title' => 'Cataract Audit',
                'uri' => 'dashboard/cataract',
                'position' => 4,
                'userrule' => 'isSurgeon',
                'restricted' => array('admin'),
                'options' => array('target' => '_blank'), ),
            'nodexport' => array(
                'title' => 'NOD Export',
                'uri' => 'NodExport',
                'position' => 5,
                'restricted' => array('NOD Export'),
            ),
            'cxldataset' => array(
                'title' => 'CXL Dataset',
                'uri' => 'CxlDataset',
                'position' => 6,
                'restricted' => array('CXL Dataset'),
            ),
            'patientmergerequest' => array(
                'title' => 'Patient Merge',
                'uri' => 'patientMergeRequest/index',
                'position' => 17,
                'restricted' => array('Patient Merge', 'Patient Merge Request'),
            ),
            'patient' => array(
                'title' => 'Add Patient',
                'uri' => 'patient/create',
                'position' => 46,
                'restricted' => array('TaskAddPatient'),
            ),
            'practices' => array(
                'title' => 'Practices',
                'uri' => 'practice/index',
                'position' => 11,
                'restricted' => array('TaskViewPractice'),
            ),
            'forum' => array(
                'title' => 'FORUM',
                'uri' => "javascript:oelauncher('forum');",
                'requires_setting' => array('setting_key'=>'enable_forum_integration', 'required_value'=>'on'),
                'position' => 90,
            ),
            'disorder' => array(
                'title' => 'Manage Disorders',
                'uri' => "/disorder/index",
                'requires_setting' => array('setting_key'=>'user_add_disorder', 'required_value'=>'on'),
                'position' => 91,
            ),
            'gps' => array(
                'title' => 'Practitioners',
                'uri' => 'gp/index',
                'position' => 10,
                'restricted' => array('TaskViewGp'),
            ),
            'analytics' => array(
                'title' => 'Analytics',
                'uri' => '/Analytics/medicalRetina',
                'position' => 11,
                'restricted' => array(false),
            ),
            'worklist' => array(
                'title' => 'Worklists',
                'uri' => '/worklist',
                'position' => 3,
                'restricted' => array(false),
            ),
            'patient_import' => array(
                'title' => 'Import Patients',
                'uri' => 'csv/upload?context=patients',
                'position' => 47,
                'restricted' => array('admin'),
            ),
        ),
        'exclude_admin_structure_param_list' => array(
            'Worklist',
        ),
    ),
);

return $config;
