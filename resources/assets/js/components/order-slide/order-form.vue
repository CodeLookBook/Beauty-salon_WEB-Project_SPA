<template lang="pug">


        t.ORDER-FORM(ref="order-form")
            r
                c
                    t.FORM
                        r
                            c
                                .container-fluid(v-if="form.isVisible")
                                    .row
                                        .col-xs-12
                                            h2.text-center  СДЕЛАЙТЕ ПРЕДВАРИТЕЛЬНЫЙ ЗАКАЗ ПРЯМОЙ СЕЙЧАС.
                                            p.text-center
                                                | Заполните форму и нажмите кнопку "ОТПРАВИТЬ". &nbsp;
                                                br.hidden-xs.hidden-sm
                                                | Мы свяжемся с вами в ближайшее время, для того &nbsp;
                                                br.hidden-xs.hidden-sm
                                                | что бы обсудить детали Вашего заказа. &nbsp;

                                    .row
                                        .col-xs-12
                                            .form#CUSTOMER-ORDER
                                                .row
                                                    .form-group.col-sm-12
                                                        el-input(placeholder="Введите имя",
                                                        v-model="form.order.customer.name",
                                                        style="color:red;")
                                                        ul.list-unstyled(v-if="requestErrors.customer.name.length")
                                                            li(v-for="error in requestErrors.customer.name") {{error}}
                                                .row
                                                    .form-group.col-sm-6
                                                        el-input(placeholder="Введите телефон", v-model="form.order.customer.phone")
                                                        ul.list-unstyled(v-if="requestErrors.customer.phone.length")
                                                            li(v-for="error in requestErrors.customer.phone") {{error}}
                                                    .form-group.col-sm-6
                                                        el-select(
                                                        v-model="form.order.service.id",
                                                        placeholder="Выберите услугу",
                                                        style="width:100%")
                                                            el-option(
                                                            v-for="service in services",
                                                            :key="service.id",
                                                            :label="service.name",
                                                            :value="service.id")
                                                        ul.list-unstyled(v-if="requestErrors.service.id.length")
                                                            li(v-for="error in requestErrors.service.id") {{error}}
                                                .row
                                                    .form-group.col-sm-6(
                                                        style="color:black !important;",)
                                                        datepicker(
                                                        :disabled="form.datepicker.disabled",
                                                        style="color:black !important;",
                                                        input-class="form-control DATEPICKER-BG",
                                                        v-model='form.order.date',
                                                        placeholder="Выберите дату",
                                                        format="dd.MM.yyyy",
                                                        language="ru")
                                                        ul.list-unstyled(v-if="requestErrors.date.length")
                                                            li(v-for="error in requestErrors.date") {{error}}
                                                    .form-group.col-sm-6
                                                        el-time-select(
                                                        :editable="false",
                                                        v-model="form.order.time",
                                                        :picker-options="{start: '09:00', step: '00:05', end: '21:00'}",
                                                        placeholder="Выберите время"
                                                        style="width:100%; color:black;")
                                                        ul.list-unstyled(v-if="requestErrors.time.length")
                                                            li(v-for="error in requestErrors.time") {{error}}
                                                .row
                                                    .col-xs-12
                                                        button.btn.btn-primary(type="submit", @click="SaveOrderToDB")
                                                            | ОТПРАВИТЬ &nbsp;
                                                            span.glyphicon.glyphicon-play-circle(aria-hidden="true")
                                .container-fluid(v-if="!form.isVisible")
                                    .row
                                        .col-xs-12.text-center
                                            .h2 Ваша заявка отправленна.
                                            p
                                                | Мы свяжемся с вами в ближайшее время, для того &nbsp;
                                                br.hidden-xs.hidden-sm
                                                | что бы обсудить детали Вашего заказа. &nbsp;
                                            .btn.btn-primary(type="submit", @click="OpenCustomerOrderForm")
                                                | СОЗДАТЬ ЕЩЕ ОДНУ ЗАВКУ &nbsp;

</template>
<style lang="scss">


    @import "../../../sass/mixins";

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //STRUCTURE  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .ORDER-FORM{
        height: 100%;
        width: 100%;

        .FORM{
            height: 100%;
            width: 100%;
        }
    }

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    $lgMin:1200px;      $mdMax:1199px;      $smMax:991px;       $xsMax:767px;
                        $mdMin:992px;       $smMin:768px;

    //DECOR: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .ORDER-FORM{
        /*background-color: #A2D9F7;*/
        background-color: #F5F8FA;

        &>.R{
            &>.C{
                vertical-align: middle;
                background-color: #F5F8FA;

                .FORM{
                    /*background-color: #A2D9F7;*/
                    .R{
                        .C{
                            padding: 7% 20% 7% 20%;

                            @include m(md,$min: $mdMin, $max: $mdMax){
                                padding: 7% 10% 7% 10%;
                            }
                            @include m(sm,$min: $smMin, $max: $smMax){
                                padding: 5% 5% %5 5%;
                            }
                            @include m(xs,              $max: $xsMax){
                                padding: 0;
                            }
                            vertical-align: middle;
                            /*color: white;*/

                            .container-fluid:first-child{
                                margin-bottom: 3em;
                            }

                            h2{
                                color: #f89898;

                                @include m(md,$min: $mdMin, $max: $mdMax){
                                    font-size: 2em;
                                }
                                @include m(sm,$min: $smMin, $max: $smMax){
                                    font-size: 1.5em;
                                }
                                @include m(xs,              $max: $xsMax){
                                    font-size: 1.5em;
                                 }
                            }

                            button{
                                float: right;
                                background-color: #f89898;
                                border: none;
                            }
                        }
                    }
                }
                ul{
                    margin-bottom: 0;

                    li{
                        color: red;
                    }
                }
            }
        }
    }

    .DATEPICKER-BG{
        background-color: white !important;
    }

</style>
<script>

    //*************************************************************************
    // HELPERS IMPORT
    //*************************************************************************

    import {mapActions, mapGetters} from "vuex";

    //*************************************************************************
    // CHILD COMPONENTS IMPORT
    //*************************************************************************

    import Table from "../table.vue"
    import Row from "../row.vue"
    import Cell from "../cell.vue"
    import Datepicker from 'vuejs-datepicker'

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
            return {

                form:{
                    isVisible: true,
                    datepicker:{
                        disabled:{
                            to:    this.YesterdayDate(),
                        }
                    },
                    order:{
                        customer:{
                            name:  this.GetCookie('order.customer.name' ),
                            phone: this.GetCookie('order.customer.phone'),
                        },
                        service:{
                            id:    parseInt(this.GetCookie('order.service.id')) ? parseInt(this.GetCookie('order.service.id')) : '',
                        },
                        state:{
                            id:  1, //id=1 - unmatched order
                        },
                        date:      this.GetCookie('order.date') ? new Date(this.GetCookie ('order.date')) : new Date(),
                        time:      this.GetCookie('order.time') ? this.GetCookie('order.time') : '',
                    }
                },

                requestErrors: {
                    customer:{
                        name:   [],
                        phone:  [],
                    },
                    service:{
                        id:     [],
                    },
                    state:{
                        id:     [],
                    },
                    date:       [],
                    time:       [],
                },

            };
        },

        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************

        computed:{
            ...mapGetters('services', [
                'services',
            ]),
            ...mapGetters('orders', [
                'createOrderResponseOk',
                'createOrderResponseStatus',
                'createOrderResponseData',
            ]),
        },

        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************

        watch:{
            'form.order.customer.name'   (newV, oldV){
                let v = this;
                v.SetCookie('order.customer.name',newV, 60)
            },
            'form.order.customer.phone'  (newV, oldV){
                let v = this;
                v.SetCookie('order.customer.phone',newV, 60)
            },
            'form.order.service.id'      (newV, oldV){
                let v = this;
                v.SetCookie('order.service.id',newV, 1)
            },
            'form.order.date'            (newV, oldV){
                let v = this;
                v.SetCookie('order.date',newV, 1)
            },
            'form.order.time'            (newV, oldV){
                let v = this;
                v.SetCookie('order.time',newV, 1)
            },

            createOrderResponseOk(newV, oldV){
                alert('createOrderResponseOk: ' + newV);
                if(newV){
                    let v = this;
                    v.DeleteFormCookies();
                    v.ResetInputFormValues();
                    v.form.isVisible = false;
                }
            },

            createOrderResponseData(newV, oldV){

                let v = this,
                    data = newV,
                    errors = v.requestErrors;

                if (!v.createOrderResponseOk) {

                    if (!data) return;

                    if (data.hasOwnProperty('order.date')) {
                        errors.date = data['order.date'];
                    } else {
                        errors.date = [];
                    }

                    if (data.hasOwnProperty('order.time')) {
                        errors.time = data['order.time'];
                    } else {
                        errors.time = [];
                    }

                    if (data.hasOwnProperty('order.customer.name')) {
                        errors.customer.name = data['order.customer.name'];
                    } else {
                        errors.customer.name = [];
                    }

                    if (data.hasOwnProperty('order.customer.phone')) {
                        errors.customer.phone = data['order.customer.phone'];
                    } else {
                        errors.customer.phone = [];
                    }

                    if (data.hasOwnProperty('order.service.id')) {
                        errors.service.id = data['order.service.id'];
                    } else {
                        errors.service.id = [];
                    }

                } else {
                    errors.date = [];
                    errors.time = [];
                    errors.customer.name = [];
                    errors.customer.phone = [];
                    errors.service.id = [];

                }

            },
        },

        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{

            ...mapActions('services', [
                'LoadServices'
            ]),
            ...mapActions('orders', [
                'CreateOrder',
            ]),


            YesterdayDate(){
                let currentDate = new Date();
                currentDate.setDate(currentDate.getDate() - 1);
                return currentDate;
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

            SetCookie   (cname, cvalue, exdays){
                var d = new Date();
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                var expires = "expires=" + d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            },
            GetCookie   (cname  ) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for(var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            },
            DeleteCookie(name   ) {
                let v = this;
                v.SetCookie(name, "", {
                    expires: -1
                });
            },
            DeleteFormCookies(){

                let v = this;

                v.DeleteCookie('order.service.id');
                v.DeleteCookie('order.date');
                v.DeleteCookie('order.time');

            },
            ResetInputFormValues(){
                let v = this;
                v.form.order={
                    customer: {
                        name: v.GetCookie('customer.name'),
                        phone: v.GetCookie('customer.phone'),
                    },
                    service: {
                        id: parseInt(v.GetCookie('service.id')) ? parseInt(v.GetCookie('service.id')) : '',
                    },
                    state: {
                        id: 1, //id=1 - unmatched order
                    },
                    date: v.GetCookie('date') ? new Date(v.GetCookie('date')) : new Date(),
                    time: v.GetCookie('time') ? v.GetCookie('time') : '',
                }
            },
            SaveOrderToDB(){
                let v = this,
                    order = {...v.form.order};

                order.date = v.FormatDate(order.date);

                v.CreateOrder(order);
             },
            OpenCustomerOrderForm(){
                let v = this;
                v.form.isVisible = true;
            },
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
            T: Table,
            R: Row,
            C: Cell,
            Datepicker,
        }

    };

</script>