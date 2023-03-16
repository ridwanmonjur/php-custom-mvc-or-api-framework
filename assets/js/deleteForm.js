const message = document.getElementById("messageWarning");
console.log({message});
function deleteForm(event) {
    event.preventDefault();
    var form = document.getElementById('delete_form');
    var checkboxes = form.getElementsByTagName('input');
    var is_checked = false;
    for (var x = 0; x < checkboxes.length; x++) {
        if (checkboxes[x].type == 'checkbox' && checkboxes[x].name == 'sku[]') {
            is_checked = checkboxes[x].checked;
            if (is_checked) break;
        }
    }
    if (is_checked) {
        form.submit();
        if (!message.classList.contains("is-hidden")) {
            message.classList.add("is-hidden");
        }
        return true;
    }
    if (message.classList.contains("is-hidden")) {
        message.classList.remove("is-hidden");
    }
   
    return false;
}


// Functions to open and close a modal