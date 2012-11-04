function ArticleCtrl($scope, $http) {

    method = 'GET';
    url = 'js/tests/sample-data/article.json';

    $http({method: method, url: url}).success(function(data) {
        $scope.articles = data;
    })
    .error(function(data, status, headers, config) {
        if( status == 404 )
        {
            alert("Omlouváme se, ale články nejsou momentálně dostupné. Zkuste to prosím později.");
        }
    });
}

