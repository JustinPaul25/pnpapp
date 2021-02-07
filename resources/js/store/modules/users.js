export default {
    namespaced: true,
    state: {
        users: {},
        agentsSelect: {},
        errors: [],
        pagination: {
            meta: {
                last_page: 1
            }
        }
    },
    getters: {
        users: state => state.users,
        agentsSelect: state => state.agentsSelect,
        errors: state => state.errors,
        pagination: state => state.pagination
    },
    mutations: {
        setUsers (state, payload) {
            state.users = payload
        },
        setAgentsSelect (state, payload) {
            state.agentsSelect = payload
        },
        setErrors (state, payload) {
            state.errors = payload
        },
        setPagination (state, payload) {
            if (payload == {}) {
                state.pagination = {
                    meta: {
                        last_page: 1
                    }
                }
            } else {
                state.pagination = payload
            }
        },
    },
    actions: {
        async agentSelect ({commit}) {
            await axios.get(`/getAgentsSelect`)
            .then(response => {
                commit('setAgentsSelect', response.data)
            })
        },
        async saveUser ({ dispatch, commit }, payload = {}) {
            try {
                const response = await axios.post(`/user`, payload)
                commit('setErrors', {})
            } catch (error) {
                if (error.response.status == 422){
                    commit('setErrors', error.response.data.errors)
                    return error.response.data.errors
                } else {
                    return Promise.reject(error);
                }
            }
        },
        async updateUser ({ dispatch, commit }, payload = {}) {
            try {
                const response = await axios.put(`/user/${payload.id}`, payload)
                commit('setErrors', {})
                return response
            } catch (error) {
                if (error.response.status == 422){
                    commit('setErrors', error.response.data.errors)
                    return error.response.data.errors
                } else {
                    return Promise.reject(error);
                }
            }
        },
        async getUsers ({ commit }, payload = {}) {
            await axios.get(`/getUsers?page=` + payload.params.page, {
                params: payload.params,
            })
            .then(response => {
                commit('setUsers', response.data)
                commit('setPagination', response.data)
            })
        },
        async deleteUser ({ commit }, payload = {}) {
            try {
                const response = await axios.delete(`/${payload.id}/user`)
                return response
            } catch (error) {
                return Promise.reject(error);
            }
        },
    }
}