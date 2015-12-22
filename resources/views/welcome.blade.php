<!DOCTYPE html>
<html lang="en" ng-app="useCaseManagement" ng-cloak>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@{{ 'USE_CASE_MANAGEMENT' | translate }}</title>

        <link href="css/bootstrap.css" rel="stylesheet">

        <link href="css/sb-admin.css" rel="stylesheet">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
    </head>

    <body>
        <div id="wrapper">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" ng-controller="LanguageMenuController">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/#/">@{{ 'USE_CASE_MANAGEMENT' | translate }}</a>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li><a href="/#/">@{{ 'DASHBOARD' | translate }}</a></li>
                        <li><a href="/#/application/">@{{ 'APPLICATION' | translate }}</a></li>
                        <li><a href="/#/actors/">@{{ 'ACTORS' | translate }}</a></li>
                        <li><a href="/#/version/">@{{ 'VERSION' | translate }}</a></li>
                        <li><a href="/#/use-case/"></i> @{{ 'USE_CASE' | translate }}</a></li>
                        <li><a href="/#/steps/">@{{ 'STEPS' | translate }}</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown alerts-dropdown">
                            <a ng-href="" class="dropdown-toggle hand" data-toggle="dropdown">
                                <i class="fa fa-long-arrow-down"></i> @{{ 'LANGUAGE' | translate }}
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a ng-href="" ng-click="changeLanguage('en')" class="hand">@{{ 'ENGLISH' | translate }}
                                        <span ng-show="currentLanguage == 'en'" class="label label-default">@{{ 'CURRENT_LANGUAGE' | translate }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a ng-href="" ng-click="changeLanguage('ptBR')" class="hand">@{{ 'PORTUGUESE_PT_BR' | translate }}
                                        <span ng-show="currentLanguage == 'ptBR'" class="label label-default">@{{ 'CURRENT_LANGUAGE' | translate }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="page-wrapper" ng-view></div>
        </div>

        <script src="bower_components/angular/angular.min.js"></script>
        <script src="bower_components/angular-route/angular-route.min.js"></script>
        <script src="bower_components/angular-translate/angular-translate.min.js"></script>
        <script src="bower_components/ng-table/dist/ng-table.min.js"></script>
        <script src="bower_components/ng-resource/dist/ng-resource.min.js"></script>
        <script src="js/app.js"></script>
        <script src="js/controller/DashboardController.js"></script>
        <script src="js/controller/ApplicationController.js"></script>
        <script src="js/controller/UseCaseController.js"></script>
        <script src="js/controller/ActorsController.js"></script>
        <script src="js/controller/StepsController.js"></script>
        <script src="js/controller/VersionController.js"></script>
        <script src="js/controller/LanguageMenuController.js"></script>
        <script src="js/directive/SuccessMessage.js"></script>
        <script src="js/directive/ErrorMessage.js"></script>
        <script src="js/directive/ModalClose.js"></script>
        <script src="js/factory/TableFactory.js"></script>
        <script src="js/factory/CrudFactory.js"></script>
        <script src="js/factory/ApplicationFactory.js"></script>
        <script src="js/factory/VersionFactory.js"></script>
        <script src="js/factory/ActorFactory.js"></script>
        <script src="js/factory/UseCaseFactory.js"></script>
        <script src="js/factory/StepFactory.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
        <script src="js/tablesorter/jquery.tablesorter.js"></script>
        <script src="js/tablesorter/tables.js"></script>
    </body>
</html>