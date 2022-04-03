function toggleList(e) {
	e.currentTarget.firstElementChild.classList.toggle('fa-angle-down');
	e.currentTarget.firstElementChild.classList.toggle('fa-angle-up');
	e.currentTarget.nextElementSibling.classList.toggle('hidden');
	e.currentTarget.nextElementSibling.classList.toggle('visible');
}
