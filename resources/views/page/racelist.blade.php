@extends('layout.angular')

@section('title', 'Race List')


@section('content')
<div class="row col-xs-12">
    <table class="table" ng-init="getRaces();">
        <tr>
            <th>Track</th>
            <th>Class</th>
            <th>No. of Competitors</th>
            <th>Race Time</th>
            <th>Betting Closes</th>
        </tr>
        <tr ng-repeat="(id, races) in raceList track by $index">
            <td><a href="{{ route('race') }}/<% races.id %>"><% races.meeting %></a></td>
            <td><% races.type %></td>
            <td><% races.competitors_count %></td>
            <td><% races.eventTime %></td>
            <td><% races.closeTime %></td>
        </tr>
    </table>
</div>       
@endsection

@section('footerScripts')
    @parent
    <script>
        app.controller('ladbrokesCtrl', ['$scope', '$http', function($scope, $http) {

            $scope.raceList = [];

            $scope.getRaces = function () {
                var url = '/api/races';
                var method = 'GET';

                $http({
                    method  : method,
                    url     : url,
                    headers : { 'Content-Type': 'application/json' }  
                })
                .then(function(response) {   
                    if (typeof response.data == 'object') {
                        $scope.raceList = response.data;
                            
                    }
                });
            }
        }]);
    </script>
@endsection