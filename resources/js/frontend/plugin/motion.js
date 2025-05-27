import { animate, stagger, scroll, press, inView, hover } from "motion";


// animation
let scale = { scale: [0, 1] };
let fade = { opacity: [0, 1] };
let fadeUp = { opacity: [0, 1], y: [10, 0] };
let fadeDown = { opacity: [0, 1], y: [-10, 0] };
let fadeLeft = { opacity: [0, 1], x: [10, 0] };
let fadeRight = { opacity: [0, 1], x: [-10, 0] };

//  options
let optionStagger = { delay: stagger(0.3,{ startDelay: 0.3}), duration: 0.5};
let optionDefault = { delay: 0.2, duration: 0.9, easing: [0.17, 0.55, 0.55, 1] };

function ifexists(selector, callback) {
    const elements = document.querySelectorAll(selector);
    if (elements.length > 0) {
        callback(elements);
    }
}

ifexists('[data-motion="hover-btn"]', (elements) => {
    hover(elements, (e) => {
        const animation = animate(
            e.querySelector('[animate-slide-x]'),
            {
                transform: ["none", "translateX(calc(100% + 2rem)", "translateX(calc(-100% - 2rem)", "none"],
                opacity: [1, 0, 0, 1],
            },
            {
                duration: 0.9,
                easing: "ease-in",
            }
        );

    //   return () =>  animation.stop();
    });
});

ifexists('[data-motion="hover-stg"]', (elements) => {
    hover(elements, (e) => {
        const animation = animate(
            e.querySelectorAll('[animate-fade-right]'),
            fadeRight,
            optionStagger,
        );
    });
})
