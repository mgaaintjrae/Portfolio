console.log("hello");

// PARALLAX HEADER
const parallax = document.querySelector('.parallax');

window.addEventListener('scroll', () => {
	parallax.style.backgroundPositionY = -window.scrollY / 4 + "px";
});

//BURGER
(function () {

	// old browser or not ?
	if (!('querySelector' in document && 'addEventListener' in window)) {
		return;
	}
	window.document.documentElement.className += ' js-enabled';

	function toggleNav() {

		// Define targets by their class or id
		var button = document.querySelector('.nav-button');
		var target = document.querySelector('body > nav');

		// click-touch event
		if (button) {
			button.addEventListener('click',
				function (e) {
					button.classList.toggle('is-active');
					target.classList.toggle('is-opened');
					e.preventDefault();
				}, false);
		}
	} // end toggleNav()

	toggleNav();
}());

// PARALLAX COMPETENCES
(function () {
	// Add event listener
	document.addEventListener("mousemove", parallax);
	const elem = document.querySelector(".paralax");
	// Magic happens here
	function parallax(e) {
		let _w = window.innerWidth / 2;
		let _h = window.innerHeight / 2;
		let _mouseX = e.clientX;
		let _mouseY = e.clientY;
		let _depth1 = `${50 - (_mouseX - _w) * 0.01}% ${50 - (_mouseY - _h) * 0.01}%`;
		let _depth2 = `${50 - (_mouseX - _w) * 0.02}% ${50 - (_mouseY - _h) * 0.02}%`;
		let _depth3 = `${50 - (_mouseX - _w) * 0.06}% ${50 - (_mouseY - _h) * 0.06}%`;
		let x = `${_depth3}, ${_depth2}, ${_depth1}`;
		// console.log(x);
		elem.style.backgroundPosition = x;
	}
})();

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