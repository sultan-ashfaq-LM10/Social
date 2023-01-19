// states
const state = {
    // homePosts: [],
    // profilePosts: []
}

// getters
const getters = {
  // use getters when you want to return a computed property based on the state
}

// mutations
const mutations = {
  // setHomePosts(state, posts) {
  //   state.homePosts = posts
  // },
  // addToHomePostList(state, post) {
    // state.homePosts.unshift(post) // not recommended

    //this code is adding a new post to the beginning of an array of homePosts and
    // creating a new copy of the array with this new post,
    // while keeping the original array intact.
    // state.homePosts = [post, ...state.homePosts]; // recommended
  //
  // },
  // setProfilePosts(state, posts) {
  //   state.profilePosts = posts
  // },
  // addToProfilePostList(state, post) {
  //   state.profilePosts = [post, ...state.profilePosts]
  // },
  // removeProfilePostFromList(state, postId) {
  //   state.profilePosts = [...state.profilePosts.filter((item) => item.id !== postId)]
  // },
  // addLikeToProfilePost(state, payload){
  //   state.profilePosts = state.profilePosts.map((post) => {
  //     if(post.id === payload.postId){
  //       post.likes.push(payload.like)
  //     }
  //     return post
  //   })
  // }
}

// actions
const actions = {
  apiStorePost({}, payload) {
    return axios
      .post('api/posts', { payload: payload })
      .then((resp) => {
        return resp
      })
      .catch((error) => {
        return error.response
      })
  },

  apiDeletePost({}, postId) {
    return axios
      .delete('api/posts/' + postId)
      .then((resp) => {
        return resp
      })
      .catch((error) => {
        return error.response
      })
  },

  apiStoreLike({}, postId) {
    return axios
      .post(`api/posts/${postId}/likes`)
      .then((resp) => {
        return resp.data
      })
      .catch((error) => {
        return error.response
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
