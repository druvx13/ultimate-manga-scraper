/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
"use strict";
jQuery( document ).ready(function() {
    jQuery("#wp_coderevonewsdashboard_hide").click(function( e ){
        e.preventDefault();
        jQuery("#coderevonewsdashboard-widget-hide").trigger("click");
    });
});