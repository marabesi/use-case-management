<!DOCTYPE html>
<html lang="en" ng-app="useCaseManagement" ng-cloak>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="data:,">

        <title>@{{ 'USE_CASE_MANAGEMENT' | translate }}</title>

        <link rel="stylesheet" href="css/style.min.css">
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
                    <a class="navbar-brand" href="/#!/">@{{ 'USE_CASE_MANAGEMENT' | translate }}</a>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li><a href="/#!/">@{{ 'DASHBOARD' | translate }}</a></li>
                        <li><a href="/#!/application/">@{{ 'APPLICATION' | translate }}</a></li>
                        <li><a href="/#!/actors/">@{{ 'ACTORS' | translate }}</a></li>
                        <li><a href="/#!/version/">@{{ 'VERSION' | translate }}</a></li>
                        <li><a href="/#!/use-case/"></i> @{{ 'USE_CASE' | translate }}</a></li>
                        <li><a href="/#!/steps/">@{{ 'STEPS' | translate }}</a></li>
                        <li><a href="/#!/preview/">@{{ 'PREVIEW' | translate }}</a></li>
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

        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>