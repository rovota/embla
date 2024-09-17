// Created and designed by Rovota
// ----------------------

document.addEventListener('DOMContentLoaded', function () {
	document.body.classList.remove('preload');
});

// Slugification
function slugify(str) {
	str = str.trim().toLowerCase().replace(/./g, function (char) {
		return {
			'á': 'a', 'ä': 'a', 'â': 'a', 'à': 'a', 'ã': 'a', 'å': 'a', 'č': 'c', 'ç': 'c', 'ć': 'c',
			'ď': 'd', 'é': 'e', 'ě': 'e', 'ë': 'e', 'è': 'e', 'ê': 'e', 'ẽ': 'e', 'ĕ': 'e', 'ȇ': 'e',
			'ğ': 'g', 'ħ': 'h', 'í': 'i', 'ì': 'i', 'î': 'i', 'ï': 'i', 'ı': 'i', 'ň': 'n', 'ñ': 'n',
			'ó': 'o', 'ö': 'o', 'ò': 'o', 'ô': 'o', 'õ': 'o', 'ø': 'o', 'ð': 'o', 'ř': 'r', 'ŕ': 'r',
			'š': 's', 'ş': 's', 'ť': 't', 'ú': 'u', 'ů': 'u', 'ü': 'u', 'ù': 'u', 'û': 'u', 'ý': 'y',
			'ÿ': 'y', 'ž': 'z', 'þ': 'b', 'đ': 'd', 'ß': 'b', 'æ': 'a',
		}[char] ?? char;
	});
	return str.replace(/([^a-z0-9-]|(-))+/g, '-').replace(/^-|-$/g, '');
}

// Automatic background lightness detection
document.querySelectorAll('.detect-lightness').forEach(element => {
	const raw = window.getComputedStyle(element).backgroundColor;
	const rgb = raw.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);

	if (rgb !== null) {
		const red = parseInt(rgb[1]) * 299;
		const green = parseInt(rgb[2]) * 587;
		const blue = parseInt(rgb[3]) * 114;

		const lightness = Math.round((red + green + blue) / 1000);
		element.setAttribute('lightness', lightness.toString());
		element.classList.add((lightness > 180) ? 'above-threshold' : 'below-threshold');
	}
});

// Toast messages
document.querySelectorAll('toast').forEach(toast => {
	const message = document.createTextNode(toast.dataset.message);
	toast.appendChild(message);

	toast.classList.add('accent-' + toast.dataset.type);
	setTimeout(() => toast.classList.add('visible'), 100);
	setTimeout(() => toast.classList.remove('visible'), 3200);
	setTimeout(() => toast.remove(), 5000);
});

// Drawer open/close triggers
document.querySelectorAll('.drawer-toggle').forEach(toggle => {
	toggle.addEventListener("click", () => {
		document.querySelector('#drawer').classList.toggle('visible');
		document.querySelector('#shading').classList.toggle('visible');
	});
});

// Input functionality
document.querySelectorAll('input, textarea, select').forEach(input => {

	// Process required checkboxes
	if (input.hasAttribute('required') && input.getAttribute('type') === 'checkbox') {
		let form = input.closest('form');
		if (!input.checked) {
			if (!form.requiredfields) {
				form.requiredfields = 1;
			} else {
				form.requiredfields++;
			}
		}
		input.addEventListener('change', () => {
			let submit = form.querySelector('[type="submit"]');
			input.checked ? form.requiredfields-- : form.requiredfields++;
			submit.disabled = (form.requiredfields !== 0);
		});
	}

	// Automatically add a required indicator
	if (input.hasAttribute('required')) {
		let group = input.closest('input-group, input-slider');
		if (group !== null) {
			let label = group.querySelector('label');
			if (label !== null && label.hasAttribute('for')) {
				if (label.innerHTML.includes('*') === false) {
					label.innerHTML = label.innerHTML + '<small>*</small>';
				}
			}
		}
	}

	// Focus when icon is clicked
	let icon = input.parentNode.querySelector('input-icon');
	icon?.addEventListener('click', () => {
		input.focus();
	});

	// Password input functionality
	if (input.getAttribute('type') === 'password') {
		let indicator = input.parentNode.querySelector('.capslock');
		input.addEventListener('keyup', event => {
			if (input === document.activeElement && event.getModifierState('CapsLock')) {
				if (!indicator.classList.contains('visible')) {
					indicator.classList.add('visible');
				}
			} else {
				if (indicator.classList.contains('visible')) {
					indicator.classList.remove('visible');
				}
			}
		});
		input.addEventListener('blur', () => {
			if (indicator.classList.contains('visible')) {
				indicator.classList.remove('visible');
			}
		});
	}

	// File input functionality
	if (input.getAttribute('type') === 'file') {
		let label = input.nextElementSibling;

		label.innerHTML = input.dataset.missingcaption;

		input.addEventListener('change', event => {
			let fileName;

			if (input.files) {
				if (input.files.length > 1) {
					fileName = (input.dataset.selectedcaption || '').replace('%1$s', input.files.length.toString);
				}
				if (input.files.length === 1) {
					fileName = event.target.value.split('\\').pop();
				}
				if (input.files.length === 0) {
					fileName = input.dataset.missingcaption;
				}
			}

			if (fileName) {
				label.innerHTML = fileName;
			} else {
				label.innerHTML = input.dataset.missingcaption;
			}
		});
	}

	// Slug input functionality
	if (input.hasAttribute('slugify')) {
		let note = input.parentNode.nextElementSibling.querySelector('span');
		note.innerHTML = slugify(input.value);
		input.addEventListener('input', () => {
			note.innerHTML = slugify(input.value);
		});
	}

	// Input length limit on input
	if (input.hasAttribute('maxlength')) {
		let limit = input.getAttribute('maxlength');
		let counter = input.parentNode.nextElementSibling?.querySelector('charcount');
		if (counter != null) {
			input.parentNode.nextElementSibling.querySelector('charlimit').innerHTML = limit;
			counter.innerHTML = input.value.length;
			input.addEventListener('input', () => {
				counter.innerHTML = input.value.length;
			});
		}
	}

	// Input error functionality
	if (input.parentNode.nextElementSibling?.nodeName === 'INPUT-ERRORS') {
		input.parentNode.classList.add('has-error');
		input.addEventListener('input', event => {
			if (input.parentNode.classList.contains('has-error')) {
				event.target.parentNode.nextElementSibling.remove();
				input.parentNode.classList.remove('has-error');
			}
		});
	}

	// Accent Preview functionality
	if (input.hasAttribute('preview-accent')) {
		input.addEventListener('click', () => {
			document.body.classList.forEach(item => {
				if (item.startsWith('accent-')) {
					document.body.classList.remove(item);
				}
			});
			document.body.classList.add('accent-' + input.value);
		});
	}

	// Theme Preview functionality
	if (input.hasAttribute('preview-theme')) {
		input.addEventListener('change', () => {
			document.body.classList.forEach(item => {
				if (item.startsWith('theme-')) {
					document.body.classList.remove(item);
				}
			});
			document.body.classList.add('theme-' + input.value);
		});
	}

	// Range input functionality
	if (input.getAttribute('type') === 'range') {
		let prefix = input.previousElementSibling;
		if (prefix !== null) {
			prefix.innerHTML = input.value;
			input.addEventListener('input', () => {
				prefix.innerHTML = input.value;
			});
		}
	}

	// Range input functionality
	if (input.hasAttribute('locale-switch')) {
		input.addEventListener('change', () => {
			window.location.href = window.location.href.replace(/\?locale=[a-z]{2}_[A-Z]{2}/g, '') + '?locale=' + input.value;
		});
	}
});

// Simulate anchor functionality by a data tag.
document.querySelectorAll('[data-href]').forEach(element => {
	element.setAttribute('tabindex', '0');
	element.addEventListener('keypress', event => {
		if (event.key === 'Enter') window.location = element.dataset.href;
	});
	element.addEventListener('click', () => {
		window.location = element.dataset.href;
	});
});

// Add classes to specific navigation elements.
document.querySelectorAll('nav-trigger').forEach(trigger => {
	document.querySelectorAll(trigger.dataset.prefix + trigger.dataset.item).forEach(element => {
		element.classList.add(trigger.dataset.class);
	});
	trigger.remove();
});

// Sortable Table functionality
document.querySelectorAll('table.sortable').forEach(table => {
	let selected_trigger;
	table.querySelectorAll('[data-sortable]').forEach(trigger => {
		if (trigger.classList.contains('sorted')) {
			selected_trigger = trigger;
		}
		trigger.addEventListener('click', () => {
			selected_trigger?.classList.remove('sorted');
			selected_trigger = trigger;
			selected_trigger.classList.add('sorted');

			let column = Array.prototype.indexOf.call(trigger.parentNode.children, trigger);
			let rows = table.querySelectorAll('tbody')[0].rows;
			let index, counter = 0, scanning = true, reorder = false, order = 'asc';

			while (scanning) {
				scanning = false;
				reorder = false;
				for (index = 0; index < (rows.length - 1); index++) {
					let a = rows[index].getElementsByTagName('td')[column];
					let b = rows[index + 1].getElementsByTagName('td')[column];
					if (a.hasAttribute('data-string')) {
						if (order === 'asc') {
							if (a.dataset.string.localeCompare(b.dataset.string) === 1) {
								reorder = true;
								break;
							}
						} else if (order === 'desc') {
							if (b.dataset.string.localeCompare(a.dataset.string) === 1) {
								reorder = true;
								break;
							}
						}
					}
					if (a.hasAttribute('data-number')) {
						if (order === 'asc') {
							if (parseFloat(a.dataset.number) > parseFloat(b.dataset.number)) {
								reorder = true;
								break;
							}
						} else if (order === 'desc') {
							if (parseFloat(a.dataset.number) < parseFloat(b.dataset.number)) {
								reorder = true;
								break;
							}
						}
					}
				}
				if (reorder === true) {
					rows[index].parentNode.insertBefore(rows[index + 1], rows[index]);
					scanning = true;
					counter++;
				} else {
					if (counter === 0 && order === "asc") {
						order = 'desc';
						scanning = true;
					}
				}
			}
		});
	});
});

// Automatically trigger the scroll-to-top button
let scroll_button = document.querySelector('scrollbutton');
if (scroll_button !== null) {
	let parent = document.querySelector(scroll_button.dataset.parent);
	parent.onscroll = () => {
		parent.scrollTop > 600 ? scroll_button.classList.add(scroll_button.dataset.class) : scroll_button.classList.remove(scroll_button.dataset.class);
	}
	scroll_button.addEventListener('click', () => parent.scrollTop = 0);
}

// Tab navigation
let tabs_toggle = document.getElementById('tabs-toggle');
tabs_toggle?.addEventListener("click", () => {
	tabs_toggle.classList.toggle('active');
	document.getElementById('tabs-content').classList.toggle('expanded');
});