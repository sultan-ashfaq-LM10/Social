// states
const state = {
    posts: []
}

// getters
const getters = {
    getPosts(){
        return state.posts
    }
}

// mutations
const mutations = {
    setPosts(state, posts){
        state.posts = posts
    }
}

// actions
const actions = {
  apiStorePost({}, payload) {
    return axios
      .post('api/posts', { payload: payload })
      .then((resp) => {
        return resp;
      })
      .catch((error) => {
        return error.response;
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
