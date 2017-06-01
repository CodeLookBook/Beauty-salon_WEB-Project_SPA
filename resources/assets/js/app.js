/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

// window.Vue = require('vue'); //TODO: Delete?


/**
 * Event bus instantiation
 */

const EventBus = new Vue();

/**
 *  Makes "Event bus" available everywhere in your app, through attaching
 *  it to the Vue global object.
 */

Object.defineProperties(Vue.prototype, {
    $bus: {
        get: function () {
            return EventBus;
        }
    }
});

/**
 * Vuex is a state management pattern + library for Vue.js applications. It
 * serves as a centralized store for all the components in an application,
 * with rules ensuring that the state can only be mutated in a predictable
 * fashion. It also integrates with Vue's official devtools extension to
 * provide advanced features such as zero-config time-travel debugging and
 * state snapshot export / import.
 */

import Vuex     from 'vuex'

/**
 * Errors objects
 */

window.SrcError                 = require('./errors/SrcError');
window.NullReferenseError       = require('./errors/NullReferenceError');
window.UndefindReferenceError   = require('./errors/UndefindReferenceError');
// window.ObjectTypeError          = require('./errors/ObjectTypeError');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import app      from './app.vue'
import store    from "./store/store"

Vue.use(Vuex);
app.store = new Vuex.Store(store);
new Vue(app);

