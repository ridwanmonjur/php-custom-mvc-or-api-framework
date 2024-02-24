const select = document.getElementById("productType");
const switcher = document.getElementById("switch");
const FORMS = ["Book", "Furniture", "Disc"];
select.onchange = function () {
    const valueSelect = select.value;
    // fetch(`app/views/product/partialForm/${valueSelect}_form.php`)
    //     .then((response) => response.text())
    //     .then((value) => switcher.innerHTML = value)
    FORMS.map((value) => {
        const elem = document.getElementById(`${value}Form`);
        if (!elem.classList.contains("is-hidden")) { elem.classList.add("is-hidden") };
        const inputs = document.querySelectorAll(`#${value}Form input`);
        Array.from(inputs).map((input)=> {
            console.log({input, disabled: input.disabled})
            input.setAttribute('disabled', true)
        })

    })
    if (String(valueSelect).trim()) {
        const selectedElem = document.getElementById(`${valueSelect}Form`);
        if (selectedElem.classList.contains("is-hidden")) { selectedElem.classList.remove("is-hidden") };
        const inputs = document.querySelectorAll(`#${valueSelect}Form input`);
        Array.from(inputs).map((input)=> input.removeAttribute('disabled'))
    }
}