$(function() {
    $.extend({
        formatCurrency: function (nStr, decSeperate, groupSeperate) {
            if(nStr == null) {
                return '0 ' + Constants.CURRENCY;
            }
            nStr = Math.round(Number(nStr));
            nStr += '';
            x = nStr.split(decSeperate);
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
            }
            return x1 + x2 + '₫';
        }
    })
})