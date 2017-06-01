<template lang="pug">

    tr.ARCHIVE-SERVICE(v-if="!wasDeleted && !wasRestored")
        td(style="vertical-align:middle;")
            | {{rowNumber}}
        td
            el-input(v-model="trashedService.name")
        td
            el-tooltip(effect="dark", content="Разархивировать/восстановить", placement="top", :open-delay="1000")
                .btn.btn-default(@click="RestoreTrashedServiceAndHideRow",  style="border: none; height: 100%")
                    span.glyphicon.glyphicon-open(aria-hidden="true")
        td
            el-tooltip(effect="dark", content="Удалить", placement="top", :open-delay="1000")
                .btn.btn-default(@click="DeleteTrashedServiceAndHideRow",  style="border: none; height: 100%")
                    span.glyphicon.glyphicon-trash(aria-hidden="true")

</template>
<style lang="scss">

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //STRUCTURE  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //DECOR: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


</style>
<script>

    //*************************************************************************
    // HELPERS IMPORT
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
                wasRestored: false,
                wasRestoreButtonPressed: false,
                trashedService:{
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
                'deleteTrashedServiceResponseOk',
                'deleteTrashedServiceResponseStatus',
                'deleteTrashedServiceResponseData',

                'restoreTrashedServiceResponseOk',
                'restoreTrashedServiceResponseStatus',
                'restoreTrashedServiceResponsedata',
            ])
        },

        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************

        watch:{
            deleteTrashedServiceResponseOk(newV, oldV){
                let v = this;
                if(newV && v.wasDeleteButtonPressed){
                    v.wasDeleted = true;
                }
            },
            restoreTrashedServiceResponseOk(newV, oldV){
                let v = this;
                if(newV && v.wasRestoreButtonPressed){
                    v.wasRestored = true;
                }
            },
            deleteTrashedServiceResponseStatus(newV, oldV){
                let v = this;
                if(parseInt(newV) === 401) v.$router.push({name: 'adminSignin'});
            },
            restoreTrashedServiceResponseStatus(newV, oldV){

                let v = this;
                if(parseInt(newV) === 401) v.$router.push({name: 'adminSignin'});

            },
        },

        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{

            ...mapActions('services',[
                'DeleteTrashedService',
                'RestoreTrashedService',
            ]),

            RestoreTrashedServiceAndHideRow(){
                let v = this;
                v.RestoreTrashedService(v.trashedService.id);
                v.wasRestoreButtonPressed = true;
            },
            DeleteTrashedServiceAndHideRow(){
                let v = this;
                v.DeleteTrashedService(v.trashedService.id);
                v.wasDeleteButtonPressed = true;
            },
        },

        //*********************************************************************
        // LIFE HOOKS
        //*********************************************************************



        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************


    };

</script>