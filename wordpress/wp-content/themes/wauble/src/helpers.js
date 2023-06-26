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
  }
}