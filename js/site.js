$(function () {
    // fancy input
    $('.fancyInput input').fancyInput().eq(0).focus();
    // allow only numeric characters in input
    //$('.fancyInput input').numeric();
    // tablesorter
    $("#results").tablesorter({ widthFixed: true, widgets: ['zebra'] });
    //$("#results").tablesorterPager({ container: $("#pager") });
    // form submit
    $(":submit").click(function () { $("#actionType").val(this.name); });
    $('form').submit(validateForm);

});

function validateForm(){
    // first check for reset
    var valid = false;
    var action = $('#actionType').val();
    if (action == 'clear')
        valid = true;
    else if (action == 'add') {
        var attack = document.getElementById('attack');
        var armor = document.getElementById('armor');
        if (isNumericMulti(armor.value, attack.value)) {
            armor.value = parseInt(armor.value,10);
            attack.value = parseInt(attack.value,10);
            //alert(armor.value + ' ' + attack.value);
            valid = true;
        }
    }
    else
        alert('WTF?!?');

    //valid = false;
    return valid;
}

function isNumeric(txt){
    return txt.match(/^[0-9]+$/) != null;
}
function isNumericMulti(){
    var numeric = false;
    for(var i=0;i< arguments.length;i++){
        if (isNumeric(arguments[i]))
            numeric = true;
        else{
            alert('Values must be numeric');
            return false;
        }
    }
    return numeric;
}



