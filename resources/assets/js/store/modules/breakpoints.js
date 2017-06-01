export default {

    namespaced: true,

    state:{
        lg: {
            maxW: Infinity, minW: 1200,
        },
        md: {
            maxW: 1199,     minW: 992,
        },
        sm: {
            maxW: 991,      minW: 768,
        },
        xs: {
            maxW: 767,      minW: 480,
        },
        xxs: {
            maxW: 479,      minW: 320,
        },
        xxxs: {
            maxW: 319,      minW: -Infinity,
        },
    },
}
