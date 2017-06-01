<template lang="pug">

    appear-transition
        t.NAVBAR
            r
                c
                    t.PADDING-SLOT
                        r
                            c.BRAND-SLOT:   slot(name="brand")
                            c.BUTTONS-SLOT: slot
                            c.SWITCH-SLOT:  slot(name="switch")

</template>
<style lang="scss">


    //IMPORT MIXINS  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    @import "../../../sass/mixins";

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    $lgMin:1200px;      $mdMax:1199px;      $smMax:991px;       $xsMax:767px;
                        $mdMin:992px;       $smMin:768px;

    //STRUCTURE  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .NAVBAR{
        width: 100%;
        height: 100%;

        .PADDING-SLOT{
            width: 80%;
            height: 100%;
            @include m(maxW, $max: $xsMax){
                width: 90%;
            }

            .BRAND-SLOT{
                width: 1%; // because of white-space: nowrap
            }

            .SWITCH-SLOT{
                width: 1%; // because of white-space: nowrap
                @include m(minW, $min: '531px') {
                    display: none;
                }
                @include m(maxW, $max: '530px') {
                    display: table-cell;
                }
            }
        }
    }

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //DECOR: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .NAVBAR{
        background-color: #F5F8FA;
        border-bottom: 1px solid #ededed;
        z-index: 20000;

        .PADDING-SLOT {
            margin: auto auto;

            .BRAND-SLOT {
                white-space: nowrap;
                vertical-align: middle;
            }

            .SWITCH-SLOT {
                @include m(maxW, $max: '530px') {
                    white-space: nowrap;
                    vertical-align: middle;
                }
            }
        }
    }

</style>
<script>

    //*************************************************************************
    // CHILD COMPONENTS IMPORT
    //*************************************************************************

    import AppearTransition from "../../transitions/appear.vue"
    import Table from "../table.vue"
    import Row from "../row.vue"
    import Cell from "../cell.vue"

    //*************************************************************************
    // COMPONENT
    //*************************************************************************

    export default {

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
            AppearTransition,
            T:Table,
            R:Row,
            C:Cell,

        }

    };

</script>