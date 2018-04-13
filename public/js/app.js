var app = (function ($) {
    var me = this;

    this.onSearch = function (search) {
        if(search === null || search === undefined) {
            return;
        }
        $('.error-message').addClass('hidden');
        $.ajax({
            url: '/search/ajax/' + me.sanitizeString(search),
            type: "GET",
            success: me.onApiCallSuccess,
            error: me.onApiCallError
        })
    };

    this.onApiCallSuccess = function (data) {
        $('#search-results').show().html(data);
        $('#results-table').DataTable();
    };

    this.onApiCallError = function (data) {
        $('#search-results').hide();
        $('.error-message').removeClass('hidden');
    };

    this.init = function () {
        $('#search').click(function () {
            me.onSearch($('#place').val());
        });

        $('#place').keypress(function (e) {
            if (e.which === 13) {
                me.onSearch($('#place').val());
            }
        });
    };

    this.sanitizeString = function(str){
        str = str.replace(/[^a-z0-9áéíóúñü \.,_-]/gim,"");
        str = str.replace(/ /g,"+");
        return str.trim();
    };

    return {
        init: me.init
    }
}(jQuery));

jQuery(document).ready(function () {
    app.init();
});
