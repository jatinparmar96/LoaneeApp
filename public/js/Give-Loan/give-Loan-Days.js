function updateImage(input, id) {
    let canvas = $('#' + id + 'image');
    let reader = new FileReader();
    reader.onload = function (e) {
        canvas.attr('src', e.target.result)
            .width(150)
            .height(150);
        $('#' + id + 'image_src').val(canvas.attr('src'));
    };
    console.log('#' + id + 'image_src');
    reader.readAsDataURL(input.files[0]);
}

function parseData(data) {
    let array = [];
    data = JSON.parse(data);
    data.forEach(function (value, id) {
        array.push(value['name'] + '-' + value['id'])
    });
    return (array);
}

function updateInstallment() {
    let loanAmount = $('#loanAmount');
    let period = $('#period');
    let installmentSelector = $('#installment');
    let method = $('input[name="Method"]:checked');
    let installment = 0;
    installment = loanAmount.val() / period.val();
    if (method.val() === 'Weekly') {
        installment = installment * 7;

    }
    else if (method.val() === 'Monthly') {
        installment = installment * 30;
    }
    // if (type.val() === 'Percentage') {
    //     let percentage = $('#lending_period');
    //     installment = loanAmount.val() / period.val();
    //     installment = Math.ceil(installment);
    // }
    installment = Math.ceil(installment);
    installmentSelector.val(installment);
}

function initBloodHound(data) {
    let users = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: data
    });
    $('input[name="agent"]').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'users',
            source: users
        });
}

$('.form-control.date').mask('00/00/0000');

function updateStartingDate() {
    let date = $('#start-date').val();
    let d = Date.parse(date);
    let endDate;
    endDate = d.add(Number($('input[name="grace_period"]').val())).days();
    let end = endDate.toString('dd/MM/yyyy');
    $('#endDate').val(end);
}

$("#mainForm").submit(function (e) {
    e.preventDefault();
    $(this).find(':input[type=submit]').prop('disabled', true);
    var form = $(this);
    var url = form.attr('action');
    let options = {
        style: 'circle',
        title: 'Success',
        message: 'Loan Added Successfully',
        position: 'top-right',
        type: 'success',
        timeout: 5000
    };
    let error = {
        style: 'circle',
        title: 'Error',
        message: 'Loan Could Not be Entered Successfully',
        position: 'top-right',
        type: 'danger',
        timeout: 5000
    };
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function (data) {
            if (data.errors) {
                for (let prop in data.errors) {
                    error.message = data.errors[prop][0];
                    $('body').pgNotification(error).show();
                }
            }
            else {
                $('body').pgNotification(options).show();
            }
            console.log(data); // show response from the php script.
            form.find(':input[type=submit]').prop('disabled', false);

        }
    });

    return false // avoid to execute the actual submit of the form.
});
