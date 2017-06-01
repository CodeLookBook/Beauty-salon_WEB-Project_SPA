<template lang="pug">

    appear-transition
        section.PAGE
            .SCROLL(ref="scroll",
                    @scroll="SaveScrollData",
                    @mousedown="SaveMouseData",
                    @mouseup="SaveMouseData",
                    @touchstart="SaveTouchData",
                    @touchend="SaveTouchData")
                slot

</template>
<style lang="sass">

    //STRUCTURE  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .PAGE
        width:  100%
        height: 100%

        &>.SCROLL
            width:  100%
            height: 100%

    //DECOR: ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .PAGE
        &>.SCROLL
            overflow-y: auto

</style>
<script>

    //*************************************************************************
    // MIXINS IMPORT
    //*************************************************************************

    import Validators from '../mixins/validators.vue'

    //*************************************************************************
    // HELPERS IMPORT
    //*************************************************************************

    import ObjectTypeError from "../errors/ObjectTypeError";

    // *************************************************************************
    // CHILD COMPONENTS IMPORT
    //*************************************************************************

    import AppearTransition from "../transitions/appear.vue"





    //*************************************************************************
    // COMPONENT
    //*************************************************************************

    export default {

        //*********************************************************************
        // MIXINS
        //*********************************************************************

        mixins:[
            Validators,
        ],

        //*********************************************************************
        // PROPERTIES
        //*********************************************************************


        //*********************************************************************
        // DATA FIELDS
        //*********************************************************************

        data(){
            return {

                scrollTop:      0,
                isScrollingTop: false,
                scrollInterval: null,
                scrollingUp:    false,
                scrollingDown:  false,

                isMouseDown:    false,
                isTouch:        false,  //Is User touching screen
            }
        },

        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************


        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************

        watch:{

            scrollTop(newV, oldV){

                let v = this;

                if(newV > oldV){
                    v.scrollingDown = true;
                    v.scrollingUp = false;
                }
                if(newV < oldV){
                    v.scrollingUp = true;
                    v.scrollingDown = false;
                }

            },

            isScrollingTop(newV, oldV){

                let v = this;
                v.CreateScrollEvent();

            },

        },

        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{

            SaveMouseData(){
                let v = this;
                v.isMouseDown = !v.isMouseDown;
            },
            SaveTouchData(){
                let v = this;
                v.isTouch = !v.isTouch;
            },
            SaveScrollData(){

                let v = this,
                    r = v.$refs,
                    el = r.scroll;   //div with Scroll (ref=scroll),
                                    // look template

                v.isScrollingTop = true;
                v.scrollTop = Math.round(el.scrollTop);

                if (v.scrollInterval) return;

                v.scrollInterval = setInterval(() => {

                    if (v.scrollTop !== Math.round(el.scrollTop)) return;
                    if (!v.scrollInterval) return; //if Interval exists, exit
//                    if (v.isMouseDown || v.isTouch) return; //if Mouse pressed, exit //TODO: decide, do I need this?

                    v.isScrollingTop = false;
                    clearInterval(v.scrollInterval);
                    v.scrollInterval = null;

                }, 250);

            },
            CreateScrollEvent(){

                let v = this,
                    e = {
                        scrollTop: v.scrollTop,
                        isScrollingTop: v.isScrollingTop,
                        scrollingUp: v.scrollingUp,
                        scrollingDown: v.scrollingDown,
                        isMouseDown: v.isMouseDown,
                        isTouch:v.isTouch,
                }

                v.$bus.$emit('PAGE-SCROLL', e);

            },

        },

        //*********************************************************************
        // LIFE HOOKS
        //*********************************************************************


        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************

        components:{
            AppearTransition,
        }

    };

</script>