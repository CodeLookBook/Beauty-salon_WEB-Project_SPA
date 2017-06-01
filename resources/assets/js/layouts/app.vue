<template lang="pug">

    .APP
        //Transitions throgh WATCH on NAVBAR-SWITCH-IS-ON and NAVBAR-SWITCH-IS-OFF events.
        .SIDE-NAVBAR-SLOT(  ref="sideNavbarSlot", :class="sideNavbarSlot.classes")
            slot(name="sideNavbarSlot")

        //Transitions throgh WATCH on NAVBAR-SWITCH-IS-ON and NAVBAR-SWITCH-IS-OFF events.
        .MAIN-SLOT(ref="mainSlot", :class="mainSlot.classes")
            .NAVBAR-SLOT(ref="navbarSlot")
                slot(name="navbar")

            .CONTENT-SLOT(ref="contentSlot")
                .SCROLL
                    slot

</template>
<style lang="scss">

    @import "../../sass/mixins";

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    $lgMin:1200px;      $mdMax:1199px;      $smMax:991px;       $xsMax:767px;
                        $mdMin:992px;       $smMin:768px;

    //STRUCTURE  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .APP{
        width: 100%;
        height: 100%;
        overflow: hidden;

        &>.SIDE-NAVBAR-SLOT{
            position: fixed;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 30000;

            @include m(minW, $min: '376px'){
                left: -22em;
                width: 22em;
                transition: left 1s ease;
            }
            @include m(maxW, $max: '375px'){
                left: -100%;
                width: 100%;
                transition: left 1s ease;
            }

            &.SIDE-NAVBAR-IS-OPENED{
                @include m(minW, $min: '376px'){
                    transition: left 1s ease;
                    left: 0;
                    width: 22em;
                }
                @include m(maxW, $max: '375px'){
                    transition: left 1s ease;
                    left: 0;
                    width: 100%;
                }
            }
        }

        &>.MAIN-SLOT{
            position: fixed;
            left: 0;
            width: 100%;
            height: 100%;
            transition: left 1s ease;
            overflow: hidden;


            &.SIDE-NAVBAR-IS-OPENED{
                @include m(minW, $min: '376px'){
                    transition: left 1s ease;
                    left: 22em;
                }
                @include m(maxW, $max: '375px'){
                    transition: left 1s ease;
                    left: 100%;
                }
            }


            &>.NAVBAR-SLOT{
                display: table;
                position: relative;
                width: 100%;
                height: 4em;
            }

            &>.CONTENT-SLOT{
                position: absolute;
                top: 4em;  /***Value DEPENDS! from .APP>.NAVBAR-SLOT CSS height.***/
                width: 100%;
                height: 100%;
                overflow: hidden;

                &>.SCROLL{
                    width: 100%;
                    height: 100%;
                }
            }
        }

    }

    //DECOR  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .APP{
        &>.SIDE-NAVBAR-SLOT{
            border-right: 1px solid #ededed;
        }
        &>.MAIN-SLOT{
            &>.NAVBAR-SLOT{
                position: relative;
            }
            &>.CONTENT-SLOT{
            }
        }
    }

</style>
<script>

    //*************************************************************************
    // MIXINS IMPORT
    //*************************************************************************

    import BrowserStoreMixin from "../mixins/browser-store.vue"
    import ValidatorsMixin  from "../mixins/validators.vue"

    //*************************************************************************
    // HELPERS IMPORT
    //*************************************************************************

    import ObjectTypeError from "../errors/ObjectTypeError";

    //*************************************************************************
    // COMPONENT
    //*************************************************************************

    export default {

        //*********************************************************************
        // MIXINS
        //*********************************************************************

        mixins:[
            BrowserStoreMixin,
            ValidatorsMixin,
        ],

        //*********************************************************************
        // PROPERTIES
        //*********************************************************************


        //*********************************************************************
        // DATA FIELDS
        //*********************************************************************

        data(){
            return {
                sideNavbarSlot:{
                    isOpen: false,
                    classes:{
                        'SIDE-NAVBAR-IS-OPENED': false,
                    }
                },
                mainSlot:{
                    classes:{
                        'SIDE-NAVBAR-IS-OPENED': false,
                    }
                },
                navbarSlot:{
                    height: 0,
                },
                homePage:{
                     scrollTop: 0
                },
            }
        },

        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************



        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************

        watch:{

            browserClientHeight(newV, oldV){

                if(newV === oldV) return;


                let v = this;

                let nsh = v.GetNavbarSlotHeight(),
                    csh = v.GetContentSlotHeight(nsh, newV);

                v.SetContentSlotHeight(csh);
            },
            browserClientWidth(newV, oldV){

                if(newV === oldV) return;

                let v = this;

                let nsh = v.GetNavbarSlotHeight(),
                    bch = v.browserClientHeight,
                    csh = v.GetContentSlotHeight(nsh, bch);

                v.SetContentSlotHeight(csh);

            },
            'sideNavbarSlot.isOpen'(newV, oldV){

                let v = this;

                //Side Navbar transition effects
                if(newV){

                    v.sideNavbarSlot.classes['SIDE-NAVBAR-IS-OPENED'] = true;
                    v.mainSlot.classes['SIDE-NAVBAR-IS-OPENED'] = true;

                } else {

                    v.sideNavbarSlot.classes['SIDE-NAVBAR-IS-OPENED'] = false;
                    v.mainSlot.classes['SIDE-NAVBAR-IS-OPENED'] = false;

                }

            },
        },

        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{

            //MANIPULATIONS WITH APP SIDEBAR ----------------------------------

            CloseAppSideNavbar(){
                let v = this;
                v.sideNavbarSlot.isOpen = false;
            },
            OpenAppSideNavbar(){
                let v = this;
                v.sideNavbarSlot.isOpen = true;
            },

            //MANIPULATIONS WITH APP TOP NAVBAR--------------------------------

            GetNavbarSlotHeight(){
                let v = this,
                    r = v.$refs,
                    e = r.navbarSlot.$el ?
                        r.navbarSlot.$el : r.navbarSlot,
                    bcr = e.getBoundingClientRect();

                return bcr.height;
            },
            GetContentSlotHeight(nNavbarHeight, nBrowserClientHeight){
                return nBrowserClientHeight - nNavbarHeight;
            },
            SetContentSlotHeight(nHeight){

                let v = this,
                    r = v.$refs,
                    cs= r.hasOwnProperty('contentSlot')? r.contentSlot : null,
                    e = cs ? (cs.hasOwnProperty('$el')? cs.$el : cs) : null ,
                    s = e ? e.style: null;

                if(!v.IsObject(s)) throw new ObjectTypeError('Object');

                s.height = nHeight + 'px';

            },

            //SUBSCRIPTIONS ON EVENTS -----------------------------------------

            //On $bus object events
            SubscribeOnEvents(){

                let v = this;
                v.$bus.$on('NAVBAR-SWITCH-IS-ON', v.OpenAppSideNavbar);
                v.$bus.$on('NAVBAR-SWITCH-IS-OFF', v.CloseAppSideNavbar);

            },

        },

        //*********************************************************************
        // LIFE HOOKS
        //*********************************************************************

        mounted(){

            let v = this;
            v.SubscribeOnEvents();

        }

        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************


    };

</script>