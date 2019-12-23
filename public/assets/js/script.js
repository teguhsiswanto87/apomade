// Template
$(document).ready(function () {
    $('.ui.dropdown').dropdown();
    $('.sidebar-menu-toggler').on('click', function () {
        var target = $(this).data('target');
        $(target)
            .sidebar({
                dinPage: true,
                transition: 'overlay',
                mobileTransition: 'overlay'
            })
            .sidebar('toggle');
    });

    //data tables
    $('#transaction').DataTable();

});

// message box
$('.message .close')
    .on('click', function () {
        $(this)
            .closest('.message')
            .transition('fade');
    });

$('.ui.accordion')
    .accordion();

// date picker for Semantic UI
$('#example2').calendar({
    type: 'date',
    monthFirst: false,
    formatter: {
        date: function (date, settings) {
            if (!date) return '';
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            return year + '-' + month + '-' + day;
        }
    }
});

// Selling Insert :: Behavior Customize
// 1. Button tambahkan
var countChecked = function () {
    var n = $('input[type=checkbox]:checked').length;
    $('#btn_si_ok').text(function () {
        if (n >= 1) {
            $('#btn_si_ok').removeClass('disabled');
            return 'Tambahkan (' + n + ')';
        } else {
            $('#btn_si_ok').addClass('disabled');
            return 'Tambahkan';
        }
    });
};
countChecked();
$('input[type=checkbox]').on('click', countChecked);
// 2. Tambah Catatan
$('#btn_si_note').on('click', function () {
    $('#btn_si_note').css('display', 'none');
    $('#inp_si_note').css('display', 'inline-block');
});
// 3. Omzet | Tax
$('#si_products, #si_sellings').on('change', function () {
    var index = 0;
    var indexsChecked = [];
    var indexsUnChecked = [];

    var shipping_tax_percent = parseFloat($('input[name=shipping_tax]:checked').val() / 100);
    var voucher_discount = $('input[name=voucher_discount]').val();

    //put array of index checked
    $('#si_products input[type=checkbox]').each(function () {
        if (this.checked) {
            indexsChecked.push(index);
        } else {
            indexsUnChecked.push(index);
        }
        index++;
    });
    // For UnChecked
    $.each(indexsUnChecked, function (i, v) {
        // set Invisible QTY
        $('#layout_si_qty' + v).css('display', 'none');
        // set QTY null or ''
        $('#inp_si_qty' + v).val('');
    });
    // For Checked
    var total = 0;
    var modal = 0;
    $("#inp_si_omzet").val(total);
    $("#inp_si_omzet_fake").val(total);
    $.each(indexsChecked, function (idx, value) {

        // set visible QTY
        $('#layout_si_qty' + value).css('display', 'flex');

        // add required
        $('#inp_si_qty' + value).prop('required', true);

        //value of SELLING_PRICE, CAPITAL
        var capital_string = $('#capital' + value).val();
        var selling_price_string = $('#selling_price' + value).val();
        var qty_string = $('#inp_si_qty' + value).val();
        var selling_price = parseInt(selling_price_string);
        var capital = parseInt(capital_string);
        var qty = parseInt((qty_string == '') ? 0 : qty_string);

        //total capital/modal (Harga Beli X Jumlah Jual)
        modal += (capital * ((qty < 0) ? 0 : qty));
        //total selling price => (Harga Jual X Jumlah Jual)
        total += (selling_price * ((qty < 0) ? 0 : qty));
        // tax
        var shipping_tax = (shipping_tax_percent * total);

        // (Omzet) = (Harga Jual X Jumlah Jual) - (Pajak Ongkir X (Harga Jual X Jumlah Jual)) - Diskon Voucher
        var turnover = total - shipping_tax - voucher_discount;
        // (Profit) = (Omzet - (Harga Beli X Jumlah Jual) - Diskon Voucher)
        var profit = turnover - modal - voucher_discount;

        $("#profit").val(profit);
        $("#inp_si_omzet").val(turnover);
        $("#inp_si_omzet_fake").val(turnover);

    });
});

// Product :: Insert
$('#pi_insert, #pi_edit').on('input', function () {
    var capital = $('#inp_pi_capital').val();
    var selling_price = $('#inp_pi_sellingprice').val();
    var gross_profit = selling_price - capital;

    $('#inp_pi_grossprofit').val(gross_profit);
});
