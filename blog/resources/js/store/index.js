import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);
const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
    state:  {
        posts: [],
    },
    actions: {
        async getAllPosts({ commit }) {
            return commit('setPosts', await applicationCache.get('/post/get_all'))
        },
    },

    mulations: {
        setPosts(stste, response) {
            state.Posts = response.data.data;
        },
    },
    strict: debug
});
