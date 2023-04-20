import { createStore } from "vuex";

const store = createStore({
    state: {
        token: localStorage.getItem("token") || null,
        id: localStorage.getItem("id") || null,
        user: JSON.parse(localStorage.getItem("user")) || null,
        play: localStorage.getItem("play") || false,
        collapse: localStorage.getItem("collapse") || false,
        podcasts: JSON.parse(localStorage.getItem("podcasts")) || [],
    },
    mutations: {
        setToken(state, token) {
            localStorage.setItem("token", token);
            state.token = token;
        },
        setUser(state, user) {
            state.user = user;
            localStorage.setItem("user", JSON.stringify(user));
            localStorage.setItem("id", user.id);
            state.id = user.id;
        },
        setPlay(state) {
            localStorage.setItem("play", true);
            localStorage.removeItem("collapse");
            state.collapse = false;
            state.play = true;
        },
        setPodcasts(state, podcasts) {
            localStorage.setItem("podcasts", JSON.stringify(podcasts));
            state.podcasts = podcasts;
        },
        collapsed(state) {
            localStorage.setItem("collapse", true);
            state.collapse = true;
        },
        clearPodcasts(state) {
            localStorage.removeItem("podcasts");
            state.podcasts = [];
        },

        clearPlay(state) {
            localStorage.removeItem("play");
            state.play = false;
        },
        clearCollapsed(state) {
            localStorage.removeItem("collapse");
            state.collapse = false;
        },
        clearToken(state) {
            localStorage.removeItem("token");
            localStorage.removeItem("id");
            localStorage.removeItem("play");
            localStorage.removeItem("user");
            localStorage.removeItem("podcasts");
            state.token = null;
            state.id = null;
            state.user = null;
            state.play = false;
            state.podcasts = [];
        },
    },
    getters: {},
    actions: {},
});

export default store;
