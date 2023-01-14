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
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
}
