<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/



/***************PAGE OK**************/
// category
$route['create_category'] = 'category_controller/create_category';
$route['admin/all_categories'] = 'category_controller/get_all_categories';
$route['get_one_category/(:any)'] = 'category_controller/get_category/$1';
$route['update_category/(:any)'] = 'category_controller/update_category/$1';
// page asso

// page ok 
$route['association'] = 'asso_controller/get_all_activ';
// static page
$route['static/getAll'] = 'staticPage_controller/get_all';
$route['static/getById/(:any)'] = 'staticPage_controller/get_by_id/$1';
$route['static/delete/(:any)'] = 'staticPage_controller/delete_staticPage/$1';
$route['static/create'] = 'staticPage_controller/create_staticPage';
$route['static/update/(:any)'] = 'staticPage_controller/update_staticPage/$1';
// faq
$route['static/faq'] = 'faq_page_controller/get_all_faq';
$route['static/faq/(:any)'] = 'faq_page_controller/get_faq_by_id/$1';
$route['static/delete_faq/(:any)'] = 'faq_page_controller/delete_faq/$1';
// event
$route['events/view_event/(:any)'] = 'event_controller/get_event/$1';
$route['evenements'] = 'event_controller/all_events_validated';
$route['evenement_cree'] = 'event_controller/success_create_event';
$route['get_event_archive'] = 'event_controller/get_event_archive';
// user
$route['erreur'] = 'user_controller/error_connexion';
$route['inscription'] = 'user_controller/create_user';
$route['connexion'] = 'user_controller/login';
$route['success_create'] = 'user_controller/success_create_user';
// mail
$route['forget'] = 'mail_controller/pw_forget';
$route['mail/reset/(:any)'] = 'mail_controller/reset_pw/$1';
// mon compte
$route['mon_compte'] = 'monCompte_controller/get_event_by_id_user';
$route['success_edit_pw'] = 'monCompte_controller/success_edit_pw';
$route['archiver_user'] = 'monCompte_controller/delete_user';
$route['modification/(:any)'] = 'monCompte_controller/update_user/$1';
$route['modif_techno'] = 'monCompte_controller/update_techno';

//  techno
$route['admin/create_techno'] = 'techno_controller/create_techno';
$route['admin/all_technos'] = 'techno_controller/get_all_technos';
$route['admin/get_one_techno/(:any)'] = 'techno_controller/get_techno/$1';
$route['admin/update_techno/(:any)'] = 'techno_controller/update_techno/$1';

//  category
$route['admin/create_category'] = 'category_controller/create_category';
$route['admin/all_categories'] = 'category_controller/get_all_categories';
$route['admin/get_one_category/(:any)'] = 'category_controller/get_category/$1';
$route['admin/update_category/(:any)'] = 'category_controller/update_category/$1';

// admin
$route['admin/edit_event/(:any)'] = 'admin_controller/update_event/$1';

$route['dashboard'] = 'admin_controller/get_all_user';
$route['admin/valider_event/(:any)'] = 'admin_controller/validated/$1';
$route['admin/archiver_event/(:any)'] = 'admin_controller/archive_event/$1';
$route['admin/activer_event/(:any)'] = 'admin_controller/active/$1';
$route['admin/refuser_event/(:any)'] = 'admin_controller/refus_event/$1';
$route['admin/actif_user/(:any)'] = 'admin_controller/actif_user/$1';
$route['admin/archive_user/(:any)'] = 'admin_controller/delete_user/$1';
$route['admin/create_faq'] = 'faq_page_controller/create_faq';
$route['admin/update_faq/(:any)'] = 'faq_page_controller/update_faq/$1';
$route['admin/member_user/(:any)'] = 'admin_controller/admin/$1';
$route['admin/admin_user/(:any)'] = 'admin_controller/member/$1';







/********************************************************************/
/********************************************************************/
/********************************************************************/


$route['nous_contacter'] = 'mail_controller/mail';


$route['slack'] = 'slack_controller/envoie_message';

$route['admin/validate_events'] = 'admin_controller/get_events_not_validated';
$route['admin/validate/(:any)'] = 'admin_controller/validate/$1';
$route['admin/archive/(:any)'] = 'admin_controller/archive/$1';
$route['admin/get_all_events'] = 'admin_controller/get_all_events';
$route['admin/get_one_event/(:any)'] = 'admin_controller/get_one_event/$1';
//  $route['admin/edit_event/(:any)'] = 'admin_controller/update_event/$1';
$route['admin/create_event'] = 'admin_controller/add_event';
$route['admin/delete/(:any)'] = 'admin_controller/delete_event/$1';
$route['admin/archive/(:any)'] = 'event_controller/archive_event/$1';
$route['deconnexion'] = 'admin_controller/log_out';
$route['admin/get_one_user/(:any)'] = 'admin_controller/get_user_by_id/$1';

$route['admin/get_one_user/(:any)'] = 'Admin_controller/get_user_by_id/$1';


// events
$route['events/participer_event/(:any)'] = 'event_controller/get_event/$1';
$route['events/create'] = 'event_controller/add_event';

// users
$route['voir/(:any)'] = 'user_controller/get_by_id/$1';
$route['get_id/(:any)'] = 'user_controller/get_by_id/$1';
$route['get_all'] = 'user_controller/get_all_user';

$route['test'] = 'test_controller/test';

//  $route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['default_controller'] = 'welcome';


