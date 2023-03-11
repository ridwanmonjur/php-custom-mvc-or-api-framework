const select = document.getElementById("productType");
const switcher = document.getElementById("switch");
select.onchange = function () {
    const importedFile = select.value;
    if (String(importedFile).trim()) {
        fetch(`app/views/product/partialForm/${importedFile}_form.php`)
            .then((response) => response.text())
            .then((value) => switcher.innerHTML = value)
    }
}