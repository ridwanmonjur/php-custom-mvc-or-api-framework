function validateForms(event) {
    const input = event.target;
    const inputName = input.name;
    const value = input.value;
    const grandParent = input.parentElement.parentElement;
    const lastGrandChild = grandParent.lastElementChild;
    if (value.trim() == "") {
        lastGrandChild.innerHTML = `<span class="has-text-danger"> Please, a value is required for this field: ${inputName}. </span>`;
    }
    else {
        lastGrandChild.innerHTML = "";
    }
    // const validityState = input.validity;
    // if (validityState.badInput) {
    //     input.setCustomValidity(`Please, submit data in numeric format for field: ${inputName} `);
    // }
    // else if (validityState.patternMismatch) {
    //     input.setCustomValidity(`Please, submit data  of indicated alphanumeric type for field: ${inputName} `);
    // }
    // else if (validityState.stepMismatch) {
    //     input.setCustomValidity(`Please, submit data in required step for field: ${inputName} `);
    // }
    // else if (validityState.valueMissing) {
    //     input.setCustomValidity(`Please, submit required data for field: ${inputName} `);
    // }
    // else {
    //     input.setCustomValidity("");
    // }

    // input.reportValidity();
}

function validateFormNumbers(event) {
    const input = event.target;
    const inputName = input.name;
    const value = input.value;
    const grandParent = input.parentElement.parentElement;
    const lastGrandChild = grandParent.lastElementChild;
    if (value.trim() == "") {
        lastGrandChild.innerHTML = `<span class="has-text-danger"> Please, a value is required for this field: ${inputName}. </span>`;
    }
    else if (isNaN(value)) {
        lastGrandChild.innerHTML = `<span class="has-text-danger"> Please, submit a numberic value field: ${inputName}. </span>`;
    }
    else if (Number(value) <= 0) {
        lastGrandChild.innerHTML = `<span class="has-text-danger"> Please, submit a higher number greater than 0 for field: ${inputName}. </span>`;
    }
    else {
        lastGrandChild.innerHTML = "";
    }

}
