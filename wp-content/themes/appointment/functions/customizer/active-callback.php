<?php
/**
 * Active Callback for customizer settings
 *
 * @package Appointment Theme
*/
//callback function for the breadcrumbs section
function appointment_related_post_callback($control) {
    if (false == $control->manager->get_setting('related_post_enable')->value()) {
        return false;
    } else {
        return true;
    }
}