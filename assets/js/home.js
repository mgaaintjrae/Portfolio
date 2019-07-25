console.log("hello");

// PARALLAX HEADER
const parallax = document.querySelector('.parallax');

window.addEventListener('scroll', () => {
	parallax.style.backgroundPositionY = -window.scrollY / 4 + "px";
});


//ANIMATE PROJECT
$(document).ready(function () {
	$(window).on('scroll', function () {

		var elmt = $('.from-left, .from-right');
		var topImg = $('.from-left, .from-right').offset().top;
		var scroll = $(window).scrollTop();

		$(elmt).each(function () {

			var topImg = $(this).offset().top - 300;

			if (topImg < scroll) {

				$(this).css("transform", "translate(0,0)");
				$(this).css("opacity", "1");

			};
		});
	});
});

//ANIMATE TEXT
$(document).ready(function () {
	$(window).on('scroll', function () {

		var elmt = $('.from-bottom');
		var topImg = $('.from-bottom').offset().top;
		var scroll = $(window).scrollTop();

		$(elmt).each(function () {

			var topImg = $(this).offset().top - 600;

			if (topImg < scroll) {

				$(this).css("transform", "translate(0,0)");
				$(this).css("opacity", "1");

			};
		});
	});
});

// Wrap every letter in a span
var textWrapper = document.querySelector('.ml3');
textWrapper.innerHTML = textWrapper.textContent.replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>");

anime.timeline({
		loop: false
	})
	.add({
		targets: '.ml3 .letter',
		opacity: [0, 1],
		easing: "easeInOutQuad",
		duration: 2250,
		delay: function (el, i) {
			return 150 * (i + 1)
		}
	}).add({
		targets: '.ml3',
		opacity: 1,
		duration: 1000,
		easing: "easeOutExpo",
		delay: 1000
	});

	
	