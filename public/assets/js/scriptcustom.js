(function($) {
    $('.faq-content > .faq-apperance:eq(0) .faq-head').addClass('active').next().slideDown();

    $('.faq-head').click(function(j) {
        var dropDown = $(this).closest('.faq-apperance').find('.faq-p');

        $(this).closest('.faq-content').find('.faq-p').not(dropDown).slideUp();

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).closest('.faq-content').find('.faq-head.active').removeClass('active');
            $(this).addClass('active');
        }

        dropDown.stop(false, true).slideToggle();

        j.preventDefault();
    });
})(jQuery); 

// step form starts here

var next = document.querySelectorAll(".form-box .next-btn");
var prev = document.querySelectorAll(".form-box .prevStep");
var steps = Array.from(document.querySelectorAll(".form-box"));
var bar = document.querySelector(".progress-bar")
var numb = document.querySelector(".numb")
let formsteps = 0;
//   net btn
next.forEach((button) => {
  button.addEventListener("click", function () {
    changeStep("next");
    // formsteps++
    bar.style.width = "30%"
    bar.innerHTML = 30
    numb.innerHTML = "30%"
   
  });
});
// prev btn
prev.forEach((button) => {
  button.addEventListener("click", function (e) {
    e.preventDefault()
    changeStep("prev");
    bar.style.width = "0%"
    bar.innerHTML = 0
    numb.innerHTML = "0%"
    // formsteps--
  });
});

//function for all
function changeStep(btn) {
  let index = 0;
  const active = document.querySelector(".form-active");
  index = steps.indexOf(active);
  steps[index].classList.remove("form-active");
  if (btn == "next") {
    index++;
  } else if (btn == "prev") {
    index--;
  }
  steps[index].classList.add("form-active");
}

//  step-form ends here
var navbar = document.querySelectorAll(".navbar-nav .nav-link")
var loc = window.location.href
console.log(loc)
for (let i = 0; i < navbar.length; i++) {
  if (navbar[i] == loc) {
    navbar[i].classList.add("active")
  }
}



var nav = document.querySelector(".navbar-toggler")
nav.addEventListener("click", function () {
  nav.classList.toggle("open")
})

var pag = document.querySelectorAll(".doc-pagination .page-link")
pag.forEach((elem) => {
  elem.addEventListener("click", function (e) {
    e.preventDefault()
    pag.forEach((page) => {
      page.classList.remove("active")
    })
    elem.classList.add("active")
  })
})

$(document).ready(function(){
  $(".profile").click(function(e){
    e.preventDefault()
     $(".sub-menu").slideToggle()
  })
})
