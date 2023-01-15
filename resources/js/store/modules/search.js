// states
const state = {
  users: []
}

// getters
const getters = {
  getUsers(){
    return state.users
  }
}

// mutations
const mutations = {
  setUsers(state, users){
    state.users = users
  }
}

// actions
const actions = {
  apiSearchUsers ({commit}, query) {
    axios.get(`/api/search/users?query=${query}`).then((resp) => {
      console.log(resp.data)
      commit('setUsers', resp.data)
    })
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
}
