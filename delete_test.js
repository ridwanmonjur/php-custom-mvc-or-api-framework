Feature('delete');

Scenario('test something',  ({ I }) => {
    I.amOnPage('/');
    I.seeElement('.delete-checkbox');
    I.executeScript(function(){
        checkboxes = document.getElementsByClassName('delete-checkbox');
        for (i=0; i<checkboxes.length;i++){
            checkboxes[i].checked=true;
        }
    });
    I.click("MASS DELETE");
    I.amOnPage('/');
    I.waitForInvisible('.delete-checkbox');
});
