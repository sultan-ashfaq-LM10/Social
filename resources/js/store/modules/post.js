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

    apiGetHomePosts({commit}) {
        return axios
        .get('api/home/posts')
        .then((resp) => {
            commit("setPosts", resp.data);
            return resp.data;
        })
        .catch((error) => {
            console.log(error.response)
        })
    },

    apiFetchProfilePosts({commit}) {
        return axios
        .get('api/profile/posts')
        .then((resp) => {
            commit("setPosts", resp.data);
            return resp.data;
        })
        .catch((error) => {
            console.log(error.response)
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
