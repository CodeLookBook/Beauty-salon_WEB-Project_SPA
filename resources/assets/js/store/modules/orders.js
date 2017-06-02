export default {

    namespaced: true,

    state:{
        orders: [],
        promises:{
            loadOrders: null,
            createOrder: null,
        },
        loadOrdersResponse:{
            ok:         null,
            status:     null,
            statusText: null,
            url:        null,
            data:       [],
        },
        createOrderResponse:{
            ok:         null,
            status:     null,
            statusText: null,
            url:        null,
            data:       [],
        },
        updateOrderResponse:{
            ok:         null,
            status:     null,
            statusText: null,
            url:        null,
            data:       [],
        },
        deleteOrderResponse:{
            ok:         null,
            status:     null,
            statusText: null,
            url:        null,
            data:       [],
        },
    },

    getters:{

        orders(state){
            return [...state.orders];
        },
        ordersResponseOk(state){
            return state.loadOrdersResponse.ok;
        },
        ordersResponseStatus(state){
            return state.loadOrdersResponse.status;
        },
        ordersResponseData(state){
            return {...state.loadOrdersResponse.data}
        },


        createOrderResponseOk(state){
          return state.createOrderResponse.ok;
        },
        createOrderResponseStatus(state){
            return state.createOrderResponse.status;
        },
        createOrderResponseData(state){
            return {...state.createOrderResponse.data};
        },

        updateOrderResponseOk(state){
            return state.updateOrderResponse.ok;
        },
        updateOrderResponseStatus(state){
            return state.updateOrderResponse.status;
        },
        updateOrderResponseData(state){
            return state.updateOrderResponse.data;
        },

    },


    mutations:{

        LoadOrders(state, oDates){

            let token = localStorage.getItem('token');

            Vue.http.get('/api/orders/range/' + oDates.start + '/' + oDates.end + '?token=' + token).then(response => {

                    state.orders = response.data.orders;
                    state.loadOrdersResponse = response;

                }, error => {

                    state.createOrderResponse = error;

                    if(parseInt(error.data.state) == 401){
                        router.push({name: 'adminSignin'});
                    }
                }
            );

        },

        CreateOrder(state, oOrder){

            let token = localStorage.getItem('token');

            Vue.http.post('/api/order?token=' + token, {
                order: {
                    date: oOrder.date,
                    time: oOrder.time,
                    customer: {
                        name:  oOrder.customer.name,
                        phone: oOrder.customer.phone,
                    },
                    service: {
                        id: oOrder.service.id,
                    },
                    state: {
                        id: oOrder.state.id,
                    }
                }
            }).then(response =>{

                state.createOrderResponse = response;

            }, error =>{
                state.createOrderResponse = error;

                if(parseInt(error.data.state) == 401){
                    router.push({name: 'adminSignin'});
                }

            });
        },

        UpdateOrder(state, oOrder){
            let token = localStorage.getItem('token');

            Vue.http.patch('/api/order/' + oOrder.id + '?token=' + token, {
                order: {
                    date: oOrder.date,
                    time: oOrder.time,
                    customer: {
                        name: oOrder.customer.name,
                        phone: oOrder.customer.phone,
                    },
                    service: {
                        id: oOrder.service.id,
                    },
                    state: {
                        id: oOrder.state.id,
                    },
                }
            }).then(response => {
                state.updateOrderResponse = response;
            }, error => {
                state.updateOrderResponse = error;

                if(parseInt(error.data.state) == 401){
                    router.push({name: 'adminSignin'});
                }
            });
        },

        DeleteOrder(state, nOrderId){

            let token = localStorage.getItem('token');

            Vue.http.delete('/api/order/' + nOrderId +'?token=' + token ).then(response=>{

                state.deleteOrderResponse = response;

            }, error=>{

                state.deleteOrderResponse = error;

                if(parseInt(error.data.state) == 401){
                    router.push({name: 'adminSignin'});
                }

            });

        }

    },

    actions:{

        LoadOrders(context, oDates){
            context.commit('LoadOrders', oDates);
        },

        CreateOrder(context,oOrder){
            context.commit('CreateOrder', oOrder);
        },

        UpdateOrder(context, oOrder){
            context.commit('UpdateOrder', oOrder);
        },

        DeleteOrder(context, nOrderId){
            context.commit('DeleteOrder', nOrderId);
        },

    },

}
