export default {
  name: 'global',
  store() {
    return {
      themeName: 'wauble',
      isMobileMenuVisible: false,
      isWindowScrolled: false,
      init() {
        window.addEventListener('scroll', this.onWindowScrollHandler)
        window.addEventListener('DOMContentLoaded', this.initCalcHeaderHeight)
        window.addEventListener('resize', this.initCalcHeaderHeight)
      },
      get bodyClasses() {
        let classes = []

        if (this.isMobileMenuVisible) {
          classes.push('mobile-menu-visible')
        }

        return classes || ''
      },
      initCalcHeaderHeight() {
        let header = document.getElementById('site-header')
        let headerHeight = header.offsetHeight
        document.documentElement.style.setProperty('--header-height', headerHeight + 'px')
      },
      onWindowScrollHandler() {
        const scrollTop = window.scrollY

        document.body.classList[scrollTop > 0 ? 'add' : 'remove']('tw-scrolled')
        this.isWindowScrolled = scrollTop > 0
      },
      openMobileMenu() {
        this.isMobileMenuVisible = true
      },
      closeMobileMenu() {
        this.isMobileMenuVisible = false
      },
      toggleMobileMenu() {
        if (this.isMobileMenuVisible) {
          this.closeMobileMenu()
        } else {
          this.openMobileMenu()
        }
      }
    }
  }
}