var geomodal = {
    showPopup: function (country) {

        // Display the dialog

        if (jQuery(window).width() < 1000) {
            _width = 320;
        }
        else {
            _width = 'auto';
        }

        jQuery("#geomodal-dialog").dialog({
            modal: true,
            resizable: false,
            draggable: false,
            width: _width,
            padding: 0,
            autoOpen: false,
            dialogClass: 'ui-widget--dark geomodal-dialog',
            open: function (event, ui) {
                jQuery('.ui-widget-overlay').addClass('ui-widget-overlay--dark');
            }
        });

        if (country == 'auto_gl-de_on_us') {
            this.additionalActions(true, true, true);
        }
        if (country == 'auto_us_on_gl-de' || country == null || country == 'auto_gl-de_on_de-gl') {
            this.isLoaded('.ui-widget-overlay').then (function (node) {
                jQuery(node).on('click', function () {
                        jQuery(this).siblings('.ui-dialog').find('.ui-dialog-content').dialog('close');
                });
            });
        }
        if (country == 'auto_gl-de_on_de-gl') {
            this.additionalActions(true, false, false);
        }

        if (country === 'auto_us_on_il' ){
            this.additionalActions(false, false, true);
        }

        if (country === 'auto_de_on_il' || country === 'auto_gl_on_il') {
            this.additionalActions(true, false, true);
        }


        if (country === 'auto_il_on_de') {
            this.additionalActions(true, false, false);
        }

        jQuery('.ui-dialog').addClass('geomodal-dialog');

        jQuery("#geomodal-dialog .close").on('click', function () {
            return this.closePopup();
        });
        jQuery("#geomodal-dialog").dialog('open');

    },

    closePopup: function () {
        jQuery("#geomodal-dialog").dialog('close');
        return false;
    },

    additionalActions: function (usCa, close, lang) {
        if (usCa) {
            jQuery('#selection-us-ca').hide();
        }
        if (close) {
            jQuery('.ui-dialog-titlebar-close').hide();
        }
        if (lang) {
            jQuery('.language-selector').hide();
        }
    },

    isLoaded: function(selector) {
        return new Promise(function (resolve) {
            var checker = setInterval(function() {
                var node = jQuery(selector);
                if (node.length) {
                    clearInterval(checker)
                    resolve(node)
                }
            }, 200)
        })
    }
};
