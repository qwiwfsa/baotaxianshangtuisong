(function (){
  const mobNavigation = () =>{
    const DOM = { }

    const cacheDOM =()=>{
      DOM.dropdownIcons = document.querySelectorAll('.wp-block-navigation__submenu-icon');
      DOM.subMenuItems = document.querySelectorAll('.wp-block-navigation__submenu-container')
    }

    const eventListeners=()=> {
      DOM.dropdownIcons.forEach(icon => {
        icon.addEventListener('click', function (e) {
          e.preventDefault();
          const submenu = icon.nextElementSibling;
          submenu.classList.toggle('is-subMenu--active');
        });
      });
    }

    const init = () => {
      cacheDOM();
      eventListeners();
    }

    return { init };
  }

  document.addEventListener('DOMContentLoaded', mobNavigation().init);
})();