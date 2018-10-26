function switchLanguage(lang) {
    $.ajax({
        type: "POST",
        url: "dictionary/clientSwitch.php",
        data: "lang="+lang,
        success: function(html) {
            window.location.reload();
        }
    })
}
