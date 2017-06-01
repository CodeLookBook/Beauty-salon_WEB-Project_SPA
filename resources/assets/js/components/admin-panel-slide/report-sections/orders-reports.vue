<template lang="pug">

    .col-xs-12.AP-ORDERS-REPORTS
        .row.AP-FILTERS-SLOT
            .col-xs-12
                .row
                    .col-sm-4.col-md-3
                        .row
                            .col-xs-12
                                .row
                                    .col-xs-12
                                        p(style="margin-top: 1em") Начальная дата:
                                .row
                                    datepicker( wrapper-class="col-xs-12 form-group",
                                                input-class="form-control input-sm DATEPICKER-BG",
                                                v-model='report.dates.start',
                                                placeholder="Выберите дату",
                                                format="dd.MM.yyyy",
                                                language="ru",)
                    .col-sm-4.col-md-3
                        .row
                            .col-xs-12
                                .row
                                    .col-xs-12
                                        p(style="margin-top: 1em") Конечная дата:
                                .row
                                    datepicker( wrapper-class="col-xs-12 form-group",
                                                input-class="form-control input-sm DATEPICKER-BG",
                                                v-model='report.dates.end',
                                                placeholder="Выберите дату",
                                                format="dd.MM.yyyy",
                                                language="ru",)

                    .col-sm-4.col-md-3
                        .row
                            .col-xs-12
                                .row
                                    .col-xs-12
                                        p(style="margin-top: 1em") Выберите услугу:
                        .row
                            .col-xs-12
                                .row
                                    .col-xs-12
                                        select.form-control.input-sm(v-model="report.selectedService", name="Service", ref="service")
                                            option(value="0") Все
                                            option( v-for="service in services", :value="service.id") {{service.name}}

                    .col-sm-12.col-md-3
                        .row
                            .col-xs-12
                                .row
                                    .col-xs-12
                                        p.hidden-sm(style="margin-top: 1em") Подтвердите выбор:
                                .row
                                    .col-xs-12
                                        button.btn.btn-primary.btn-sm.col-xs-12( type="button",
                                                                                 @click="UpdateReportTable"
                                                                                 style="text-align:left;")
                                            | Отобразить заказы


        .row.AP-DATA-SLOT
            .col-xs-12
                .row
                    .col-xs-12
                        h3(style="margin-top: 2em") {{reportName}}:
                .row
                    .col-xs-12
                        table(style="table-layout: fixed; width: 100%;")
                            tr
                                td
                                    div(style="width: 100%; overflow-x: auto;")
                                        table.table.table-hover(style="min-width: 950px;")
                                            thead
                                                tr
                                                    th
                                                    th #
                                                    th Дата
                                                    th Время
                                                    th(v-if="report.showSelectedServiceColumn") Услуга
                                                    th Имя
                                                    th Телефон
                                                    th Состояние
                                            tbody
                                                report-row(
                                                v-for           ="(order, index) in report.filteredByStateOrders",
                                                :key            ="order.id",
                                                :row-number     ="index + 1",
                                                :showServiceCol = "report.showSelectedServiceColumn",

                                                :orderId        ="order.id",
                                                :orderDate      ="order.date",
                                                :orderTime      ="order.time",

                                                :orderStateId   ="order.state.id",
                                                :orderStateName ="order.state.name",

                                                :customerId     ="order.customer.id",
                                                :customerName   ="order.customer.name",
                                                :customerPhone  ="order.customer.phone",
                                                :isCustomerTrashed="order.customer.deleted_at ? deleted_at : ''",

                                                :serviceId      ="order.service.id",
                                                :serviceName    ="order.service.name",

                                                :services       ="services",
                                                :orderStates    ="orderStates")

</template>
<style lang="scss">

    @import '../../../../sass/mixins';

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


    //DECOR: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .DATEPICKER-BG{
        background-color: white !important;
    }

</style>
<script>

    //*************************************************************************
    // HELPERS IMPORT
    //*************************************************************************

    import {mapGetters} from "vuex"
    import {mapActions} from "vuex"

    //*************************************************************************
    // CHILD COMPONENTS IMPORT
    //*************************************************************************

    import Datepicker from 'vuejs-datepicker'
    import OrderReportRow from './orders-report-row.vue'
    import BrowserStoreMethods from '../../../mixins/browser-store.vue'

    //*************************************************************************
    // COMPONENT
    //*************************************************************************

    export default {

        //*********************************************************************
        // MIXINS
        //*********************************************************************

        mixins:[
            BrowserStoreMethods,
        ],

        //*********************************************************************
        // PROPERTIES
        //*********************************************************************

        props:{
            actionCode:{
                type: Number,
            },
            reportName:{
                type: String,
            },
        },

        //*********************************************************************
        // DATA FIELDS
        //*********************************************************************

        data(){
            return {
                report:{
                    dates:{
                        start:  new Date(),
                        end:    new Date(),
                    },
                    filteredByStateOrders:      null,
                    services:                   null,
                    selectedService:            0,
                    showSelectedServiceColumn:  true,
                },

            }
        },

        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************

        computed:{

            ...mapGetters('orders', [
                'orders',
                'ordersResponseStatus',
            ]),

            ...mapGetters('services', [
                'services',
                'loadServicesResponseStatus',
            ]),

            ...mapGetters('orderStates',[
                'orderStates',
                'loadOrderStatesResponseStatus',
            ]),

            ordersState(){

                let v = this,
                    state;

                switch(this.actionCode){
                    case 1:
                        state = 1; //unmatched order
                        break;
                    case 2:
                        state = 2; //matched order
                        break;
                    case 3:
                        state = 3; //completed order
                        break;
                }

                return state;
            },
        },

        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************

        watch:{

            ordersResponseStatus(newV, oldV){

                let v = this;

                if(parseInt(newV) === 401) v.$router.push({name: 'adminSignin'});

            },
            loadServicesResponseStatus(newV, oldV){

                let v = this;

                if(parseInt(newV) === 401) v.$router.push({name: 'adminSignin'});

            },
            loadOrderStatesResponseStatus(newV, oldV){

                let v = this;

                if(parseInt(newV) === 401) v.$router.push({name: 'adminSignin'});

            },

            'report.dates.start'(newV, oldV){

                let v = this,
                    r = v.report,
                    d = r.dates;

                if(newV > d.end){
                    d.end = newV;
                }

            },
            'report.dates.end'  (newV, oldV){

                let v = this,
                    r = v.report,
                    d = r.dates;

                if(newV < d.start){
                    d.start = newV;
                }

            },
            'ordersState'       (newV, oldV){

                if(newV === oldV) return;

                let v = this,
                    d = v.report.dates,
                    formattedDates = {
                        start: v.FormatDate(d.start),
                        end  : v.FormatDate(d.end  ),
                    };

                v.report.filteredByStateOrders = null;
                v.LoadOrders(formattedDates);
                v.LoadServices();
                v.LoadOrderStates();

            },
            orders              (newV, oldV){

                if(newV === oldV) return;

                let v = this;
                v.SaveFilteredByStateOrders(
                    v.GetFilteredByStateOrders()
                );

            },
        },

        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{

            ...mapActions('orders', [
                'LoadOrders',
            ]),
            ...mapActions('services', [
                'LoadServices',
            ]),
            ...mapActions('orderStates', [
                'LoadOrderStates',
            ]),

            CurrentDate(){
                let today   = new Date(),
                    dd      = today.getDate(),
                    mm      = today.getMonth()+1, //January is 0!
                    yyyy    = today.getFullYear();

                if(dd<10) {
                    dd='0' + dd;
                }

                if(mm<10) {
                    mm='0' + mm;
                }

                return dd+'.'+mm+'.'+yyyy;
            },
            FormatDate(date){
                let dd      = date.getDate(),
                    mm      = date.getMonth()+1, //January is 0!
                    yyyy    = date.getFullYear();

                if(dd<10) {
                    dd='0' + dd;
                }

                if(mm<10) {
                    mm='0' + mm;
                }

                return dd+'.'+mm+'.'+yyyy;
            },

            GetFilteredByStateOrders(){

                let v = this,
                    r = v.report;

                return v.orders.filter(order=>{

                    return (
                        order.state.id === v.ordersState
                        &&
                        (
                            parseInt(r.selectedService) === 0 ||

                            parseInt(order.service.id) === parseInt(r.selectedService)
                        )
                    );
                });

            },
            SaveFilteredByStateOrders(aFilterdOrders){

                let v = this,
                    r = v.report;

                r.filteredByStateOrders = aFilterdOrders;

            },

            UpdateReportTable(){

                let v = this,
                    d = v.report.dates,
                    formattedDates = {
                        start: v.FormatDate(d.start),
                        end  : v.FormatDate(d.end  ),
                    };

                v.LoadOrders(formattedDates);
                v.LoadServices();
                v.LoadOrderStates();
            },

            Subscribe(){
                let v = this;
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
                    }

                }, error => {

                    localStorage.removeItem('token');
                    v.$router.push({name: 'adminSignin'});

                }
            );

        },

        mounted(){

            let v = this,
                d = v.report.dates,
                formattedDates = {
                    start: v.FormatDate(d.start),
                    end  : v.FormatDate(d.end  ),
                };

            v.LoadOrders(formattedDates);
            v.LoadServices();
            v.LoadOrderStates();
            v.Subscribe();

        },

        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************

        components:{
            Datepicker,
            ReportRow: OrderReportRow,
        }

    };

</script>