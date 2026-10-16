// v-reveal: the element fades in when it scrolls into view.
// Usage: v-reveal (from below), v-reveal="'left'", v-reveal="{ dir: 'right', delay: 150 }"
// Directions: up, down, left, right, zoom
const reduced = typeof window !== 'undefined' && window.matchMedia?.('(prefers-reduced-motion: reduce)').matches;

const observer =
    typeof IntersectionObserver !== 'undefined' && !reduced
        ? new IntersectionObserver(
              (entries) => {
                  for (const entry of entries) {
                      if (entry.isIntersecting) {
                          entry.target.classList.add('is-visible');
                          observer.unobserve(entry.target);
                      }
                  }
              },
              { threshold: 0.12, rootMargin: '0px 0px -40px 0px' },
          )
        : null;

export default {
    mounted(el, binding) {
        if (!observer) return;
        const value = binding.value ?? 'up';
        const dir = typeof value === 'object' ? value.dir ?? 'up' : value;
        const delay = typeof value === 'object' ? value.delay ?? 0 : 0;
        el.classList.add('reveal', `reveal-${dir}`);
        if (delay) el.style.transitionDelay = `${delay}ms`;
        observer.observe(el);
    },
    unmounted(el) {
        observer?.unobserve(el);
    },
};

// Gives cards in a row different directions: left, up, right, left, up, right…
export const cycle = (index, delayStep = 90) => ({
    dir: ['left', 'up', 'right'][index % 3],
    delay: (index % 3) * delayStep,
});
