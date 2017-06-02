export default {

    namespaced: true,

    state:{
        token: {
            key: null,
            isValid: null,
        },
        response: null,
    },

    getters:{

        token(state){
             return state.token.key;
        },

        /**
         * @return {boolean}
         */
        isUserTokenValid(state){
            return state.token.isValid;
        },

        /**
         *
         * @return {Object} response data
         */
        userSigninResponseOk(state){

            let s = state,
                r = s.response,
                ok= null;

            if(r) ok = r.data.ok;

            return state.response.ok;

        },

        /**
         * @param state
         * @return {string} http request status code
         */
        userSigninResponseStatus(state){

            let s = state,
                r = s.response,
                status = null;

            if(r) {
                status = r.status;
            }

            return status;

        },

        /**
         * @return {object} Http request data.
         */
        userSigninResponseData(state){

            let s = state,
                r = s.response,
                data = null;

            if(r) data = r.data;

            return data;
        },

    },

    mutations:{

        GetTokenFromServer(state, credentials){

            //Requests and save token
            Vue.http.post('api/admin/signin', {
                'email':    credentials.email ,
                'password': credentials.password,
            }).then(response=>{

                let r = response,
                    d = r.data,
                    s = state;

                s.response = r;

                s.token.key = d.token;
                s.token.isValid = true;
                localStorage.setItem('token', s.token.key);

            }, error=>{

                let e = error,
                    s = state;

                s.response = error;

                s.token.key = null;
                s.token.isValid = false;
                localStorage.removeItem('token');

            });

        },

    },

    actions:{
        GetTokenFromServer(context, credentials){
            context.commit('GetTokenFromServer', credentials);
        },
    },

}
