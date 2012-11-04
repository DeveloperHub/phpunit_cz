describe('PHPUnit', function() {

    describe('Index.html e2e tests suite', function() {

        beforeEach(function() {
            browser().navigateTo('../../../index.html');
        });


        it('exists any article', function() {
            expect(repeater('#articles div').count()).toBe(3);

            input('query').enter('github');
            expect(repeater('#articles div').count()).toBe(1);

            input('query').enter('phpunit');
            expect(repeater('#articles div').count()).toBe(3);

        });

        it('exists any category', function(){
           expect(repeater('#category-list li').count()).toBe(7);
        });
    });
});