<template lang="pug">

    c.NAVBAR-SWITCH
        t.TOGGLE(@click.native="Toggle")
            r
                c
                    .LINE
                    .LINE
                    .LINE

</template>
<style lang="scss">

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


    //STRUCTURE  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .NAVBAR-SWITCH {
        .TOGGLE{
            width:  3em !important;
            height: 3em !important;
        }
    }

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


    //DECOR: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .NAVBAR-SWITCH{
        vertical-align: middle;

        .TOGGLE {
            width:  3em !important;
            height: 3em !important;
            vertical-align: middle;
            background-color: rgba(0, 0, 0, 0);
            border: 1px solid #f89898;
            border-radius: 4px 4px 4px 4px;

            &:hover{
                border-color: #eb8c8c;
            }
            &:hover .LINE{
                background-color: #eb8c8c;
            }
            &:active{
                border-color: #eb8c8c;
            }
            &:active .LINE{
                background-color: #eb8c8c;
            }

            .R{
                .C{
                    vertical-align: middle;
                    cursor: pointer;

                    .LINE{
                        display: block;
                        width: 50%;
                        margin: 3px auto 3px auto;
                        height: 3px;
                        background-color: #f89898;
                    }
                }
            }
        }
    }

</style>
<script>

    //*************************************************************************
    // CHILD COMPONENTS IMPORT
    //*************************************************************************

    import Table from '../table.vue'
    import Row from '../row.vue'
    import Cell from '../cell.vue'

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

        data(){
            return{
                pressed: false,
            }
        },

        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************


        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************

        watch:{
            pressed(newV, oldV){

                let v = this;

                if(newV){
                    v.CreateEvent('NAVBAR-SWITCH-IS-ON');
                } else {
                    v.CreateEvent('NAVBAR-SWITCH-IS-OFF');
                }

            },
        },

        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{

            Toggle(){

                let v = this;
                v.pressed = !v.pressed;

            },

            CreateEvent(sName){

                let v = this;
                v.$bus.$emit(sName);

            },

            Subscribe(){

                let v = this;
                v.$bus.$on('CLOSE-SIDE-NAVBAR', v.Toggle);

            }

        },

        //*********************************************************************
        // LIFE HOOKS
        //*********************************************************************

        mounted(){

            let v = this;

            v.Subscribe();

        },

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