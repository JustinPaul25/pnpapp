export default {
    namespaced: true,
    state: {
        reports: {},
        errors: [],
        pagination: {
            meta: {
                last_page: 1
            }
        }
    },
    getters: {
        reports: state => state.reports,
        errors: state => state.errors,
        pagination: state => state.pagination
    },
    mutations: {
        setReports (state, payload) {
            state.reports = payload
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
        async saveReport ({ dispatch, commit }, payload = {}) {
            try {
                const response = await axios.post(`/report`, payload)
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
        async updateReport ({ dispatch, commit }, payload = {}) {
            try {
                const response = await axios.post(`/report-update`, payload)
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
        async getReports ({ commit }, payload = {}) {
            await axios.get(`/getReports?page=` + payload.params.page, {
                params: payload.params
            })
            .then(response => {
                commit('setReports', response.data)
                commit('setPagination', response.data)
            })
        },
        async markSolved ({ commit }, payload = {}) {
            await axios.get(`/report-solved/${payload.id}`)
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