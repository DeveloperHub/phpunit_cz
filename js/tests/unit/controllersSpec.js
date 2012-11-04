describe('Controllers', function(){

    it('should create "articles" model with 3 articles', function() {
        var scope = {},
            ctrl = new ArticleCtrl(scope);

        expect(scope.articles.length).toBe(3);
    });
});
