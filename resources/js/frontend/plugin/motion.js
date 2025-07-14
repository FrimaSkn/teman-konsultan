import { animate, stagger, scroll, press, inView, hover } from "motion";


// animation
let scale = { scale: [0, 1] };
let fade = { opacity: [0, 1] };
let fadeUp = { opacity: [0, 1], y: [10, 0] };
let fadeDown = { opacity: [0, 1], y: [-10, 0] };
let fadeLeft = { opacity: [0, 1], x: [10, 0] };
let fadeRight = { opacity: [0, 1], x: [-10, 0] };
let fadeUpLeft = { opacity: [0, 1], y: [10, 0], x: [10, 0] };
let fadeUpRight = { opacity: [0, 1], y: [10, 0], x: [-10, 0] };
let fadeDownLeft = { opacity: [0, 1], y: [-10, 0], x: [10, 0] };
let fadeDownRight = { opacity: [0, 1], y: [-10, 0], x: [-10, 0] };

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
            e.querySelectorAll('[hover-fade-right]'),
            fadeRight,
            optionStagger,
        );
    });
});

// animation on inview
ifexists('[data-motion="inview-fadeup"]', (elements) => {
    inView(elements, (e) => {
            const animation = animate(
                e,
                fadeUp,
                optionDefault
            );
    });
});

ifexists('[data-motion="inview-fadedown"]', (elements) => {
    inView(elements, (e) => {
        const animation = animate(
            e,
            fadeDown,
            optionDefault
        );
    });
});

ifexists('[data-motion="inview-fadeleft"]', (elements) => {
    inView(elements, (e) => {
        const animation = animate(
            e,
            fadeLeft,
            optionDefault
        );
    });
});

ifexists('[data-motion="inview-faderight"]', (elements) => {
    inView(elements, (e) => {
        const animation = animate(
            e,
            fadeRight,
            optionDefault
        );
    });
});

ifexists('[data-motion="inview-fade"]', (elements) => {
    inView(elements, (e) => {
        const animation = animate(
            e,
            fade,
            optionDefault
        );
    });
});

ifexists('[data-motion="inview-scale"]', (elements) => {
    inView(elements, (e) => {
        const animation = animate(
            e,
            scale,
            optionDefault
        );
    });
});

ifexists('[data-motion="inview-downright"]', (elements) => {
    inView(elements, (e) => {
        const animation = animate(
            e,
            fadeDownRight,
            optionStagger
        );
    });
});

ifexists('[data-motion="inview-downleft"]', (elements) => {
    inView(elements, (e) => {
        const animation = animate(
            e,
            fadeDownLeft,
            optionStagger
        );
    });
});

ifexists('[data-motion="inview-upright"]', (elements) => {
    inView(elements, (e) => {
        const animation = animate(
            e,
            fadeUpRight,
            optionStagger
        );
    });
});

ifexists('[data-motion="inview-upleft"]', (elements) => {
    inView(elements, (e) => {
        const animation = animate(
            e,
            fadeUpLeft,
            optionStagger
        );
    });
});

// animation on inview stagger
ifexists('[data-motion="inview-fadeup-stg"]', (elements) => {
    inView(elements, (e) => {
        const animation = animate(
            e.querySelectorAll('[data-animate="inview-fadeup-stg"]'),
            fadeUp,
            optionStagger
        );
    });
});

ifexists('[data-motion="inview-fadedown-stg"]', (elements) => {
    inView(elements, (e) => {
        const animation = animate(
            e.querySelectorAll('[data-animate="inview-fadedown-stg"]'),
            fadeDown,
            optionStagger
        );
    });
});

ifexists('[data-motion="inview-fadeleft-stg"]', (elements) => {
    inView(elements, (e) => {
        const animation = animate(
            e.querySelectorAll('[data-animate="inview-fadeleft-stg"]'),
            fadeLeft,
            optionStagger
        );
    });
});

ifexists('[data-motion="inview-faderight-stg"]', (elements) => {
    inView(elements, (e) => {
        const animation = animate(
            e.querySelectorAll('[data-animate="inview-faderight-stg"]'),
            fadeRight,
            optionStagger
        );
    });
});

ifexists('[data-motion="inview-fade-stg"]', (elements) => {
    inView(elements, (e) => {
        const animation = animate(
            e.querySelectorAll('[data-animate="inview-fade-stg"]'),
            fade,
            optionStagger
        );
    });
});

ifexists('[data-motion="inview-scale-stg"]', (elements) => {
    inView(elements, (e) => {
        const animation = animate(
            e.querySelectorAll('[data-animate="inview-scale-stg"]'),
            scale,
            optionStagger
        );
    });
});
