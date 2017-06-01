export default {

    namespaced: true,

    //*************************************************************************
    // SCREEN STATE
    //*************************************************************************

    state:{
        width: null,
        height: null,
    },

    //*************************************************************************
    // SCREEN GETTERS
    //*************************************************************************

    getters:{

        /**
         * Screen sizes
         */

        screenWidth (state){

            let s = state;

            return s.width;

        },

        screenHeight(state){

            let s = state;

            return s.height
        },

        /**
         * Screen breakpoints diapasons MIN, MAX values
         */

        lgScreenMaxWidth  (state, getters, rootState){

            let r = rootState,
                b = r.breakpoints,
                lg= b.lg;

            return lg.maxW;

        },
        lgScreenMinWidth  (state, getters, rootState){

            let r = rootState,
                b = r.breakpoints,
                lg= b.lg;

            return lg.minW;

        },
        mdScreenMaxWidth  (state, getters, rootState){
            let r = rootState,
                b = r.breakpoints,
                md= b.md;
            return md.maxW;
        },
        mdScreenMinWidth  (state, getters, rootState){

            let r = rootState,
                b = r.breakpoints,
                md= b.md;

            return md.minW;

        },
        smScreenMaxWidth  (state, getters, rootState){

            let r = rootState,
                b = r.breakpoints,
                sm= b.sm;

            return sm.maxW;

        },
        smScreenMinWidth  (state, getters, rootState){

            let r = rootState,
                b = r.breakpoints,
                sm= b.sm;

            return sm.minW;

        },
        xsScreenMaxWidth  (state, getters, rootState){

            let r = rootState,
                b = r.breakpoints,
                xs= b.xs;

            return xs.maxW;

        },
        xsScreenMinWidth  (state, getters, rootState){

            let r = rootState,
                b = r.breakpoints,
                xs= b.xs;

            return xs.minW;

        },
        xxsScreenMaxWidth (state, getters, rootState){

            let r = rootState,
                b = r.breakpoints,
                xxs= b.xxs;

            return xxs.maxW;

        },
        xxsScreenMinWidth (state, getters, rootState){

            let r = rootState,
                b = r.breakpoints,
                xxs= b.xxs;

            return xxs.minW;

        },
        xxxsScreenMaxWidth(state, getters, rootState){

            let r = rootState,
                b = r.breakpoints,
                xxxs= b.xxxs;

            return xxxs.maxW;

        },
        xxxsScreenMinWidth(state, getters, rootState){

            let r = rootState,
                b = r.breakpoints,
                xxxs= b.xxxs;

            return xxxs.minW;

        },

        /**
         * Check screen conformity to one of the custom screen types:
         * lgImgSrc, mdImgSrc, smImgSrc, xsImgSrc, xxsImgSrc, xxxsImgSrc
         */

        isScreenWidthLg   (state, getters, rootState){

            let s = state,
                w = s.width,
                r = rootState,
                b = r.breakpoints;

                return w >= b.lg.minW;

        },
        isScreenWidthMd   (state, getters, rootState){

            let s = state,
                w = s.width,
                r = rootState,
                b = r.breakpoints;

            return w <= b.md.maxW && w >= b.md.minW;

        },
        isScreenWidthSm   (state, getters, rootState){

            let s = state,
                w = s.width,
                r = rootState,
                b = r.breakpoints;

            return w <= b.sm.maxW && w >= b.sm.minW;

        },
        isScreenWidthXs  (state, getters, rootState){

            let s = state,
                w = s.width,
                r = rootState,
                b = r.breakpoints;

            return w <= b.xs.maxW && w >= b.xs.minW;

        },
        isScreenWidthXxs (state, getters, rootState){

            let s = state,
                w = s.width,
                r = rootState,
                b = r.breakpoints;

            return w <= b.xxs.maxW && w >= b.xxs.minW;

        },
        isScreenWidthXxxs(state, getters, rootState){

            let s = state,
                w = s.width,
                r = rootState,
                b = r.breakpoints;

            return w <= b.xxxs.maxW && w >= b.xxxs.minW;

        },

    },

    mutations:{

        SaveScreenHeight(state){

            let s = state,
                oldH = s.height,
                w = window,
                newH = w.screen.height;

            if(oldH === newH) return;

            s.height = newH;

        },
        SaveScreenWidth(state){

            let s = state,
                oldW = s.width,
                w = window,
                newW = w.screen.width;

            if(oldW === newW) return;

            s.width = newW;

        },

    },
}