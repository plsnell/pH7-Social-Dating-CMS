/*
 * Author:        Pierre-Henry Soria <ph7software@gmail.com>
 * Copyright:     (c) 2012-2013, Pierre-Henry Soria. All Rights Reserved.
 * License:       GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 */

var sCountry = $('#str_country').val();
var sUrlSlug = (typeof sCountry != 'undefined' ? '?country=' + sCountry : '');

$('#str_city').autocomplete({
    source: function(oRequest, oResponse)
    {
        $.ajax({
            url: 'http://ws.geonames.org/searchJSON' + sUrlSlug,
            dataType: 'jsonp',
            data:
            {
                featureClass: 'P',
                style: 'full',
                maxRows: 12,
                name_startsWith: request.term
            },
            success: function(oData) {
                response($.map(oData.geonames, function(oItem)
                {
                    $('#str_city').click(function()
                    {
                        $('#str_state').val((oItem.adminName1 ? oItem.adminName1 : ''));
                        $('#str_zip_code').val(oItem.postalcode);
                    });

                    return {
                        label: oItem.name + (oItem.adminName1 ? ', ' + oItem.adminName1 : '') + (sCountry ? '' : ', ' + oItem.countryName),
                        value: oItem.name
                    }
                }))
            }
        })
    }
});
