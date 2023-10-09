// Switch this flag to true to enable a11y debugging
const a11yDebug = false

if (a11yDebug) {
 function getKeyboardFocusableElements (element = document) {
  return [...element.querySelectorAll(
    'a[href], button, input, textarea, select, details,[tabindex]:not([tabindex="-1"])'
    )]
  .filter(el => !el.hasAttribute('disabled') && !el.getAttribute("aria-hidden"))
}

let focusable = getKeyboardFocusableElements()

focusable.forEach((element) => {
  element.addEventListener('focus', function(e) {
    console.log(e.target)
  }) 
})
}