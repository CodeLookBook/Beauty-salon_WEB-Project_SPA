<script>

    //*************************************************************************
    // HELPERS
    //*************************************************************************

    import {mapGetters} from "vuex";
    import {mapMutations} from "vuex";

    //*************************************************************************
    // COMPONENT
    //*************************************************************************

    export default {

        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************

        computed:{
            ...mapGetters('browser',[

                'browserClientHeight',
                'browserClientWidth',

                'isBrowserClientWidthLg',
                'isBrowserClientWidthMd',
                'isBrowserClientWidthSm',
                'isBrowserClientWidthXs',
                'isBrowserClientWidthXxs',
                'isBrowserClientWidthXxxs',

            ]),
        },

        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{

            ...mapMutations('browser',[
                'SaveBrowserClientWidth',
                'SaveBrowserClientHeight',
            ]),
        },
    };

</script>