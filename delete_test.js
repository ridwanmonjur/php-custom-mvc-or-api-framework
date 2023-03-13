// Feature('delete');

// Scenario('test something', ({ I }) => {
//     I.amOnPage('/');
//     I.seeElement('.delete-checkbox');
//     I.executeScript(function () {
//         checkboxes = document.getElementsByClassName('delete-checkbox');
//         for (i = 0; i < checkboxes.length; i++) {
//             checkboxes[i].checked = true;
//         }
//     });
//     I.click("MASS DELETE");
//     I.amOnPage('/');
//     I.waitForInvisible('.delete-checkbox');
// });


Feature('edit');

Scenario('test something', ({ I }) => {
    I.amOnPage('/');
    I.click('ADD');
    I.seeElement('#product_form');
    I.fillField('#sku', 'InvalidInput');
    I.fillField('#name', 'InvalidName22');
    I.fillField('#price', 'E');
    I.selectOption('#productType', 'Book');
    I.fillField('#weight', 'E');
    I.click('Save');
});

