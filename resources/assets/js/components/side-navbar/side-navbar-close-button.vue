<template lang="pug">

    r
        c.SIDE-NAVBAR-CLOSE-BUTTON
            t
                r
                    c.EMPTY-CELL
                    c.TEXT: span: slot

                    //Send event CLOSE-SIDE-NAVBAR to switch component
                    c.ICON(@click.native="CloseSideNavbar"): span.glyphicon.glyphicon-remove-circle(aria-hidden="true")

</template>
<style lang="scss">

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //STRUCTURE  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .SIDE-NAVBAR-CLOSE-BUTTON {
        height: 4em;

        &>.T {
            width: 100%;
            height: 100%;

            .EMPTY-CELL{
            }
            .TEXT{
                width: 1px;
            }
            .ICON{
                width: 4em;
            }
        }
    }

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //DECOR: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .SIDE-NAVBAR-CLOSE-BUTTON{
        background-color: #EDEDED;

        &>.T{
            .TEXT{
                white-space: nowrap;
                vertical-align: middle;
                padding: 0 1em 0 1em;
                text-decoration: underline;
            }
            .ICON{
                vertical-align: middle;
                text-align: center;
                cursor: pointer;

                span{
                    position: static;
                    display: block;
                    margin: auto auto;
                    font-size: 2em;

                    &:hover{
                        -webkit-transition: font-size 0.3s ease;
                        -moz-transition: font-size 0.3s ease;
                        -o-transition: font-size 0.3s ease;
                        transition: font-size 0.3s ease;
                        font-size: 2.2em;
                    }
                    &:active{
                        -webkit-transition: font-size 0.01s ease;
                        -moz-transition: font-size 0.01s ease;
                        -o-transition: font-size 0.01s ease;
                        transition: font-size 0.01s ease;
                        font-size: 2em;
                    }
                }
            }
        }
    }

</style>
<script>

    //*************************************************************************
    // MIXINS IMPORT
    //*************************************************************************

    import CloseSideNavbar from "../../mixins/close-side-navbar.vue"

    //*************************************************************************
    // CHILD COMPONENTS IMPORT
    //*************************************************************************

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

        mixins:[CloseSideNavbar],

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
            T: Table,
            R: Row,
            C: Cell,
        }

    };

</script>