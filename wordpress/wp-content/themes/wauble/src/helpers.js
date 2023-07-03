export default {
  randomNumber(min = 0, max = 1000) {
    return Math.floor(Math.random() * (max - min + 1) + min)
  },
  debounce(fn, wait) {
    let t;
    return (...args) => {
      clearTimeout(t);
      t = setTimeout(() => fn.apply(this, args), wait);
    };
  },
  truncateLongTitle(input) {
    return input.length > 5 ? `${input.substring(0, 18)}...` : input
  },
  async fetchHTML(endpoint) {
    return await fetch(endpoint)
      .then((response) => response.text())
      .then((responseText) => {
        return new DOMParser().parseFromString(responseText, 'text/html')
      })
  },
  isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  }
}