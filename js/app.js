angular.module('phpunit', []).
    config(['$routeProvider', function($routeProvider) {
    $routeProvider.
        when('/articles', {templateUrl: 'template/article-list.html', controller: ArticleCtrl}).
        when('/article/:articleId', {templateUrl: 'template/article-detail.html', controller: ArticleDetailCtrl}).
        otherwise({redirectTo: '/articles'});
}]);