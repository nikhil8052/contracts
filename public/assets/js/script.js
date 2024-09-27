$(document).ready(function () {
  $(".client-slider").slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    arrows: true,
    infinite: true,
    autoplay: false,
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
  $(".prev-btn").click(function () {
    $(".slick-list").slick("slickPrev");
  });

  $(".next-btn").click(function () {
    $(".slick-list").slick("slickNext");
  });
  $(".prev-btn").addClass("slick-disabled");
  $(".slick-list").on("afterChange", function () {
    if ($(".slick-prev").hasClass("slick-disabled")) {
      $(".prev-btn").addClass("slick-disabled");
    } else {
      $(".prev-btn").removeClass("slick-disabled");
    }
    if ($(".slick-next").hasClass("slick-disabled")) {
      $(".next-btn").addClass("slick-disabled");
    } else {
      $(".next-btn").removeClass("slick-disabled");
    }
  });
});

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
