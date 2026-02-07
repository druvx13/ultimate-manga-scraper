/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
"use strict"; 
var initial = '';
function umsLoading(btn)
{
    btn.attr('disabled','disabled');
    if(!btn.find('spinner').length){
        btn.append('<span class="spinner"></span>');
    }
    btn.find('.spinner').css('visibility','unset');
}
function umsRmLoading(btn)
{
    btn.removeAttr('disabled');
    btn.find('.spinner').remove();
}
    function mainChanged()
    {
        if(jQuery('.input-checkbox').is(":checked"))
        {            
            jQuery(".hideMain").show();
        }
        else
        {
            jQuery(".hideMain").hide();
        }
        if(jQuery("#spin_text option:selected").val() === 'best' || jQuery("#spin_text option:selected").val() === 'wordai' || jQuery("#spin_text option:selected").val() === 'spinrewriter') 
        {      
            jQuery(".hideBest").show();
        }
        else
        {
            jQuery(".hideBest").hide();
        }
if (mycustommainsettings.best_user == '' || mycustommainsettings.best_password == '')
{
        if(jQuery("#spin_text option:selected").val() === 'best') 
        {      
            jQuery("#bestspin").show();
        }
        else
        {
            jQuery("#bestspin").hide();
        }
        if(jQuery("#spin_text option:selected").val() === 'wordai') 
        {      
            jQuery("#wordai").show();
        }
        else
        {
            jQuery("#wordai").hide();
        }
        if(jQuery("#spin_text option:selected").val() === 'spinrewriter') 
        {      
            jQuery("#spinrewriter").show();
        }
        else
        {
            jQuery("#spinrewriter").hide();
        }
}
else
{
if(initial == '')
{
    initial = jQuery("#spin_text option:selected").val();
}
if(initial != '' && initial != jQuery("#spin_text option:selected").val())
{
        if(jQuery("#spin_text option:selected").val() === 'best') 
        {      
            jQuery("#bestspin").show();
        }
        else
        {
            jQuery("#bestspin").hide();
        }
        if(jQuery("#spin_text option:selected").val() === 'wordai') 
        {      
            jQuery("#wordai").show();
        }
        else
        {
            jQuery("#wordai").hide();
        }
        if(jQuery("#spin_text option:selected").val() === 'spinrewriter') 
        {      
            jQuery("#spinrewriter").show();
        }
        else
        {
            jQuery("#spinrewriter").hide();
        }
}
else
{
    jQuery("#spinrewriter").hide();
    jQuery("#wordai").hide();
    jQuery("#bestspin").hide();
}
}
        if(jQuery('#send_email').is(":checked"))
        {            
            jQuery(".hideMail").show();
        }
        else
        {
            jQuery(".hideMail").hide();
        }
        if(jQuery('#enable_logging').is(":checked"))
        {            
            jQuery(".hideLog").show();
        }
        else
        {
            jQuery(".hideLog").hide();
        }
        if(jQuery('#links_hide').is(":checked"))
        {            
            jQuery(".hideGoo").show();
        }
        else
        {
            jQuery(".hideGoo").hide();
        }
    }
    window.onload = mainChanged;
    jQuery(document).ready(function(){
        jQuery('span.wpums-delete').on('click', function(){
            var confirm_delete = confirm('Delete This Rule?');
            if (confirm_delete) {
                jQuery(this).parent().parent().remove();
                jQuery('#myForm').submit();						
            }
        });
        var plugin_slug = mycustommainsettings.plugin_slug;
        jQuery('#' + plugin_slug + '_register').on('click', function()
        {
            var ajaxurl = mycustommainsettings.ajaxurl;
            var nonce = jQuery('#' + plugin_slug + '_activation_nonce').val();
            var code = jQuery('#' + plugin_slug + '_register_code').val();
            if(code == '')
            {
                alert('You need to enter a purchase code for the activation to work.');
            }
            else
            {
                var thisbut = jQuery(this);
                umsLoading(thisbut);
                var data = {
                    action: 'ums_activation',
                    code: code,
                    nonce: nonce
                };
                jQuery.post(ajaxurl, data, function(response) {
                    umsRmLoading(thisbut);
                    if(response.trim() == 'ok')
                    {
                        location.reload();
                    }
                    else
                    {
                        alert('Error in registration process: ' + response);
                    }
                }).fail( function(xhr) 
                {
                    umsRmLoading(thisbut);
                    alert('Exception in registration process: ' + xhr.statusText);
                });
            }
        });
        jQuery('#' + plugin_slug + '_revoke_license').on('click', function()
        {
            var confirm_delete = confirm('Are you sure you want to revoke your license?');
            if (confirm_delete) 
            {
                var ajaxurl = mycustommainsettings.ajaxurl;
                var nonce = jQuery('#' + plugin_slug + '_activation_nonce').val();
                var thisbut = jQuery(this);
                umsLoading(thisbut);
                var data = {
                    action: 'ums_revoke',
                    nonce: nonce
                };
                jQuery.post(ajaxurl, data, function(response) {
                    umsRmLoading(thisbut);
                    if(response.trim() == 'ok')
                    {
                        location.reload();
                    }
                    else
                    {
                        alert('Error in revoking process: ' + response);
                    }
                }).fail( function(xhr) 
                {
                    umsRmLoading(thisbut);
                    alert('Exception in revoking process: ' + xhr.statusText);
            });
            }
        });
    });
    var unsaved = false;
    jQuery(document).ready(function () {
        jQuery(":input").change(function(){
            if (this.id != 'PreventChromeAutocomplete' && this.className != 'sc_chat_form_field_prompt_text')
                unsaved = true;
        });
        function unloadPage(){ 
            if(unsaved){
                return "You have unsaved changes on this page. Do you want to leave this page and discard your changes or stay on this page?";
            }
        }
        window.onbeforeunload = unloadPage;
    });

function revealRec(){document.getElementById("diviIdrec").innerHTML = '<br/>We recommend that you check <b><a href="https://www.elegantthemes.com/affiliates/idevaffiliate.php?id=50837_5_1_16" target="_blank">Divi theme</a></b>, by <b><a href="https://www.elegantthemes.com/affiliates/idevaffiliate.php?id=50837_1_1_3" target="_blank">ElegantThemes</a></b>! It is easy to configure and it looks gorgeous. Check it out now!<br/><br/><a href="https://www.elegantthemes.com/affiliates/idevaffiliate.php?id=50837_5_1_19" target="_blank" rel="nofollow"><img style="border:0px" src="https://3.bp.blogspot.com/-h9TLQozNO6Q/W92Sk80zwjI/AAAAAAAAAjg/JC8sFWAUPzseR4nnjhVNbRQmCnr1ZMu4gCLcBGAs/s1600/divi.jpg" width="468" height="60" alt="Divi WordPress Theme"></a>';}