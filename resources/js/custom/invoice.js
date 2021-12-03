let addJobBtnTimesClicked = 0;

$(function () {
    $(document).on('click', '.add-part-close-btn', deletePart);
    $(document).on('click', '.add-invoice-part', addJob);
    sessionSuccess();
    sessionError();
    sessionCatchExceptionMessage();
})

function sessionSuccess()
{
    let message = $('#session-success').val();
    if (message){
        toastr.success(message);
    }
}

function sessionError()
{
    let message = $('#session-custom-error').val();
    if (message){
        toastr.error(message);
    }
}

function sessionCatchExceptionMessage()
{   let message = $('.session-catch-exception').val() ;
    if (message)
    {
        toastr.error(message);
    }
}

function addJob()
{
    let chooseTemplate = $(this).attr('data-template');
    let targetLocation = $(this).attr('data-target');
    let addJob = $($(chooseTemplate).html());
    addJobBtnTimesClicked += 1;
    addJob.find('.add-part-name').map((index, element) => {
        return $(element).attr('name', $(element).attr('name') + `[${addJobBtnTimesClicked}]`)
    });
    $(targetLocation).append(addJob);
}

function deletePart()
{
    // $(this).closest('.addPartContainer').remove();
    let panel = $(this).closest('.addPartContainer');
    panel.slideUp(function() {
        panel.remove();
    });

}

