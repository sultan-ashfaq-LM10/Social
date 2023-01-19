// states
const state = {}

// getters
const getters = {}

// mutations
const mutations = {}

// actions
const actions = {
  apiGetFriendsAccepted({ commit }) {
    return axios.get('/api/profile/friends?type=accepted').then((resp) => {
      return resp.data
    })
  },

  apiGetFriendsPending({ commit }) {
    return axios.get('/api/profile/friends?type=pending').then((resp) => {
      return resp.data
    })
  },

  apiGetFriendsRequest({ commit }) {
    return axios.get('/api/profile/friends?type=request').then((resp) => {
      return resp.data
    })
  },

  apiUpdateFriendsRequest({dispatch}, payload) {
    return axios
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
