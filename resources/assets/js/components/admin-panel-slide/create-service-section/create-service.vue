<template lang="pug">

    .col-xs-12.AP-CREATE-SERVICE
        .row
            .col-sm-12.col-md-6
                h3(style="margin-top: 1em;") {{reportName}}
        .row
            .col-sm-12.col-md-6
                .row
                    .form-group.col-xs-12
                        label Название услуги:
                        el-input(placeholder="Введите название", v-model="service.name")
                        ul.list-unstyled(
                            style="margin:0;"
                            v-if="createServiceResponseOk != null && !createServiceResponseOk")
                            li(v-for="error in createServiceResponseData['name']") {{error}}
                    .form-group.col-xs-12
                        button.btn.btn-primary(type="submit", @click="SaveServiceToDB")
                            | COХРАНИТЬ &nbsp;
                            span.glyphicon.glyphicon-play-circle(aria-hidden="true")
                .row(v-if="wasSaved")
                    .col-sm-12.col-md-6
                        .alert.alert-success(role="alert") Данные сохранены.

</template>
<style lang="scss">

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //STRUCTURE  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //DECOR: ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .AP-CREATE-SERVICE{
        li{
            color: red;
        }
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
                wasSaved: false,
                service:{
                    name: this.GetCookie('name'),
                },
            };
        },

        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************

        computed:{
            ...mapGetters('services', [
                'createServiceResponseOk',
                'createServiceResponseStatus',
                'createServiceResponseData',
            ]),
        },

        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************

        watch:{
            createServiceResponseOk(newV, oldV){

                let v = this;
                alert('CreateService => Ok() => newV(before): ' + newV);

                if(newV) {
                    v.DeleteCookie('name');
                    v.service.name = '';
                    v.wasSaved = true;
                    setTimeout(() => {
                        v.wasSaved = false;
                    }, 1500);
                }


            },
            createServiceResponseStatus(newV, oldV){

                let v = this;
                if(parseInt(newV) === 401) v.$router.push({name: 'adminSignin'})

            },
            'service.name'(newV, oldV){

                let v = this;
                v.SetCookie('name', newV, 1);

            },
        },

        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{
            ...mapActions('services',[
                'CreateService',
            ]),

            SaveServiceToDB(){
                let v = this;
                v.CreateService(v.service);
            },

            SetCookie   (cname, cvalue, exdays){
                var d = new Date();
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                var expires = "expires=" + d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            },
            GetCookie   (cname  ) {
                let name = cname + "=";
                let ca = document.cookie.split(';');
                for(let i = 0; i < ca.length; i++) {
                    let c = ca[i];
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
        },

        //*********************************************************************
        // LIFE HOOKS
        //*********************************************************************


        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************


    };

</script>