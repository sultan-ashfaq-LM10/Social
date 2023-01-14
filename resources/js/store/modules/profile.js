// states
const state = {
  posts: [],
  acceptedFriends: [],
  pendingFriends: [],
};

// getters
const getters = {
  getPosts() {
    return state.posts;
  },
  getAcceptedFriends() {
    return state.acceptedFriends;
  },
  getPendingFriends() {
    return state.pendingFriends;
  },
};

// mutations
const mutations = {
  setPosts(state, posts) {
    state.posts = posts;
  },
  setAcceptedFriends(state, friends) {
    state.acceptedFriends = friends;
  },
  setPendingFriends(state, friends) {
    state.pendingFriends = friends;
  },
};

// actions
const actions = {
  apiGetPosts({commit}) {
    return axios
    .get("api/profile/posts")
    .then((resp) => {
      commit("setPosts", resp.data);
      return resp.data;
    })
    .catch((error) => {
      console.log(error.response);
    });
  },
  apiGetFriendsAccepted({commit}) {
    axios.get("/api/profile/friends?type=accepted").then((resp) => {
      commit("setAcceptedFriends", resp.data);
    });
  },

  apiGetFriendsPending({commit}) {
    axios.get("/api/profile/friends?type=pending").then((resp) => {
      commit("setPendingFriends", resp.data);
    });
  },
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};
