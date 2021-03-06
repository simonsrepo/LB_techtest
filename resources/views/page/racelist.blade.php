@extends('layout.angular')

@section('title', 'Race List')


@section('content')
<div class="row col-xs-12">
    <table class="table table-striped raceList" ng-init="getRaces();">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Track</th>
                <th scope="col">Class</th>
                <th scope="col">No. of Competitors</th>
                <th scope="col">Race Time</th>
                <th scope="col">Betting Closes</th>
            </tr>
        </thead> 
        <tbody>   
            <tr ng-repeat="(id, races) in raceList track by $index">
                <td><a href="{{ route('race') }}/<% races.id %>"><% races.meeting %></a></td>
                <td><% races.type %></td>
                <td><% races.competitors_count %></td>
                <td><% races.eventTime %></td>
                <td><% races.closeTimer %></td>
            </tr>
        </tbody>    
    </table>
</div>       
@endsection

@section('footerScripts')
    @parent
    <script>
        app.controller('ladbrokesCtrl', ['$scope', '$http', '$interval', function($scope, $http, $interval) {

            $scope.raceList = [];
            $scope.fetchedData = [];
            var getNextData = true;
            var intervalPromise;
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
                        
                        $interval.cancel(intervalPromise);
                        $scope.fetchedData = response.data;
                        intervalPromise = $interval(reloadRaceList, 1000);
                        getNextData = true;
                    }
                });
            }

            var reloadRaceList = function () {
                $scope.raceList = [];
                var testdsdsd = '';
                var fetechedData = [];
                var addToRaceList = true;
                for(var x in $scope.fetchedData) {
                    var closeTime = $scope.fetchedData[x].closeTime;
                    var formattedCloseTime = formatTime(closeTime);
                    $scope.fetchedData[x].closeTimer = formattedCloseTime;
                    var eventTime = $scope.fetchedData[x].eventTime;

                    if (formattedCloseTime !== 'Ended') {
                        fetechedData.push($scope.fetchedData[x]);
                    } else {
                        if (getNextData) {
                            getNextData = false;
                            $scope.getRaces();
                        }
                    }
                    
                }
                $scope.raceList = fetechedData;
            }

            formatTime = function(dateTime) {
                var currentDate = new Date();
                var currentTime = currentDate.getTime();
                var millSecsInDay =  60 * 60 * 24 * 1000;


                var timer = Date.parse(dateTime);
                var timeDiff = (timer - currentTime);
                
                if (timeDiff <= 0) {
                    return 'Ended';
                }
                var countDown = new Date(timeDiff);
                var dateString = Math.floor(timeDiff / millSecsInDay) + ' Day(s) '; 
                dateString += countDown.getHours() + ' Hour(s) ';
                dateString += countDown.getMinutes() + ' Minute(s) ';
                dateString += countDown.getSeconds() + ' Second(s)';
                return dateString;
            }
        }]);
    </script>
@endsection