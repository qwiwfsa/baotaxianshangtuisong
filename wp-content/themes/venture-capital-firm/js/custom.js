jQuery(document).ready(function() {
  jQuery('.owl-carousel').owlCarousel({
    loop: true,
    margin: 15,
    nav: true,
    navText: ["<span class='left-btn p-3'></span>", "<span class='right-btn p-3'></span>"], 
    dots: false,
    rtl: false,
    responsive: {
    0: { 
      items: 1 
    },
    768: { 
      items: 2 
    },
    992: { 
      items: 2 
    },
    1200: { 
      items: 3 
    }
  },
    autoplay: true,
  });
 });


// tabs.js
document.addEventListener("click", e => {  if (e.target.parentElement.classList.contains("tab-title")  ) { venture_capital_firm_redTab(e) }  });

[...document.querySelectorAll("div.main-tab div")].forEach((tabTile, index) => {
    tabTile.classList.toggle('active', index == 0)
  });
[...document.querySelectorAll(".tab-content")].forEach((tabcontent, index) => {
  tabcontent.classList.toggle('active', index == 0)
  });
function venture_capital_firm_redTab(e) {  
  let venture_capital_firm_tabTiles = [...document.querySelectorAll("div.main-tab div")];
  let venture_capital_firm_tabcontents = [...document.querySelectorAll(".tab-content")];
  let venture_capital_firm_activeTabIndex = venture_capital_firm_tabTiles.findIndex(tab => { return tab == e.target.parentElement })
  venture_capital_firm_tabTiles.forEach((tabTile, index) => {
    tabTile.classList.toggle('active', index === venture_capital_firm_activeTabIndex)
  })
  venture_capital_firm_tabcontents.forEach((tabcontent, index) => {
  tabcontent.classList.toggle('active', index === venture_capital_firm_activeTabIndex)
  })
}

// Scroll to Top
window.onscroll = function() {
  const venture_capital_firm_button = document.querySelector('.scroll-top-box');
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    venture_capital_firm_button.style.display = "block";
  } else {
    venture_capital_firm_button.style.display = "none";
  }
};

document.querySelector('.scroll-top-box a').onclick = function(event) {
  event.preventDefault();
  window.scrollTo({top: 0, behavior: 'smooth'});
};