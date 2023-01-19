// states
const state = {};

// getters
const getters = {
  getPosts() {
    return state.posts;
  }
};

// mutations
const mutations = {};

// actions
const actions = {
  apiGetPosts({commit}) {
    return axios
    .get("api/profile/posts")
    .then((resp) => {
      return resp.data;
    })
    .catch((error) => {
      console.log(error.response);
    });
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};
