require([
    'jquery',
    'jquery/ui'
], function ($) {
    function reserve1() {
        $.ajax('/geomodal/geoip/geoip')
            .then(
                function success(response) {
                    // console.log(response);
                    reserveSuccess(response);
                },

                function fail(data, status) {
                    console.log('We couldn\'t determine your country by ip. Returned status of',
                        status);
                }
            );
    }

    function reserveSuccess(response) {
        var resps = response.split('/');
        decideOnPopup(resps[0], resps[1]);
    }
    function checkCookies() {
        if (cookieGeoModal.getCookie('geoip_check')) {
            return true;
        }
        else {
            cookieGeoModal.setCookie('geoip_check', '1', '1');
            return false;
        }
    }
    function decideOnPopup(countryCodeAjax, currentSite) {
        if (currentSite == 'german') {
            if (countryCodeAjax == 'US' || countryCodeAjax == 'CA') {
                if(!checkCookies()) {
                    geomodal.showPopup('auto_us_on_gl-de');
                }
            }
            else if (countryCodeAjax === 'IL') {
                geomodal.showPopup('auto_il_on_de');
            }
            else if (countryCodeAjax != 'DE' && countryCodeAjax != 'AT') {
                geomodal.showPopup('auto_gl-de_on_de-gl');
            }
            else {
                geomodal.additionalActions(true, false, false);
            }
        }
        else if (currentSite == 'global') {
            if (countryCodeAjax == 'US' || countryCodeAjax == 'CA') {
                if(!checkCookies()) {
                    geomodal.showPopup('auto_us_on_gl-de');
                }
            }
            else if (countryCodeAjax == 'DE' || countryCodeAjax == 'AT') {
                geomodal.showPopup('auto_gl-de_on_de-gl');
            }
            else if (countryCodeAjax === 'IL') {
                geomodal.showPopup('auto_il_on_de');
            }
            else {
                geomodal.additionalActions(true, false, false);
            }
        }
        else if (currentSite == 'israel') {
            if (countryCodeAjax == 'US' || countryCodeAjax == 'CA') {
                if (!checkCookies()) {
                    geomodal.showPopup('auto_us_on_il');
                }
            }
            else if (countryCodeAjax == 'DE' || countryCodeAjax == 'AT') {
                geomodal.showPopup('auto_de_on_il');
            }
            else if (countryCodeAjax != 'IL') {
                geomodal.showPopup('auto_gl_on_il');
            }
            else {
                geomodal.additionalActions(true, false, false);
            }
        }
        else {
            if (countryCodeAjax != 'US' && countryCodeAjax != 'CA') {
                geomodal.showPopup('auto_gl-de_on_us');
            }
        }
    }
    $.ajax('/geomodal/config/autopopup')
        .then(
            function success(response) {
                if (response) {
                    reserve1();
                }
            },

            function fail(data, status) {
                console.log('Request to config autopopup controller failed.  Returned status of',
                    status);
            }
        );

});