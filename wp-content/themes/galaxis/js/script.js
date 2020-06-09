(function() {
	// Check if target matches to an element.
	function galaxisTargetMatches(selector) {
		return event.target.matches ? event.target.matches(selector) : event.target.msMatchesSelector(selector);
	}

	// Get next sibling.
	function galaxisNextSibling(element) {
		do {
			element = element.nextSibling;
		} while (element && element.nodeType !== 1);
		return element;
	}

	// Handle sub-menu arrow clicks.
	function galaxisSubMenuArrowClick(subMenuArrow, subMenuArrows, subMenus) {
		var galaxisSubMenu = galaxisNextSibling(subMenuArrow);
		if(galaxisSubMenu) {
			// Accessibility support for dropdown menu.
			var galaxisSubMenuLink = subMenuArrow.previousSibling;

			galaxisSetTabIndex(subMenus, -1);

			if(galaxisSubMenu.classList.contains('sub-menu--open')) {
				subMenuArrow.classList.remove('sub-menu-show');
				galaxisSubMenu.classList.remove('sub-menu--open');
				galaxisSubMenuLink.setAttribute('aria-expanded', 'false');
				subMenuArrow.getElementsByClassName('menu-arrow-button-hide')[0].setAttribute('aria-hidden', 'true');
				subMenuArrow.getElementsByClassName('menu-arrow-button-show')[0].setAttribute('aria-hidden', 'false');
			} else {
				if(subMenus.length) {
					[].forEach.call(subMenus, function(el) {
						el.classList.remove('sub-menu--open');
					});
				}
				if(subMenuArrows.length) {
					for(var i = 0; i < subMenuArrows.length; i++) {
						subMenuArrows[i].classList.remove('sub-menu-show');
						subMenuArrows[i].previousSibling.setAttribute('aria-expanded', 'false');
						subMenuArrows[i].getElementsByClassName('menu-arrow-button-hide')[0].setAttribute('aria-hidden', 'true');
						subMenuArrows[i].getElementsByClassName('menu-arrow-button-show')[0].setAttribute('aria-hidden', 'false');
					}
				}

				subMenuArrow.classList.add('sub-menu-show');
				galaxisSubMenu.classList.add('sub-menu--open');
				galaxisSubMenuLink.setAttribute('aria-expanded', 'true');
				subMenuArrow.getElementsByClassName('menu-arrow-button-hide')[0].setAttribute('aria-hidden', 'false');
				subMenuArrow.getElementsByClassName('menu-arrow-button-show')[0].setAttribute('aria-hidden', 'true');
				galaxisSetTabIndex(galaxisSubMenu, 0);
				galaxisSetTabIndex(galaxisSubMenu.querySelectorAll('.sub-menu'), -1);
			}
		}
	}

	// Setup mobile menu.
	function galaxisMobileMenu() {
		document.addEventListener('click', function(event) {
			if(galaxisTargetMatches('.menu-toggle')) {
				event.preventDefault();
				var galaxisNavIcon = event.target || event.srcElement;
				var galaxisMainNav = document.querySelector('.main-navigation > .primary-menu-container');

				// Slide mobile menu.
				galaxisNavIcon.classList.toggle('menu-toggle--open');
				galaxisMainNav.classList.toggle('primary-menu-container--open');

				if(galaxisNavIcon.classList.contains('menu-toggle--open')) {
					galaxisNavIcon.setAttribute('aria-expanded', 'true');
					galaxisSetTabIndex(document.querySelector('.main-navigation .menu'), 0);
					galaxisSetTabIndex(document.querySelectorAll('.main-navigation .sub-menu'), -1);
				} else {
					galaxisNavIcon.setAttribute('aria-expanded', 'false');
				}

			} else if(galaxisTargetMatches('.main-navigation .menu .sub-menu li.menu-item-has-children > .menu-arrow-button')) {
				event.preventDefault();
				var galaxisSubMenuArrow1 = event.target || event.srcElement;

				var galaxisSubMenuArrows1 = document.querySelectorAll('.main-navigation .menu .sub-menu > li.menu-item-has-children > .menu-arrow-button');
				var galaxisSubMenus1 = document.querySelectorAll('.main-navigation .menu .sub-menu > li.menu-item-has-children > .sub-menu');

				galaxisSubMenuArrowClick(galaxisSubMenuArrow1, galaxisSubMenuArrows1, galaxisSubMenus1);

			} else if(galaxisTargetMatches('.main-navigation .menu li.menu-item-has-children > .menu-arrow-button')) {
				event.preventDefault();
				var galaxisSubMenuArrow2 = event.target || event.srcElement;

				var galaxisSubMenuArrows2 = document.querySelectorAll('.main-navigation .menu > li.menu-item-has-children > .menu-arrow-button');
				var galaxisSubMenus2 = document.querySelectorAll('.main-navigation .menu > li.menu-item-has-children > .sub-menu');

				galaxisSubMenuArrowClick(galaxisSubMenuArrow2, galaxisSubMenuArrows2, galaxisSubMenus2);

			} else {
				var galaxisSubMenuArrows3 = document.querySelectorAll('.main-navigation .menu > li.menu-item-has-children > .menu-arrow-button');
				var galaxisSubMenus3 = document.querySelectorAll('.main-navigation .menu > li.menu-item-has-children > .sub-menu');
				if(galaxisSubMenus3.length) {
					[].forEach.call(galaxisSubMenus3, function(el) {
						el.classList.remove('sub-menu--open');
					});
				}
				if(galaxisSubMenuArrows3.length) {
					for(var i = 0; i < galaxisSubMenuArrows3.length; i++) {
						galaxisSubMenuArrows3[i].classList.remove('sub-menu-show');
						galaxisSubMenuArrows3[i].previousSibling.setAttribute('aria-expanded', 'false');
						galaxisSubMenuArrows3[i].getElementsByClassName('menu-arrow-button-hide')[0].setAttribute('aria-hidden', 'true');
						galaxisSubMenuArrows3[i].getElementsByClassName('menu-arrow-button-show')[0].setAttribute('aria-hidden', 'false');
					}
				}
				galaxisSetTabIndex(document.querySelectorAll('.main-navigation .sub-menu'), -1);
			}
		});
	}

	// Mobile menu.
	galaxisMobileMenu();

	var galaxisFocusableElements = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';

	// Set tabindex of focusable elements.
	function galaxisSetTabIndex(element, value) {
		if(NodeList.prototype.isPrototypeOf(element)) {
			[].forEach.call(element, function(el) {
				[].forEach.call(el.querySelectorAll(galaxisFocusableElements), function(el) {
					el.setAttribute('tabindex', value);
				});
			});

		} else {
			[].forEach.call(element.querySelectorAll(galaxisFocusableElements), function(el) {
				el.setAttribute('tabindex', value);
			});
		}
	}

	galaxisSetTabIndex(document.querySelectorAll('.main-navigation .sub-menu'), -1);

	document.addEventListener('keydown', function(event) {
		var galaxisIsTabPressed = ('Tab' === event.key || 9 === event.keyCode);
		if(!galaxisIsTabPressed) {
			return;
		}

		var galaxisNavIcon = document.querySelector('.menu-toggle');
		if(galaxisNavIcon && ('none' !== getComputedStyle(galaxisNavIcon, null).display)) {
			if(!galaxisNavIcon.classList.contains('menu-toggle--open')) {
				galaxisSetTabIndex(document.querySelector('.main-navigation .menu'), -1);
			}

			if(!event.shiftKey) {
				if(!document.activeElement.classList || !document.activeElement.classList.contains('sub-menu-show')) {
					var galaxisActiveElementArrow = galaxisNextSibling(document.activeElement);
					if(!galaxisActiveElementArrow || (galaxisActiveElementArrow.classList && !galaxisActiveElementArrow.classList.contains('menu-arrow-button'))) {
						var galaxisActiveElementSibling = galaxisNextSibling(document.activeElement.parentNode);
						if(!galaxisActiveElementSibling && document.activeElement.parentNode.parentNode.id && 'primary-menu' === document.activeElement.parentNode.parentNode.id) {
							var menuFocusableElements = document.activeElement.parentNode.parentNode.querySelectorAll(galaxisFocusableElements);
							if(menuFocusableElements.length > 0) {
								menuFocusableElements[0].focus();
								event.preventDefault();
							}
						}
					}
				}
			}
		}

		if(!event.shiftKey) {
			if(!document.activeElement.classList || !document.activeElement.classList.contains('sub-menu-show')) {
				var galaxisActiveElementArrow = galaxisNextSibling(document.activeElement);
				if(!galaxisActiveElementArrow || (galaxisActiveElementArrow.classList && !galaxisActiveElementArrow.classList.contains('menu-arrow-button'))) {
					var galaxisActiveElementSibling = galaxisNextSibling(document.activeElement.parentNode);
					if(!galaxisActiveElementSibling && document.activeElement.parentNode.parentNode.classList && document.activeElement.parentNode.parentNode.classList.contains('sub-menu--open')) {
						var subMenuFocusableElements = document.activeElement.parentNode.parentNode.querySelectorAll(galaxisFocusableElements);
						if(subMenuFocusableElements.length > 0) {
							subMenuFocusableElements[0].focus();
							event.preventDefault();
						}
					}
				}
			}
		}
	});

	// Sticky menu.
	var galaxisMainMenuSticky = document.querySelector('.site-menu-content--sticky');
	if(galaxisMainMenuSticky) {
		var galaxisStickyMenuClass = 'sticky-menu';
		var galaxisStickyMenuInViewClass = 'sticky-menu-in-view';
		var galaxisHeaderHeight = document.querySelector('.site-header').offsetHeight;
		window.addEventListener('scroll', function() {
			if(window.pageYOffset > galaxisHeaderHeight + 100) {
				galaxisMainMenuSticky.classList.add(galaxisStickyMenuClass);
			} else {
				galaxisMainMenuSticky.classList.remove(galaxisStickyMenuClass);
			}
			if(window.pageYOffset > (galaxisHeaderHeight + 150)) {
				galaxisMainMenuSticky.classList.add(galaxisStickyMenuInViewClass);
			} else {
				galaxisMainMenuSticky.classList.remove(galaxisStickyMenuInViewClass);
			}
		});
	}

	// Utility function.
	function galaxisUtil() {}

	// Smooth scroll.
	galaxisUtil.scrollTo = function(final, duration, cb) {
		var galaxisStart = window.scrollY || document.documentElement.scrollTop,
			galaxisCurrentTime = null;

		var galaxisAnimateScroll = function(timestamp) {
			if(!galaxisCurrentTime) {
				galaxisCurrentTime = timestamp;
			}

			var galaxisProgress = timestamp - galaxisCurrentTime;

			if(galaxisProgress > duration) {
				galaxisProgress = duration;
			}

			var galaxisVal = Math.easeInOutQuad(galaxisProgress, galaxisStart, final - galaxisStart, duration);

			window.scrollTo(0, galaxisVal);
			if(galaxisProgress < duration) {
				window.requestAnimationFrame(galaxisAnimateScroll);
			} else {
				cb && cb();
			}
		};

		window.requestAnimationFrame(galaxisAnimateScroll);
	};

	// Animation curves.
	Math.easeInOutQuad = function (t, b, c, d) {
		t /= d/2;
		if(t < 1) return c/2*t*t + b;
		t--;
		return -c/2 * (t*(t-2) - 1) + b;
	};

	// Back to top.
	var galaxisBackTop = document.querySelector('.back-to-top');
	if(galaxisBackTop) {
		var galaxisOffset = 300;
		var galaxisOffsetOpacity = 1200;
		var galaxisScrollDuration = 700;
		var galaxisScrolling = false;
		window.addEventListener('scroll', function() {
			if(!galaxisScrolling) {
				galaxisScrolling = true;
				(!window.requestAnimationFrame) ? setTimeout(galaxisCheckBackToTop, 250) : window.requestAnimationFrame(galaxisCheckBackToTop);
			}
		});

		document.addEventListener('click', function(event) {
			if(galaxisTargetMatches('.back-to-top')) {
				event.preventDefault();
				(!window.requestAnimationFrame) ? window.scrollTo(0, 0) : galaxisUtil.scrollTo(0, galaxisScrollDuration);
			}
		});
	}

	function galaxisCheckBackToTop() {
		var galaxisWindowTop = window.scrollY || document.documentElement.scrollTop;
		( galaxisWindowTop > galaxisOffset ) ? galaxisBackTop.classList.add('back-to-top--show') : galaxisBackTop.classList.remove('back-to-top--show', 'back-to-top--fade-out');
		( galaxisWindowTop > galaxisOffsetOpacity ) && galaxisBackTop.classList.add('back-to-top--fade-out');
		galaxisScrolling = false;
	}

})();
