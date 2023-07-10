import Alpine from "alpinejs"
import collapse from "@alpinejs/collapse"
import intersect from '@alpinejs/intersect'
import alpineExtended from "./alpine"
import helpers from "./helpers.js"
import "./a11y.js"

window.Alpine = Alpine
window.htmx = require('htmx.org');

// Declare our namespace on the window
const namespace = "wauble"

// Define our namespace and helpers property
window[namespace] = window[namespace] || {}
window[namespace].helpers = {}

// Map helper functions to window[namespace].helpers
for (const [key, value] of Object.entries(helpers)) {
  window[namespace].helpers[key] = value
}

if (process.env.NODE_ENV === "development") {
  const tableData = {
    "Theme Namespace": namespace,
    "WP Template": window[namespace].wordpress.currentTemplate,
    "WP Version": window[namespace].wordpress.wpVersion,
  }
  console.table(tableData)

  // Clear HTMX headers that cause CORS issues in dev
  // document.addEventListener('htmx:configRequest', (evt) => {
  //   evt.detail.headers = [];
  // });

  // Replace live site URL with local URL for XHR requests
  document.body.addEventListener('htmx:beforeSwap', function (evt) {
    if (
      !evt.detail.xhr.responseURL.includes('https://bs') &&
      !evt.detail.xhr.responseURL.includes('http://bs')
    ) {
      return
    }

    evt.detail.serverResponse = evt.detail.serverResponse.replace(/\/wauble.lndo.site/g, '\/bs.wauble.lndo.site')
  });
}

Alpine.plugin(intersect)
Alpine.plugin(collapse)
alpineExtended.register(Alpine)
Alpine.start()

console.log('Wauble Frontend Script Loaded')
