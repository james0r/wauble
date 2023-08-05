import Alpine from "alpinejs"
import collapse from "@alpinejs/collapse"
import intersect from '@alpinejs/intersect'
import alpineGlobals from "./alpine"
import helpers from "./helpers.js"
import "./a11y.js"

window.Alpine = Alpine

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
}

Alpine.plugin([intersect, collapse])
alpineGlobals.register(Alpine)
Alpine.start()

console.log('Wauble Frontend Script Loaded')
