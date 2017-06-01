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
                                                    th.FIT-TO-CONTENT

                                            tbody
                                                archive-service-row(
                                                    v-for="(trashedService, index) in trashedServicesList",
                                                    :key = "trashedService.id",
                                                    :rowNumber="index + 1",
                                                    :id   = "trashedService.id",
                                                    :name = "trashedService.name",)


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

    import ArchiveServiceRow from './archive-service-row.vue'

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
        },

        //*********************************************************************
        // DATA FIELDS
        //*********************************************************************

        data(){
            return {
                trashedServicesList : [],
            };
        },

        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************

        computed:{
            ...mapGetters('services',[
                'trashedServices',
                'loadTrashedServicesResponseOk',
                'loadTrashedServicesResponseStatus',
                'loadTrashedServicesResponseData',
            ]),
        },

        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************

        watch:{
            trashedServices(){
                let v = this;
                v.trashedServicesList = v.trashedServices;
            },
            loadTrashedServicesResponseStatus(newV, oldV){

                let v = this;
                if(parseInt(newV) === 401) v.$router.push({name:'adminSignin'})

            }
        },

        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{
            ...mapActions('services',[
                'LoadTrashedServices',
            ]),
        },

        //*********************************************************************
        // LIFE HOOKS
        //*********************************************************************

        mounted(){
            let v = this;
            v.LoadTrashedServices();
        },

        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************

        components:{
            ArchiveServiceRow,
        }

    };

</script>