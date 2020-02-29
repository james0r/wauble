<?php
/*
*Template Name: Schedule Template
*/
?>

<script>
  function resizeIframe(obj) {
    console.log( 'called' );
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }

  window.onload = function () {
    var obj = document.getElementById('schedulicity-widgetFrame');
    resizeIframe(obj);
  }
</script>

<?php get_header(); ?>
<?php get_part('pagetitle'); ?>
<div class="minor-container">
<div class="spinner">
  <div class="double-bounce1"></div>
  <div class="double-bounce2"></div>
</div>
  <script type="text/javascript" 
          src="https://www.schedulicity.com/api/public/widget/MRMPVW/embed">
  </script>
</div>

<?php get_footer(); ?>

<script>
  (function (win) {
    'use strict';
 
    var listeners = [],
      doc = win.document,
      MutationObserver = win.MutationObserver || win.WebKitMutationObserver,
      observer;
 
    function ready(selector, fn) {
      // Store the selector and callback to be monitored
      listeners.push({
        selector: selector,
        fn: fn
      });
      if (!observer) {
        // Watch for changes in the document
        observer = new MutationObserver(check);
        observer.observe(doc.documentElement, {
          childList: true,
          subtree: true
        });
      }
      // Check if the element is currently in the DOM
      check();
    }
 
    function check() {
      // Check the DOM for elements matching a stored selector
      for (var i = 0, len = listeners.length, listener, elements; i < len; i++) {
        listener = listeners[i];
        // Query for elements matching the specified selector
        elements = doc.querySelectorAll(listener.selector);
        for (var j = 0, jLen = elements.length, element; j < jLen; j++) {
          element = elements[j];
          // Make sure the callback isn't invoked with the 
          // same element more than once
          if (!element.ready) {
            element.ready = true;
            // Invoke the callback with the element
            listener.fn.call(element, element);
          }
        }
      }
    }
 
    // Expose `ready`
    win.ready = ready;
 
  })(this);



  ready('.schedulicity-embed', function () {
    setTimeout(function() {
    $('.spinner').fadeOut('fast', function() {
        $('.schedulicity-embed').fadeIn();
    })
    }, 1000);
  })
</script>