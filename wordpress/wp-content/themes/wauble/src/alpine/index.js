export default {
  register: (Alpine) => {
    // Register Alpine stores
    const alpineStores = require.context('./stores/', true, /\.js$/)

    alpineStores.keys().forEach((key) => {
      const store = alpineStores(key).default

      const name = store.name

      Alpine.store(name, store.store())
    })

    // Register Alpine components
    // const alpineComponents = require.context('./components/', true, /\.js$/)

    // alpineComponents.keys().forEach((key) => {
    //   const component = alpineComponents(key).default

    //   // Component name will be named exactly as defined in the module
    //   const name = component.name

    //   Alpine.data(name, component.component)
    // })

    // Register Alpine Magic Properties
    // const alpineMagic = require.context('./magic/', true, /\.js$/)

    // alpineMagic.keys().forEach((key) => {
    //   const magic = alpineMagic(key).default

    //   // Magic name will be named exactly as defined in the module
    //   const name = magic.name

    //   Alpine.magic(name, magic.callback)
    // })

    // Register Alpine directives
    // const alpineDirectives = require.context('./directives/', true, /\.js$/)

    // alpineDirectives.keys().forEach((key) => {
    //   const directive = alpineDirectives(key).default

    //   // Magic name will be named exactly as defined in the module
    //   const name = directive.name

    //   Alpine.directive(name, directive.callback)
    // })
  },
}
