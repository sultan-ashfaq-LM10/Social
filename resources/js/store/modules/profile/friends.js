// states
const state = {
  acceptedFriends: [],
  pendingFriends: [],
  requestFriends: [],
}

// getters
const getters = {
  getAcceptedFriends() {
    return state.acceptedFriends
  },
  getPendingFriends() {
    return state.pendingFriends
  },
  getRequestFriends() {
    return state.requestFriends
  },
}

// mutations
const mutations = {
  setAcceptedFriends(state, friends) {
    state.acceptedFriends = friends
  },
  setPendingFriends(state, friends) {
    state.pendingFriends = friends
  },
  setRequestFriends(state, friends) {
    state.requestFriends = friends
  },
}

// actions
const actions = {
  apiGetFriendsAccepted({ commit }) {
    axios.get('/api/profile/friends?type=accepted').then((resp) => {
      commit('setAcceptedFriends', resp.data)
    })
  },

  apiGetFriendsPending({ commit }) {
    axios.get('/api/profile/friends?type=pending').then((resp) => {
      commit('setPendingFriends', resp.data)
    })
  },

  apiGetFriendsRequest({ commit }) {
    axios.get('/api/profile/friends?type=request').then((resp) => {
      commit('setRequestFriends', resp.data)
    })
  },

  apiUpdateFriendsRequest({dispatch}, payload) {
    axios
      .put(`/api/profile/friends/${payload.id}`, {
        type: payload.type,
      })
      .then((resp) => {
        if (resp.data){
          dispatch('apiGetFriendsRequest')
        }
        return resp.data
      })
      .catch((error) => {
        return error.response.data
      })
  },

  apiDeleteFriendsRequest({dispatch}, payload) {
    return axios.delete(`/api/profile/friends/${payload.id}`).then((resp) => {
      if (resp.data) {
        dispatch(`apiGetFriends${payload.tabType}`)

      }
      return resp.data
    }).catch((error) => {
      return error.response.data
    })
  },
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
}
