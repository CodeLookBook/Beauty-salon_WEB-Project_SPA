<template lang="pug">

    img (:src="image.src" :alt="alt")

</template>
<style lang="scss">
</style>
<script>

    //*************************************************************************
    // HELPERS IMPORT
    //*************************************************************************
    
    import {mapGetters} from "vuex"

    //*************************************************************************
    // MIXINS IMPORT
    //*************************************************************************
    
    import ScreenStore from '../mixins/screen-store.vue'
    import BrowserStore from '../mixins/browser-store.vue'
    import Validators from '../mixins/browser-store.vue'
    import ObjectTypeError from "./ObjectTypeError";
    import NullReferenceError from "./NullReferenceError";
    import SrcError from "./SrcError";

    //*************************************************************************
    // IMG COMPONENT (SMART)
    //*************************************************************************

    export default {
        
        //*********************************************************************
        // MIXINS
        //*********************************************************************        
        
        mixins:[
            ScreenStore,
            BrowserStore,
            Validators,
        ],

        //*********************************************************************
        // NAME
        //*********************************************************************

        customerName: 'image',

        //*********************************************************************
        // PROPERTIES
        //*********************************************************************

        props:{

            //Defines, the way how images should be fitted. Could have two
            // values: 1. screen; 2. container
            fitTo:{
                type: String,
                default: 'container',
            },

            // References to images with different sizes for different screens
            // Screen width: > 1199px
            lgSrc:{
                type: String,
                required: true,
            },

            // Screen width: 992px - 1199px
            mdSrc:{
                type: String,
                required: true,
            },

            // Screen width: 768px - 991up
            smSrc:{
                type: String,
                required: true,
            },

            // Screen width: 480px - 767px
            xsSrc:{
                type: String,
                required: true,
            },

            // Screen width: 320px - 479px
            xxsSrc:{
                type: String,
                required: true,
            },

            // Screen width: 320px - lower
            xxxsSrc:{
                type: String,
                required: true,
            },

        },

        //*********************************************************************
        // FIELDS
        //*********************************************************************

        data(){
            return {

                image:{
                    src: '',
                },

                //Parent HTML element
                parent:{
                    width: null,
                },
            }
        },



        //********************************************************************
        // COMPUTED PROPERTIES
        //********************************************************************
        

        //********************************************************************
        // METHODS
        //********************************************************************

        watch:{
            'parent.width': {
                handler: function (newV, oldV) {

                    let v = this;

                    if(!v.IsNull(oldV)){
                        if (newV > oldV) {
                            if (v.FitsToContainer()) {

                                let oldSrc = v.image.src,
                                    newSrc = v.GetSrcFittedToContainer();

                                //Check if img src was changed according to new
                                //parent size. If not exit function.
                                if (oldSrc === newSrc) return;

                                v.image.src = newSrc;

                            }
                        }
                    } else if (!oldV) {
                        v.image.src = v.GetSrcFittedToContainer();
                    }
                },
                immediate: true,
            },
            'browserClientWidth':{
                handler: function (newV, oldV) {

                    let v = this;

                    //If img src loads at first
                    //just use: GetSrcFittedToContainer(); if No
                    //get into if()
                    if(!v.IsUndefined(oldV)){
                        if (newV > oldV) {
                            if (v.FitsToScreen()) {

                                let oldSrc = v.image.src,
                                    newSrc = v.GetSrcFittedToScreen();

                                //Check if img src was changed according to new
                                //screen size. If not exit function.
                                if (oldSrc === newSrc) return;

                                v.image.src = newSrc;

                            }
                        }
                    } else if (!oldV) {
                        v.image.src = v.GetSrcFittedToContainer();
                    }
                },
                immediate: true,
            },
        },


        //********************************************************************
        // METHODS
        //********************************************************************

        methods:{

            /**
             * Validated image src
             * @return {boolean}
             */
            IsSrcValid(sSrc){
                let v = this;
                return v.IsString(sSrc) && !v.IsEmptyString(sSrc);
            },
            /**
             * Checks if image size fits to parent container width.
             * @return {boolean}
             */
            FitsToContainer(){
                let v = this;
                return v.fitTo === "container";
            },
            /**
             * Checks if image size fits to screen width.
             * @return {boolean}
             */
            FitsToScreen(){
                let v = this;
                return v.fitTo === "screen";
            },


            /**
             * Gets width of the image component container.
             * @return {number}
             * @constructor
             */
            GetParentWidth(){

                let v = this,
                    p = v.$parent,
                    e = p.$el ? p.$el : p, //parent component or HTML element
                    t = typeof e;

                if(!v.IsObject(e)) throw new ObjectTypeError('Object');

                let s = getComputedStyle(e);   //parent computed style

                if(!v.IsNull(s)) throw new NullReferenceError('Object');
                if(!v.IsNull(s)) throw new UndefindReferenceError('Object');

                let w = parseInt(s.width); //parent width

                if(!v.IsNumber(w)) throw new ObjectTypeError('Number');

                return w;

            },
            SaveParentWidth(){
                let v = this;
                v.parent.width = v.GetParentWidth();
            },


            /**
             * Return image src attribute value.
             * @return {undefined || string}
             */
            GetSrcFittedToScreen   (){

                let v       = this,
                    src     = undefined;

                if (v.isScreenWidthLg)  src = v.lgSrc;  else
                if (v.isScreenWidthMd)  src = v.mdSrc;  else
                if (v.isScreenWidthSm)  src = v.smSrc;  else
                if (v.isScreenWidthXs)  src = v.xsSrc;  else
                if (v.isScreenWidthXxs) src = v.xxsSrc; else
                if (v.isScreenWidthXxs())src = v.xxxsSrc;

                if(!v.IsSrcValid(src)) throw new SrcError();

                return src;

            },
            /**
             * Return image src attribute value.
             * @return {string}
             */
            GetSrcFittedToContainer(){

                let v   = this,
                    pw  = v.parent.width,//parent width
                    src = '';            //url to image

                if(!!pw){
                    if(pw >= v.lgScreenMinWidth   && pw <= v.lgScreenMaxWidth  ) src = v.lgSrc  ; else
                    if(pw >= v.mdScreenMinWidth   && pw <= v.mdScreenMaxWidth  ) src = v.mdSrc  ; else
                    if(pw >= v.smScreenMinWidth   && pw <= v.smScreenMaxWidth  ) src = v.smSrc  ; else
                    if(pw >= v.xsScreenMinWidth   && pw <= v.xsScreenMaxWidth  ) src = v.xsSrc  ; else
                    if(pw >= v.xxsScreenMinWidth  && pw <= v.xxsScreenMaxWidth ) src = v.xxsSrc ; else
                    if(pw >= v.xxxsScreenMinWidth && pw <= v.xxxsScreenMaxWidth) src = v.xxxsSrc;
                }

                if(!v.IsSrcValid(src)) throw new SrcError();

                return src;

            },
            /**
             * Returns corresponding src attribute value that should be
             * loaded to the app.
             * @return {string}
             */
            Src(){

                let v = this,
                    src = '';

                if (v.FitsToScreen()   ) src = v.GetSrcFittedToScreen   (); else
                if (v.FitsToContainer()) src = v.GetSrcFittedToContainer();

                return src;
            },

            /**
             * Component data properties initialization that must be done
             * at 'mounted' hook.
             * @constructor
             */
            InitializeComponentDataProperties(){
                let v = this;
                v.SaveParentWidth();
            },

            /**
             * Subscription on events, that must be done at 'mounted'
             * hook.
             * @constructor
             */
            SubscribeOnEvents(){
                let v = this,
                    w = window;
                w.addEventListener('resize', v.SaveParentWidth());
            }

        },



        //********************************************************************
        // LIFECYCLE HOOKS
        //********************************************************************

        mounted(){
            let v = this;
            v.InitializeComponentDataProperties();
            v.SubscribeOnEvents();
        },

    };

</script>