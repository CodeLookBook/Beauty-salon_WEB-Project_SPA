<template lang="pug">

    .col-xs-12.AP-CREATE-ORDER

        .row
            .col-sm-12.col-md-6
                h3(style="margin-top: 1em;") СОЗДАТЬ ЗАПИСЬ:
        .row
            .col-sm-12.col-md-6
                .row
                    .form-group.col-sm-12
                        .row
                            .col-xs-12
                                label Имя заказчика:
                        .row
                            .col-xs-12
                                el-input(placeholder="Введите имя", v-model="orderForm.customer.name")
                        .row(v-if="requestErrors.customer.name.length")
                            .col-xs-12
                                ul.list-unstyled
                                    li(v-for="error in requestErrors.customer.name") {{error}}

                    .form-group.col-sm-12
                        .row
                            .col-xs-12
                                label Телефон заказчика:
                        .row
                            .col-xs-12
                                el-input(placeholder="Введите телефон", v-model="orderForm.customer.phone")
                        .row(v-if="requestErrors.customer.phone.length")
                            .col-xs-12
                                ul.list-unstyled
                                    li(v-for="error in requestErrors.customer.phone") {{error}}

                    .form-group.col-sm-12
                        .row
                            .col-xs-12
                                label Заказываемая услуга:
                        .row
                            el-select.col-xs-12(v-model="orderForm.service.id" placeholder="Выберите услугу")
                                el-option(v-for="service in services", :key="service.id", :label="service.name", :value="service.id")
                        .row(v-if="requestErrors.service.id.length")
                            .col-xs-12
                                ul.list-unstyled
                                    li(v-for="error in requestErrors.service.id") {{error}}

                    .form-group.col-sm-12
                        .row
                            .col-xs-12
                                label Планируемая дата приема:
                        .row
                            .col-xs-12
                                datepicker(
                                    :disabled="datepicker.disabled",
                                    wrapper-class="",
                                    input-class="form-control DATEPICKER-BG",
                                    v-model='orderForm.date',
                                    placeholder="Выберите дату",
                                    format="dd.MM.yyyy",
                                    language="ru",)
                        .row(v-if="requestErrors.date.length")
                            .col-xs-12
                                ul.list-unstyled
                                    li(v-for="error in requestErrors.date") {{error}}

                    .form-group.col-sm-12
                        .row
                            .col-xs-12
                                label Время приема:
                        .row
                            .col-xs-12
                                el-time-select(
                                    :editable="false",
                                    v-model="orderForm.time",
                                    :picker-options="{start: '09:00', step: '00:05', end: '21:00'}",
                                    placeholder="Выберите время"
                                    style="width:100%")
                        .row(v-if="requestErrors.time.length")
                            .col-xs-12
                                ul.list-unstyled
                                    li(v-for="error in requestErrors.time") {{error}}

                    .form-group.col-sm-12
                        .row
                            .col-xs-12
                                label Cостояние записи:
                        .row
                            el-select.col-xs-12(v-model="orderForm.state.id" placeholder="Выберите текущее состояние")
                                el-option(v-for="orderState in orderStates", :key="orderState.id", :label="orderState.name", :value="orderState.id")

                    .form-group.col-xs-12
                        button.btn.btn-primary(type="submit", @click="SaveOrderToDB")
                            | COХРАНИТЬ &nbsp;
                            span.glyphicon.glyphicon-play-circle(aria-hidden="true")

        div(style="position: fixed; left:0; bottom:0; width:100%;" v-if="wasOrderSaved")
            .container-fluid
                .row
                    .col-sm-12.col-md-6
                        .alert.alert-success(role="alert") Данные сохранены.


</template>
<style lang="scss">

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //STRUCTURE  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //DECOR: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .DATEPICKER-BG{
        background-color: white !important;
    }
    .AP-CREATE-ORDER{
        li{
            color: red;
        }
    }

</style>
<script>

    //*************************************************************************
    // HELPERS
    //*************************************************************************

    import {mapGetters} from 'vuex'
    import {mapActions} from 'vuex'

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


        //*********************************************************************
        // DATA FIELDS
        //*********************************************************************

        data(){
            return {

                datepicker:{
                    disabled:{
                        to: this.YesterdayDate(),
                    }
                },

                orderForm:{
                    customer:{
                        name:    this.GetCookie('customer.name' ),
                        phone:   this.GetCookie('customer.phone'),
                    },
                    service:{
                        id:      parseInt(this.GetCookie('service.id')) ? parseInt(this.GetCookie('service.id')) : '',
                    },
                    state: {
                        id:      parseInt(this.GetCookie('state.id'  )) ? parseInt(this.GetCookie ('state.id' )) : 2,
                    },
                    date:        this.GetCookie('date') ? new Date(this.GetCookie ('date')) : new Date(),
                    time:        this.GetCookie('time') ? this.GetCookie('time') : '',
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

                saveButtonWasPressed: false,
                wasOrderSaved: false,

            }
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
            ...mapGetters('user',[
                'userSigninResponseStatus'
            ]),
            ...mapGetters('orderStates',[
                'orderStates',
                'orderStatesResponseOk',
                'orderStatesResponseStatus',
                'orderStatesResponseData',
            ]),
        },

        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************

        watch: {

            createOrderResponseOk(newV, oldV){

                let v = this;

                //Shows info message "Data were saved"
                if (newV && v.saveButtonWasPressed) {
                    v.wasOrderSaved = true;
                    setTimeout(() => {
                        v.wasOrderSaved = false;
                    }, 1500);

                    //Delete data from form fields
                    v.orderForm = {
                        customer: {
                            name: '',
                            phone: '',
                        },
                        service: {
                            id: '',
                        },
                        state: {
                            id: 2,
                        },
                        date: new Date(),
                        time: '',
                    }
                }

            },

            //Handles errors referenced with resived data from server.
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

            ordersResponseStatus(newV, oldV){

                let v = this;

                /**
                 * Redirects page to '/api/admin' if token had expired
                 * and set isAdminSignin var stored in local storage to false.
                 */
                if (newV == 401) {
                    localStorage.removeItem('token');
                    v.$router.push({name: 'adminSignin'});
                }
            },


            'orderForm.customer.name'   (newV, oldV){
                let v = this;
                v.SetCookie('customer.name',newV, 1)
            },
            'orderForm.customer.phone'  (newV, oldV){
                let v = this;
                v.SetCookie('customer.phone',newV, 1)
            },
            'orderForm.service.id'      (newV, oldV){
                let v = this;
                v.SetCookie('service.id',newV, 1)
            },
            'orderForm.state.id'        (newV, oldV){
                let v = this;
                v.SetCookie('state.id',newV, 1)
            },
            'orderForm.date'            (newV, oldV){
                let v = this;
                v.SetCookie('date',newV, 1)
            },
            'orderForm.time'            (newV, oldV){
                let v = this;
                v.SetCookie('time',newV, 1)
            },
        },

        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{

            ...mapActions('orders', [
                'CreateOrder',
            ]),
            ...mapActions('services', [
                'LoadServices',
            ]),
            ...mapActions('orderStates',[
                'LoadOrderStates'
            ]),

            SaveOrderToDB(){
                let v = this,
                    token = localStorage.getItem('token'),
                    order = {...v.orderForm};

                order.date = v.FormatDate(order.date);

                v.CreateOrder(order);
                v.DeleteFormCookies();

                v.saveButtonWasPressed = true;
            },

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

                v.DeleteCookie('customer.name');
                v.DeleteCookie('customer.phone');
                v.DeleteCookie('service.id');
                v.DeleteCookie('state.id');
                v.DeleteCookie('date');
                v.DeleteCookie('time');

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
            let v = this;
            v.LoadServices();
            v.LoadOrderStates();
        },

        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************

        components:{
            Datepicker,
        }

    };

</script>