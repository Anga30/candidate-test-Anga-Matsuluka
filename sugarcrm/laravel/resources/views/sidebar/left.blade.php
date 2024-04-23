<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/bootstrap.css" rel="stylesheet"/>
        <style>
            body {
                background: #e3e3e3;
            }
        </style>
    </head>
    <body ng-app="modulesList">
        <div id="sidebar" ng-controller="ModuleController" class="container-fluid">
            <div class="input-group mb-3">
                <input type="text" class="form-control" ng-model="caseNumber" placeholder="Case Number" aria-label="Case Number" aria-describedby="button-addon2">
                <button ng-click="findAndShowCase()" class="btn btn-outline-secondary" type="button">Search</button>
            </div>
            <div ng-show="!shownCase">
                @if ( count($moduleVardefs) )
                    @foreach ($moduleVardefs as $beanName => $moduleVardef)
                        <div class="input-group mb-3">
                            <button ng-click="requestPage('/module/{{$beanName}}/listview')" class="btn btn-outline-secondary">View {{$moduleVardef['labelPlural']}} >>></button><br>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info">Modules will appear here</div>
                @endif
            </div>
            <div ng-show="shownCase">
                @verbatim
                    <div class="card" style="width: 18rem;">
                        <div class="card-header clearfix">
                            Case {{showCase.id}} <button ng-click="clearShownCase()" type="button" class="btn-close float-end" aria-label="Close"></button>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name: {{ shownCase.name }}</li>
                            <li class="list-group-item">Type: {{ shownCase.type }}</li>
                            <li class="list-group-item">Status: {{ shownCase.status }}</li>
                            <li class="list-group-item">Created: {{ shownCase.created_at }}</li>
                        </ul>
                    </div>
                @endverbatim
            </div>
            <div class="fixed-bottom">
                <a href="/instructions" target="_blank" type="button" class="btn btn-warning" id="test-instructions-btn">Test Instructions</a>
            </div>
        </div>
        <script src="/js/angular.min.js"></script>
        <script src="/js/sidebarApp.js"></script>
    </body>
</html>