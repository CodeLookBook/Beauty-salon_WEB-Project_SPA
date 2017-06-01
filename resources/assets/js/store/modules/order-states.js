export default {

    namespaced: true,

    state:{
        states: [],
        response:{
            ok:         false,
            status:     '',
            statusText: '',
            url:        '',
            data:       [],
        },
    },

    getters:{

        orderStates(state){
            return [...state.states];
        },
        loadOrderStatesResponseOk(state){
            return state.response.ok;
        },
        loadOrderStatesResponseStatus(state){
            return state.response.status;
        },
        loadOrderStatesResponseData(state){
            return state.response.data;
        }

    },

    mutations:{
        LoadOrderStates(state){

            let token = localStorage.getItem('token');

            Vue.http.get('/api/order_states?token=' + token).then(response => {

                let r = response,
                    d = r.data,
                    s = state;

                s.states = d.hasOwnProperty('states') ? d.states : [];

                s.response = {
                    ok           : r.ok,
                    status       : r.status,
                    statusText   : r.statusText,
                    url          : r.url,
                    data         : r.data,
                }

            }, error =>{

                let e = error,
                    d = e.data,
                    s = state;

                s.states = [];

                s.response = {
                    ok           : e.ok,
                    status       : e.status,
                    statusText   : e.statusText,
                    url          : e.url,
                    data         : e.data,
                };

                if(e.status == 401){
                    localStorage.setItem('isAdminSignin', false);
                }

            });

        },
    },

    actions:{
        LoadOrderStates(context){
            context.commit('LoadOrderStates');
        }
    }
}