// Created and designed by Rovota
// ----------------------

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

function updateFormElementUsingDirective(form, config, input) {
	let [action, target, value] = config.split(':');
	form.querySelectorAll('[name="' + target + '"]').forEach(element => {
		if (action === 'check') {
			element.checked = true;
		}
		if (action === 'uncheck') {
			element.checked = false;
		}
		if (action === 'disable') {
			element.disabled = true;
		}
		if (action === 'enable') {
			element.disabled = false;
		}

		// Enable chain reactions
		let event = new Event('change');
		element.dispatchEvent(event);
	});
}

function removeDataOverlay() {
	let overlay = document.querySelector('overlay');
	if (overlay !== null) {
		overlay.classList.remove('visible');
		setTimeout(() => overlay.remove(), 150);
	}
}

function showDataOverlay(url) {

	let overlay = document.createElement('overlay');
	let content = document.createElement('content');
	let iframe = document.createElement('iframe');

	document.body.appendChild(overlay);

	overlay.appendChild(content);
	content.appendChild(iframe);

	if (iframe !== null) {
		iframe.src = url;

		iframe.onload = function() {
			iframe.style.height = (iframe.contentWindow.document.body.scrollHeight) + 'px';
			overlay.classList.add('visible');
		};
	}
}

function fixDrawingCanvas(canvas, drawing) {
	const ratio = Math.max(window.devicePixelRatio || 1, 1);

	canvas.width = canvas.offsetWidth * ratio;
	canvas.height = canvas.offsetHeight * ratio;
	canvas.getContext("2d").scale(ratio, ratio);

	drawing.fromData(drawing.toData());
}

function cloneCanvas(oldCanvas) {
	const newCanvas = document.createElement('canvas');
	const context = oldCanvas.getContext('2d', { willReadFrequently: true });
	if (context) {
		newCanvas.width = oldCanvas.width;
		newCanvas.height = oldCanvas.height;
		const newContext = newCanvas.getContext('2d', { willReadFrequently: true });
		if (newContext) {
			const imageData = context.getImageData(0, 0, oldCanvas.width, oldCanvas.height);
			newContext.putImageData(imageData, 0, 0);
		}

	}

	return newCanvas;
}

function dataUrlToFile(data, filename) {
	let fragments = data.split(",");
	let mime = fragments[0].match(/:(.*?);/)[1];
	let content = atob(fragments[fragments.length - 1]);

	let n = content.length;
	let u8arr = new Uint8Array(n);

	while (n--) {
		u8arr[n] = content.charCodeAt(n);
	}

	return new File([u8arr], filename, { type: mime });
}

// -----------------
// Toast Messages

document.querySelectorAll('toast').forEach(toast => {
	const message = document.createTextNode(toast.dataset.message);
	toast.appendChild(message);

	toast.classList.add('accent-' + toast.dataset.type);
	setTimeout(() => toast.classList.add('visible'), 100);
	setTimeout(() => toast.classList.remove('visible'), 3200);
	setTimeout(() => toast.remove(), 5000);
});

// -----------------
// Lightness Detection

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

// -----------------
// Drawing

document.querySelectorAll('#drawing').forEach(element => {
	element.getContext("2d", { willReadFrequently: true })

	let input = null, options = {
		penColor: element.dataset.pencil ?? '#000000',
		backgroundColor: 'transparent',
		minDistance: 3,
	};

	let canvas = new SignaturePad(element, options);

	if (element.dataset.input !== null) {
		input = document.querySelector(`input[name="${element.dataset.input}"]`);
	}

	// Correct scaling issues on a page load and resizing
	fixDrawingCanvas(element, canvas);
	window.onresize = function() {
		fixDrawingCanvas(element, canvas);
	}

	let wrapper = element.parentNode;
	let clearButton = wrapper.querySelector('#clear');

	if (clearButton !== null) {
		clearButton.addEventListener("click", () => {
			if (input !== null) {
				const transfer = new DataTransfer();

				input.files = transfer.files;
				input.dispatchEvent(new Event('change'));
			}
			canvas.clear();
		});
	}

	// When an input is present, assign the drawing as an image.
	if (input !== null) {
		canvas.addEventListener("endStroke", () => {
			let data = canvas.toData();
			let originalHeight = element.scrollHeight;
			let originalWidth = element.scrollWidth;
			let clone = new SignaturePad(cloneCanvas(element));

			clone._ctx.canvas.width = originalWidth;
			clone._ctx.canvas.height = originalHeight;
			clone.fromData(data);
			clone.removeBlanks();

			const file = dataUrlToFile(clone.toDataURL('image/png'), (input.name ?? 'drawing') + '.png');
			const transfer = new DataTransfer();

			transfer.items.add(file);

			input.files = transfer.files;
			input.dispatchEvent(new Event('change'));
		});
	}
});

// -----------------
// Inputs

document.querySelectorAll('input, textarea, select').forEach(input => {

	let form = input.closest('form');

	// Input error functionality
	if (input.parentElement.nextElementSibling?.nodeName === 'INPUT-ERRORS') {
		input.parentElement.classList.add('has-error');
		input.addEventListener('input', event => {
			if (input.parentElement.classList.contains('has-error')) {
				event.target.parentElement.nextElementSibling.remove();
				input.parentElement.classList.remove('has-error');
			}
		});
	}

	// Process required checkboxes
	if (input.hasAttribute('required') && input.getAttribute('type') === 'checkbox') {
		if (form !== null) {
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

	// Focus when the icon is clicked
	let icon = input.parentElement.querySelector('input-icon');
	icon?.addEventListener('click', () => {
		input.focus();
	});

	// Password input functionality
	if (input.getAttribute('type') === 'password') {
		let indicator = input.parentElement.querySelector('.capslock');
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

		if (label !== null) {
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

	// Slug input functionality
	if (input.hasAttribute('slugify')) {
		let note = input.parentElement.nextElementSibling.querySelector('span');
		note.innerHTML = slugify(input.value);
		input.addEventListener('input', () => {
			note.innerHTML = slugify(input.value);
		});
	}

	// Input length limit on input
	if (input.hasAttribute('maxlength')) {
		let limit = input.getAttribute('maxlength');
		let counter = input.parentElement.nextElementSibling?.querySelector('charcount');
		if (counter != null) {
			input.parentElement.nextElementSibling.querySelector('charlimit').innerHTML = limit;
			counter.innerHTML = input.value.length;
			input.addEventListener('input', () => {
				counter.innerHTML = input.value.length;
			});
		}
	}

	// Locale input functionality
	if (input.hasAttribute('data-switch')) {
		input.addEventListener('change', () => {
			if (input.dataset.switch === 'locale') {
				window.location.href = window.location.href.replace(/\?locale=[a-z]{2}_[A-Z]{2}/g, '') + '?locale=' + input.value;
			}
		});
	}

	// Preview functionality
	if (input.hasAttribute('data-preview')) {
		input.addEventListener('change', () => {
			document.body.classList.forEach(item => {
				if (item.startsWith(input.dataset.preview + '-')) {
					document.body.classList.remove(item);
				}
			});
			document.body.classList.add(input.dataset.preview + '-' + input.value);
		});
	}

	// Cross-Input Synchronization
	if (input.hasAttribute('data-sync')) {
		input.addEventListener('change', () => {
			let directives = input.dataset.sync.includes('&') ? input.dataset.sync.split('&') : [input.dataset.sync];
			directives.forEach(directive => {
				let trigger = directive.substring(0, directive.indexOf('['));
				let config = directive.substring(directive.indexOf('[') + 1, directive.indexOf(']'));

				if (trigger !== null && config !== null) {
					if (trigger === 'checked' && input.checked === true) {
						updateFormElementUsingDirective(form, config, input);
					}
					if (trigger === 'unchecked' && input.checked === false) {
						updateFormElementUsingDirective(form, config, input);
					}
				}
			})
		});
	}

});

// -----------------
// Toggles

document.querySelectorAll('[data-toggle]').forEach(toggle => {
	toggle.addEventListener("click", () => {
		// Enable drawer functionality
		if (toggle.dataset.toggle === 'drawer') {
			document.querySelector('#drawer').classList.toggle('visible');
			document.querySelector('#drawer-shading').classList.toggle('visible');
		}
	});
});

// -----------------
// Simulate Anchors

document.querySelectorAll('[data-href]').forEach(element => {
	element.setAttribute('tabindex', '0');
	element.addEventListener('keypress', event => {
		if (event.key === 'Enter') window.location = element.dataset.href;
	});
	element.addEventListener('click', () => {
		window.location = element.dataset.href;
	});
});

// -----------------
// Table Sorting

document.querySelectorAll('[data-sortable]').forEach(table => {
	let selected_trigger;
	table.querySelectorAll('.sortable').forEach(trigger => {
		if (trigger.classList.contains('sorted')) {
			selected_trigger = trigger;
		}
		trigger.addEventListener('click', () => {
			selected_trigger?.classList.remove('sorted');
			selected_trigger = trigger;
			selected_trigger.classList.add('sorted');

			let column = Array.prototype.indexOf.call(trigger.parentElement.children, trigger);
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
					rows[index].parentElement.insertBefore(rows[index + 1], rows[index]);
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


// -----------------
// Process Triggers

document.querySelectorAll('nav-trigger').forEach(trigger => {
	document.querySelectorAll(trigger.dataset.prefix + trigger.dataset.item).forEach(element => {
		element.classList.add(trigger.dataset.class);
	});
	trigger.remove();
});

// -----------------
// Fragment Identification

document.querySelectorAll('h2').forEach(heading => {
	if (!heading.hasAttribute('id')) {
		heading.setAttribute('id', slugify(heading.textContent));
	}
});

// -----------------
// Carousel Functionality

document.querySelectorAll('carousel').forEach(carousel => {

	let slides = carousel.querySelectorAll('.item');
	slides[0].classList.add('visible');

	if (slides.length > 1) {

		let slide_duration = 5000;
		let lock_duration = 10000;
		let current_slide = 0;

		let indicators = carousel.nextElementSibling.querySelectorAll('indicator');
		indicators[current_slide].classList.add('active');

		const getNextSlideId = () => {
			return current_slide === (slides.length - 1) ? 0 : current_slide + 1;
		}

		const switchToSlide = function(id) {
			slides.forEach((slide, index) => {
				slide.classList.remove('visible');
				indicators[index].classList.remove('focus');
				indicators[index].classList.remove('active');
				indicators[index].classList.remove('extended');
			})
			slides[id].classList.add('visible');
			indicators[id].classList.add('active');
			current_slide = id;
		}

		let cycle = setInterval(() => {
			switchToSlide(getNextSlideId());
		}, slide_duration);

		let wait = null;

		indicators.forEach((indicator, index) => {
			indicator.addEventListener('click', () => {
				clearInterval(cycle); clearInterval(wait); switchToSlide(index);
				indicators[index].classList.add('extended');
				wait = setInterval(() => {
					cycle = setInterval(() => {
						switchToSlide(getNextSlideId());
					}, slide_duration);
					clearInterval(wait);
				}, lock_duration - slide_duration);
			})
		});

		slides.forEach((slide, index) => {
			slide.addEventListener("focus", () => {
				indicators[index].click();
				indicators[index].classList.add('focus');
			});
			slide.addEventListener("blur", () => {
				indicators[index].classList.remove('focus');
			});
		});
	}
});

// -----------------
// Scroll Location

let scroll_button = document.querySelector('scrollbutton');

if (scroll_button !== null) {
	let parent = document.querySelector(scroll_button.dataset.parent);
	parent.onscroll = () => {
		parent.scrollTop > 600 ? scroll_button.classList.add(scroll_button.dataset.class) : scroll_button.classList.remove(scroll_button.dataset.class);
	}
	scroll_button.addEventListener('click', () => parent.scrollTop = 0);
}

// -----------------
// Tabs Expansion

let tabs_toggle = document.getElementById('tabs-toggle');

if (tabs_toggle !== null) {
	tabs_toggle.addEventListener("click", () => {
		tabs_toggle.classList.toggle('active');
		document.getElementById('tabs-content').classList.toggle('expanded');
	});
}

// -----------------
// Standalone Fixes

if (window.matchMedia('(display-mode: standalone)').matches) {
	if (document.title.includes(' - ')) {
		document.title = document.title.split(' - ')[0].trim();
	}
}

// -----------------
// Dialog Interactivity

if (window.self === window.top) {
	document.querySelectorAll('[data-overlay]').forEach(trigger => {
		trigger.addEventListener("click", (event) => {
			event.preventDefault();
			trigger.blur();
			showDataOverlay(trigger.href);
		});
	});

	window.addEventListener('message', function(event) {
		if (event.data.startsWith('close:dialog')) {
			removeDataOverlay();
		}
		if (event.data.startsWith('switch:dialog')) {
			removeDataOverlay();
			setTimeout(() => showDataOverlay(event.data.split('dialog:')[1]), 150);
		}
	});
}

if (window.self !== window.top) {
	document.querySelectorAll('[href]').forEach(link => {
		link.addEventListener("click", (event) => {
			if (link.hasAttribute('target') === false) {
				event.preventDefault();
				if (link.hasAttribute('data-message')) {
					window.top.postMessage(link.dataset.message, '*');
				} else {
					window.top.postMessage('switch:dialog:' + link.href, '*');
				}
			}
		});
	});
}