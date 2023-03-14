function validateForms(event) {
    const input = event.target;
    const validityState = input.validity;
    const inputName = input.name;
    if (validityState.badInput) {
        input.setCustomValidity(`Please, submit data in numeric format for field: ${inputName} `);
    }
    else if (validityState.patternMismatch) {
        input.setCustomValidity(`Please, submit data  of indicated alphanumeric type for field: ${inputName} `);
    }
    else if (validityState.stepMismatch) {
        input.setCustomValidity(`Please, submit data in required step for field: ${inputName} `);
    }
    else if (validityState.valueMissing) {
        input.setCustomValidity(`Please, submit required data for field: ${inputName} `);
    }
    else if (validityState.rangeUnderflow) {
        input.setCustomValidity(`Please, submit a higher number greater than 0 for field: ${inputName} `);
    } else if (validityState.rangeOverflow) {
        input.setCustomValidity(`Please, submit a lower number for field: ${inputName} `);
    }
    else {
        input.setCustomValidity("");
    }

    input.reportValidity();
}
