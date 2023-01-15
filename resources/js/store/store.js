import Vue from 'vue'
import Vuex from 'vuex'
import home from './modules/home'
import profile from './modules/profile'
import post from './modules/post'
import search from './modules/search'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    home,
    profile,
    post,
    search
  },

  state: {
    authUser: null,
    isLoading: false,
  },

  mutations: {
    setAuthUser(state, payload) {
      state.authUser = payload
    },
    setIsLoading(state) {
      state.isLoading = !state.isLoading
    },
  },

  actions: {
    apiGetAuthUser({ commit }) {
      axios.get('/api/users/details').then((resp) => {
        commit('setAuthUser', resp.data)
      })
    },
    logout({ commit }) {
      commit('setIsLoading')
      axios.post('logout').then((resp) => {
        commit('setAuthUser', null)
        commit('setIsLoading')
      })
    },

    eventScrollToTop() {
      window.scrollTo(0, 0)
    },
  },

  strict: true,
})
