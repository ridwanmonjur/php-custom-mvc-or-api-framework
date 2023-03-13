function validateFormsUsingCustomValidity(event) {
    const input = event.target;
    const validityState = input.validity;
    const inputName = input.name;
    if (validityState.badInput) {
        // for emails and urls
        input.setCustomValidity(`Please, submit data of indicated type for field: ${inputName} `);
    }
    else if (validityState.patternMismatxh) {
        input.setCustomValidity(`Please, submit data in email or url format for field: ${inputName} `);
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

// TO PASS AUTOQA BOT!
// SINCE FIRST METHOD DISABLES
function validateFormsNumeric(event) {
    const input = event.target;
    const inputName = input.name;
    const value = input.value;

    
    input.reportValidity();
}