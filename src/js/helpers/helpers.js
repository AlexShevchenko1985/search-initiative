/**
 *
 * Converts an array-like object to an array.
 * @param {NodeList} items - The array-like object to be converted to an array.
 * @returns {Array} The converted array.
 */
const convertToArray = items => Array.prototype.slice.call(items);

/**
 *
 * Converts nodes matching the given selector to an array.
 * @function
 * @param {string} selector - The selector used to select nodes.
 * @returns {Array} An array of nodes matching the selector.
 */
const convertNodesToArray = selector => {
    const items = document.querySelectorAll(selector);
    return convertToArray(items);
};

const fadeOut = (el, time = 400) => {
    el.style.opacity = 1;
    let last = +new Date();

    const tick = () => {
        el.style.opacity = +el.style.opacity - (new Date() - last) / time;
        last = +new Date();

        if (+el.style.opacity > 0) {
            if (typeof window.requestAnimationFrame !== 'undefined') {
                requestAnimationFrame(tick);
            } else {
                setTimeout(tick, 16);
            }
        } else {
            el.style.display = 'none';
        }
    };

    tick();
};

const fadeIn = (el, time = 400) => {
    el.style.opacity = 0;
    el.style.display = 'block';

    let last = +new Date();
    const tick = () => {
        el.style.opacity = +el.style.opacity + (new Date() - last) / time;
        last = +new Date();

        if (+el.style.opacity < 1) {
            if (typeof window.requestAnimationFrame !== 'undefined') {
                requestAnimationFrame(tick);
            } else {
                setTimeout(tick, 16);
            }
        }
    };

    tick();
};

export { convertToArray, convertNodesToArray, fadeIn, fadeOut };
