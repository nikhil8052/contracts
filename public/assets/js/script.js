

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

$(document).ready(function () {
  $(".tc-sec .col-lg-4 .tc-index ol.tc-links li.tc-item").click(function () {
    $(this)
      .closest(".tc-sec .col-lg-4 .tc-index ol.tc-links > li.tc-item")
      .toggleClass("active")
      .siblings()
      .removeClass("active");
  });
});


// tabinatin slider ---//////////////////////////////////////
$(function () {
  // vars
  var slider,
    btn,
    tabC,
    prevIndex,
    objTab = {};

  btn = $(".btn");
  tabC = $(".tabContent");

  prevIndex = 0;

  btn.on("click", function () {
    var th, thIndex;

    th = $(this);
    thIndex = th.index();

    if (!th.hasClass("active")) {
      if (prevIndex != thIndex && prevIndex !== "undefined") {
        btn.eq(prevIndex).removeClass("active");
        tabC.eq(prevIndex).removeClass("show");
      }
      btn.eq(thIndex).addClass("active");
      tabC.eq(thIndex).addClass("show");
      prevIndex = thIndex;

      //slick position filter
      //if you have problem with slick in tabs, use next option
      //magic option
      tabC.eq(thIndex).find(".slider").slick("setPosition");
    }
  });

  slider = $(".slider");

  slider.slick({
    dots: true,
    arrows: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });
});
