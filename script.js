/**
 *	Add Page Javascript File.
 */

addInitEvent(init_add_page);

function init_add_page() {
	var button = $('add_page_button');
	if (!button) return;
	
	if (button.nodeName.toLowerCase() == 'a') {
		add_page_clicked_url = button.getAttribute('href');
	} else {
		add_page_clicked_url = button.parentNode.parentNode.getAttribute('action');
	}
	
	addEvent(button, "click", add_page_clicked);
	
	button.style.display = '';
}

function add_page_clicked(e) {
	var page_name = prompt("Add Page");
	window.location.href = $('dokuwiki_url').value + page_name
}