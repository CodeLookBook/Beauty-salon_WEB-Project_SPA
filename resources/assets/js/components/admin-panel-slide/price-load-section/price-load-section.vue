<template lang="pug">

    .col-xs-12.AP-PRICE-LOAD-SECTION
        .row(v-if="isFormVisible")
            .col-xs-12
                .row
                    .col-xs-12
                        h3(style="margin-top: 1em;") {{reportName}}
                        p   Данный файл будет доступен клиентам для скачивания при нажатии кнопки "Загрузить",
                            | расположенной в верхнем меню сайта, а такжэ доступной в боковом меню при просмотре
                            | с мобильных устройств.
                            br
                            | Поддерживаемый формат файлов: PDF.
                            br
                            | Размер файла не должен превыщать - 2M.
                .row
                    .col-xs-12
                        form(ref="fileForm", @submit.prevent="LoadFileOnServer", enctype="multipart/form-data" method="post")
                            input(type="file", name='price', @change="OnFileChange", accept="application/pdf")
                            ul.list-unstyled
                                li(v-if="error.isFileSizeOutIfLimit") Размер файла не должен превышать 2 Мб.

                            button.btn.btn-primary(:class="classes" role="button") Сохранить
        .row(v-if="!isFormVisible")
            .col-xs-12
                .row
                    .col-xs-12
                        h3 ФАЙЛ СОХРАНЕН
                        button.btn.btn-primary(@click="OpenForm") ЗАГРУЗИТЬ НОВЫЙ ФАЙЛ

</template>
<style lang="scss">

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //STRUCTURE  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //DECOR: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .AP-PRICE-LOAD-SECTION{
        li{
            color: red;
        }
    }
</style>
<script>

    //*************************************************************************
    // HELPERS IMPORT
    //*************************************************************************

    import {mapActions, mapMutations} from "vuex";

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
            }
        },

        //*********************************************************************
        // DATA FIELDS
        //*********************************************************************

        data(){
            return {
                isFormVisible: true,
                classes:{
                    disabled: true,
                },
                file:{
                    sizeMax: 2000000,
                },
                error:{
                    isFileSizeOutIfLimit: false,
                }
            };
        },

        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************


        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************


        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{
            ...mapMutations('price', [
                'LoadPrice',
            ]),

            OnFileChange(e){

                let v = this,
                    files = e.target.files || e.dataTransfer.files,
                    file  = files[0],
                    c = v.classes,
                    er = v.error;


                if(file.size > v.file.sizeMax){
                    c.disabled = true;
                    er.isFileSizeOutIfLimit = true;
                } else {
                    c.disabled = false;
                    er.isFileSizeOutIfLimit = false;
                }

            },

            LoadFileOnServer(){

                let v = this,
                    form = v.$refs.fileForm,
                    formData = new FormData(form);

                v.LoadPrice(formData);
                v.isFormVisible = false;

            },

            OpenForm(){
                let v = this;
                v.isFormVisible = true;
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

                    if(!response.data.isTokenValid){
                        v.$router.push({name: 'adminSignin'});
                    }

                }, error => {

                    localStorage.removeItem('token');
                    v.$router.push({name: 'adminSignin'});

                }
            );

        },

        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************


    };

</script>