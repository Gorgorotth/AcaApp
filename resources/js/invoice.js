let addJobBtnTimesClicked = 0;

// $('#add-invoice-part').on('click', addParts);
$(document).on('click', '.add-part-close-btn', deletePart);
$(document).on('click', '.add-invoice-part', addJob);

function addJob() {
    let chooseTemplate = $(this).attr('data-template');
    let addJob = $($(chooseTemplate).html());
    addJobBtnTimesClicked += 1;
    addJob.find('.add-part-name').map((index, element) => {
        return $(element).attr('name', $(element).attr('name') + `[${addJobBtnTimesClicked}]`)
    });
    $('#containerLocation').append(addJob);
}

function deletePart() {
    $(this).closest('.addPartContainer').fadeOut(300);
}

