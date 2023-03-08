function deleteForm(event) {
    event.preventDefault();
    var form = document.getElementById('delete_form');
    var inputs = form.getElementsByTagName('input');
    var is_checked = false;
    for (var x = 0; x < inputs.length; x++) {
        if (inputs[x].type == 'checkbox' && inputs[x].name == 'sku[]') {
            is_checked = inputs[x].checked;
            if (is_checked) break;
        }
    }
    if (is_checked) {
        form.submit();
    }
    else {
        M.toast({html: 'You should check one of the checkboxes to delete!'})
        return false;
    }
}