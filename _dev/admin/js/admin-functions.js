var added = [];
jQuery(document).ready(function() {
  jQuery('.carbon-field.carbon-text').each(check_if_type_range);

  document.addEventListener('newRangeItem', function() {
    jQuery('.carbon-field.carbon-text').each(check_if_type_range);
  })
});

// --- Functions ---
function check_if_type_range() { 
  var $wrap = jQuery(this);
  $wrap.find('input[type=range]').each(function() {
    var $range = jQuery(this);
    if (added.indexOf($range.attr('id')) === -1) {
      added.push($range.attr('id'));
      if ($range.length > 0) {
        var $label = $wrap.find('label');
        var original_label = $label.html();

        modify_wrap_label($wrap, $range, $label, original_label);
        $range.on('input', modify_wrap_label.bind(this, $wrap, $range, $label, original_label));
      }
    }
  });
}

function modify_wrap_label($wrap, $range, $label, original_label, ev) {
  label_text = original_label + ' [' + $range.val() + '%]';
  $label.html(label_text);
}
