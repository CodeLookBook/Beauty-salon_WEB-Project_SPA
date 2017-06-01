window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');

} catch (e) {}




/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');

/**
 * Vue-resource provides services for making web requests and handle
 * responses using a XMLHttpRequest or JSONP
 */
import VueResource from 'vue-resource'
window.Vue.use(VueResource);


/**
 * Vue-router setup
 */
import VueRouter from 'vue-router';
window.Vue.use(VueRouter);


/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);
    request.headers.set('X-Requested-With', 'XMLHttpRequest');
next();
});

/**
 * Velocity is an animation engine with the same API as jQuery's $.animate().
 * It works with and without jQuery. It's incredibly fast, and it features
 * color animation, transforms, loops, easings, SVG support, and scrolling.
 * It is the best of jQuery and CSS transitions combined.
 */

window.Velocity = require("velocity-animate");

/**
 * A Vue.js component for sharing links to social networks, work with
 * Vue.js 1.X or 2.X
 */
const SocialSharing = require('vue-social-sharing');
window.Vue.use(SocialSharing);

/**
 * Element, a Vue 2.0 based component library for developers, designers
 * and product managers.
 */
import { TimeSelect, Select, Option, Input, Tooltip } from 'element-ui'
import lang from 'element-ui/lib/locale/lang/ru-RU'
import locale from 'element-ui/lib/locale'

// configure language
locale.use(lang)

// import components
Vue.use(TimeSelect);
Vue.use(Select);
Vue.use(Option);
Vue.use(Input);
Vue.use(Tooltip);



/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

// window.axios = require('axios');
//
// window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'
//
// window.Pusher = require('pusher-js');
//
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
