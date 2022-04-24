//Requires global scope for referencing external js file
var data = [
    "properties","brokers","metroAreas","states"
];

var dynamicData =  (function($, window, document, data) {
    'use strict';

    var cols = {};

    var events = function () {
        if($('body').hasClass('home')) {
            $.getJSON("/wp-content/plugins/bfm-map/src/data/cols.json", function(coldata){
                $.each(coldata, function(k, v){
                    cols[k] = v;
                });
            });

            $.getScript("/wp-content/plugins/bfm-map/src/data/data.js", function(){
                var propData = {};
                var assetTypes = ["office", "industrial", "retail", "multifamily"];

                var numCol = "";
                var sizeCol = "";

                $.each(assetTypes, function(k, assetType){
                    propData[assetType] = {
                        "size" : 0,
                        "units" : 0
                    };

                    switch (assetType) {
                        case "office":
                            numCol = "StateOfficeCount";
                            sizeCol = "StateOfficeSF";
                            break;
                        case "industrial":
                            numCol = "StateIndustrialCount";
                            sizeCol = "StateIndustrialSF";
                            break;
                        case "retail":
                            numCol = "StateRetailCount";
                            sizeCol = "StateRetailSF";
                            break;
                        case "multifamily":
                            numCol = "StateResidentialCount";
                            sizeCol = "StateUnits";
                            break;
                    }

                    for (var si = 0; si < data.states.length; si++) {
                        if (data.states[si][cols.states[numCol]] > 0) {
                            propData[assetType]["units"] += parseInt(data.states[si][cols.states[numCol]]);
                            propData[assetType]["size"] += parseInt(data.states[si][cols.states[sizeCol]]);
                        }
                    }

                    propData[assetType]["size"] = formatSize(propData[assetType]["size"]);

                    $('#catBlock__'+assetType + ' .meta--description')
                    .text($('#catBlock__'+assetType + ' .meta--description').html()
                    .format(
                        propData[assetType]["units"],
                        (propData[assetType]["units"] > 1 ? "properties" : "property"),
                        addCommas(propData[assetType]["size"]),
                        (assetType == "multifamily") ? "units" : "sqft"
                    ));
                });
            });
        }
    }

    function formatSize(digit) {
        var output;

        if(digit >= 1000000) {
            var formattedNum = Math.floor(digit/1000000);

            if(digit % 1000000 > 0) {
                output = "over ";
            }

            output += formattedNum +" million ";

            return output;
        } else {
            return digit;
        }
    }

    function addCommas(nStr) {
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

    String.prototype.format = function()
    {
        var pattern = /\{\d+\}/g;
        var args = arguments;
        return this.replace(pattern, function(capture){ return args[capture.match(/\d+/)]; });
    }

    return {
      init: function () {
        events();
      }
    }
})(jQuery, window, document, data);
site.queue(dynamicData);