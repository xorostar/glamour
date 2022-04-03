// When the user scrolls the page, execute myFunction 
window.onscroll = function () {
	handleStickyNavbar()
};

// Get the navbar
var navbar = document.querySelector("header nav");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function handleStickyNavbar() {
	if (window.pageYOffset >= sticky) {
		navbar.classList.add("sticky")
	} else {
		navbar.classList.remove("sticky");
	}
}
