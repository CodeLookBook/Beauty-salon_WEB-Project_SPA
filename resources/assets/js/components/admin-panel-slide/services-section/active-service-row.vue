<template lang="pug">

    tr(v-if="!wasDeleted")
        td(style="vertical-align:middle;")
            | {{rowNumber}}
        td
            el-input(v-model="service.name")
        td
            el-tooltip(effect="dark", content="Поместить в архив", placement="top", :open-delay="1000")
                .btn.btn-default(@click="DeleteServiceAndHideRow" style="border: none; height: 100%")
                    span.glyphicon.glyphicon-save(aria-hidden="true")

</template>
<style lang="scss">

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //STRUCTURE  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //DECOR: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


</style>
<script>

    //*************************************************************************
    // HELPERS
    //*************************************************************************

    import {mapActions, mapGetters} from "vuex";

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
            rowNumber:{
                type: Number,
            },
            id:{
                type: Number,
            },
            name:{
                type: String,
            }
        },

        //*********************************************************************
        // DATA FIELDS
        //*********************************************************************

        data(){
            return {
                wasDeleted: false,
                wasDeleteButtonPressed: false,
                service:{
                    id: this.id,
                    name: this.name,
                },
            };
        },

        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************

        computed:{
            ...mapGetters('services', [
                'deleteServiceResponseOk',
                'deleteServiceResponseStatus',
                'deleteServiceResponseData',

                'updateServiceResponseOk',
                'updateServiceResponseStatus',
                'updateServiceResponseData',
            ]),
        },

        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************

        watch:{
            deleteServiceResponseOk     (newV, oldV){
                let v = this;
                if(newV && v.wasDeleteButtonPressed) {
                    v.wasDeleted = true;
                }
            },
            deleteServiceResponseStatus (newV, oldV){
                let v = this;
                if(parseInt(newV) === 401) v.$router.push({name: 'adminSignin'})
            },
            updateServiceResponseStatus (newV, oldV){
                let v = this;
                if(parseInt(newV) === 401) v.$router.push({name:'adminSignin'});
            },
            'service.name'              (newV, oldV){
                if(newV === oldV) return;
                let v = this;
                v.UpdateService(v.service);
            },
        },

        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{
            ...mapActions('services', [
                'DeleteService',
                'UpdateService',
            ]),

            DeleteServiceAndHideRow(){
                let v = this;
                v.DeleteService(v.service.id);
                v.wasDeleteButtonPressed = true;

            },
        }

        //*********************************************************************
        // LIFE HOOKS
        //*********************************************************************


        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************


    };

</script>