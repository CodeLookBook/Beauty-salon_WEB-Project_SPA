<template lang="pug">

            t.GREETING-CARD
                r
                    c
                        .container-fluid.CONTENT
                            .row
                                .col-xs-10.col-xs-offset-1.col-md-10.col-md-offset-1
                                    h4    Городской формат центра красоты, где все
                                        | к чему привыкла самая взыскательная аудитория
                                        | делается быстро и с искренней доброжелательностью
                                        | гостеприимного дома.

                            .row
                                .col-xs-10.col-xs-offset-1.col-md-10.col-md-offset-1
                                    a.btn.btn-default.ORDER-BUTTON(href="/#ORDER-SLIDE") Заказать услугу

                            social-sharing(
                            social-sharing url="https://www.beauty.dev",
                            title='БЕЛЫЙ САД - городской формат центра красоты.',
                            description="Здесь вы найдете все к чему привыкла самая взыскательная аудитория, " +
                                        "здесь все делается быстро и с искренней доброжелательностью " +
                                        "гостеприимного дома.",
                            quote="БЕЛЫЙ САД - центр красоты.",
                            hashtags="БелыйСад, ЦентрКрасоты",
                            twitter-user="БелыйСад",
                            v-cloak inline-template)
                                .row
                                    .col-xs-10.col-xs-offset-1.col-md-10.col-md-offset-1
                                        .btn-group.btn-group-md.btn-group-sm.btn-group-xs.SOCIAL-NETWORK-BUTTON-GROUP
                                            network.btn.btn-default.SOCIAL-NETWORK-BUTTON(network="facebook")
                                                i.fa.fa-fw.fa-facebook &nbsp;Share
                                            network.btn.btn-default.SOCIAL-NETWORK-BUTTON(network="googleplus")
                                                i.fa.fa-fw.fa-google-plus &nbsp;Share
                                            network.btn.btn-default.SOCIAL-NETWORK-BUTTON(network="twitter")
                                                i.fa.fa-fw.fa-twitter &nbsp;Twitt
                                            network.btn.btn-default.SOCIAL-NETWORK-BUTTON(network="vk")
                                                i.fa.fa-vk &nbsp;Share
                                            //network.btn.btn-default.SOCIAL-NETWORK-BUTTON(network="whatsapp")
                                                i.fa.fa-fw.fa-whatsapp &nbsp;Send

</template>
<style lang="scss">

    @import "../../../sass/mixins";

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    $lgMin:1200px;      $mdMax:1199px;      $smMax:991px;       $xsMax:767px;
                        $mdMin:992px;       $smMin:768px;

    //STRUCTURE  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .GREETING-CARD{
        height: 100%;
        width: 30%;

        @include m(betweenW, $min: 1130px, $max: 1199px){
            width: 30%;
        }
        @include m(betweenW, $min: 992px, $max: 1198px){
            width: 40%;
        }
        @include m(betweenW, $min: 681px, $max: 991px){
            width: 50%;
        }
        @include m(maxW, $max: 680px){
            width: 100%;
        }
    }

    //BREAKPOINTS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    $lgMin:1200px;      $mdMax:1199px;      $smMax:991px;       $xsMax:767px;
                        $mdMin:992px;       $smMin:768px;

    //DECOR: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    .GREETING-CARD{

        background-color: rgba(0, 0, 0, 0.49);

        &>DIV{
            &>DIV{
                vertical-align: middle;
                text-align: left;

                .CONTENT{
                    h4{
                        padding-top: 1em;
                        color: white;
                        /*color: #f89898;*/
                    }

                    .ORDER-BUTTON{
                        margin-top: 1em;
                        margin-bottom: 1.5em;
                        border: none;
                        /*border-color: white;*/
                        background-color: #A2D9F7;
                        /*color: #A2D9F7;*/
                        color: white;
                    }

                    .SOCIAL-NETWORK-BUTTON-GROUP{
                        margin-bottom: 1.5em;

                        .SOCIAL-NETWORK-BUTTON{
                            /*border-color: white;*/
                            background-color: transparent;
                            border: none;
                            color: #A2D9F7;
                            font-size: 1.2em;
                            .fa-fw{
                                width: auto;
                            }
                            &:hover{
                                /*background-color: #F5F8FA;*/
                            }
                        }
                    }

                }

            }
        }
    }

</style>
<script>

    //*************************************************************************
    // CHILD COMPONENTS IMPORT
    //*************************************************************************

    import Table from "../table.vue"
    import Row from "../row.vue"
    import Cell from "../cell.vue"
    import Appear from "../../transitions/appear.vue"

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


        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************


        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************


        //*********************************************************************
        // METHODS
        //*********************************************************************


        //*********************************************************************
        // LIFE HOOKS
        //*********************************************************************


        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************

        components:{
            T: Table,
            R: Row,
            C: Cell,
            AppearTransition: Appear,
        }

    };

</script>