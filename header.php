<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta property="og:image" content="<?php echo $share_image; ?>">
  <meta property="og:url" content="<?php global $wp;
                                    echo home_url($wp->request) ?>">
  <meta property="og:title" content="">
  
  <?php wp_head(); ?>
</head>

<body <?php body_class('') ?>>
  <?php get_part('header'); ?>

  <?php 
    if (carbon_get_theme_option('crb_show_promo_options')) : ?>

  <div class="promo-banner-major">
    <div class="minor-container">
      <div class="promo-banner">
        <div class="promo-banner-inner">
          <?php echo carbon_get_theme_option('crb_promo_banner'); ?>
          <i class="fa fa-times promo-close" aria-hidden="true"></i>
        </div>
      </div>
    </div>
  </div>

  <?php endif; ?>

  <div class="major-container--header">
    <div class="minor-container">
      <header class="header-inner">
        <a href="/">
          <?php echo wp_get_attachment_image(
            carbon_get_theme_option('crb_header_logo'),
            array('250', '400', '800'),
            "",
            array("class" => "logo-img")
          )
          ?>
        </a>
        <?php
        if (has_nav_menu('header-menu')) {
          $header_nav = wp_nav_menu(array(
            'menu'            => 'header-menu',
            'theme_location'  => 'header-menu',
            'container'       => 'nav',
            'container_class' => 'header__nav'
          ));
        }
        ?>
      </header>
      <header class="header-inner--mobile">
        <div class="mobile-drawer">
          <div class="container hamburger original">
            <div id="menu-toggle">
              <div id="hamburger">
                <span></span>
                <span></span>
                <span></span>
              </div>
              <div id="cross">
                <span></span>
                <span></span>
              </div>
            </div>
          </div>
          <?php
          if (has_nav_menu('header-menu')) {
            $header_nav = wp_nav_menu(array(
              'menu'            => 'header-menu',
              'theme_location'  => 'header-menu',
              'container'       => 'nav',
              'container_class' => 'header__nav--mobile'
            ));
          }
          ?>
        </div>
        <div class="container hamburger clone">
          <div id="menu-toggle2">
            <div id="hamburger2">
              <span></span>
              <span></span>
              <span></span>
            </div>
            <div id="cross2">
              <span></span>
              <span></span>
            </div>
          </div>
        </div>

        <?php echo wp_get_attachment_image(
          carbon_get_theme_option('crb_header_logo'),
          array('250', '400', '800'),
          "",
          array("class" => "logo-img")
        )
        ?>
      </header>
    </div>
  </div>

  <script>
    (function($) {

      $('#menu-toggle2').click(function() {
        $('#menu-toggle2').toggleClass('open');
        $('#menu-toggle').toggleClass('open');
        $('.mobile-drawer').toggleClass('drawer-shown');
      })

      $('#menu-toggle').click(function() {
        if ($('.mobile-drawer').hasClass('drawer-shown')) {
          $('.mobile-drawer').removeClass('drawer-shown');
        } else {
          $('.mobile-drawer').addClass('drawer-shown');
        }
        $('#menu-toggle2').toggleClass('open');
        $('#menu-toggle').toggleClass('open');
      })

      $('li.menu-item-has-children > a').on('click', function(event) {
        event.preventDefault();
        var $mysub = $(this).parent().find('.sub-menu');

        if ($mysub.hasClass('is-open')) {
          $mysub.slideUp('slow');
          $mysub.removeClass('is-open');
          $(this).removeClass('is-open');
        } else {
          $mysub.addClass('is-open');
          $mysub.slideDown('slow');
          $(this).addClass('is-open');
        }
      })

      function setCookie(c_name, c_value, exdays) {
        console.log( 'called' );
        var exdate = new Date();
        exdate.setDate(exdate.getDate() + exdays);
        document.cookie = encodeURIComponent(c_name) +
          "=" + encodeURIComponent(c_value) +
          (!exdays ? "" : "; expires=" + exdate.toUTCString());;
      }

      function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
      }

      $('.promo-banner-major').hide();

      if (getCookie('banner_shown') == undefined) {
        $('.promo-banner-major').show();
      }

      $('.promo-close').on('click', function() {
        $('.promo-banner-major').hide();
        setCookie('banner_shown', true, 7);
      })

      function checkHeight() {
        if (window.innerWidth < 980 || $('.major-container--header').hasClass('stucky')) {
          $('.promo-banner-major').css('margin-top', $('.major-container--header').height());
        } else {
          $('.promo-banner-major').css('margin-top', "0px");
        }

        if (!$(window).scrollTop() && window.innerWidth > 980) {
          $('.promo-banner-major').css('margin-top', "0px");
        }
      }


      // Bind to the resize event of the window object
      $(window).on("resize", function() {
        checkHeight();
      }).resize();

      $(window).scroll(function(event) {
        checkHeight();
        console.log( $(window).scrollTop() );
      })


    })(jQuery);
  </script>