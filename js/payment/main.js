$(function() {
    $('[data-toggle="tooltip"]').tooltip();

    $('[data-method="' + $('.paymentMethodType').val() + '"]').tab('show');

    $("[data-toggle='pill']").on('show.bs.tab', function(e){
        $('.paymentMethodType').val($(e.target).data('method'));
    });

    $(".transaction-amount").inputFilter(function(value) {
        return /^\d*[.]?\d*$/.test(value);
    });

    recalculateTotal();

    $('.transaction-amount').on('change', recalculateTotal);

    $('form').on('submit', function () {
        if (grecaptcha.getResponse() === '') {
            $('.captcha-validation').addClass('d-block');

            return false;
        }
    });
});

function recalculateTotal() {
    var amount = (Math.round(parseFloat($('.transaction-amount').val()) * 100) / 100) || 0;

    $('.transaction-amount').val(amount.toFixed(2));
    $('.info-amount').text('$' + amount.toFixed(2));
    $('.info-amount').parents('a.nav-link').each(function () {
        var fee = (Math.round(parseFloat($(this).data('fee-value')) * 100) / 100);

        if ($(this).data('fee-type') === 'part') {
            fee = Math.round((amount * $(this).data('fee-value')) * 100) / 100;
            var fees = 3.5/100 * amount;
            $(this).find('.info-fee').text('$' + fees.toFixed(2));
        }

        $(this).find('.info-total').text('$' + (fees + amount).toFixed(2));
        $(this).find('.info-total2').text('$' + (fee + amount).toFixed(2));
    });
}

(function($) {
    $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            }
        });
    };
}(jQuery));
