<template lang="pug">

    //abbreviation 'AP' - is Admin Pannel

    .col-xs-12.AP-BUTTON(@click="PressButton", :class="classes")
        slot

</template>
<style lang="scss">

    @import "../../../sass/mixins";

    //DECOR: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .AP-BUTTON{
        padding-top: 1em;
        padding-bottom: 1em;
        border-bottom: 1px solid #e2e2e2;
        @include t(backgroun-color, 1s);

        &:hover{
            @include t(backgroun-color, 0.5s);
            background-color: #fafafa;
            cursor: pointer;
        }
        &:active{
            background-color: #f5f5f5;
        }

        &.PRESSED{
            background-color: #d1e7fa;
        }
    }

</style>
<script>

    //*************************************************************************
    // CHILD COMPONENTS IMPORT
    //*************************************************************************


    //*************************************************************************
    // COMPONENT
    //*************************************************************************

    export default {

        //*********************************************************************
        // PROPERTIES
        //*********************************************************************

        props:{

            action:{
                type: Number,
            },

            pressed:{
                type: Boolean,
                default: false,
            },

            name:{
                type: String,
            },
        },

        //*********************************************************************
        // DATA FIELDS
        //*********************************************************************

        data(){
            return {
                isPressed: this.pressed,
                classes:{
                    PRESSED: this.pressed,
                }
            }
        },

        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************


        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************

        watch:{
            isPressed(newV, oldV){

                if(newV === oldV) return;

                let v = this;

                if(newV){
                    v.CreateEvent();
                    v.AddClasses();
                } else {
                    v.RemoveClasses();
                }

            },
        },

        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{

            PressButton(){
                let v = this;
                v.isPressed = true;
            },
            OutpressButton(e){
                let v = this;

                if(e.target === v) return;

                v.isPressed = false;
            },
            AddClasses(){
                let v = this,
                    c = v.classes;
                c.PRESSED = true;
            },
            RemoveClasses(){
                let v = this,
                    c = v.classes;
                c.PRESSED = false;
            },
            CreateEvent(){
                let v = this,
                    e = {
                        target: this,
                        name: v.name,
                        action: v.action,
                    }
                v.$bus.$emit('AP-BUTTON-IS-PRESSED', e);
            },

            Subscribe(){
                let v = this;
                v.$bus.$on('AP-BUTTON-IS-PRESSED', v.OutpressButton);
            },
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


    };

</script>