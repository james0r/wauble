import * as focusTrap from 'focus-trap'; // ESM

export default {
  name: 'global',
  store() {
    return {
      themeName: 'wauble',
      isMobileMenuVisible: false,
      mobileNavEl: null,
      mobileFocusTrap: null,
      init() {
        window.addEventListener('scroll', this.onWindowScrollHandler)
        window.addEventListener('DOMContentLoaded', this.initCalcHeaderHeight)
        window.addEventListener('resize', this.initCalcHeaderHeight)

        this.mobileNavEl = document.getElementById('mobile-header-nav-list')
        this.mobileFocusTrap = focusTrap.createFocusTrap(this.mobileNavEl, {
          allowOutsideClick: true
        })
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
        var scrollTop =
          window.pageYOffset !== undefined
            ? window.pageYOffset
            : (document.documentElement || document.body.parentNode || document.body).scrollTop

        if (scrollTop > 0) {
          document.body.classList.add('scrolled')
          this.isWindowScrolled = true
        } else {
          document.body.classList.remove('scrolled')
          this.isWindowScrolled = false
        }
      },
      openMobileMenu() {
        this.isMobileMenuVisible = true
        setTimeout(() => {
          this.mobileFocusTrap.activate()
        }, 1000)
      },
      closeMobileMenu() {
        this.isMobileMenuVisible = false
        this.mobileFocusTrap.deactivate()
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