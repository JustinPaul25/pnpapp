export default {
    namespaced: true,
    state: {
        ranks: {},
    },
    getters: {
        ranks: state => state.ranks,
    },
    mutations: {
        setRanks (state, payload) {
            state.ranks = payload
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
        async getRanks ({ commit }, payload = {}) {
            await axios.get(`/getRanks`)
            .then(response => {
                commit('setRanks', response.data)
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