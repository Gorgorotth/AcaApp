let addJobBtnTimesClicked = 0;

$(document).on('click', '.add-part-close-btn', deletePart);
$(document).on('click', '.session-close-button', deleteSession);
$(document).on('click', '.add-invoice-part', addJob);

window.onload = (event) => {
        setTimeout(destroySession, 5000);
}

function addJob()
{
    let chooseTemplate = $(this).attr('data-template');
    let addJob = $($(chooseTemplate).html());
    addJobBtnTimesClicked += 1;
    addJob.find('.add-part-name').map((index, element) => {
        return $(element).attr('name', $(element).attr('name') + `[${addJobBtnTimesClicked}]`)
    });
    $('#containerLocation').append(addJob);
}

function deletePart()
{
    $(this).closest('.addPartContainer').remove();

}

function destroySession(){
    $('.close-session-message-output').remove();
}

function deleteSession()
{
    $(this).closest('.close-session-message-output').remove();

}

// $('#create-invoice').on('submit', throwErrors);

// function throwErrors()
// {
//     let error = $('.error');
//     error.map((err, message)=>{
//         return toastr.error(message.val());
//     })
// }

