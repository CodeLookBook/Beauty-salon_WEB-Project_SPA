<template lang="pug">

    //abbreviation 'AP' - is Admin Pannel

    layout(v-if="isUserTokenValid")
        buttons-groups(slot="buttons-groups")

            buttons-group.AP-ORDERS-BUTTONS-GROUP(:is-shown="true")
                group-name(slot="name") Записи
                p-button(:action="0")   Создать
                p-button(:action="1", :pressed="true") Несогласованные
                p-button(:action="2")   Согласованные
                p-button(:action="3")   Выполненные

            buttons-group.AP-SERVICES-BUTTONS-GROUP
                group-name(slot="name")  Услуги
                p-button(:action="4")    Создать
                p-button(:action="5")    Действующие
                p-button(:action="6")    Архив

            buttons-group.AP-PRICE-BUTTONS-GROUP
                group-name(slot="name")  Прайс
                p-button(:action="7")    Создать

            buttons-group.AP-PAGE-BUTTONS-GROUP(:is-shown="true")
                p-button(@click.native="ExitAdminPanel") Выйти

        ap-data(slot="data")
            component(:is="section.type", :reportName="reportName", :actionCode="actionCode")

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

    import Layout from "./admin-panel-layout.vue"
    import ButtonsGroups from "./layout-sections/buttons-groups"
    import ButtonsGroup from "./buttons-group.vue"
    import Button from "./button.vue"
    import ButtonsGroupName from "./buttons-group-name.vue"
    import Data from "./layout-sections/data.vue"
    import OrdersReports from "./report-sections/orders-reports.vue"
    import CreateOrder from "./create-order-section/create-order.vue"
    import ActiveServices from "./services-section/active-services.vue"
    import CreateService from "./create-service-section/create-service.vue"
    import ArchiveServices from "./services-section/archive-services.vue"
    import PriseLoad from "./price-load-section/price-load-section.vue"

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
                isUserTokenValid: false,
                actionCode: 1, // 1 is number of default action

                section:{
                    type: 'OrdersReports'
                },
            }
        },

        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************

        computed:{
            reportName(){

                let name;

                switch (this.actionCode){
                    case 1:
                        name = 'НЕСОГЛАСОВАННЫЕ ЗАПИСИ';
                        break;
                    case 2:
                        name = 'СОГЛАСОВАННЫЕ ЗАПИСИ';
                        break;
                    case 3:
                        name = 'ВЫПОЛНЕННЫЕ ЗАПИСИ';
                        break;
                    case 4:
                        name = 'СОЗДАТЬ НОВУЮ УСЛУГУ'
                        break;
                    case 5:
                        name = 'ПЕРЕЧЕНЬ ДЕЙСТВУЮЩИХ УСЛУГ';
                        break;
                    case 6:
                        name = 'ПЕРЕЧЕНЬ ЗААРХИВИРОВАННЫХ УСЛУГ';
                        break;
                    case 7:
                        name = 'ЗАГРУЗИТЬ НОВЫЙ ПРАЙС';
                        break;
                    default:
                        name = 'НЕСОГЛАСОВАННЫЕ ЗАПИСИ';
                }

                return name;
            }
        },

        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************


        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{

            ToggleReport(e){

                let v = this,
                    s = v.section,
                    action = e.action;

                switch (action){
                    case 0:
                        s.type = 'CreateOrder';
                        break;
                    case 1:
                    case 2:
                    case 3:
                        s.type = 'OrdersReports';
                        break;
                    case 4:
                        s.type = 'CreateService';
                        break;
                    case 5:
                        s.type = 'ActiveServices';
                        break;
                    case 6:
                        s.type = 'ArchiveServices';
                        break;
                    case 7:
                        s.type = 'PriseLoad';
                        break
                    default:
                        s.type = 'OrdersReports';
                }
            },
            SaveActionCode(e){
                let v = this;
                v.actionCode = e.action;
            },
            OpenCreateOrderSection(){
                let v = this;
                v.section.type = 'CreateOrder';
            },
            ExitAdminPanel(){
                localStorage.removeItem('token');
                let v = this;
                v.$router.push({name: 'adminSignin'});
            },
            Subscribe(){
                let v = this;
                v.$bus.$on('AP-BUTTON-IS-PRESSED', v.ToggleReport);
                v.$bus.$on('AP-BUTTON-IS-PRESSED', v.SaveActionCode);
            },

        },

        //*********************************************************************
        // LIFE HOOKS
        //*********************************************************************

        beforeCreate(){

            let v = this,
                token = localStorage.getItem('token');

            v.$http.get('/api/admin/auth/validation?token=' + token).then(
                response => {

                    if(!response.data.isTokenValid){
                        v.$router.push({name: 'adminSignin'});
                    } else {
                        v.isUserTokenValid =  response.data.isTokenValid;
                    }

                }, error => {
                    v.$router.push({name: 'adminSignin'});
                }
            );

        },

        mounted(){

            let v = this;
            v.Subscribe();
        },

        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************

        components:{
            Layout,
            ButtonsGroups,
            ButtonsGroup,
            PButton: Button,
            GroupName: ButtonsGroupName,
            ApData: Data,
            OrdersReports,
            CreateOrder,
            ActiveServices,
            CreateService,
            ArchiveServices,
            PriseLoad,
        }

    };

</script>