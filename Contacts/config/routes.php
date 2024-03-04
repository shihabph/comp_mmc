<?php

use Cake\Routing\RouteBuilder;
use Croogo\Core\Router;

Router::plugin('Croogo/Contacts', ['path' => '/'], function (RouteBuilder $route) {
    $route->prefix('admin', function (RouteBuilder $route) {
        $route->setExtensions(['json']);
        $route->applyMiddleware('csrf');

        $route->scope('/contacts', [], function (RouteBuilder $route) {
            $route->fallbacks();
        });
    });
    Router::build($route, '/contact', ['controller' => 'Contacts', 'action' => 'view', 'contact']);
    Router::build($route, '/contact/*', ['controller' => 'Contacts', 'action' => 'view']);
    Router::build($route, '/captcha_test/*', ['controller' => 'Contacts', 'action' => 'captchaTest']);

    // Employees Menu
    Router::build($route, '/employees/*', ['controller' => 'Contacts', 'action' => 'employeesList']);
    Router::build($route, '/employees/profile/*', ['controller' => 'Contacts', 'action' => 'employeesProfile']);

    // gallery Menu
    Router::build($route, '/gallery/*', ['controller' => 'Contacts', 'action' => 'Gallery']);
    Router::build($route, '/gallery/view/*', ['controller' => 'Contacts', 'action' => 'viewPhotos']);

    Router::build($route, '/contact', ['controller' => 'Contacts', 'action' => 'view', 'contact']);
    Router::build($route, '/view/', ['controller' => 'Contacts', 'action' => 'view']);
    Router::build($route, '/form_view/', ['controller' => 'Contacts', 'action' => 'formView']);
    Router::build($route, '/admissionform/*', ['controller' => 'Contacts', 'action' => 'admissionform']);
    Router::build($route, '/payment/*', ['controller' => 'Contacts', 'action' => 'payment']);
    Router::build($route, '/admitcard/', ['controller' => 'Contacts', 'action' => 'admitcard']);
    Router::build($route, '/two_taka_search/', ['controller' => 'Contacts', 'action' => 'twoTakaSearch']);
    Router::build($route, '/sid_search', ['controller' => 'Contacts', 'action' => 'sidSearch']);


    Router::build($route, '/tform/*', ['controller' => 'Contacts', 'action' => 'tform']);
    Router::build($route, '/index/*', ['controller' => 'Contacts', 'action' => 'index']);
    Router::build($route, '/search_student/*', ['controller' => 'Contacts', 'action' => 'search']);
    Router::build($route, '/Ajax/getCodeAjax', ['controller' => 'Ajax', 'action' => 'getCodeAjax']);
    Router::build($route, '/Ajax/getSubjectAjax', ['controller' => 'Ajax', 'action' => 'getSubjectAjax']);
    Router::build($route, '/Ajax/getReligionSubjectAjax', ['controller' => 'Ajax', 'action' => 'getReligionSubjectAjax']);
    Router::build($route, '/getSectionAjax', ['controller' => 'Ajax', 'action' => 'getSectionAjax']);
    Router::build($route, '/getLevelSectionAjax', ['controller' => 'Ajax', 'action' => 'getLevelSectionAjax']);

    Router::build($route, '/student_dashboard/', ['controller' => 'Contacts', 'action' => 'studentDashboard']);
    Router::build($route, '/student_dashboard/view_result/*', ['controller' => 'Contacts', 'action' => 'viewResult']);

});

Router::plugin('Croogo/Contacts', ['path' => '/'], function (RouteBuilder $route) {
    $route->setExtensions(['json']);
    $route->applyMiddleware('csrf');
    Router::build($route, '/userLoginAjax', ['controller' => 'Contacts', 'action' => 'userLoginAjax']);
    Router::build($route, '/logout', ['controller' => 'Contacts', 'action' => 'userLogout']);
    Router::build($route, '/student_dashboard/getYearlyAttandanceAjax', ['controller' => 'Contacts', 'action' => 'getYearlyAttandanceAjax']);
});
