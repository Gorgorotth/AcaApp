
let addPartBtnTimesClicked = 0;

$('#addPartButton').on('click', addParts);
$(document).on('click', '.addPartCloseBtn', deletePart);

function addParts() {
    let addPart = $($('#createInvoicePart').html());
    addPartBtnTimesClicked += 1;
    addPart.find('.addPartName').map((index, element) => {
        return $(element).attr('name', $(element).attr('name') + `[${addPartBtnTimesClicked}]`)
    });
    $('#containerLocation').append(addPart);
}

function deletePart() {
    $(this).closest('.addPartContainer').fadeOut(300);
}

