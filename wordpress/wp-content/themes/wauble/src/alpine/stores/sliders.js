import EmblaCarousel from 'embla-carousel'

export default {
  name: 'sliders',
  store() {
    return {
      init() {
        const fullWidthSliders = document.querySelectorAll('.section-full-width-slider')

        if (fullWidthSliders) {
          fullWidthSliders.forEach((fullWidthSlider) => {
            const EMBLA_OPTIONS = JSON.parse(fullWidthSlider.querySelector('[embla-options]').textContent)
            const slider = fullWidthSlider.querySelector('.embla')
            const prevButtonNode = fullWidthSlider.querySelector('.embla__button--prev')
            const nextButtonNode = fullWidthSlider.querySelector('.embla__button--next')
            const dotsNode = fullWidthSlider.querySelector('.embla__dots')

            const embla = EmblaCarousel(slider, EMBLA_OPTIONS)

            if (EMBLA_OPTIONS.showNavigation) {
              this.initPrevNextBtns(embla, prevButtonNode, nextButtonNode)
            }

            if (EMBLA_OPTIONS.showPagination) {
              this.addDotBtnsAndClickHandlers(embla, dotsNode)
            }
          })
        }
      },
      addPrevNextBtnsClickHandlers (emblaApi, prevBtn, nextBtn) {
        const scrollPrev = () => emblaApi.scrollPrev()
        const scrollNext = () => emblaApi.scrollNext()
        prevBtn.addEventListener('click', scrollPrev, false)
        nextBtn.addEventListener('click', scrollNext, false)
      
        return () => {
          prevBtn.removeEventListener('click', scrollPrev, false)
          nextBtn.removeEventListener('click', scrollNext, false)
        }
      },
      addTogglePrevNextBtnsActive (emblaApi, prevBtn, nextBtn) {
        const togglePrevNextBtnsState = () => {
          if (emblaApi.canScrollPrev()) prevBtn.removeAttribute('disabled')
          else prevBtn.setAttribute('disabled', 'disabled')
      
          if (emblaApi.canScrollNext()) nextBtn.removeAttribute('disabled')
          else nextBtn.setAttribute('disabled', 'disabled')
        }
      
        emblaApi
          .on('select', togglePrevNextBtnsState)
          .on('init', togglePrevNextBtnsState)
          .on('reInit', togglePrevNextBtnsState)
      
        return () => {
          prevBtn.removeAttribute('disabled')
          nextBtn.setAttribute('disabled', 'disabled')
        }
      },
      addDotBtnsAndClickHandlers (emblaApi, dotsNode) {
        let dotNodes = []
      
        const addDotBtnsWithClickHandlers = () => {
          dotsNode.innerHTML = emblaApi 
            .scrollSnapList()
            .map(() => '<button class="embla__dot" type="button"></button>')
            .join('')
      
          dotNodes = Array.from(dotsNode.querySelectorAll('.embla__dot'))
          dotNodes.forEach((dotNode, index) => {
            dotNode.addEventListener('click', () => emblaApi.scrollTo(index), false)
          })
        }
      
        const toggleDotBtnsActive = () => {
          const previous = emblaApi.previousScrollSnap()
          const selected = emblaApi.selectedScrollSnap()
          dotNodes[previous].classList.remove('embla__dot--selected')
          dotNodes[selected].classList.add('embla__dot--selected')
        }
      
        emblaApi
          .on('init', addDotBtnsWithClickHandlers)
          .on('reInit', addDotBtnsWithClickHandlers)
          .on('init', toggleDotBtnsActive)
          .on('reInit', toggleDotBtnsActive)
          .on('select', toggleDotBtnsActive)
      
        return () => {
          dotsNode.innerHTML = ''
        }
      },
      initPrevNextBtns (emblaApi, prevBtn, nextBtn) {
        const removePrevNextBtnsClickHandlers = this.addPrevNextBtnsClickHandlers(
          emblaApi,
          prevBtn,
          nextBtn,
        )
        const removeTogglePrevNextBtnsActive = this.addTogglePrevNextBtnsActive(
          emblaApi,
          prevBtn,
          nextBtn,
        )
        
        emblaApi
          .on('destroy', removePrevNextBtnsClickHandlers)
          .on('destroy', removeTogglePrevNextBtnsActive)
      }
    }
  }
}