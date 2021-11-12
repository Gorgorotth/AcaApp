let dataArray = {
    addEmailBtnTimesClicked: 0,
    addMechanicBtnTimesClicked: 0
}

$(document).on('click', '.add-to-garage-close-btn', removeFromGarage);
$(document).on('click', '.add-item-to-garage', addItemToGarage);
$(document).on('click', '#create-mechanic-submit-btn', checkCreateMechanicPassword);

function checkCreateMechanicPassword(e) {
    e.preventDefault();
    let name = $('#create-mechanic-name');
    let email = $('#create-mechanic-email');
    let password = $('#create-mechanic-password');
    let confirmPassword = $('#create-mechanic-confirm-password');
    let errorLabel = $('#create-mechanic-error-label');
    if (name.val() || email.val()) {
        if (password.val() !== confirmPassword.val()) {
            errorLabel.text('-Wrong Password');
            confirmPassword.addClass('border-danger');
            password.addClass('border-danger');
        } else if (!password.val() || !confirmPassword.val()) {
            errorLabel.text('-You must fill both password fields');
            confirmPassword.addClass('border-danger');
            password.addClass('border-danger');
        } else {
            $('#create-mechanic-form').submit();
        }
    } else {
        errorLabel.text('-All fields must be filled!!!');
    }
}

function addItemToGarage() {
    let chooseTemplate = $(this).attr('data-template');
    let addItem = $($(chooseTemplate).html());
    let clicked = dataArray[$(this).attr('data-times-clicked')] += 1;
    addItem.find('.add-to-garage').map((index, element) => {
        return $(element).attr('name', $(element).attr('name') + `[${clicked}]`)
    });
    let target = $(this).attr('data-target');
    $(target).append(addItem);
}

function removeFromGarage() {
    $(this).closest('.deleteContent').remove();
}