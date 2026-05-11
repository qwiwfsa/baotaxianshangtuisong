// function for toggling tabs in theme info page
(function () {
  document.addEventListener('DOMContentLoaded', function () {
    const cmAdmin_tabs = document.querySelectorAll('.tab')
    const tabPanels = document.querySelectorAll('.tab-panel')

    cmAdmin_tabs.forEach(tab => {
      tab.addEventListener('click', function () {
        const tabId = this.id
        showTab(tabId)
      })
    })

    function showTab (tabId) {
      cmAdmin_tabs.forEach(tab => tab.classList.remove('active'))
      document.getElementById(tabId).classList.add('active')

      tabPanels.forEach(panel => panel.classList.remove('active'))
      document.querySelector(`.tab-panel[data-tab="${tabId}"]`).classList.add('active')
    }
  })

  //ajax request to activate plugin in one click from theme info page
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.install-plugin').forEach(function(button) {
      button.addEventListener('click', function() {
        let pluginSlug = button.getAttribute('data-plugin-slug');
        let filename = button.getAttribute('data-file-name');
        let nonce = cm_themeInfo.nonce; // Get the nonce from localized script

        // Display loading animation
        button.innerHTML = 'Installing...';

        // Make a fetch request
        fetch(cm_themeInfo.ajaxurl, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: 'action=cm_admin_install_plugin&plugin_slug=' + encodeURIComponent(pluginSlug) + '&filename=' + encodeURIComponent(filename) + '&nonce=' + encodeURIComponent(nonce),
        })
          .then(function(response) {
            if (!response.ok) {
              throw new Error('Network response was not ok');
            }
            return response.json();
          })
          .then(function(data) {
            if (data.success) {
              const message = data.data.message ;
              console.log('Success: ' + message);
              button.innerHTML = 'Activated';
            } else {
              const errorMessage = data.data.message;
              console.error('Error: ' + errorMessage);
              button.innerHTML = 'Error';
            }
          })
          .catch(function(error) {
            console.error('There was a problem with the fetch operation:', error);
            button.innerHTML = 'Error: ' + error.message;
          });
      });
    });
  });
})()