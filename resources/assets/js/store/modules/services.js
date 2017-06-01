export default {

    namespaced: true,

    state: {
        services: [],
        trashedServices: [],
        loadServicesResponse: {
            ok: null,
            status: null,
            statusText: null,
            url: null,
            data: null,
        },
        createServiceResponse: {
            ok: null,
            status: null,
            statusText: null,
            url: null,
            data: null,
        },
        updateServiceResponse:{
            ok: null,
            status: null,
            statusText: null,
            url: null,
            data: null,
        },
        deleteServiceResponse: {
            ok: null,
            status: null,
            statusText: null,
            url: null,
            data: null,
        },
        loadTrashedServicesResponse: {
            ok: null,
            status: null,
            statusText: null,
            url: null,
            data: null,
        },
        deleteTrashedServiceResponse: {
            ok: null,
            status: null,
            statusText: null,
            url: null,
            data: null,
        },
        restoreTrashedServiceResponse: {
            ok: null,
            status: null,
            statusText: null,
            url: null,
            data: null,
        },
    },
    getters: {

        services(state){
            return [...state.services];
        },
        loadServicesResponseOk(state){
            return state.loadServicesResponse.ok;
        },
        loadServicesResponseStatus(state){
            return state.loadServicesResponse.status;
        },

        createServiceResponseOk(state){
            return state.createServiceResponse.ok;
        },
        createServiceResponseStatus(state){
            return state.createServiceResponse.status;
        },
        createServiceResponseData(state){
            return {...state.createServiceResponse.data};
        },

        updateServiceResponseOk(state){
            return state.createServiceResponse.ok;
        },
        updateServiceResponseStatus(state){
            return state.createServiceResponse.status;
        },
        updateServiceResponseData(state){
            return {...state.createServiceResponse.data};
        },

        deleteServiceResponseOk(state){
            return state.deleteServiceResponse.ok;
        },
        deleteServiceResponseStatus(state){
            return state.deleteServiceResponse.status;
        },
        deleteServiceResponseData(state){
            return {...state.deleteServiceResponse.data};
        },

        trashedServices(state){
            return [...state.trashedServices];
        },
        loadTrashedServicesResponseOk(state){
            return state.loadTrashedServicesResponse.ok;
        },
        loadTrashedServicesResponseStatus(state){
            return state.loadTrashedServicesResponse.status;
        },
        loadTrashedServicesResponseData(state){
            return {...state.loadTrashedServicesResponse.data};
        },


        deleteTrashedServiceResponseOk(state){
            return state.deleteTrashedServiceResponse.ok;
        },
        deleteTrashedServiceResponseStatus(state){
            return state.deleteTrashedServiceResponse.status;
        },
        deleteTrashedServiceResponseData(state){
            return {...state.deleteTrashedServiceResponse.data};
        },


        restoreTrashedServiceResponseOk(state){
            return state.restoreTrashedServiceResponse.ok;
        },
        restoreTrashedServiceResponseStatus(state){
            return state.restoreTrashedServiceResponse.status;
        },
        restoreTrashedServiceResponsedata(state){
            return state.restoreTrashedServiceResponse.data;
        },
    },

    mutations: {

        LoadServices(state){

            let token = localStorage.getItem('token');

            Vue.http.get('/api/services?token=' + token).then(response => {

                    state.services = response.data.services;
                    state.loadServicesResponse = response;

                }, error => {

                    state.loadServicesResponse = error;

                }
            );

        },

        CreateService(state, oService){

            let token = localStorage.getItem('token');
            state.createServiceResponse = {
                ok: null,
                status: null,
                statusText: null,
                url: null,
                data: null,
            };

            Vue.http.post('/api/service?token=' + token, {
                name: oService.name,
            }).then(response => {

                state.createServiceResponse = response;

            }, error => {

                state.createServiceResponse = error;
                console.log('SERVICES => CreateOrder() => response: ' +  error);

            });

        },
        UpdateService(state, oService){

            let token = localStorage.getItem('token');
            state.updateServiceResponse = {
                ok: null,
                status: null,
                statusText: null,
                url: null,
                data: null,
            };
            alert('SERVICES => UpdateService() => oService.name: ' + oService.name)

            Vue.http.patch('/api/service/' + oService.id + '?token=' + token,{
                name: oService.name,
            }).then(
                response => {
                    state.updateServiceResponse = response;
                    console.log('Services => UpdateService() => response: ')
                    console.log(response)
                }, error => {
                    state.updateServiceResponse = error;
                    console.log('Services => UpdateService() => error: ')
                    console.log(error)
                },
            );

        },


        DeleteService(state, id){

            let token = localStorage.getItem('token');
            state.deleteServiceResponse = {
                ok: null,
                status: null,
                statusText: null,
                url: null,
                data: null,
            };

            Vue.http.delete('/api/service/' + id + '?token=' + token).then(
                response => {

                    state.deleteServiceResponse = response;

                }, error => {

                    state.deleteServiceResponse = error;

                }
            )

        },
        LoadTrashedServices(state){

            let token = localStorage.getItem('token');
            state.loadTrashedServicesResponse = {
                ok: null,
                status: null,
                statusText: null,
                url: null,
                data: null,
            };

            Vue.http.get('/api/services/trashed?token=' + token).then(response => {

                    state.trashedServices = response.data.trashedServices;
                    state.loadTrashedServicesResponse = response;

                }, error => {

                    state.loadTrashedServicesResponse = error;

                }
            );

        },
        DeleteTrashedService(state, id){

            let token = localStorage.getItem('token');
            state.deleteTrashedServiceResponse = {
                ok: null,
                status: null,
                statusText: null,
                url: null,
                data: null,
            };

            Vue.http.delete('/api/service/trashed/' + id + '?token=' + token).then(
                response => {

                    state.deleteTrashedServiceResponse = response;

                }, error => {

                    state.deleteTrashedServiceResponse = error;

                }
            );

        },

        RestoreTrashedService(state, id){

            let token = localStorage.getItem('token');
            state.restoreTrashedServiceResponse = {
                ok: null,
                status: null,
                statusText: null,
                url: null,
                data: null,
            };

            Vue.http.patch('/api/service/trashed/' + id + '?token=' + token).then(
                response => {

                    state.restoreTrashedServiceResponse = response;

                }, error => {

                    state.restoreTrashedServiceResponse = error;

                }
            );

        },
    },

    actions: {
        LoadServices(context){
            context.commit('LoadServices');
        },
        CreateService(context, oService){
            context.commit('CreateService', oService);
        },
        UpdateService(context, oService){
            context.commit('UpdateService', oService);
        },
        DeleteService(context, id){
            context.commit('DeleteService', id);
        },
        LoadTrashedServices(context){
            context.commit('LoadTrashedServices');
        },
        DeleteTrashedService(context, id){
            context.commit('DeleteTrashedService', id);
        },
        RestoreTrashedService(context, id){
            context.commit('RestoreTrashedService', id);
        },
    },
}
