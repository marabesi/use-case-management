angular.module('useCase').run(['$templateCache', function($templateCache) {
  'use strict';

  $templateCache.put('view/actors.html',
    "<div ng-controller=\"ActorsController\">\n" +
    "    <div class=\"row\">\n" +
    "        <success-message submitted=\"submitted\">\n" +
    "            <strong>{{ 'WELL_DONE' | translate }}</strong> {{ 'YOU_SUCCESSFULLY_CREATED_A_ACTOR' | translate }}\n" +
    "        </success-message>\n" +
    "        \n" +
    "        <error-message error=\"error\">\n" +
    "            <strong>{{ 'SORRY_SOMETHING_WENT_WRONG' | translate }}</strong> {{messageError}}\n" +
    "        </error-message>\n" +
    "\n" +
    "        <div class=\"col-lg-12\">\n" +
    "            <form role=\"form\" ng-submit=\"create()\" name=\"form\">\n" +
    "                <input name=\"id\" type=\"hidden\" value=\"{{actor.id}}\" />\n" +
    "                <div class=\"form-group\">\n" +
    "                    <label>{{ 'NAME' | translate }}</label>\n" +
    "                    <input class=\"form-control\" name=\"name\" ng-model=\"actor.name\" required ng-class=\"\"/>\n" +
    "                    <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form.name.$error.required && form.name.$dirty\">\n" +
    "                        {{ 'NAME_IS_REQUIRED' | translate }}\n" +
    "                    </div>\n" +
    "                </div>\n" +
    "\n" +
    "                <div class=\"form-group\">\n" +
    "                    <label>{{ 'DESCRIPTION' | translate }}</label>\n" +
    "                    <textarea class=\"form-control\" rows=\"3\" name=\"description\" ng-model=\"actor.description\" required></textarea>\n" +
    "                    <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form.description.$error.required && form.description.$dirty\">\n" +
    "                        {{ 'DESCRIPTION_IS_REQUIRED' | translate }}\n" +
    "                    </div>\n" +
    "                </div>\n" +
    "\n" +
    "                <button type=\"submit\" class=\"btn btn-default\" ng-disabled=\"form.$invalid\">{{ message | translate }}</button>\n" +
    "                <button type=\"button\" class=\"btn btn-danger\" ng-show=\"actor.id\" ng-click=\"cancel()\"> {{ 'CANCEL' | translate }}</button>\n" +
    "            </form>\n" +
    "        </div>\n" +
    "    </div>\n" +
    "    <div class=\"row\">\n" +
    "        <div class=\"col-lg-12\">\n" +
    "            <h2>{{ 'ACTOR_LIST' | translate }}</h2>\n" +
    "            <div class=\"table-responsive\">\n" +
    "                <table ng-table=\"customConfigParams\" class=\"table\">\n" +
    "                    <thead>\n" +
    "                        <tr>\n" +
    "                            <th>{{ 'NAME' | translate }}</th>\n" +
    "                            <th>{{ 'DESCRIPTION' | translate }}</th>\n" +
    "                            <th>{{ 'ACTION' | translate }}</th>\n" +
    "                        </tr>\n" +
    "                    </thead>\n" +
    "                    <tbody>\n" +
    "                        <tr ng-repeat=\"actor in $data track by $index\">\n" +
    "                            <td>{{actor.nome}}</td>\n" +
    "                            <td>{{actor.descricao}}</td>\n" +
    "                            <td>\n" +
    "                                <button class=\"btn btn-primary\" ng-click=\"edit($index)\">{{ 'EDIT' | translate }}</button> \n" +
    "                                <button class=\"btn btn-danger\" ng-click=\"remove(actor.id_ator)\">{{ 'DELETE' | translate }}</button>\n" +
    "                            </td>\n" +
    "                        </tr>\n" +
    "                        <tr ng-show=\"$data.length == 0\" class=\"warning\">\n" +
    "                            <td colspan=\"3\" align=\"center\">{{ 'ACTOR_NOT_FOUND' | translate }}</td>\n" +
    "                        </tr>\n" +
    "                    </tbody>\n" +
    "                </table>\n" +
    "            </div>\n" +
    "        </div>\n" +
    "    </div>\n" +
    "</div>\n" +
    "\n" +
    "<a href=\"#/application\" class=\"btn btn-info\"><< {{ 'APPLICATION' | translate }}</a>\n" +
    "<a href=\"#/version\" class=\"btn btn-info\"> {{ 'NEXT' | translate }}</a>"
  );


  $templateCache.put('view/application.html',
    "<div class=\"row\">\n" +
    "    <success-message submitted=\"submitted\">\n" +
    "        <strong>{{ 'WELL_DONE' | translate }}</strong> {{ 'YOU_SUCCESSFULLY_CREATED_AN_APPLICATION' | translate }}\n" +
    "    </success-message>\n" +
    "    <div class=\"col-lg-12\">\n" +
    "        <form role=\"form\" name=\"form\" ng-submit=\"create()\">\n" +
    "            <input name=\"id\" type=\"hidden\" value=\"{{application.id}}\" />\n" +
    "            <div class=\"form-group\">\n" +
    "                <label>{{ 'NAME' | translate }}</label>\n" +
    "                <input class=\"form-control\" name=\"name\" ng-model=\"application.name\" required/>\n" +
    "                <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form.name.$error.required && form.name.$dirty\">\n" +
    "                    {{ 'NAME_IS_REQUIRED' | translate }}\n" +
    "                </div>\n" +
    "            </div>\n" +
    "\n" +
    "            <button type=\"submit\" class=\"btn btn-default\" ng-disabled=\"form.$invalid\"> {{ message | translate }}</button>\n" +
    "            <button type=\"button\" class=\"btn btn-danger\" ng-show=\"application.id\" ng-click=\"cancel()\"> {{ 'CANCEL' | translate }}</button>\n" +
    "        </form>\n" +
    "    </div>\n" +
    "</div>\n" +
    "<div class=\"row\">\n" +
    "    <div class=\"col-lg-12\">\n" +
    "        <h2>{{ 'LIST_APPLICATION' | translate }}</h2>\n" +
    "        <div class=\"table-responsive\">\n" +
    "            <table ng-table=\"customConfigParams\" class=\"table table-bordered table-hover tablesorter\">\n" +
    "                <thead>\n" +
    "                    <tr>\n" +
    "                        <th>{{ 'NAME' | translate }} <i class=\"fa fa-sort\"></i></th>\n" +
    "                        <th>{{ 'ACTION' | translate }}</th>\n" +
    "                    </tr>\n" +
    "                </thead>\n" +
    "                <tbody>\n" +
    "                    <tr ng-repeat=\"app in $data track by $index\">\n" +
    "                        <td>{{app.nome}}</td>\n" +
    "                        <td>\n" +
    "                            <button class=\"btn btn-primary\" ng-click=\"edit($index)\">{{ 'EDIT' | translate }}</button> \n" +
    "                            <button class=\"btn btn-danger\" ng-click=\"remove(app.id_sistema)\">{{ 'DELETE' | translate }}</button>\n" +
    "                        </td>\n" +
    "                    </tr>\n" +
    "                    <tr ng-show=\"$data.length == 0\" class=\"warning\">\n" +
    "                        <td align=\"center\" colspan=\"2\">{{ 'APPLICATION_NOT_FOUND' | translate }}</td>\n" +
    "                    </tr>\n" +
    "                </tbody>\n" +
    "            </table>\n" +
    "        </div>\n" +
    "    </div>\n" +
    "</div>\n" +
    "\n" +
    "<a href=\"#/actors\" class=\"btn btn-info\"> {{ 'NEXT' | translate }}</a>"
  );


  $templateCache.put('view/dashboard.html',
    "<div class=\"row\">\n" +
    "    <div class=\"col-lg-6\">\n" +
    "        <div class=\"panel panel-info\">\n" +
    "            <div class=\"panel-heading\">\n" +
    "                <div class=\"row\">\n" +
    "                    <div class=\"col-xs-6\">\n" +
    "                        <i class=\"fa fa-comments fa-5x\"></i>\n" +
    "                    </div>\n" +
    "                    <div class=\"col-xs-6 text-right\">\n" +
    "                        <p class=\"announcement-heading\">{{total}}</p>\n" +
    "                        <p class=\"announcement-text\">{{ 'USE_CASE' | translate }}(s)</p>\n" +
    "                    </div>\n" +
    "                </div>\n" +
    "            </div>\n" +
    "            <a href=\"#/use-case\">\n" +
    "                <div class=\"panel-footer announcement-bottom\">\n" +
    "                    <div class=\"row\">\n" +
    "                        <div class=\"col-xs-6\">\n" +
    "                            {{ 'VIEW_ALL' | translate }}\n" +
    "                        </div>\n" +
    "                        <div class=\"col-xs-6 text-right\">\n" +
    "                            <i class=\"fa fa-arrow-circle-right\"></i>\n" +
    "                        </div>\n" +
    "                    </div>\n" +
    "                </div>\n" +
    "            </a>\n" +
    "        </div>\n" +
    "    </div>\n" +
    "    <div class=\"col-lg-6\">\n" +
    "        <div class=\"panel panel-danger\">\n" +
    "            <div class=\"panel-heading\">\n" +
    "                <div class=\"row\">\n" +
    "                    <div class=\"col-xs-6\">\n" +
    "                        <i class=\"fa fa-tasks fa-5x\"></i>\n" +
    "                    </div>\n" +
    "                    <div class=\"col-xs-6 text-right\">\n" +
    "                        <p class=\"announcement-heading\">{{totalDeleted}}</p>\n" +
    "                        <p class=\"announcement-text\">{{ 'DELETED_USE_CASE' | translate }}(s)</p>\n" +
    "                    </div>\n" +
    "                </div>\n" +
    "            </div>\n" +
    "            <a href=\"#/use-case\">\n" +
    "                <div class=\"panel-footer announcement-bottom\">\n" +
    "                    <div class=\"row\">\n" +
    "                        <div class=\"col-xs-6\">\n" +
    "                            {{ 'VIEW_ALL' | translate }}\n" +
    "                        </div>\n" +
    "                        <div class=\"col-xs-6 text-right\">\n" +
    "                            <i class=\"fa fa-arrow-circle-right\"></i>\n" +
    "                        </div>\n" +
    "                    </div>\n" +
    "                </div>\n" +
    "            </a>\n" +
    "        </div>\n" +
    "    </div>\n" +
    "</div>"
  );


  $templateCache.put('view/partial/errorMessage.html',
    "<div ng-show=\"error\" class=\"alert alert-dismissable alert-danger\">\n" +
    "    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>\n" +
    "    <span ng-transclude></span>\n" +
    "</div>"
  );


  $templateCache.put('view/partial/successMessage.html',
    "<div ng-show=\"submitted\" class=\"alert alert-dismissable alert-success\">\n" +
    "    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>\n" +
    "    <span ng-transclude></span>\n" +
    "</div>"
  );


  $templateCache.put('view/preview.html',
    "<div class=\"row\">\n" +
    "    <div class=\"col-lg-12\">\n" +
    "        <div class=\"form-group\">\n" +
    "            <label>{{ 'APPLICATION' | translate }}</label>\n" +
    "            <select class=\"form-control\" name=\"application\" ng-model=\"preview.application\" ng-change=\"build()\">\n" +
    "                <option value=\"\">{{ 'SELECT' | translate }}</option>\n" +
    "                <option ng-repeat=\"app in application\" value=\"{{app.id_sistema}}\">{{app.nome}}</option>\n" +
    "            </select>\n" +
    "        </div>\n" +
    "    </div>\n" +
    "</div>\n" +
    "\n" +
    "<div class=\"row\" ng-show=\"!preview.application\">\n" +
    "    <div class=\"alert alert-info alert-dismissable\">\n" +
    "        {{ 'HELPER_PREVIEW' | translate }}\n" +
    "    </div>\n" +
    "</div>\n" +
    "\n" +
    "<div class=\"row\" ng-show=\"!previewData.app.useCase.length && preview.application\">\n" +
    "    <div class=\"alert alert-danger alert-dismissable\">\n" +
    "        {{ 'PREVIEW_HELPER_NO_USE_CASES' | translate }}\n" +
    "    </div>\n" +
    "</div>\n" +
    "\n" +
    "<div class=\"row\" ng-show=\"previewData.app.useCase.length > 0\">\n" +
    "    <ul>\n" +
    "        <ul ng-repeat=\"row in previewData\">\n" +
    "            <li>\n" +
    "                {{row.nome}}\n" +
    "                <ul ng-repeat=\"useCase in row.useCase\">\n" +
    "                    <li><strong>{{useCase.descricao}}</strong></li>\n" +
    "\n" +
    "                    <ul>\n" +
    "                        <li ng-repeat=\"actor in useCase.revision.actors\">\n" +
    "                            {{actor.nome}}\n" +
    "                        </li>\n" +
    "                    </ul>\n" +
    "\n" +
    "                    <ul>\n" +
    "                        <ul ng-repeat=\"flow in useCase.revision.flow\">\n" +
    "\n" +
    "                            <li ng-repeat=\"(type, obj) in flow\">\n" +
    "                                <strong>{{ (type | uppercase) | translate }}</strong>\n" +
    "                                <ul ng-repeat=\"(index, items) in obj\">\n" +
    "                                    <ul>\n" +
    "                                        <li>{{index | translate}}\n" +
    "                                            <ul>\n" +
    "                                                <li ng-repeat=\"item in items\">\n" +
    "                                                    {{item.identifier}}\n" +
    "                                                    <span>{{item.description}}</span>\n" +
    "                                                </li>\n" +
    "                                            </ul>\n" +
    "                                        </li>\n" +
    "                                    </ul>\n" +
    "                                </ul>\n" +
    "                            </li>\n" +
    "                        </ul>\n" +
    "                    </ul>\n" +
    "                </ul>\n" +
    "            </li>\n" +
    "        </ul>\n" +
    "    </ul>\n" +
    "</div>"
  );


  $templateCache.put('view/steps.html',
    "<div ng-controller=\"StepsController\">\n" +
    "    <success-message submitted=\"submitted\">\n" +
    "        <strong>{{ 'WELL_DONE' | translate }}</strong> {{ 'YOU_SUCCESSFULLY_CREATED_AN_STEP' | translate }}\n" +
    "    </success-message>\n" +
    "\n" +
    "    <error-message error=\"error\">\n" +
    "        <strong>{{ 'SORRY_SOMETHING_WENT_WRONG' | translate }}</strong> {{messageError}}\n" +
    "    </error-message>\n" +
    "\n" +
    "    <div class=\"row\">\n" +
    "        <form role=\"form\" ng-submit=\"create()\" name=\"form\" novalidate>\n" +
    "            <input type=\"hidden\" name=\"id_passos\" value=\"{{useCase.id_passos}}\"/>\n" +
    "            <input type=\"hidden\" name=\"id_fluxo\" value=\"{{useCase.id_fluxo}}\"/>\n" +
    "\n" +
    "            <div class=\"panel-body\">\n" +
    "                <div class=\"col-lg-3\">\n" +
    "                    <div class=\"form-group\">\n" +
    "                        <label>{{ 'APPLICATION' | translate }}</label>\n" +
    "                        <select class=\"form-control\"\n" +
    "                                required\n" +
    "                                name=\"application\"\n" +
    "                                ng-model=\"useCase.application\"\n" +
    "                                ng-options=\"app.id_sistema as app.nome for app in application\"\n" +
    "                                ng-change=\"fetchUseCase(useCase.application)\">\n" +
    "\n" +
    "                            <option value=\"\">{{ 'SELECT' | translate }}</option>\n" +
    "                        </select>\n" +
    "                        <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form.application.$error.required && form.application.$dirty\">\n" +
    "                            {{ 'APPLICATION_IS_REQUIRED' | translate }}\n" +
    "                        </div>\n" +
    "                    </div>\n" +
    "                </div>\n" +
    "                <div class=\"col-lg-3\">\n" +
    "                    <div class=\"form-group\">\n" +
    "                        <label>{{ 'USE_CASE' | translate }}</label>\n" +
    "                        <select\n" +
    "	                        class=\"form-control\"\n" +
    "	                        name=\"useCase\"\n" +
    "	                        ng-model=\"useCase.useCase\"\n" +
    "	                        required\n" +
    "                        	ng-options=\"usec.id_revisao as usec.descricao for usec in useCases\">\n" +
    "                            <option value=\"\">{{ 'SELECT' | translate }}</option>\n" +
    "                        </select>\n" +
    "                        <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form.useCase.$error.required && form.useCase.$dirty\">\n" +
    "                            {{ 'USE_CASE_IS_REQUIRED' | translate }}\n" +
    "                        </div>\n" +
    "                    </div>\n" +
    "                </div>\n" +
    "                <div class=\"col-lg-3\">\n" +
    "                    <div class=\"form-group\">\n" +
    "                        <label>{{ 'TYPE' | translate }}</label>\n" +
    "                        <select\n" +
    "                        	class=\"form-control\"\n" +
    "                        	required\n" +
    "                        	name=\"type\"\n" +
    "                        	ng-model=\"useCase.type\"\n" +
    "                        	ng-options=\"type.id as type.description for type in types\">\n" +
    "                            <option value=\"\">{{ 'SELECT' | translate }}</option>\n" +
    "                        </select>\n" +
    "                        <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form.type.$error.required && form.type.$dirty\">\n" +
    "                            {{ 'TYPE_IS_REQUIRED' | translate }}\n" +
    "                        </div>\n" +
    "                    </div>\n" +
    "                </div>\n" +
    "            </div>\n" +
    "            <div class=\"panel-body\">\n" +
    "                <div class=\"col-lg-1\">\n" +
    "                    <div class=\"form-group\">\n" +
    "                        <label>{{ 'STEP' | translate }}</label>\n" +
    "                        <input class=\"form-control\" name=\"identifier\" ng-model=\"useCase.identifier\" required/>\n" +
    "                        <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form.identifier.$error.required && form.identifier.$dirty\">\n" +
    "                            {{ 'STEP_IS_REQUIRED' | translate }}\n" +
    "                        </div>\n" +
    "                    </div>\n" +
    "                </div>\n" +
    "                <div class=\"col-lg-9\">\n" +
    "                    <div class=\"form-group\">\n" +
    "                        <label>{{ 'DESCRIPTION' | translate }}</label>\n" +
    "                        <textarea class=\"form-control\" name=\"description\" ng-model=\"useCase.description\" required></textarea>\n" +
    "                        <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form.description.$error.required && form.description.$dirty\">\n" +
    "                            {{ 'DESCRIPTION_IS_REQUIRED' | translate }}\n" +
    "                        </div>\n" +
    "                    </div>\n" +
    "                </div>\n" +
    "            </div>\n" +
    "            <div class=\"panel-body\" ng-repeat=\"step in elements track by $index\">\n" +
    "                <div class=\"col-lg-3\">\n" +
    "                    <div class=\"form-group\" ng-show=\"$index == 0\">\n" +
    "                        <label>{{ 'COMPLEMENTARY' | translate }}</label>\n" +
    "                    </div>\n" +
    "                    <div class=\"input-group\">\n" +
    "                        <select class=\"form-control\" name=\"complementary[{{$index}}]\" ng-model=\"useCase.complementary[$index]\">\n" +
    "                            <option value=\"\">{{ 'SELECT' | translate }}</option>\n" +
    "                            <option ng-repeat=\"complementary in complementaries\" value=\"{{complementary.identifier}}|{{complementary.description}}|{{complementary.id}}\">\n" +
    "                                {{complementary.identifier}} - {{complementary.description}}\n" +
    "                            </option>\n" +
    "                        </select>\n" +
    "                        <span class=\"input-group-btn\">\n" +
    "                            <button type=\"button\" class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#newElementModal\" ng-click=\"createComplementary()\">+</button>\n" +
    "                        </span>\n" +
    "                    </div>\n" +
    "                    <div class=\"input-group\">\n" +
    "                        <div class=\"form-group\">\n" +
    "                            <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form['complementary[' + $index + ']'].$error.required\">\n" +
    "                                {{ 'COMPLEMENTARY_IS_REQUIRED' | translate }}\n" +
    "                            </div>\n" +
    "                        </div>\n" +
    "                    </div>\n" +
    "                </div>\n" +
    "                <div class=\"col-lg-3\">\n" +
    "                    <div class=\"form-group\" ng-show=\"$index == 0\">\n" +
    "                        <label>{{ 'BUSINESS' | translate }}</label>\n" +
    "                    </div>\n" +
    "                    <div class=\"input-group\">\n" +
    "                        <select class=\"form-control\" name=\"business[{{$index}}]\" ng-model=\"useCase.business[$index]\">\n" +
    "                            <option value=\"\">{{ 'SELECT' | translate }}</option>\n" +
    "                            <option ng-repeat=\"rule in rules\" value=\"{{rule.identifier}}|{{rule.description}}|{{rule.id}}\">\n" +
    "                                {{rule.identifier}} - {{rule.description}}\n" +
    "                            </option>\n" +
    "                        </select>\n" +
    "                        <span class=\"input-group-btn\">\n" +
    "                            <button type=\"button\" class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#newElementModal\" ng-click=\"createRule()\">+</button>\n" +
    "                        </span>\n" +
    "                    </div>\n" +
    "                    <div class=\"input-group\">\n" +
    "                        <div class=\"form-group\">\n" +
    "                            <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form['business[' + $index + ']'].$error.required\">\n" +
    "                                {{ 'BUSINESS_IS_REQUIRED' | translate }}\n" +
    "                            </div>\n" +
    "                        </div>\n" +
    "                    </div>\n" +
    "                </div>\n" +
    "                <div class=\"col-lg-3\">\n" +
    "                    <div class=\"form-group\" ng-show=\"$index == 0\">\n" +
    "                        <label>{{ 'REFERENCE' | translate }}</label>\n" +
    "                    </div>\n" +
    "                    <div class=\"input-group\">\n" +
    "                        <select class=\"form-control\" name=\"reference[{{$index}}]\" ng-model=\"useCase.reference[$index]\">\n" +
    "                            <option value=\"\">{{ 'SELECT' | translate }}</option>\n" +
    "                            <option ng-repeat=\"reference in references\" value=\"{{reference.identifier}}|{{reference.description}}|{{reference.id}}\">\n" +
    "                                {{reference.identifier}} - {{reference.description}}\n" +
    "                            </option>\n" +
    "                        </select>\n" +
    "                        <span class=\"input-group-btn\">\n" +
    "                            <button type=\"button\" class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#newElementModal\" ng-click=\"createReference()\">+</button>\n" +
    "                        </span>\n" +
    "                    </div>\n" +
    "                    <div class=\"input-group\">\n" +
    "                        <div class=\"form-group\">\n" +
    "                            <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form['reference[' + $index + ']'].$error.required\">\n" +
    "                                {{ 'REFERENCE_IS_REQUIRED' | translate }}\n" +
    "                            </div>\n" +
    "                        </div>\n" +
    "                    </div>\n" +
    "                </div>\n" +
    "                <div class=\"col-lg-3\" ng-show=\"$index == 0\">\n" +
    "                    <div class=\"form-group fix-top-button\">\n" +
    "                        <button type=\"button\" class=\"btn btn-primary\" ng-click=\"createNewElement()\">\n" +
    "                            <span>{{ 'NEW_LINE' | translate }}</span>\n" +
    "                        </button>\n" +
    "                        <button type=\"submit\" class=\"btn btn-success\" ng-disabled=\"form.$invalid\">\n" +
    "                            <span>{{ message | translate }}</span>\n" +
    "                        </button>\n" +
    "                        <button type=\"button\" class=\"btn btn-danger\" ng-show=\"useCase.id_passos\" ng-click=\"cancel()\"> {{ 'CANCEL' | translate }}</button>\n" +
    "                    </div>\n" +
    "                </div>\n" +
    "\n" +
    "                <button type=\"button\" class=\"btn btn-danger\" ng-show=\"$index > 0\" ng-click=\"removeElement($index)\">\n" +
    "                    <span>-</span>\n" +
    "                </button>\n" +
    "            </div>\n" +
    "        </form>\n" +
    "    </div>\n" +
    "    <!--<div class=\"row\">-->\n" +
    "        <!--<div class=\"alert alert-info alert-dismissable\">-->\n" +
    "            <!--<a href=\"#/preview\">{{ 'STEP_HELPER' | translate }}</a>-->\n" +
    "        <!--</div>-->\n" +
    "    <!--</div>-->\n" +
    "    <div class=\"row\">\n" +
    "        <div class=\"col-lg-12\">\n" +
    "            <h2>{{ 'LIST_STEP' | translate }}</h2>\n" +
    "            <div class=\"table-responsive\">\n" +
    "                <table ng-table=\"customConfigParams\" show-filter=\"true\" class=\"table table-bordered table-hover tablesorter\">\n" +
    "                    <tr ng-repeat=\"app in $data track by $index\">\n" +
    "                        <td data-title=\"tableHeader[0]\" sortable=\"useCase\" filter=\"{ 'useCase': 'select' }\" filter-data=\"allUseCases\">{{app.caso_de_uso_descricao}}</td>\n" +
    "                        <td data-title=\"tableHeader[1]\">{{ 'TYPE_' + app.tipo | translate }}</td>\n" +
    "                        <td data-title=\"tableHeader[2]\">{{app.identificador}}</td>\n" +
    "                        <td data-title=\"tableHeader[3]\">{{app.descricao}}</td>\n" +
    "                        <td data-title=\"tableHeader[4]\">\n" +
    "                            <button class=\"btn btn-primary\" ng-click=\"edit($index)\">{{ 'EDIT' | translate }}</button>\n" +
    "                            <button class=\"btn btn-danger\" ng-click=\"remove(app.id_passos, app.id_fluxo)\">{{ 'DELETE' | translate }}</button>\n" +
    "                        </td>\n" +
    "                    </tr>\n" +
    "                    <tr ng-show=\"$data.length == 0\" class=\"warning\">\n" +
    "                        <td align=\"center\" colspan=\"5\">{{ 'STEP_NOT_FOUND' | translate }}</td>\n" +
    "                    </tr>\n" +
    "                </table>\n" +
    "            </div>\n" +
    "        </div>\n" +
    "    </div>\n" +
    "    <div id=\"newElementModal\" class=\"modal fade\" role=\"dialog\">\n" +
    "        <div class=\"modal-dialog\">\n" +
    "            <div class=\"modal-content\">\n" +
    "                <div class=\"modal-header\">\n" +
    "                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>\n" +
    "                    <h4 class=\"modal-title\">{{ modal.title | translate }}</h4>\n" +
    "                </div>\n" +
    "                <div class=\"modal-body\">\n" +
    "                    <form role=\"form\" ng-submit=\"createOption(modal.active)\" name=\"formElement\">\n" +
    "                        <div class=\"form-group\">\n" +
    "                            <label>{{ 'IDENTIFIER' | translate }}</label>\n" +
    "                            <input class=\"form-control\" name=\"identifier\" ng-model=\"option.identifier\" required ng-class=\"\"/>\n" +
    "                            <div class=\"alert alert-dismissable alert-danger\" ng-show=\"formElement.identifier.$error.required\">\n" +
    "                                {{ 'IDENTIFIER_IS_REQUIRED' | translate }}\n" +
    "                            </div>\n" +
    "                        </div>\n" +
    "                        <div class=\"form-group\">\n" +
    "                            <label>{{ 'DESCRIPTION' | translate }}</label>\n" +
    "                            <textarea class=\"form-control\" rows=\"3\" name=\"description\" ng-model=\"option.description\" required></textarea>\n" +
    "                            <div class=\"alert alert-dismissable alert-danger\" ng-show=\"formElement.description.$error.required\">\n" +
    "                                {{ 'DESCRIPTION_IS_REQUIRED' | translate }}\n" +
    "                            </div>\n" +
    "                        </div>\n" +
    "                        <button type=\"submit\" class=\"btn btn-default\" ng-disabled=\"formElement.$invalid\" modal-close>{{ 'SAVE' | translate }}</button>\n" +
    "                    </form>\n" +
    "                </div>\n" +
    "                <div class=\"modal-footer\">\n" +
    "                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">{{ 'CLOSE' | translate }}</button>\n" +
    "                </div>\n" +
    "            </div>\n" +
    "        </div>\n" +
    "    </div>\n" +
    "\n" +
    "    <div id=\"preview\" class=\"modal fade\" role=\"dialog\">\n" +
    "        <div class=\"modal-dialog\">\n" +
    "            <div class=\"modal-content\">\n" +
    "                <div class=\"modal-header\">\n" +
    "                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>\n" +
    "                    <h4 class=\"modal-title\">{{ 'PREVIEW' | translate }}</h4>\n" +
    "                </div>\n" +
    "                <div class=\"modal-body\">\n" +
    "\n" +
    "                </div>\n" +
    "                <div class=\"modal-footer\">\n" +
    "                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">{{ 'CLOSE' | translate }}</button>\n" +
    "                </div>\n" +
    "            </div>\n" +
    "        </div>\n" +
    "    </div>\n" +
    "</div>\n" +
    "\n" +
    "<a href=\"#/use-case\" class=\"btn btn-info\"> << {{ 'USE_CASE' | translate }}</a>"
  );


  $templateCache.put('view/use-case.html',
    "<div class=\"row\">\n" +
    "    <success-message submitted=\"submitted\">\n" +
    "        <strong>{{ 'WELL_DONE' | translate }}</strong> {{ 'YOU_SUCCESSFULLY_CREATED_A_USE_CASE' | translate }}\n" +
    "    </success-message>\n" +
    "    <div class=\"col-lg-12\">\n" +
    "        <form role=\"form\" name=\"form\" ng-submit=\"create()\">\n" +
    "            <input name=\"id\" type=\"hidden\" value=\"{{useCase.id}}\" />\n" +
    "            <input name=\"id_revision\" type=\"hidden\" value=\"{{useCase.id_revision}}\" />\n" +
    "            <input name=\"id_actor_revision\" type=\"hidden\" value=\"{{useCase.id_actor_revision}}\" />\n" +
    "\n" +
    "            <div class=\"form-group\">\n" +
    "                <label>{{ 'APPLICATION' | translate }}</label>\n" +
    "                <select class=\"form-control\"\n" +
    "                    required\n" +
    "                    name=\"application\"\n" +
    "                    ng-model=\"useCase.application\"\n" +
    "                    ng-options=\"app.id_sistema as app.nome for app in application\"\n" +
    "                    ng-disabled=\"useCase.id\">\n" +
    "\n" +
    "                    <option value=\"\">{{ 'SELECT' | translate }}</option>\n" +
    "                </select>\n" +
    "                <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form.application.$error.required && form.application.$dirty\">\n" +
    "                    {{ 'APPLICATION_IS_REQUIRED' | translate }}\n" +
    "                </div>\n" +
    "            </div>\n" +
    "            <div class=\"form-group\">\n" +
    "                <label>{{ 'DESCRIPTION' | translate }}</label>\n" +
    "                <textarea class=\"form-control\" name=\"description\" rows=\"3\" required ng-model=\"useCase.description\"></textarea>\n" +
    "                <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form.description.$error.required && form.description.$dirty\">\n" +
    "                    {{ 'DESCRIPTION_IS_REQUIRED' | translate }}\n" +
    "                </div>\n" +
    "            </div>\n" +
    "            <div class=\"form-group\">\n" +
    "                <label>{{ 'VERSION' | translate }}</label>\n" +
    "                <select class=\"form-control\" name=\"version\" ng-model=\"useCase.version\" required>\n" +
    "                    <option value=\"\">{{ 'SELECT' | translate }}</option>\n" +
    "                    <option ng-repeat=\"option in version\" ng-selected=\"useCase.version\" value=\"{{option.id_dados_revisao}}\">{{option.versao}}</option>\n" +
    "                </select>\n" +
    "                <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form.version.$error.required && form.version.$dirty\">\n" +
    "                    {{ 'VERSION_IS_REQUIRED' | translate }}\n" +
    "                </div>\n" +
    "            </div>\n" +
    "\n" +
    "            <div class=\"input-group\">\n" +
    "                <label>{{ 'ACTORS' | translate }}</label>\n" +
    "            </div>\n" +
    "            <div ng-repeat=\"element in actorsElements track by $index\">\n" +
    "                <div class=\"input-group\">\n" +
    "                    <select \n" +
    "                    	class=\"form-control\" \n" +
    "                    	name=\"actor[{{$index}}]\" \n" +
    "                    	ng-model=\"useCase.actor[$index]\" \n" +
    "                    	required\n" +
    "                    	ng-options=\"actor.id_ator as actor.nome for actor in actors\">\n" +
    "                        <option value=\"\">{{ 'SELECT' | translate }}</option>\n" +
    "                    </select>\n" +
    "\n" +
    "                    <span class=\"input-group-btn\">\n" +
    "                        <button type=\"button\" class=\"btn btn-info\" ng-click=\"createActor($index)\" ng-show=\"$index == 0\">+</button>\n" +
    "                        <button type=\"button\" class=\"btn btn-danger\" ng-click=\"deleteActor($index)\" ng-show=\"$index > 0\">-</button>\n" +
    "                    </span>\n" +
    "                </div>\n" +
    "                <div class=\"form-group\">\n" +
    "                    <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form['actor[' + $index + ']'].$error.required && form['actor[' + $index + ']'].$dirty\">\n" +
    "                        {{ 'ACTOR_IS_REQUIRED' | translate }}\n" +
    "                    </div>\n" +
    "                </div>\n" +
    "            </div>\n" +
    "            <div class=\"form-group\">\n" +
    "                <label>{{ 'USE_CASE_STATUS' | translate }}</label>\n" +
    "                <select \n" +
    "                	class=\"form-control\" \n" +
    "                	name=\"status\" \n" +
    "                	ng-model=\"useCase.status\" \n" +
    "                	required\n" +
    "                	ng-options=\"st.id as st.description for st in selectStatus\">\n" +
    "                    <option value=\"\">{{ 'SELECT' | translate }}</option>\n" +
    "                </select>\n" +
    "                <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form.status.$error.required && form.status.$dirty\">\n" +
    "                    {{ 'USE_CASE_STATUS_IS_REQUIRED' | translate }}\n" +
    "                </div>\n" +
    "            </div>\n" +
    "            <div class=\"form-group\">\n" +
    "                <label>{{ 'PRE_CONDITION' | translate }}</label>\n" +
    "                <textarea class=\"form-control\" name=\"preCondition\" ng-model=\"useCase.preCondition\"></textarea>\n" +
    "            </div>\n" +
    "            <div class=\"form-group\">\n" +
    "                <label>{{ 'POS_CONDITION' | translate }}</label>\n" +
    "                <textarea class=\"form-control\" name=\"posCondition\" ng-model=\"useCase.posCondition\"></textarea>\n" +
    "            </div>\n" +
    "            <button type=\"submit\" class=\"btn btn-default btn-info\" ng-disabled=\"form.$invalid\">{{ message | translate }}</button>\n" +
    "            <button type=\"button\" class=\"btn btn-danger\" ng-show=\"useCase.id\" ng-click=\"cancel()\"> {{ 'CANCEL' | translate }}</button>\n" +
    "        </form>\n" +
    "    </div>\n" +
    "</div>\n" +
    "<div class=\"row\">\n" +
    "    <div class=\"col-lg-12\">\n" +
    "        <h2>{{ 'LIST_USE_CASE' | translate }}</h2>\n" +
    "        <div class=\"table-responsive\">\n" +
    "            <table ng-table=\"customConfigParams\" show-filter=\"true\" class=\"table table-bordered table-hover tablesorter\">\n" +
    "                <tr ng-repeat=\"useCase in $data track by $index\">\n" +
    "                    <td data-title=\"tableHeader[0]\" sortable=\"application\" filter=\"{ 'application': 'select' }\" filter-data=\"applicationFilter\">{{useCase.nome}}</td>\n" +
    "                    <td data-title=\"tableHeader[1]\">{{useCase.descricao}}</td>\n" +
    "                    <td data-title=\"tableHeader[2]\">{{ useCase.status | translate }}</td>\n" +
    "                    <td data-title=\"tableHeader[3]\">\n" +
    "                        <button class=\"btn btn-primary\" ng-click=\"edit($index)\">{{ 'EDIT' | translate }}</button>\n" +
    "                        <button class=\"btn btn-danger\" ng-click=\"remove(useCase.id_caso_de_uso, useCase.id_revisao)\">{{ 'DELETE' | translate }}</button>\n" +
    "                    </td>\n" +
    "                </tr>\n" +
    "                <tr ng-show=\"$data.length == 0\" class=\"warning\">\n" +
    "                    <td colspan=\"4\" align=\"center\">{{ 'USE_CASE_NOT_FOUND' | translate }}</td>\n" +
    "                </tr>\n" +
    "            </table>\n" +
    "        </div>\n" +
    "    </div>\n" +
    "</div>\n" +
    "\n" +
    "<a href=\"#/version\" class=\"btn btn-info\"><< {{ 'VERSION' | translate }}</a>\n" +
    "<a href=\"#/steps\" class=\"btn btn-info\">{{ 'NEXT' | translate }} >></a>"
  );


  $templateCache.put('view/version.html',
    "<div class=\"row\">\n" +
    "    <success-message submitted=\"submitted\">\n" +
    "        <strong>{{ 'WELL_DONE' | translate }}</strong> {{ 'YOU_SUCCESSFULLY_CREATED_A_VERSION' | translate }}\n" +
    "    </success-message>\n" +
    "    \n" +
    "    <error-message error=\"error\">\n" +
    "        <strong>{{ 'SORRY_SOMETHING_WENT_WRONG' | translate }}</strong> {{messageError}}\n" +
    "    </error-message>\n" +
    "\n" +
    "    <div class=\"col-lg-12\">\n" +
    "        <form role=\"form\" name=\"form\" ng-submit=\"create()\">\n" +
    "            <input name=\"id\" type=\"hidden\" value=\"{{version.id}}\" />\n" +
    "            <div class=\"form-group\">\n" +
    "                <label>{{ 'VERSION' | translate }}</label>\n" +
    "                <input class=\"form-control\" name=\"version\" ng-model=\"version.name\" required ng-class=\"\"/>\n" +
    "                <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form.version.$error.required && form.version.$dirty\">\n" +
    "                    {{ 'VERSION_NAME_IS_REQUIRED' | translate }}\n" +
    "                </div>\n" +
    "            </div>\n" +
    "\n" +
    "            <div class=\"form-group\">\n" +
    "                <label>{{ 'DESCRIPTION' | translate }}</label>\n" +
    "                <textarea class=\"form-control\" name=\"description\" rows=\"3\" required ng-model=\"version.description\"></textarea>\n" +
    "                <div class=\"alert alert-dismissable alert-danger\" ng-show=\"form.description.$error.required && form.description.$dirty\">\n" +
    "                    {{ 'DESCRIPTION_IS_REQUIRED' | translate }}\n" +
    "                </div>\n" +
    "            </div>\n" +
    "\n" +
    "            <button type=\"submit\" class=\"btn btn-default\" ng-disabled=\"form.$invalid\">{{ message | translate }}</button>\n" +
    "            <button type=\"button\" class=\"btn btn-danger\" ng-show=\"version.id\" ng-click=\"cancel()\"> {{ 'CANCEL' | translate }}</button>\n" +
    "        </form>\n" +
    "\n" +
    "    </div>\n" +
    "</div>\n" +
    "<div class=\"row\">\n" +
    "    <div class=\"col-lg-12\">\n" +
    "        <h2>{{ 'LIST_VERSION' | translate }}</h2>\n" +
    "        <div class=\"table-responsive\">\n" +
    "            <table ng-table=\"customConfigParams\" class=\"table table-bordered table-hover tablesorter\">\n" +
    "                <thead>\n" +
    "                    <tr>\n" +
    "                        <th>{{ 'VERSION' | translate }}</th>\n" +
    "                        <th>{{ 'DESCRIPTION' | translate }}</th>\n" +
    "                        <th>{{ 'ACTION' | translate }}</th>\n" +
    "                    </tr>\n" +
    "                </thead>\n" +
    "                <tbody>\n" +
    "                    <tr ng-repeat=\"version in $data track by $index\">\n" +
    "                        <td>{{version.versao}}</td>\n" +
    "                        <td>{{version.descricao}}</td>\n" +
    "                        <td>\n" +
    "                            <button class=\"btn btn-primary\" ng-click=\"edit($index)\">{{ 'EDIT' | translate }}</button> \n" +
    "                            <button class=\"btn btn-danger\" ng-click=\"remove(version.id_dados_revisao)\">{{ 'DELETE' | translate }}</button>\n" +
    "                        </td>\n" +
    "                    </tr>\n" +
    "                    <tr ng-show=\"$data.length == 0\" class=\"warning\">\n" +
    "                        <td colspan=\"3\" align=\"center\">{{ 'VERSION_NOT_FOUND' | translate }}</td>\n" +
    "                    </tr>\n" +
    "                </tbody>\n" +
    "            </table>\n" +
    "        </div>\n" +
    "    </div>\n" +
    "</div>\n" +
    "\n" +
    "<a href=\"#/actors\" class=\"btn btn-info\"><< {{ 'ACTORS' | translate }}</a>\n" +
    "<a href=\"#/use-case\" class=\"btn btn-info\"> {{ 'NEXT' | translate }}</a>"
  );

}]);
