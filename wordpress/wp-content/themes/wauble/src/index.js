import Alpine from "alpinejs"
import collapse from "@alpinejs/collapse"
import intersect from '@alpinejs/intersect'
import alpineExtended from "./alpine"
import helpers from "./helpers.js"
import "./a11y.js"

window.Alpine = Alpine
window.htmx = require('htmx.org');

// Declare our NAMESPACE on the window
const NAMESPACE = "wauble"

// Define our NAMESPACE and helpers property
window[NAMESPACE] = window[NAMESPACE] || {}
window[NAMESPACE].helpers = {}

// Map helper functions to window[NAMESPACE].helpers
for (const [key, value] of Object.entries(helpers)) {
  window[NAMESPACE].helpers[key] = value
}

if (process.env.NODE_ENV === "development") {
  const tableData = {
    "Theme NAMESPACE": NAMESPACE,
    "WP Template": window[NAMESPACE].wordpress.currentTemplate,
    "WP Version": window[NAMESPACE].wordpress.wpVersion,
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

Alpine.plugin([intersect, collapse])
alpineExtended.register(Alpine)
Alpine.start()

console.log('Wauble Frontend Script Loaded')
