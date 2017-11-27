@extends('layout.angular')

@section('title', 'Race List')


@section('content')
<div class="row">
    <div class="col-xs-12">
        Track: <% track %> <br />
        Class: <% class %><br />
        Start Time: <% closeTime %><br />
        Betting Closes: <% eventTime %> 
    </div>
</div>    
<div class="row col-xs-12">
    <table class="table" ng-init="getCompetitors();">
        <tr>
            <th>Lane</th>
            <th>Competitor</th>
        </tr>
        <tr ng-repeat="(id, competitor) in competitorList track by $index">
            <td><% competitor.position %></td>
            <td><% competitor.competitorName %></td>
        </tr>
    </table>
</div>       
@endsection

@section('footerScripts')
    @parent
    <script>
        app.controller('ladbrokesCtrl', ['$scope', '$http', function($scope, $http) {

            $scope.competitorList = [];

            $scope.getCompetitors = function () {
                var url = '/api/races/competitors/{{ $raceID }}';
                var method = 'GET';

                $http({
                    method  : method,
                    url     : url,
                    headers : { 'Content-Type': 'application/json' }  
                })
                .then(function(response) {  
                    if (typeof response.data == 'object') {
                        $scope.competitorList = response.data.competitors;
                        $scope.track = response.data.meeting;
                        $scope.class = response.data.type;
                        $scope.closeTime = response.data.closeTime;
                        $scope.eventTime = response.data.eventTime;
                    }
                });
            }
        }]);
    </script>
@endsection