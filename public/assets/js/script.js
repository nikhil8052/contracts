

// ------------------------------------------------

// ---------------------------------------------
// footer_dropdown
const optionMenu = document.querySelector(".select-menu"),
  selectBtn = optionMenu.querySelector(".select-btn"),
  options = optionMenu.querySelectorAll(".option"),
  sBtn_text = optionMenu.querySelector(".sBtn-text");

// Ensure the menu is closed by default
optionMenu.classList.remove("active");

selectBtn.addEventListener("click", () =>
  optionMenu.classList.toggle("active")
);

options.forEach((option) => {
  option.addEventListener("click", () => {
    let selectedOption = option.querySelector(".option-text").innerText;
    sBtn_text.innerText = selectedOption;

    optionMenu.classList.remove("active");
  });
});

// Close the dropdown when clicking outside
document.addEventListener("click", (event) => {
  if (!optionMenu.contains(event.target) && event.target !== selectBtn) {
    optionMenu.classList.remove("active");
  }
});



// ===================================
// contact page
let index = 1;

const on = (listener, query, fn) => {
  document.querySelectorAll(query).forEach((item) => {
    item.addEventListener(listener, (el) => {
      fn(el);
    });
  });
};

on("click", ".selectBtn", (item) => {
  const next = item.target.nextElementSibling;
  if (next) {
    next.classList.toggle("toggle");
  }
});

on("click", ".option", (item) => {
  const dropdown = item.target.closest(".select");
  if (dropdown) {
    dropdown.classList.remove("toggle");
    const parent = dropdown.querySelector(".selectBtn");
    parent.setAttribute("data-type", item.target.getAttribute("data-type"));
    parent.innerHTML = item.target.innerHTML; // Copy the inner HTML including the image
  }
});

document.addEventListener("click", (event) => {
  const select = document.querySelectorAll(".select");
  select.forEach((dropdown) => {
    if (!dropdown.contains(event.target)) {
      dropdown.classList.remove("toggle");
    }
  });
});

// ===============

//////////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function () {
  const selectBtn = document.querySelector(".selectBtn");
  const options = document.querySelectorAll(".option");
  const selectDropdown = document.querySelector(".selectDropdown");

  // Function to toggle the dropdown
  function toggleDropdown() {
    const isDisplayed = selectDropdown.style.display === "block";
    selectDropdown.style.display = isDisplayed ? "none" : "block";
  }

  // Event listener for the select button
  selectBtn.addEventListener("click", function () {
    toggleDropdown();
  });

  // Close the dropdown when an option is selected
  options.forEach((option) => {
    option.addEventListener("click", function () {
      const rating = this.innerHTML;
      selectBtn.innerHTML = rating; // Update the select button with the selected option
      selectDropdown.style.display = "none"; // Close the dropdown
    });
  });

  // Optional: Close the dropdown if clicked outside
  document.addEventListener("click", function (event) {
    if (
      !selectBtn.contains(event.target) &&
      !selectDropdown.contains(event.target)
    ) {
      selectDropdown.style.display = "none";
    }
  });
});


// /////////////////////////30sep/////////////////////////////////

// $(document).ready(function () {
//   $(".tc-sec .col-lg-4 .tc-index ol.tc-links li.tc-item").click(function () {
//     alert("Fdsfds");
//     $(this)
//       .closest(".tc-sec .col-lg-4 .tc-index ol.tc-links > li.tc-item")
//       .toggleClass("active")
//       .siblings()
//       .removeClass("active");
//   });
// });
$('.tc-item a').click(function(event){
  event.preventDefault();
  var target = $($(this).attr('href'));
  var offset = 200; // Adjust this value based on your header's height
  $('html, body').animate({
      scrollTop: target.offset().top - offset
  }, 500); // 500 ms for smooth scroll
});


//// --- tabinatin slider ---//////////////////////////////////////


//   $(document).ready(function() {
//     $('.doc_cat_tab .btn').on('click', function() {
//         // Remove 'active' class from all buttons
//         $('.doc_cat_tab .btn').removeClass('active');

//         // Add 'active' class to the clicked button
//         $(this).addClass('active');
//     });
// });

 
// Nikhil Code 

// Home Page Tabs 
// $(function () {
//   // vars
//   var slider,
//     btn,
//     tabC,
//     prevIndex,
//     objTab = {};


//   btn = $(".home_tab_btns");
//   tabC = $(".tabContent");

//   prevIndex = 0;

//   btn.on("click", function (e) {
//     var th, thIndex;
//     // Current button and the index of the current button 
//     th = $(this);
//     thIndex = th.index();
//     if(!th.hasClass("active")) {
//       if(prevIndex != thIndex && prevIndex !== "undefined"){
//         btn.eq(prevIndex).removeClass("active");
//         tabC.eq(prevIndex).removeClass("show");
//       }
//       btn.eq(thIndex).addClass("active");
//       tabC.eq(thIndex).addClass("show");
//       prevIndex = thIndex;
//       tabC.eq(thIndex).find(".slider").slick("setPosition");
//     }
//   });
//   slider = $(".slider");
//   slider.slick({
//     dots: true,
//     arrows: false,
//     slidesToShow: 4,
//     slidesToScroll: 1,
//     responsive: [
//       {
//         breakpoint: 991,
//         settings: {
//           slidesToShow: 3,
//         },
//       },
//       {
//         breakpoint: 767,
//         settings: {
//           slidesToShow: 1,
//         },
//       },
//     ],
//   });
// });

// End code 

// Function to check the scroll position
// function checkScroll() {
//   var myElement = document.getElementById("myID");
//   // Check if the page has been scrolled 200px or more
//   if(window.scrollY > 460) {
//     myElement.style.visibility = "visible";  // Show the element
//   }else{
//     myElement.style.visibility = "hidden"; 
//   } 
// }

// // Add the scroll event listener
// window.addEventListener("scroll", checkScroll);

// // Run the checkScroll function on initial page load to account for already scrolled pages
// document.addEventListener("DOMContentLoaded", checkScroll);


$(document).ready(function() {
  function checkScroll() {
      const $myElement = $('#myID');
      if($(window).scrollTop() > 460) {
          $myElement.show(); 
      }else {
          $myElement.hide();
      }
  }
  checkScroll();
  $(window).on('scroll', checkScroll);
});

// Header dropdown 
$(document).ready(function () {
  function handleMenuClick() {
    // Handle click event on menu items
    $('.menu-item > a').off('click').on('click', function (e) {
      e.preventDefault(); // Prevent default link behavior

      const $dropdownMenu = $(this).siblings('.dropdown_menu');
      $dropdownMenu.slideToggle(200); // Slide toggle the dropdown

      $(this).parent('.menu-item').toggleClass('active');

      $(this).toggleClass('clicked');

      // Close other dropdowns
      $('.menu-item')
        .not($(this).parent('.menu-item'))
        .removeClass('active')
        .find('.dropdown_menu')
        .slideUp(200);
      $('.menu-item > a')
        .not($(this))
        .removeClass('clicked'); // Remove class 'clicked' from other items
    });
  }

  handleMenuClick(); // Apply menu functionality

  $(window).resize(function () {
    handleMenuClick(); // Reapply in case of dynamic DOM changes
  });
});


