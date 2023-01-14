// states
const state = {
    posts: [],
    friends: [],
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
    apiGetPosts({commit}) {
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
