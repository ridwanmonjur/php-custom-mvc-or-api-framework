const select = document.getElementById("productType");
const switcher = document.getElementById("switch");
console.log({ select });
select.onchange = function() {
    console.log({ value: select.value });
    const importedFile = select.value ?? "none"
   
    fetch(`${window.location.origin}/scandiweb-test/app/views/product/partialForm/${importedFile}_form.php`)
    .then((response)=> response.text())
    .then((value)=>{
        switcher.innerHTML = value;
    })
}