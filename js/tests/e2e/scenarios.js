describe('PHPUnit', function() {

    describe('Article list view', function() {

        beforeEach(function() {
            browser().navigateTo('../../../index.html');
        });


        it('should filter the article list as user types into the search box', function() {
            expect(repeater('#articles div').count()).toBe(3);

            input('query').enter('github');
            expect(repeater('#articles div').count()).toBe(1);

            input('query').enter('phpunit');
            expect(repeater('#articles div').count()).toBe(3);

        });
    });
});