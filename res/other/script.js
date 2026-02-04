/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
"use strict";
jQuery( document ).ready(function() {
    jQuery("#wp_coderevodashboard_hide").click(function( e ){
        e.preventDefault();
        jQuery("#coderevodashboard-widget-hide").trigger("click");
    });
});