<script>

    //*************************************************************************
    // PAGES IMPORT
    //*************************************************************************

    import HomePage         from "../pages/home.vue"
    import AdminSigninPage  from "../pages/admin-signin.vue"
    import AdminPanelPage   from "../pages/admin-panel.vue"

    //*************************************************************************
    // ARRAY OF ROTES
    //*************************************************************************

    export default [

        { path:'/',              name:'start',       component: HomePage         },
        { path:'/home',          name:'home',        component: HomePage         },
        { path:'/admin',         name:'adminSignin', component: AdminSigninPage  },
        { path:'/admin/panel',   name:"adminPanel",  component: AdminPanelPage   },

    ];

</script>