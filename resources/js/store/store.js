import Vue from 'vue'
import Vuex from 'vuex'
import home from './modules/home'
import profile from './modules/profile'
import post from './modules/post'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    home,
    profile,
    post,
  },

  state: {
    authUser: null,
  },

  mutations: {
    setAuthUser(state, payload) {
      state.authUser = payload
    },
  },

  actions: {
    apiGetAuthUser({ commit }) {
      axios.get('/api/users/details').then((resp) => {
        commit('setAuthUser', resp.data)
      })
    },
    logout({ commit }) {
      axios.post('logout').then((resp) => {
        commit('setAuthUser', null)
      })
    },

    eventScrollToTop() {
      window.scrollTo(0, 0)
    },
  },

  strict: true,
})
