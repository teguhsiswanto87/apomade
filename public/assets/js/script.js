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

    // data tables
    $('#table_sellings_details').DataTable();


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
$('#si_products input[type=checkbox]').on('click', countChecked);
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
        // bg inactive & hover
        $('#index_si_item' + v).mouseover(function () {
            $(this).css('background-color', '#e8e8e8');
        }).mouseout(function () {
            $(this).css('background-color', '#fff');
        });

    });
    // For Checked
    var total = 0;
    var modal = 0;
    $("#inp_si_omzet").val(total);
    $("#inp_si_omzet_fake").val(total);
    $.each(indexsChecked, function (idx, value) {

        // set visible QTY
        $('#layout_si_qty' + value).css('display', 'flex');
        // bg active & hover
        $('#index_si_item' + value).mouseover(function () {
            $(this).css('background-color', '#e8e8e8');
        }).mouseout(function () {
            $(this).css('background-color', '#f0f0f0');
        });


        // add required
        $('#inp_si_qty' + value).prop('required', true);
        if ($('#inp_si_qty' + value).val() == '') {
            $('#inp_si_qty' + value).val(1); // min 1 qty
        }

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
        var profit = turnover - modal;//tanpa dikurangi voucher soalnya sudah di turnover

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

// Selling :: Edit
// selling detail insert on change
var check_se_product = $('#se_products :checkbox').on('change', function () {
    var index = 0;
    var indexsChecked = [];
    var indexsUnChecked = [];

    //put array of index checked
    $('#se_products input[type=checkbox]').each(function () {
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
        $('#layout_se_qty' + v).css('display', 'none');
        // set QTY null or ''
        $('#inp_se_qty' + v).val('');
        // bg inactive & hover
        $('#index_se_item' + v).mouseover(function () {
            $(this).css('background-color', '#e8e8e8');
        }).mouseout(function () {
            $(this).css('background-color', '#fff');
        });

    });
    // For Checked
    $.each(indexsChecked, function (idx, value) {

        // set visible QTY
        $('#layout_se_qty' + value).css('display', 'flex');
        // bg active & hover
        $('#index_se_item' + value).mouseover(function () {
            $(this).css('background-color', '#e8e8e8');
        }).mouseout(function () {
            $(this).css('background-color', '#f0f0f0');
        });

        // add required
        $('#inp_se_qty' + value).prop('required', true);
        if ($('#inp_se_qty' + value).val() == '') {
            $('#inp_se_qty' + value).val(1); // min 1 qty
        }

    });
});

//modal insert detail product
$('#btn_se_insertdetailproduct').click(function () {
    $('#modal_se_insertdetailproduct').modal({
        onDeny: function () {
            $('#se_products :checkbox:checked').prop('checked', false);
            // copy from checkbox triggered function
            $('[id^=layout_se_qty]').css('display', 'none');
            $('[id^=inp_se_qty]').val('');
            $('#btn_se_insertdetailproducts_ok').addClass('disabled');
            $('#btn_se_insertdetailproducts_ok').text('Tambahkan');

            return true;
        },
        onApprove: function () {
            $('#form_se_insertdetailproducts').submit();
            return false;
        }
    }).modal('show');
});


// button tambahkan
var countChecked_2 = function () {
    var n = $('#se_products :checkbox:checked').length;
    $('#btn_se_insertdetailproducts_ok').text(function () {
        if (n >= 1) {
            $('#btn_se_insertdetailproducts_ok').removeClass('disabled');
            return 'Tambahkan (' + n + ')';
        } else {
            $('#btn_se_insertdetailproducts_ok').addClass('disabled');
            return 'Tambahkan';
        }
    });
};
countChecked_2();
$('#se_products :checkbox').on('click', countChecked_2);

//modal increase qty of detail product
//1. read all modal and his button
$btnIncreaseQty = [];
for ($i = 0; $i < $('#data_se_sumProductSold').val(); $i++) {
    $btnIncreaseQty.push('btn_se_increaseQty' + $i);
}
//2. mapping button + modal + form ID
$.each($btnIncreaseQty, function (index, value) {
    // index = 1,2,3,...
    // value = btn_se_increaseQty...
    $('#' + value).click(function () {
        $('#modal_se_increaseQty' + index).modal({
            onDeny: function () {
                $('#modal_se_increaseQty' + index + ' input[type=number]').val('');
                return true;
            },
            onApprove: function () {
                $('#form_se_increaseQty' + index).submit();
                return false;
            }
        }).modal('show');
    });
});

//modal decrease qty of detail product
$btnDecreaseQty = [];
for ($i = 0; $i < $('#data_se_sumProductSold').val(); $i++) {
    $btnDecreaseQty.push('btn_se_decreaseQty' + $i);
}
//2. change value in the form
$.each($btnDecreaseQty, function (index, value) {
    // index = 1,2,3,...
    // value = btn_se_decreaseQty...
    $('#' + value).click(function () {
        //replace value
        $('#modal_se_decreaseQty .header').html('Kurangi Jumlah \"' + $('#items_se_product' + index + ' .header').text() + '\"');
        $('#data_se_decreaseQty_sellings_id').val($('#data_se_sellings_id' + index).val());
        $('#data_se_decreaseQty_products_id').val($('#data_se_products_id' + index).val());
        $('#data_se_decreaseQty_qty').attr({
            'max': ($('#data_se_qty' + index).val() - 1)
        });
        $('#data_se_decreaseQty_qtyNow').html('Jumlah saat ini: ' + $('#data_se_qty' + index).val());

        //modal options
        $('#modal_se_decreaseQty').modal({
            onDeny: function () {
                $('#modal_se_decreaseQty input[type=number]').val('');
                return true;
            },
            onApprove: function () {
                $('#form_se_decreaseQty').submit();
                return false;
            }
        }).modal('show');
    });
});

//selling edit form
var form_se_omzet = function () {
    var se_sellingprice_x_qty = 0;
    var se_capital_x_qty = 0;
    for ($i = 0; $i < $('#data_se_sumProductSold').val(); $i++) {
        //sum shopping total
        var sellingprice_x_qty_string = $('#data_se_sellingricexqty' + $i).val();
        se_sellingprice_x_qty += parseInt(sellingprice_x_qty_string);
        //sum capital
        var capital_x_qty_string = $('#data_se_capitalxqty' + $i).val();
        se_capital_x_qty += parseInt(capital_x_qty_string);
    }
    // selling price x qty (shopping total)
    $('#se_sd_shoppingTotal').val(se_sellingprice_x_qty);
    //capital
    $('#se_sd_capital').val(se_capital_x_qty);
    //discount
    var voucher_discount = parseInt($('#se_voucher_discount').val());
    //shipping tax
    var shipping_tax_percent = $("input[name='shipping_tax']:checked").val();
    var shippingTax = shipping_tax_percent * se_sellingprice_x_qty / 100;
    $('#se_sd_shippingTax').val(shippingTax);
    $('#span_se_shippingTax').html(shippingTax);
    //omzet
    var omzet = se_sellingprice_x_qty - voucher_discount - shippingTax;
    $('#inp_se_omzet_fake').val(omzet);
    //profit
    var profit = omzet - se_capital_x_qty;
    $("#form_se_edit_sellings input[name='profit']").val(profit);

};
form_se_omzet();
$('#form_se_edit_sellings').on('change', form_se_omzet);
