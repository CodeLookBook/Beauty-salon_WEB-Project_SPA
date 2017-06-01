<template lang="pug">

    layout

        //SIDE-NAVBAR
        side-navbar(slot="sideNavbarSlot")

            side-navbar-links-group-vertical
                side-navbar-close-button
                side-navbar-link-vertical(href="/#ORDER-SLIDE") Заказать услугу
                side-navbar-link-vertical(href="/#ADRESS-SLIDE") Адрес

            side-navbar-buttons-group
                side-navbar-button.SIDE-NAVBAR-DOWNLOAD-PRICE(href="/api/price")
                    span.glyphicon.glyphicon-download-alt(aria-hidden="true")
                        span &nbsp;Загрузить

            side-navbar-links-group-horizontal
                side-navbar-link-horizontal.CENTER-TEXT(href="http://www.vk.com"):    img.SIDE-NAVBAR-SOCIAL-ICON(src="/img/icons/vk.png" alt="vk logo")
                side-navbar-link-horizontal.CENTER-TEXT(href="http://facebook.com"):  img.SIDE-NAVBAR-SOCIAL-ICON(src="/img/icons/fb.png" alt="fb logo")
                side-navbar-link-horizontal.CENTER-TEXT(href="http://instagram.com"): img.SIDE-NAVBAR-SOCIAL-ICON(src="/img/icons/in.png" alt="instagram logo")


        //TOP-NAVBAR
        navbar(slot="navbar")

            buttons-group(slot="brand")
                btn-link(href="/"):    img.NAVBAR-LOGO(src="/img/logos/bs.png", alt="logo")

            buttons-group.FLOAT-RIGHT.NAVBAR-BUTTONS-GROUP-VISIBILTIY
                btn.NAVBAR-DOWNLOAD-PRICE
                    span.glyphicon.glyphicon-download-alt(aria-hidden="true")
                        | &nbsp;Загрузить

            buttons-group.FLOAT-RIGHT.NAVBAR-BUTTONS-GROUP-VISIBILTIY
                btn-link(href="http://www.vk.com"):    img.NAVBAR-SOCIAL-ICON(src="/img/icons/vk.png" alt="vk logo")
                btn-link(href="http://facebook.com"):  img.NAVBAR-SOCIAL-ICON(src="/img/icons/fb.png" alt="fb logo")
                btn-link(href="http://instagram.com"): img.NAVBAR-SOCIAL-ICON(src="/img/icons/in.png" alt="instagram logo")

            buttons-group.FLOAT-RIGHT(slot="switch")
                btn-switch

        <!--component(:is="page")-->

        router-view

</template>
<style lang="scss">

    //IMPORT MIXINS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    @import "../sass/mixins";

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    $lgMin:1200px;      $mdMax:1199px;      $smMax:991px;       $xsMax:767px;
                        $mdMin:992px;       $smMin:768px;

    //STRUCTURE  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    $lgMin:1200px;      $mdMax:1199px;      $smMax:991px;       $xsMax:767px;
                        $mdMin:992px;       $smMin:768px;

    //DECOR: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .NAVBAR-LOGO{
        vertical-align: middle;
        height: 1.8em;
    }

    .SIDE-NAVBAR-SOCIAL-ICON{
        display: inline-block;
        height: 1.5em;
        margin: 1em;
    }

    .CENTER-TEXT{
        text-align: center;
    }

    .NAVBAR-SOCIAL-ICON{
        vertical-align: middle;
        height: 1.5em;
        padding-left: 1em;
        padding-right: 1em;
    }

    .FLOAT-RIGHT{
        float: right;
    }

    .SIDE-NAVBAR-DOWNLOAD-PRICE{
        .SIDE-NAVBAR-BUTTON{ //this class created in "side-navbar-button" component
            width: 100%;
            border: none;
            color: white;
            background-color: #f89898;

            &:hover{
                background-color: #eb8c8c;
            }
            &:active{
                background-color: #eb8c8c;
            }
        }
    }

    .NAVBAR-DOWNLOAD-PRICE{
        .NAVBAR-BUTTON{ //this class created in "button" component
            vertical-align: middle;
            border: none;
            color: white;
            background-color: #f89898;
            margin-left: 2em;

            &:hover{
                background-color: #eb8c8c;
            }
            &:active{
                background-color: #eb8c8c;
            }
        }
    }

    .NAVBAR-BUTTONS-GROUP-VISIBILTIY{
        @include m(maxW, $max: 530px){
            //530px is the moment when NAVBAR SWIRCH buttom becomes visible
            display: none !important;
        }
    }
</style>
<script>

    //*************************************************************************
    // MIXINS IMPORT
    //*************************************************************************

    import ScreenStore from "./mixins/screen-store.vue"
    import BrowserStore from "./mixins/browser-store.vue"

    //*************************************************************************
    // HELPERS IMPORT
    //*************************************************************************

    import router from "./router/router.vue"

    //*************************************************************************
    // CHILD COMPONENTS IMPORT
    //*************************************************************************

    import Layout                 from './layouts/app.vue'
    import Home                   from './pages/home.vue'
    import Navbar                 from "./components/navbar/navbar.vue"
    import ButtonsGroup           from "./components/navbar/buttons-group.vue"
    import Button                 from "./components/navbar/button.vue"
    import ButtonLink             from "./components/navbar/button-link.vue"
    import Switch                 from "./components/navbar/switch.vue"
    import SideNavbar             from  "./components/side-navbar/side-navbar.vue"
    import SideNavbarLinksGroupHorizontal from "./components/side-navbar/side-navbar-links-group-horizontal.vue"
    import SideNavbarLinkHorizontal       from "./components/side-navbar/side-navbar-link-horizontal.vue"
    import SideNavbarLinksGroupVertical   from "./components/side-navbar/side-navbar-links-group-vertical.vue"
    import SideNavbarLinkVertical         from "./components/side-navbar/side-navbar-link-vertical.vue"
    import SideNavbarButtonsGroup from "./components/side-navbar/side-navbar-buttons-group.vue"
    import SideNavbarButton       from "./components/side-navbar/side-navbar-button.vue"
    import SideNavbarCloseButton  from "./components/side-navbar/side-navbar-close-button.vue"

    //*************************************************************************
    // COMPONENT
    //*************************************************************************

    export default {

        //*********************************************************************
        // MIXINS
        //*********************************************************************

        mixins:[
            ScreenStore,
            BrowserStore,
        ],

        //*********************************************************************
        // MOUNT HTML ELEMENT
        //*********************************************************************

        el:'#app',

        //*********************************************************************
        // ROUTER
        //*********************************************************************

        router: router,

        //*********************************************************************
        // PROPERTIES
        //*********************************************************************


        //*********************************************************************
        // DATA FIELDS
        //*********************************************************************

        data(){
            return {
                page: 'Home'
            };
        },

        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************


        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************


        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{

            /**
             *
             * @constructor
             */
            Initialize(){

                let v = this;

                /**
                 * Initiates local store var-s.
                 */
                v.SaveScreenHeight();
                v.SaveScreenWidth();
                v.SaveBrowserClientHeight();
                v.SaveBrowserClientWidth();

            },
            /**
             * Adds event listeners programmatically
             * @constructor
             */
            Subscribe(){

                let v = this,
                    w = window,
                    AddEvent = w.addEventListener;

                AddEvent('resize', v.SaveScreenHeight);
                AddEvent('resize', v.SaveScreenWidth);
                AddEvent('resize', v.SaveBrowserClientHeight);
                AddEvent('resize', v.SaveBrowserClientWidth);

            },
            /**
             * Removes event listeners programmatically
             * @constructor
             */
            Unsubscribe(){

                let v = this,
                    w = window,
                    DelEvent = w.removeEventListener;

                DelEvent('resize', v.SaveScreenHeight);
                DelEvent('resize', v.SaveScreenWidth);
                DelEvent('resize', v.SaveBrowserClientHeight);
                DelEvent('resize', v.SaveBrowserClientWidth);
            },

        },

        //*********************************************************************
        // LIFE HOOKS
        //*********************************************************************

        mounted(){

            let v = this;

            v.Initialize();
            v.Subscribe();

        },

        beforeDestroy(){

            let v = this;
            v.Unsubscribe();

        },


        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************

        components:{
            Layout,
            Home,
            Navbar,
            ButtonsGroup,
            Btn: Button,
            BtnLink: ButtonLink,
            BtnSwitch: Switch,
            SideNavbar,
            SideNavbarLinksGroupHorizontal,
            SideNavbarLinkHorizontal,
            SideNavbarButtonsGroup,
            SideNavbarButton,
            SideNavbarLinksGroupVertical,
            SideNavbarLinkVertical,
            SideNavbarCloseButton,
        }

    };

</script>