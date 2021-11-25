
$('#changeMechanicPasswordBtn').on('click', validateNewMechanicPassword);

function validateNewMechanicPassword(e)
{
    e.preventDefault();
    let wrongPasswordLabel = $('#wrong-password-label');
    let newPassword = $('#new-password');
    let confirmPassword = $('#confirm-password');
    if (newPassword.val() !== confirmPassword.val()){
        wrongPasswordLabel.text('-Wrong Password');
        confirmPassword.addClass('border-danger');
    }else if (!newPassword.val() || !confirmPassword.val()){
        wrongPasswordLabel.text('-You must fill both password fields');
        confirmPassword.addClass('border-danger');
        newPassword.addClass('border-danger');
    }else {
        $('#changeMechanicPassword').submit();
    }

}


