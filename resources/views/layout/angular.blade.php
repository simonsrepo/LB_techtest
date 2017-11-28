<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        @section('styleSheets')
            <link href="{{ mix('/css/app.css') }}" rel="stylesheet" type="text/css">
        @show
        @section('headerScripts')
            <script src="{{ mix('/js/app.js') }}" ></script>
        @show
    </head>
    <body>
        @section('nav')
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span> Races</a>
        </nav>
        @show
        <div class="container" ng-app="myApp" ng-controller="ladbrokesCtrl">
            @yield('content')
        </div>
    </body>
    @section('footerScripts')
    <script>
        var app = angular.module('myApp', [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });
    </script>
    @show
</html>
