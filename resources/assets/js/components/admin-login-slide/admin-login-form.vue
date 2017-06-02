<template lang="pug">

    .container-fluid#ADMIN-LOGIN-FORM-CONTAINER
        .row
            .col-sm-offset-3.col-sm-6.col-md-offset-4.col-md-4.ADMIN-LOGIN-FORM-SLOT
                .row
                    form.col-xs-12#ADMIN-LOGIN-FORM(action="/api/admin/signin"
                                                    method="POST")
                        .row
                            .form-group.col-xs-12
                                h4 ВХОД В КАБИНЕТ АДМИНИСТРАТОРА
                            .form-group.col-xs-12(:class="tags.loginInput.classes")
                                label(for="login") Логин пользователя:
                                input.form-control( v-model ="credentials.email",
                                                    name='login',
                                                    type    ="email",
                                                    placeholder="email")
                                .row
                                    .col-xs-12
                                        ul.list-unstyled
                                            li(v-for="error in errors.email") {{error}}

                            .form-group.col-xs-12(:class="tags.passwordInput.classes")
                                label(for="password") Пароль:
                                input.form-control( v-model ="credentials.password",
                                                    name="password",
                                                    type    ="password",
                                                    placeholder="password")
                                .row
                                    .col-xs-12
                                        ul.list-unstyled
                                            li(v-for="error in errors.password") {{error}}

                        .row
                            .col-xs-12
                                ul.list-unstyled(v-if=  "userSigninResponseStatus == 401 ||" +
                                                        "userSigninResponseStatus == 500"
                                    )
                                    li(v-if="userSigninResponseStatus == 401") {{userSigninResponseData['error']}}
                                    li(v-if="userSigninResponseStatus == 500") {{userSigninResponseData['error']}}
                            .form-group.col-xs-12
                                button.btn.btn-primary.col-xs-12( type="submit",
                                                                  @click.prevent = "Signin")
                                    | Войти &nbsp;

</template>
<style lang="scss">

    @import '../../../sass/mixins';

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    $lgMin:1200px;      $mdMax:1199px;      $smMax:991px;       $xsMax:767px;
                        $mdMin:992px;       $smMin:768px;

    //STRUCTURE  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    #ADMIN-LOGIN-FORM-CONTAINER{
        .ADMIN-LOGIN-FORM-SLOT{
            background-color: #EBF3F8;

            #ADMIN-LOGIN-FORM{
                padding-top: 2em;
                padding-bottom: 2em;
            }
        }
    }

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //DECOR: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    #ADMIN-LOGIN-FORM-CONTAINER {
        .ADMIN-LOGIN-FORM-SLOT {

            #ADMIN-LOGIN-FORM{

                label{
                    font-weight: normal;
                }
                li{
                    margin-bottom: 0;
                    color: red;
                }
            }
        }
    }
</style>
<script>

    //*************************************************************************
    // HELPERS IMPORT
    //*************************************************************************

    import {mapGetters} from "vuex";
    import {mapActions} from "vuex";

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


        //*********************************************************************
        // DATA FIELDS
        //*********************************************************************

        data(){
            return {
                credentials:{
                    email:   '', //user e-mail
                    password:'',
                },

                errors: {
                    email:    null,
                    password: null,
                },

                tags:{
                    loginInput:{
                        classes: {
                            'has-error': false,
                            'has-success': false,
                        }
                    },
                    passwordInput:{
                        classes:{
                            'has-error': false,
                            'has-success': false,
                        }
                    }
                },
            }
        },

        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************

        computed:{
            ...mapGetters('user', [
                'token',
                'userSigninResponseOk',
                'userSigninResponseStatus',
                'userSigninResponseData',
            ]),
        },


        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************

        watch:{

            token(newV, oldV){

                let v = this;
                v.ValidateToken();

            },

            userSigninResponseData  (newV, oldV){

                let v = this,
                    d  = newV,
                    e  = v.errors;

                if(!v.userSigninResponseOk){

                    if(d['email'   ]){
                        e.email    = d['email'];
                    } else {
                        e.email    = null;
                    }

                    if(d['password']) {
                        e.password = d['password'];
                    } else {
                        e.password = null;
                    }

                } else {
                    e.email        = null;
                    e.password     = null;
                }

            },

            'errors.email'   (newV, oldV){

                let v = this,
                    t = v.tags,
                    c = t.loginInput.classes;

                if(newV){
                    c['has-error'] = true;
                } else {
                    c['has-error'] = false;
                    c['has-success'] = true;
                }
            },

            'errors.password'(newV, oldV){

                let v = this,
                    t = v.tags,
                    c = t.passwordInput.classes;

                if(newV){
                    c['has-error'] = true;
                } else {
                    c['has-error'] = false;
                    c['has-success'] = true;
                }

            },

        },

        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{

            ...mapActions('user', [
                'GetTokenFromServer',
            ]),

            Signin                  (){

                let v = this;
                v.GetTokenFromServer(v.credentials);

            },

            ValidateToken(){

                let v = this,
                    token = localStorage.getItem('token');

                v.$http.get('/api/admin/auth/validation?token=' + token).then(
                    response => {

                        if(response.data.isTokenValid){
                            v.$router.push({name: 'adminPanel'});
                        } else {
                            localStorage.removeItem('token');
                        }

                    }, error => {

                        localStorage.removeItem('token');

                    }
                );

            }
        },

        //*********************************************************************
        // LIFE HOOKS
        //*********************************************************************

        beforeCreate(){

            let v = this,
                token = localStorage.getItem('token');

            v.$http.get('/api/admin/auth/validation?token=' + token).then(
                response => {

                    if(response.data.isTokenValid){
                        v.$router.push({name: 'adminPanel'});
                    }

                }, error => {

                    localStorage.removeItem('token');

                }
            );

        },

        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************


    };

</script>