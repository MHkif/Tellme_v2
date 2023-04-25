import { createStore } from "vuex";

const store = createStore({
    state: {
        token: localStorage.getItem("token") || null,
        id: localStorage.getItem("id") || null,
        user: JSON.parse(localStorage.getItem("user")) || null,
        collapse: localStorage.getItem("collapse") || false,
        podcasts: JSON.parse(localStorage.getItem("podcasts")) || [],
        isPlaying: false,
        audio: localStorage.getItem("audio") || false,
        currentPlayList: null,
        currentPodcast: JSON.parse(localStorage.getItem("podcast")) || null,
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
            state.isPlaying = true;
            state.audio = true;
        },
        setAudio(state) {
            localStorage.setItem("audio", true);
            state.audio = true;
        },
        setPodcasts(state, podcasts) {
            localStorage.setItem("podcasts", JSON.stringify(podcasts));
            state.podcasts = podcasts;
        },
        setPodcast(state, podcast) {
            localStorage.setItem("podcast", JSON.stringify(podcast));
            state.currentPodcast = podcast;
            // state.isPlaying = true;
            state.audio = true;
        },

        clearPodcast(state) {
            localStorage.removeItem("podcasts");
            state.currentPodcast = null;
            state.isPlaying = false;
            state.audio = false;
            localStorage.removeItem("audio");
        },

        clearPlay(state) {
            state.isPlaying = false;
        },

        clearToken(state) {
            localStorage.removeItem("token");
            localStorage.removeItem("id");
            localStorage.removeItem("audio");
            localStorage.removeItem("user");
            localStorage.removeItem("podcasts");
            state.token = null;
            state.id = null;
            state.user = null;
            state.play = false;
            state.podcasts = [];
            state.audio = false;
        },
        loadAudio(podcast, state) {
            state.currentPodcast = podcast;

            if (state.audio && state.audio.src) {
                state.audio.pause();
                state.isPlaying = false;
                state.audio.src = "";
            }

            state.audio = new Audio();
            state.audio.src = podcast.url;

            setTimeout(() => {
                state.isPlaying = true;
                state.audio.play();
            }, 200);
        },
        playOrPauseAudio(state, audio) {
            if (audio.paused) {
                state.isPlaying = true;
                audio.play();
            } else {
                state.isPlaying = false;
                state.audio.pause();
            }
        },
        playOrPauseThisAudio(podcast, state) {
            if (
                !state.audio ||
                !state.audio.src ||
                state.currentPodcast.id !== podcast.id
            ) {
                state.loadAudio(podcast);
                return;
            }

            this.playOrPauseAudio();
        },
    },
    getters: {},
    actions: {
        loadAudio(podcast) {
            this.currentPodcast = podcast;

            if (this.audio && this.audio.src) {
                this.audio.pause();
                this.isPlaying = false;
                this.audio.src = "";
            }

            this.audio = new Audio();
            this.audio.src = podcast.url;

            setTimeout(() => {
                this.isPlaying = true;
                this.audio.play();
            }, 200);
        },
        playOrPauseSong() {
            if (this.audio.paused) {
                this.isPlaying = true;
                this.audio.play();
            } else {
                this.isPlaying = false;
                this.audio.pause();
            }
        },

        playOrPauseThisAudio(podcast) {
            if (
                !this.audio ||
                !this.audio.src ||
                this.currentPodcast.id !== podcast.id
            ) {
                this.loadAudio(podcast);
                return;
            }

            this.playOrPauseSong();
        },

        prevSong(currentPodcast) {
            let track = this.currentPlayList.podcasts[currentPodcast.id - 2];
            this.loadSong(playlist, track);
        },

        nextSong(currentPodcast) {
            if (currentPodcast.id === this.currentPlayList.podcasts.length) {
                let podcast = this.currentPlayList.podcasts[0];
                this.loadSong(this.currentPlayList, podcast);
            } else {
                let podcast = this.currentPlayList.podcasts[currentPodcast.id];
                this.loadSong(this.currentPlayList, track);
            }
        },

        playFromFirst() {
            this.resetState();
            let podcast = this.currentPlayList.podcasts[0];
            this.loadAudio(podcast);
        },
    },
});

export default store;
