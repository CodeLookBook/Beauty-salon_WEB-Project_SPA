<template lang="pug">

    layout
        slide.GREET
            .GREET-FON-IMG
                greet-card

        slide#ORDER-SLIDE.ORDER(ref="oderSlid")
            order-form(ref="orderForm")

        slide#ADRESS-SLIDE.CONTACTS
            #mapkit-1595

</template>
<style lang="scss">

    @import "../../sass/mixins";

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    $lgMin:1200px;      $mdMax:1199px;      $smMax:991px;       $xsMax:767px;
                        $mdMin:992px;       $smMin:768px;

    //DECOR: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .GREET{
        .GREET-FON-IMG{
            width: 100%;
            height: 100%;
            background-image: url("/img/GREET-SLIDE-FON2.jpg");
            background-size: cover;
            background-position: center center;
        }
    }

    .ORDER{
        background-color: #F5F8FA;
        &>DIV{
            &>DIV{
                vertical-align: middle;
            }
        }
    }

</style>
<script>

    //*************************************************************************
    // CHILD COMPONENTS IMPORT
    //*************************************************************************

    import UpTransition from "../transitions/up.vue"
    import GreetCard from "../components/greet-slide/greet-card.vue"
    import OrderForm from "../components/order-slide/order-form.vue"

    //*************************************************************************
    // COMPONENT
    //*************************************************************************

    export default {

        //*********************************************************************
        // COMPONENT NAME
        //*********************************************************************

        customerName: 'HOME-PAGE',

        //*********************************************************************
        // PROPERTIES
        //*********************************************************************


        //*********************************************************************
        // DATA FIELDS
        //*********************************************************************


        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************


        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************


        //*********************************************************************
        // METHODS
        //*********************************************************************


        //*********************************************************************
        // LIFE HOOKS
        //*********************************************************************


        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************

        components:{

            Layout: require('../layouts/home.vue'),
            Slide:  require('../components/slide.vue'),
            Sketch: require('../components/sketch.vue'),
            UpTransition,
            GreetCard,
            OrderForm,
        },

    };

</script>