import Vue from 'vue'
import Vuex from 'vuex'

import report from './modules/reports'
import user from './modules/users'
import rank from './modules/ranks'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
    },

    modules: {
       report,
       user,
       rank
    },

    getters: {
    },

    mutations: {
    }
})

export default store