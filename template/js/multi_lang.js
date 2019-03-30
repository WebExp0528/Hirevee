google.load("language", "1");
var apiKey = "AIzaSyBXrB8ArcOP8PKUIzu7ibIxoitHmgZ6xHM";

$(document).ready(function () {
	
    if ($('#selSourceLanguage option').size() == 0) {
    	alert("why?");
        loadLanguages();
        if ($("#divBranding").innerHTML == "") {
            google.language.getBranding('divBranding');
        }
    }
    
    //$('#langForm').submit();
    
    $('#btnDetect').click(function (e) {
        e.preventDefault();
        $.blockUI({ css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        }
        });
        detectLanguage();
        $.unblockUI();
    });

    $('#selTargetLanguage').change(function (e) {
        e.preventDefault();
        //$('#langForm').submit();
        //var text = $.trim($('#txtOrgText').val());
        var text = org_text;
    alert("org_text : " + text);
        //$('#divTranslated').html("");
        if (text.length > 0) {
            //var langSource = $('#selSourceLanguage').val();
        	var langSource = "en";
            var langTarget = $('#selTargetLanguage').val();

            if (langSource === "" || langTarget === "") {
                alert("Select Source Language and Target Language");
            }
//            else if (langSource === langTarget) {
//                alert("Source Language and Target Language cannot be same");
//            }
            else {
                $.blockUI({ css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                }
                });
                var apiurl = "https://www.googleapis.com/language/translate/v2?key=" + apiKey + "&source=" + langSource + "&target=" + langTarget + "&q=";

                $.ajax({
                    url: apiurl + encodeURIComponent(text),
                    dataType: 'jsonp',
                    async: false,
                    success: function (data) {
                        if (langSource === langTarget) {
                            //$('#divTranslated').html(text);
                            $('#translated_string').val(text);
                        }
                        else if (langSource != "") {
                            try {
                                //$('#divTranslated').html(data.data.translations[0].translatedText);
                                $('#translated_string').val(data.data.translations[0].translatedText);
                                $('#translated_string1').val(data.data.translations[0].translatedText);
                                //alert(data.data.translations[0].translatedText);
                                alert($('#translated_string').val());
                            }
                            catch (e) {
                                //$('#divTranslated').html(text);
                            	$('#translated_string').val(text);
                            }
                        }
//                        $('#divTranslated').css({ "border": "1px solid #7F9DB9" });
//                        $('#divTranslated').css({ "padding": "4 4 4 4" });
//
//                        $('#lblTranslation').css({ "color": "black" });
                        $.unblockUI();
                    },
                    error: function (x, e) {
                        alert('Error occured while translating the text');
                        $.unblockUI();
                    }
                });
            }
        }
        else {
            alert("Nothing was entered to translate");
            $.unblockUI();
        }
      
        $('#langForm').submit();
     	//$('#langForm_text').submit();
     	//$.post("", {selTargetLanguage : $('#selTargetLanguage').val()},  );
    });
    $.unblockUI();
});

function loadLanguages() {
    var apiurl = "https://www.googleapis.com/language/translate/v2/languages?key=" + apiKey + "&target=en";

    $.ajax({
        url: apiurl,
        dataType: 'jsonp',
        success: function (data) {
            var languages = data.data.languages;
            $.each(languages, function (index, language) {
                //$('#selSourceLanguage').append('<option value="' + language.language + '">' + language.name + '</option>');
                $('#selTargetLanguage').append('<option value="' + language.language + '">' + language.name + '</option>');
            });
            //$("select#selSourceLanguage").val('en');
            //$("select#selTargetLanguage").val('en');
            $("select#selTargetLanguage").val(tar_lang);
        },
        error: function (x, e) {
            alert('Error occured while loading the Google Supported Languages');
        }
    });
}

function detectLanguage() {
    var text = $.trim($('#txtOrgText').val());
    if (text.length > 0) {
        var apiurl = "https://www.googleapis.com/language/translate/v2/detect?key=" + apiKey + "&q=";

        $.ajax({
            url: apiurl + encodeURIComponent(text),
            dataType: 'jsonp',
            async: false,
            success: function (data) {
                var obj = data.data.detections[0];
                $('#selSourceLanguage').val(obj[0].language);
                langSource = obj[0].language;
                $('#divDetectedLanguage').html("The automatically detected language is: " + $('#selSourceLanguage option:selected').text());
                $.unblockUI();
            },
            error: function (x, e) {
                $('#divDetectedLanguage').html("Error occured while detecting the current text language");
                $.unblockUI();
            }
        });
    }
    else {
        $('#divDetectedLanguage').html("No Text for Translation was provided");
        $.unblockUI();
    }
}