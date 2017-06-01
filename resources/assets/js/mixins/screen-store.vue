<script>

    //*************************************************************************
    // HELPERS
    //*************************************************************************

    import {mapMutations} from "vuex";
    import {mapGetters} from "vuex";

    //*************************************************************************
    // COMPONENT
    //*************************************************************************

    export default {

        //*********************************************************************
        // DATA FIELDS
        //*********************************************************************


        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************

        computed: {
            ...mapGetters('screen',[

                'screenWidth',
                'screenHeight',

                'lgScreenMaxWidth',
                'lgScreenMinWidth',
                'mdScreenMaxWidth',
                'mdScreenMinWidth',
                'smScreenMaxWidth',
                'smScreenMinWidth',
                'xsScreenMaxWidth',
                'xsScreenMinWidth',
                'xxsScreenMaxWidth',
                'xxsScreenMinWidth',
                'xxxsScreenMaxWidth',
                'xxxsScreenMinWidth',

                'isScreenWidthLg',
                'isScreenWidthMd',
                'isScreenWidthSm',
                'isScreenWidthXs',
                'isScreenWidthXxs',
                'isScreenWidthXxxs'
            ])
        },

        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************


        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{
            ...mapMutations('screen',[
                'SaveScreenHeight',
                'SaveScreenWidth',
            ]),
        },

        //*********************************************************************
        // LIFE HOOKS
        //*********************************************************************


        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************


    };

</script>