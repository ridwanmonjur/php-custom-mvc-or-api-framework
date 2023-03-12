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
    }
    else {
        M.toast({html: 'You should check one of the checkboxes to delete!'})
        return false;
    }
}