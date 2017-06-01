<template lang="pug">

    tr(v-if="!deleted" ref="order")
        td
            .btn.btn-default(@click="DeleteOrderAndHideOrderRow" style="border: none; heifht: 100%")
                span.glyphicon.glyphicon-trash(aria-hidden="true")
        td(style="vertical-align:middle;") {{rowNumber     }}
        td
            datepicker(
                :disabled="{to: YesterdayDate(),}"
                input-class="form-control DATEPICKER-BG",
                v-model='order.date',
                placeholder="Выберите дату",
                format="dd.MM.yyyy",
                language="ru",)
        td
            el-time-select(
                :editable="false",
                :clearable="false",
                v-model="order.time",
                :picker-options="{start: '09:00', step: '00:05', end: '21:00'}",
                placeholder="Выберите время",
                style="width:100%",)

        td
            el-select(
                v-model="order.service.id",
                placeholder="Выберите услугу",
                style="width:100%")
                el-option(v-for="service in services", :key="service.id", :label="service.name", :value="service.id")

        td
            el-input(v-model="order.customer.name")
        td
            el-input(v-model="order.customer.phone")
        td
            el-select(v-model="order.state.id" placeholder="Выберите текущее состояние")
                el-option(v-for="orderState in orderStates", :key="orderState.id", :label="orderState.name", :value="orderState.id")

    //{{orderStateName}}

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

    import {mapActions} from "vuex";

    //*************************************************************************
    // CHILD COMPONENTS IMPORT
    //*************************************************************************

    import Datepicker from 'vuejs-datepicker'

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
            showServiceCol:{
                type: Boolean,
                default: true,
            },

            orderId:{
                type: Number,
            },
            orderDate:{
                type: String,
            },
            orderTime:{
                type: String,
            },

            customerId:{
                type: Number,
            },
            customerName:{
                type: String,
                default: '',
            },
            customerPhone:{
                type: String,
                default: '',
            },
            isCustomerTrashed:{
                type: Boolean,
            },

            serviceId:{
                type: Number,
            },
            serviceName: {
                type: String,
                default: '',
            },

            orderStateId:{
                type: Number,
            },
            orderStateName:{
                type: String,
            },

            services:{
                type: Array,
                default:[],
            },

            orderStates:{
                type: Array,
                default:[],
            },

        },

        //*********************************************************************
        // DATA FIELDS
        //*********************************************************************

        data(){
            return{
                deleted: false,
                order:{
                    id: this.orderId,
                    date: this.FormatDate(this.orderDate),
                    time: this.orderTime.slice(0,5),

                    customer:{
                        name: this.customerName,
                        phone: this.customerPhone,
                    },
                    service:{
                        id: this.serviceId,
                    },
                    state:{
                        id: this.orderStateId
                    }
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
            'order.date'(newV, oldV){

                if(newV === oldV) return;

                let v = this,
                    order = {...v.order};

                order.date =  v.DateToString(v.order.date);
                v.UpdateOrder(order);

            },
            'order.time'(newV, oldV){

                if(newV === oldV) return;

                let v = this,
                    order = {...v.order};
                order.date =  v.DateToString(v.order.date);
                v.UpdateOrder(order);

            },
            'order.customer.name'(newV, oldV){

                if(newV === oldV) return;

                let v = this,
                    order = {...v.order};
                order.date =  v.DateToString(v.order.date);
                v.UpdateOrder(order);

            },
            'order.customer.phone'(newV, oldV){

                if(newV === oldV) return;

                let v = this,
                    order = {...v.order};
                order.date =  v.DateToString(v.order.date);
                v.UpdateOrder(order);

            },
            'order.service.id'(newV, oldV){

                if(newV === oldV) return;

                let v = this,
                    order = {...v.order};
                order.date =  v.DateToString(v.order.date);
                v.UpdateOrder(order);

            },
            'order.state.id'(newV, oldV){

                if(newV === oldV) return;

                let v = this,
                    order = {...v.order};
                order.date =  v.DateToString(v.order.date);
                v.UpdateOrder(order);

            },
        },

        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{

            ...mapActions('orders', [
                'UpdateOrder',
                'DeleteOrder',
            ]),

            YesterdayDate(){

                let currentDate = new Date();
                currentDate.setDate(currentDate.getDate() - 1);
                return currentDate;

            },

            FormatDate(sDate){

                let dateParts = sDate.split(".");
                return new Date(dateParts[2], (dateParts[1] - 1), dateParts[0]);

            },

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
            DateToString(date){
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
            DeleteOrderAndHideOrderRow(){
                let v = this;
                v.DeleteOrder(v.orderId);
                v.deleted = true;
            },

        },

        //*********************************************************************
        // LIFE HOOKS
        //*********************************************************************


        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************

        components:{
            Datepicker,
        }

    };

</script>