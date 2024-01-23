/* eslint-disable no-undef */
/* eslint-disable func-names */
// eslint-disable-next-line func-names
(function($) {
  const helper = {
    // custom helper function for debounce - how to work see https://codepen.io/Hyubert/pen/abZmXjm
    /**
     * Debounce
     * need for once call function
     *
     * @param { function } - callback function
     * @param { number } - timeout time (ms)
     * @return { function }
     */
    debounce(func, timeout) {
      let timeoutID;
      // eslint-disable-next-line no-param-reassign
      timeout = timeout || 200;
      return function() {
        const scope = this;
        // eslint-disable-next-line prefer-rest-params
        const args = arguments;
        clearTimeout(timeoutID);
        timeoutID = setTimeout(function() {
          func.apply(scope, Array.prototype.slice.call(args));
        }, timeout);
      };
    },
    /**
     * Helper if element exist then call function
     */
    isElementExist(_el, _cb, _argCb) {
      const elem = document.querySelector(_el);
      if (document.body.contains(elem)) {
        try {
          if (arguments.length <= 2) {
            _cb();
          } else {
            _cb(..._argCb);
          }
        } catch (e) {
          // eslint-disable-next-line no-console
          console.log(e);
        }
      }
    },

    /**
     *  viewportCheckerAnimate function
     *
     * @param whatElement - element name
     * @param whatClassAdded - class name if element is in viewport
     * @param classAfterAnimate - class name after element animates
     */
    viewportCheckerAnimate(whatElement, whatClassAdded, classAfterAnimate) {
      jQuery(whatElement)
        .addClass('a-hidden')
        .viewportChecker({
          classToRemove: 'a-hidden',
          classToAdd: `animated ${whatClassAdded}`,
          offset: 1,
          callbackFunction(elem) {
            if (classAfterAnimate) {
              elem.on('animationend', () => {
                elem.addClass('animation-end');
              });
            }
          }
        });
    },
    // helpler windowResize
    windowResize(functName) {
      const self = this;
      $(window).on('resize orientationchange', self.debounce(functName, 200));
    },
    /**
     * Init slick slider only on mobile device
     *
     * @param {DOM} $slider
     * @param {array} option - slick slider option
     */
    mobileSlider($slider, option) {
      if (window.matchMedia('(max-width: 768px)').matches) {
        if (!$slider.hasClass('slick-initialized')) {
          $slider.slick(option);
        }
      } else if ($slider.hasClass('slick-initialized')) {
        $slider.slick('unslick');
      }
    },
    /**
     * Set cookie
     *
     * @param {string} name
     * @param {string} value
     * @param {int} days
     */
    setCookie(name, value, days) {
      var expires = '';
      if (days) {
        var date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        expires = '; expires=' + date.toUTCString();
      }
      document.cookie = name + '=' + (value || '') + expires + '; path=/';
    },
    /**
     *Get Cookie
     *
     * @param {string} name
     * @return {string}
     */
    getCookie(name) {
      var nameEQ = name + '=';
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
      }
      return null;
    },
    /**
     * Erase Cookie,
     *
     * @param {string} name
     */
    eraseCookie(name) {
      document.cookie =
        name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }
  };

  const theme = {
    /**
     * Main init function
     */
    init() {
      this.plugins(); // Init all plugins
      this.bindEvents(); // Bind all events
      this.initAnimations(); // Init all animations
    },

    /**
     * Init External Plugins
     */
    plugins() {},

    /**
     * Bind all events here
     *
     */
    bindEvents() {
      const self = this;
      /** * Run on Document Ready ** */
      $(document).on('ready', function() {
        self.smoothScrollLinks();

        helper.isElementExist('.portfolio-archieve__grid', theme.initPortfolioGrid);
        helper.isElementExist('.news-archieve__grid', theme.initNewsGrid);

        helper.isElementExist('.portfolio-gallery__carousel', theme.initPortfolioSlider);
        helper.isElementExist('.services-project__item', theme.initServicesAccordion);
        helper.isElementExist('.core', theme.initCore);
        helper.isElementExist('.team', theme.initTeam);
        helper.windowResize(theme.initTeam);
      });
      /** * Run on Window Load ** */
      var prevScrollPos = window.scrollY;
      var header = document.getElementById('header'); // Replace 'your-header-id' with the actual ID of your header element

      $(window).on('scroll', function() {
        if ($(window).scrollTop() >= 50)
          $('.header').addClass('header--sticky');
        else $('.header').removeClass('header--sticky');

      
        var currentScrollPos = window.scrollY;

        if (prevScrollPos >= currentScrollPos) {
          // Scrolling up
          header.style.top = '0'; // Show the header
        } else {
          // Scrolling down
          header.style.top = '-100px'; // Hide the header (adjust the value as needed)
        }
        if(currentScrollPos < 5)
          header.style.top = '0';
        prevScrollPos = currentScrollPos;
      });
    },

    /**
     * init scroll revealing animations function
     */
    initAnimations() {
      helper.viewportCheckerAnimate('.a-up', 'fadeInUp', true);
      helper.viewportCheckerAnimate('.a-down', 'fadeInDown');
      helper.viewportCheckerAnimate('.a-left', 'fadeInLeft');
      helper.viewportCheckerAnimate('.a-right', 'fadeInRight');
      helper.viewportCheckerAnimate('.a-op', 'fade');
    },

    /**
     * Smooth Scroll link
     */
    smoothScrollLinks() {
      $('a[href^="#"').on('click touchstart', function() {
        const target = $(this).attr('href');
        if (target !== '#' && $(target).length > 0) {
          const offset = $(target).offset().top - $('header').outerHeight();
          $('html, body').animate(
            {
              scrollTop: offset
            },
            500
          );
        }
        return false;
      });
    },

    // ajax CPT
    initPortfolioGrid() {
      function ajaxPortfolio(ind) {
        const $parent = $('.portfolio-archieve__grid')
        $.ajax({
          url: ajaxurl,
          type: 'POST',
          data: {
            action: 'loadAjaxPortfolio',
            ind
          },
          beforeSend: function() {
            $parent.html(
              '<div class="lds-wrapper"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>'
            );
          },
          success: function(res) {
            let json = $.parseJSON(res);
            let strHTML = json.output;
            $parent.html(strHTML);
          },
          complete: function() {}
        })
      }
      $('.portfolio-archieve__category__item').on('click', function() {
        const category = $(this).attr('value')
        $(this).toggleClass('active');
        const list = [];
        $('.portfolio-archieve__category__item.active').each(function() {
          var cat = $(this).attr('value');
          list.push(cat);
        })
        // ajaxPortfolio(list)
      })
    },
    // ajax CPT
    initNewsGrid() {
      function ajaxNews(ind) {
        const $parent = $('.news-archieve__grid')
        $.ajax({
          url: ajaxurl,
          type: 'POST',
          data: {
            action: 'loadAjaxNews',
            ind
          },
          beforeSend: function() {
            $parent.html(
              '<div class="lds-wrapper"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>'
            );
          },
          success: function(res) {
            let json = $.parseJSON(res);
            let strHTML = json.output;
            $parent.html(strHTML);
          },
          complete: function() {}
        })
      }
      $('.news-archieve__category__item').on('click', function() {
        const category = $(this).attr('value')
        $('.news-archieve__category__item').removeClass('active');
        $(this).addClass('active');
        ajaxNews(category)
      })
    },
    // Carousel
    initPortfolioSlider() {
      $('.portfolio-gallery__carousel').slick({
        dots: false,
        autoplay: false,
        centerMode: true,
        variableWidth: true,
        centerPadding: '5px',
      })
    },
    initServicesAccordion() {
      $('.services-project__item .item-content__main').slideUp();
      $('.services-project__item.active .item-content__main').slideDown();
      $('.services-project .item-content__title').on('click', function() {
        // if($(this).next().is(':visible')) {
        //   return;
        // }
        // $('.services-project__item').removeClass('active');
        // $('.services-project__item .item-content__main').slideUp();
        $(this).next().slideToggle('slow');
        $(this).closest('.services-project__item').toggleClass('active');
      })
    },
    initCore() {
      $('.core-quote__item').on('click', function() {
        $('.core-quote__item__description').slideUp();
        $('.core-quote__item').removeClass('active');
        if(!$(this).find('.core-quote__item__description').is(':visible')) {
          $(this).addClass('active');
          $(this).find('.core-quote__item__description').slideDown();
        }
      })
    },
    initTeam() {
      helper.mobileSlider($('.team-content'), {
        responsive: [
          {
            breakpoint: 640,
            settings: {
              slidesToShow: 1,
              centerMode: true,
              centerPadding: "10%"
            }
          }
        ]
      })
    }
  };
  // Initialize Theme
  $('.hamburger').on('click', function() {
    $('.header-nav').addClass('active');
    $('.header').addClass('active');
    // setTimeout(() => {
      var currentPosition = $(window).scrollTop();
      
      // Calculate the new scroll position by adding 10 pixels to the current position
      var newPosition = currentPosition + 1;
      $('html, body').animate({ scrollTop: newPosition }, 'slow');
      $('html, body').animate({ scrollTop: newPosition - 2 }, 'slow');
    // }, 100)
    document.body.style.overflow = 'hidden';
  })
  function moveMouse(offsetX, offsetY) {
    var event = $.Event('mousemove');
    event.pageX = offsetX + $(window).scrollLeft();
    event.pageY = offsetY + $(window).scrollTop();
    $(document).trigger(event);
  }
  $('.header-nav__close').on('click', function() {
    $('.header-nav').removeClass('active');
    setTimeout(() => {
      var currentPosition = $(window).scrollTop();
      $('.header').removeClass('active');
      // Calculate the new scroll position by adding 10 pixels to the current position
      var newPosition = currentPosition + 1;
      $('html, body').animate({ scrollTop: newPosition }, 'slow');
      $('html, body').animate({ scrollTop: newPosition - 1 }, 'slow');
    }, 100)
    document.body.style.overflowY = 'scroll';
  })
  //

  $('.portfolio-carousel').slick({
    slidesToScroll: 1,
    slidesToShow: 3,
    adaptiveHeight: true,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
        }
      },
      {
        breakpoint: 640,
        settings: {
          slidesToShow: 1,
          centerMode: true,
        }
      }
    ]
  })
  $('.news-carousel').slick({
    slidesToScroll: 1,
    slidesToShow: 3,
    adaptiveHeight: true,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
        }
      },
      {
        breakpoint: 640,
        settings: {
          slidesToShow: 1,
          centerMode: true,
        }
      }
    ]
  })
  //portfolio category
  $('.portfolio-archieve__info__title').on('click', function() {
    $('.portfolio-archieve__info__categories').toggleClass('active');
    $('.portfolio-archieve__info__title').toggleClass('active');
  })
  $('body').on('click', '.facetwp-checkbox', function() {
    var value = $(this).attr('data-value')
    if(value != 'all-projects') {
      $('[data-value="all-projects"]').removeClass('checked')
    }
    else {
      $('.facetwp-checkbox').each(function() {
        if ($(this).hasClass('checked') && $(this).attr('data-value') != 'all-projects') {
            $(this).click();
        }
      });
      $(this).addClass('checked');
    }
  });

  //services accordion
  $('.services-accordion__item__title').on('click', function() {
    $('.services-accordion__item__description').slideUp();
    if(!$(this).next().is(':visible'))
      $(this).next().slideDown();
  })

  /////////counter

  // function animateValue(obj, start, end, duration) {
  //   let startTimestamp = null;
  //   const step = (timestamp) => {
  //     if (!startTimestamp) startTimestamp = timestamp;
  //     duration += 15;
  //     const progress = Math.min((timestamp - startTimestamp) / duration, 1);
  //     obj.innerHTML = Math.floor(progress * (end - start) + start);
  //     if (progress < 1) {
  //       window.requestAnimationFrame(step);
  //     }
  //   };
  //   window.requestAnimationFrame(step);
  // }

  function animateValue(obj, start, end, duration) {
    var finalCount = end;
    var step = 10; // update interval in milliseconds
  
    var currentCount = start;
  
    var counter = setInterval(function() {
      var remainingDistance = finalCount - currentCount;
      var increment = remainingDistance / (duration / step);
  
      currentCount += increment;
  
      if (currentCount >= finalCount) {
        currentCount = finalCount;
        clearInterval(counter);
      }
      // console.log(ojb)
      $(obj).text(Math.round(currentCount));
    }, step);
  }
  var flag = 0;
  const observer = new IntersectionObserver((entries) => {
    console.log("flag", flag)
    // if (flag ++ > 0)
      // return;
    entries.forEach((entry) => {
    if (entry.isIntersecting) {
        $('.statistics-item__number').find('.number').each(function() {
          var num = parseInt($(this).attr('end'));
          var start = parseInt($(this).attr('start'));
          console.log(start);
          $(this).attr('start', num.toString());
          animateValue(this, start, num, 1000);
        });
      }
    });
  });
  
  // Get the target section element
  const section = document.querySelector('.statistics');
  
  // Start observing the section
  if(section)
    observer.observe(section)

  
  $('.mobile-show').on('click', function() {
    $('.portfolio-hero__info').slideToggle();
    $('.mobile-show').toggleClass('active');
  })

  var data = [
        {speed:5},
        {speed:-5},
        {speed:5},
        {speed:15},
    ];
    
  if($('.parallax-window'))
    $('.parallax-window').parallax();
  if($('.services-gallery__item'))
  {
    $('.services-gallery__item').each(function(i, o) {
      $(this).jquery_parallax(data[i]);
    })
  }
  if($('.about-gallery__item'))
  {
    $('.about-gallery__item').each(function(i, o) {
      $(this).jquery_parallax(data[i]);
    })
  }
  if($('.statistics-item')) {
    $(document).mousemove(function(event) {
      const mouseX = event.clientX;
      const mouseY = event.clientY;
      $('.statistics-item').each(function() {
        const $title = $(this);
        const relaY = $title.offset().top - window.pageYOffset;
        const relaX = $title.offset().left;
    
        $(this).find('.statistics-item__title').css('top', `${mouseY - relaY}px`);
        $(this).find('.statistics-item__title').css('left', `${mouseX - relaX}px`);
      });
    })
  }
  // $('.gallery-image').find('.button-next .button-btn').on('click', function() {
  //   $('.slick-prev').trigger('click')
  // })
  // $('.gallery-image').find('.button-prev .button-btn').on('click', function() {
  //   $('.slick-next').trigger('click')
  // })

  
  $(document).click(function(event) {
    var modal = $('.loop-team__modal');
    // Check if the clicked element is outside the modal
    if (!modal.is(event.target) && modal.has(event.target).length === 0 && $('.loop-team__modal').hasClass('active')) {
      // $('.loop-team__modal').removeClass('active')
      console.log("sdf")
    }
  });
  $('.loop-team__img').on('click', function() {
    if($('.loop-team__modal').hasClass('active'))
      return;
    const $modal = $(this).parent()
    var num = $modal.attr('num');
    $('.team-mobile').find(`[num="${num}"]`).find('.loop-team__modal').addClass('active');
    $('.team-content').find(`[num="${num}"]`).find('.loop-team__modal').addClass('active');
  })
  $('.loop-team__popup').on('click', function() {
    if($('.loop-team__modal').hasClass('active'))
      return;
    const $modal = $(this).parent()
    var num = $modal.attr('num');
    $('.team-mobile').find(`[num="${num}"]`).find('.loop-team__modal').addClass('active');
    $('.team-content').find(`[num="${num}"]`).find('.loop-team__modal').addClass('active');
  })
  $('.loop-team__modal').find('.close').on('click', function() {
    $('.loop-team__modal').removeClass('active')
  })

  console.log($('.item-project__title').width())
  $('.item-project__title').each(function() {
    if($(this).width() > 250)
    {
      $(this).css('max-width', '276px')
      $(this).css('min-width', '220px')
      $(this).css('text-wrap', 'balance')
    }
  });
  theme.init();
})(jQuery);
