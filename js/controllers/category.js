function CategoryCtrl($scope, $http) {
    method = 'GET';
    url = 'js/tests/sample-data/category.json';

    $http({method: method, url: url}).success(function(data) {
        $scope.category = data;
    })
        .error(function(data, status, headers, config) {
            if( status == 404 )
            {
                alert("Omlouváme se, ale kategorie nejsou momentálně dostupné. Zkuste to prosím později.");
            }
        });
}
