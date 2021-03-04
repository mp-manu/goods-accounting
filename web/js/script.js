$("#btn-row").click(function() {
    var clone = $('#form-row').clone('.fields-frm');
    clone.find("#btn-row").remove();
    $('.new-rows').append(clone);
});

function delBtn(el){
    $(el).closest('#form-row').remove();
}
