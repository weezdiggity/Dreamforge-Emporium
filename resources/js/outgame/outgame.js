import $ from 'jquery';

window.$ = $;
window.jQuery = $;
window.ogame = window.ogame || {};
// resources/js/outgame/outgame.js
console.log("Outgame JS loaded.");

window.select_uni = function (serverId, serverName, serverAlias) {
    console.log(`Selecting server: ${serverId}, ${serverName}, ${serverAlias}`);
window.emailOnlySignup = 1;
window.emailOnlyLogin = 1;
    // Define characteristics namespace and init function
    window.ogame.characteristics = {
        init: function (config) {
            console.log("ogame.characteristics.init called with config:", config);

            // Example: Do something with the config
            // This is where you put your actual init logic.

            // For demonstration, you might iterate config keys:
            Object.keys(config).forEach(key => {
                const setting = config[key];
                // Do something with each setting, e.g.:
                console.log(`Setting ${key}:`, setting);
            });
        }
    };
    (function ($) {
        $.fn.validationEngineLanguage = function () {
        };
    $.validationEngineLanguage = {
        newLang: function () {
        $.validationEngineLanguage.allRules = {
            "required": {
                "alertText": "This field is required",
                "alertTextCheckboxMultiple": "Make a decision",
                "alertTextCheckboxe": "You must accept the T&Cs."
            },
            "length": {
                "regex": /^.{3,20}$/,
                "alertText": "Between 3 and 20 characters allowed."
            },
            "pwLength": {
                "regex": /^.{4,20}$/,
                "alertText": "Between 4 and 20 characters allowed."
            },
            "email": {
                "regex": /^[a-zA-Z0-9_.\-]+@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/,
                "alertText": "You need to enter a valid email address!"
            },
            "noSpecialCharacters": {
                "regex": /^[a-zA-Z0-9\s_\-]+$/,
                "alertText": "Contains invalid characters."
            },
            "noBeginOrEndUnderscore": {
                "regex": /^([^_]+(.*[^_])?)?$/,
                "alertText": "Your name may not start or end with an underscore."
            },
            "noBeginOrEndHyphen": {
                "regex": /^([^\-]+(.*[^\-])?)?$/,
                "alertText": ""
            },
            "noBeginOrEndWhitespace": {
                "regex": /^([^\s]+(.*[^\s])?)?$/,
                "alertText": "Your name may not start or end with a space."
            },
            "notMoreThanThreeUnderscores": {
                "regex": /^[^_]*(_[^_]*){0,3}$/,
                "alertText": "Your name may not contain more than 3 underscores in total."
            },
            "notMoreThanThreeHyphen": {
                "regex": /^[^\-]*(\-[^\-]*){0,3}$/,
                "alertText": ""
            },
            "notMoreThanThreeWhitespaces": {
                "regex": /^[^\s]*(\s[^\s]*){0,3}$/,
                "alertText": "Your name may not include more than 3 spaces in total."
            },
            "noCollocateUnderscores": {
                "regex": /^[^_]*(_[^_]+)*_?$/,
                "alertText": "You may not use two or more underscores one after the other."
            },
            "noCollocateHyphen": {
                "regex": /^[^\-]*(\-[^\-]+)*-?$/,
                "alertText": ""
            },
            "noCollocateWhitespaces": {
                "regex": /^[^\s]*(\s[^\s]+)*\s?$/,
                "alertText": "You may not use two or more spaces one after the other."
            },
            "ajaxUser": {
                "file": "../validateUser.php",
                "alertTextOk": "This username is available.",
                "alertTextLoad": "Please wait, loading...",
                "alertText": "This username is not available anymore."
            },
            "ajaxName": {
                "file": "../validateUser.php",
                "alertTextOk": "This username is available.",
                "alertTextLoad": "This username is available."
            },
            "alertText": "This username is not available anymore.",
            "onlyLetter": {
                "regex": /^[a-zA-Z ']+$/,
                "alertText": "Use characters only."
            }
        }
    }
            }
        })(jQuery);
    var universeDistinctions = [];

    $(document).ready(function () {
        $(".zebra tr:odd").addClass("alt");
    $.validationEngineLanguage.newLang();
        });
// ]]>
    $(document).ready(function () {
        select_uni('s128', 'Betelgeuse', 'exodus-server-old');
    });

    $(document).ready(function () {
        if (typeof checkIpadApp === 'function') {
            checkIpadApp();
        } else {
            console.warn('checkIpadApp is not defined yet.');
        }
    });

    $(document).ready(function () {
        ogame.characteristics.init({
            "speed_fleet": {
                "css": "speed_fleet",
                "text": "Fleet Speed: the higher the value, the less time you have left to react to an attack.",
                "valueCategory": "speed",
                "valueKey": "fleet",
                "valueAppendix": "x",
                "type": "range"
            },
            "speed_economy": {
                "css": "speed_economy",
                "text": "Economy Speed: the higher the value, the faster constructions and research will be completed and resources gathered.",
                "valueCategory": "speed",
                "valueKey": "server",
                "valueAppendix": "x",
                "type": "range"
            },
            "debris_field_factor_ships": {
                "css": "ships_in_debris_field",
                "text": "Some of the ships destroyed in battle will enter the debris field.",
                "valueCategory": "combat",
                "valueKey": "debris_field_factor_ships",
                "valueAppendix": "%",
                "type": "range",
                "step": 10
            },
            "defence_in_debris_field": {
                "css": "defence_in_debris_field",
                "text": "Some of the defensive structures destroyed in battle will enter the debris field.",
                "valueCategory": "combat",
                "valueKey": "debris_field_factor_def",
                "valueAppendix": "%",
                "type": "range",
                "step": 10
            },
            "dark_matter_signup_gift": {
                "css": "dm",
                "text": "You will receive Dark Matter as a reward for confirming your email address.",
                "valueCategory": "general",
                "valueKey": "dark_matter_signup_gift",
                "type": "range",
                "step": 1000
            },
            "aks_on": {
                "css": "aks_on",
                "text": "Alliance battle system activated",
                "valueCategory": "alliance",
                "valueKey": "aks",
                "condition": "tooltip.alliance.aks",
                "type": "binary"
            },
            "planet_fields": {
                "css": "planet_fields",
                "text": "The maximum amount of building slots has been increased.",
                "valueCategory": "size",
                "valueKey": "planet_field_bonus",
                "type": "range",
                "step": 10
            },
            "wreckfield": {
                "css": "wreck_field",
                "text": "Space Dock activated: some destroyed ships can be restored using the Space Dock.",
                "valueCategory": "wreckfield",
                "valueKey": "enabled",
                "type": "binary"
            },
            "universe_big": {
                "css": "universe_big",
                "text": "Amount of Galaxies in the Universe",
                "valueCategory": "size",
                "valueKey": "galaxies_max",
                "condition": "tooltip.size.galaxies_max > 9",
                "type": "range"
            }
        });

        $("#transition_email_only_login_dialog").dialog({
            create: function () {
                $(this).dialog('widget')
                    .find('.ui-dialog-titlebar')
                    .removeClass('ui-corner-all')
                    .addClass('ui-corner-top');
            },
            autoOpen: false,
            modal: false,
            width: 200,
            resizable: false,
            draggable: false,
            show: {
                effect: 'fade',
                duration: 'fast'
            },
            hide: {
                effect: 'fade'
            },
            position: {
                my: 'right-20px top-50px',
                at: 'left center',
                of: $('#usernameLogin')
            }
        });
    });