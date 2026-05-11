jQuery(document).ready(function ($) {
    $(document).on('click', '.welcome-notice .notice-dismiss', function () {

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'venture_capital_firm_dismissed_notice',
            }
        });

    });
});

// Plugin – AI Content Writer plugin activation
document.addEventListener('DOMContentLoaded', function () {
    const venture_capital_firm_button = document.getElementById('install-activate-button');

    if (!venture_capital_firm_button) return;

    venture_capital_firm_button.addEventListener('click', function (e) {
        e.preventDefault();

        const venture_capital_firm_redirectUrl = venture_capital_firm_button.getAttribute('data-redirect');

        // Step 1: Check if plugin is already active
        const venture_capital_firm_checkData = new FormData();
        venture_capital_firm_checkData.append('action', 'check_plugin_activation');

        fetch(installPluginData.ajaxurl, {
            method: 'POST',
            body: venture_capital_firm_checkData,
        })
        .then(res => res.json())
        .then(res => {
            if (res.success && res.data.active) {
                // Plugin is already active → just redirect
                window.location.href = venture_capital_firm_redirectUrl;
            } else {
                // Not active → proceed with install + activate
                venture_capital_firm_button.textContent = 'Installing & Activating...';

                const venture_capital_firm_installData = new FormData();
                venture_capital_firm_installData.append('action', 'install_and_activate_required_plugin');
                venture_capital_firm_installData.append('_ajax_nonce', installPluginData.nonce);

                fetch(installPluginData.ajaxurl, {
                    method: 'POST',
                    body: venture_capital_firm_installData,
                })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        window.location.href = venture_capital_firm_redirectUrl;
                    } else {
                        alert('Activation error: ' + (res.data?.message || 'Unknown error'));
                        venture_capital_firm_button.textContent = 'Try Again';
                    }
                })
                .catch(error => {
                    alert('Request failed: ' + error.message);
                    venture_capital_firm_button.textContent = 'Try Again';
                });
            }
        })
        .catch(error => {
            alert('Check request failed: ' + error.message);
        });
    });
});
