function venture_capital_firm_open_tab(evt, cityName) {
    var venture_capital_firm_i, venture_capital_firm_tabcontent, venture_capital_firm_tablinks;
    venture_capital_firm_tabcontent = document.getElementsByClassName("tabcontent");
    for (venture_capital_firm_i = 0; venture_capital_firm_i < venture_capital_firm_tabcontent.length; venture_capital_firm_i++) {
        venture_capital_firm_tabcontent[venture_capital_firm_i].style.display = "none";
    }
    venture_capital_firm_tablinks = document.getElementsByClassName("tablinks");
    for (venture_capital_firm_i = 0; venture_capital_firm_i < venture_capital_firm_tablinks.length; venture_capital_firm_i++) {
        venture_capital_firm_tablinks[venture_capital_firm_i].className = venture_capital_firm_tablinks[venture_capital_firm_i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

jQuery(document).ready(function () {
    jQuery( ".tab-sec .tablinks" ).first().addClass( "active" );
});