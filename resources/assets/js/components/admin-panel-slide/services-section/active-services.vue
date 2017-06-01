<template lang="pug">

    .col-xs-12.AP-SERVICES-REPORTS
        .row.AP-DATA-SLOT
            .col-xs-12
                .row
                    .col-xs-12
                        h3(style="margin-top: 1em;") {{reportName}}:
                .row
                    .col-xs-12
                        table(style="table-layout: fixed; width: 100%;")
                            tr
                                td
                                    div(style="width: 100%; overflow-x: auto;")
                                        table.table.table-hover
                                            thead
                                                tr
                                                    th.FIT-TO-CONTENT #
                                                    th Название
                                                    th.FIT-TO-CONTENT

                                            tbody
                                                active-service-row(
                                                    v-for="(service, index) in activeServicesList",
                                                    :key="service.id",
                                                    :rowNumber="index + 1",
                                                    :id="service.id",
                                                    :name="service.name")


</template>
<style lang="scss">

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //STRUCTURE  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //DECOR: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .FIT-TO-CONTENT{
        white-space: nowrap;
        width: 1em;
    }

</style>
<script>

    //*************************************************************************
    // HELPERS
    //*************************************************************************

    import {mapActions, mapGetters} from "vuex";

    //*************************************************************************
    // CHILD COMPONENTS IMPORT
    //*************************************************************************

    import ActiveServiceRow from "./active-service-row.vue"

    //*************************************************************************
    // COMPONENT
    //*************************************************************************

    export default {

        //*********************************************************************
        // PROPERTIES
        //*********************************************************************

        props:{
            reportName:{
                type: String,
            },
            actionCode:{
                type: Number,
            }
        },

        //*********************************************************************
        // DATA FIELDS
        //*********************************************************************

        data(){
            return {
                activeServicesList:   [],
            }
        },

        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************

        computed:{
            ...mapGetters('services',[
                'services',
                'loadServicesResponseOk',
                'loadServicesResponseStatus',
            ])
        },

        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************

        watch:{
            services(){
                let v = this;
                v.activeServicesList = v.services;
            },
            'loadServicesResponseStatus'(newV, oldV){
                let v = this;
                if(parseInt(newV) === 401) v.$router.push({name: 'adminSignin'})
            },
        },

        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{
            ...mapActions('services', [
                'LoadServices',
            ]),
        },

        //*********************************************************************
        // LIFE HOOKS
        //*********************************************************************

        mounted(){
            let v = this;
            v.LoadServices();
        },

        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************

        components:{
            ActiveServiceRow,
        }

    };

</script>