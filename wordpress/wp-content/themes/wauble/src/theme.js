import Alpine from "alpinejs"
import collapse from "@alpinejs/collapse"
import intersect from '@alpinejs/intersect'
import focus from "@alpinejs/focus"
import morph from "@alpinejs/morph"
import alpineGlobals from "./alpine"

import helpers from "./helpers.js"
import "./a11y.js"

window.Alpine = Alpine

const NAMESPACE = "wauble"

window[NAMESPACE] = window[NAMESPACE] || {}
window[NAMESPACE].helpers = {}

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

Alpine.plugin([intersect, collapse, focus, morph])
alpineGlobals.register(Alpine)
Alpine.start() 

console.log('Wauble Frontend Script Loaded')