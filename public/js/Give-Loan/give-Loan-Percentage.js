function p_update_starting_date() {
    let date = $('#p_start_date').val();
    let d = Date.parse(date);
    let endDate;
    endDate = d.add(Number($('input[name="p_grace_period"]').val())).months();
    let end = endDate.toString('dd/MM/yyyy');
    $('#p_end_date').val(end);
}
function p_update_installment() {
    let loanAmount = $('#p_loan_amount');
    let period = $('#p_grace_period');
    let rate = $('#p_percentage');
    let installmentSelector = $('#p_installment');
    let installment = 0;
    installment = rate.val()/100 * loanAmount.val();
    installment = Math.ceil(installment);
    installmentSelector.val(installment);
}