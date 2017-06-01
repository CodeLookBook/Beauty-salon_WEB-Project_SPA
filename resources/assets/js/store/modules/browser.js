
export default {

    namespaced: true,

    state:{

        clientHeight: null,
        clientWidth: null,

    },

    getters:{

        browserClientHeight(state){

            let s = state;

            return s.clientHeight;

        },
        browserClientWidth(state){

            let s = state;

            return s.clientWidth;

        },

        isBrowserClientWidthLg   (state, getters, rootState){

            let s = state,
                w = s.clientWidth,
                r = rootState,
                b = r.breakpoints;

            return w >= b.lg.minW;

        },
        isBrowserClientWidthMd   (state, getters, rootState){

            let s = state,
                w = s.clientWidth,
                r = rootState,
                b = r.breakpoints;

            return w <= b.md.maxW && w >= b.md.minW;

        },
        isBrowserClientWidthSm   (state, getters, rootState){

            let s = state,
                w = s.clientWidth,
                r = rootState,
                b = r.breakpoints;

            return w <= b.sm.maxW && w >= b.sm.minW;

        },
        isBrowserClientWidthXs  (state, getters, rootState){

            let s = state,
                w = s.clientWidth,
                r = rootState,
                b = r.breakpoints;

            return w <= b.xs.maxW && w >= b.xs.minW;

        },
        isBrowserClientWidthXxs (state, getters, rootState){

            let s = state,
                w = s.clientWidth,
                r = rootState,
                b = r.breakpoints;

            return w <= b.xxs.maxW && w >= b.xxs.minW;

        },
        isBrowserClientWidthXxxs(state, getters, rootState){

            let s = state,
                w = s.clientWidth,
                r = rootState,
                b = r.breakpoints;

            return w <= b.xxxs.maxW && w >= b.xxxs.minW;

        },

    },

    mutations:{

        SaveBrowserClientWidth(state){

            let w  = window,
                d  = w.document,
                de = d.documentElement,
                b  = d.hasOwnProperty('body') ? d.body :
                    d.getElementsByTagName('body')[0],
                s  = state;

            s.clientWidth = de.clientWidth || b.clientWidth;

        },
        SaveBrowserClientHeight(state){

            let w  = window,
                d  = w.document,
                de = d.documentElement,
                b  = d.hasOwnProperty('body') ? d.body :
                    d.getElementsByTagName('body')[0],
                s  = state;


            s.clientHeight = de.clientHeight || b.clientHeight;

        },

    }





}