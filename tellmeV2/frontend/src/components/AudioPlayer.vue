<template>
    <footer
        :class="this.$store.state.audio ? '' : 'hidden'"
        id="AudioPlayer"
        class="fixed flex flex-col items-center justify-between bottom-0 w-[calc(100%-3.35rem)] z-50 h-[80px] bg-[#181818] border-t border-t-[#272727] sm:flex-row"
        style="background-color: #252525"
    >
        <div @click="close" class="absolute top-1 right-2">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-5 h-5 md:w-6 md:h-6 text-gray-500 hover:text-red-600"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </svg>
        </div>

        <div class="flex items-center w-1/4">
            <div class="flex items-center ml-4">
                <img
                    class="hidden rounded shadow-2xl md:block h-14 w-14"
                    src="../assets/cover.jpg"
                />
                <div class="ml-4 w-[60%] overflow-hidden">
                    <div
                        class="text-[14px] text-white hover:underline cursor-pointer"
                    >
                        {{ podcast.title }}
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-[35%] mx-auto w-2/4">
            <div class="flex-col items-center justify-center">
                <div class="buttons flex items-center justify-center h-[30px]">
                    <button class="mx-2">
                        <SkipBackward fillColor="#FFFFFF" :size="25" />
                    </button>
                    <button
                        @click="playOrPauseThisAudio"
                        class="p-1 rounded-full mx-3 bg-white"
                    >
                        <Play
                            v-if="!this.$store.state.isPlaying"
                            fillColor="#181818"
                            :size="25"
                        />
                        <Pause v-else fillColor="#181818" :size="25" />
                    </button>
                    <button class="mx-2">
                        <SkipForward fillColor="#FFFFFF" :size="25" />
                    </button>
                </div>

                <div class="flex items-center h-[25px]">
                    <div
                        v-if="isTrackTimeCurrent"
                        class="text-white text-[12px] pr-2 pt-[11px]"
                    >
                        {{ isTrackTimeCurrent }}
                    </div>
                    <div
                        ref="seekerContainer"
                        class="w-full relative mt-2 mb-3"
                        @mouseenter="isHover = true"
                        @mouseleave="isHover = false"
                    >
                        <input
                            v-model="range"
                            ref="seeker"
                            type="range"
                            class="absolute rounded-full my-2 w-full h-0 z-40 appearance-none bg-opacity-100 focus:outline-none accent-white"
                            :class="{ rangeDotHidden: !isHover }"
                        />
                        <div
                            class="pointer-events-none mt-[6px] absolute h-[4px] z-10 inset-y-0 left-0 w-0"
                            :style="`width: ${range}%;`"
                            :class="isHover ? 'bg-green-500' : 'bg-white'"
                        />
                        <div
                            class="absolute h-[4px] z-[-0] mt-[6px] inset-y-0 left-0 w-full bg-gray-500 rounded-full"
                        />
                    </div>
                    <div
                        v-if="isTrackTimeTotal"
                        class="text-white text-[12px] pl-2 pt-[11px]"
                    >
                        {{ isTrackTimeTotal }}
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center w-1/4 justify-end pr-10">
            <MusicPlayerVolume />
        </div>
    </footer>
</template>

<script>
import Play from "vue-material-design-icons/Play.vue";
import Pause from "vue-material-design-icons/Pause.vue";
import SkipBackward from "vue-material-design-icons/SkipBackward.vue";
import SkipForward from "vue-material-design-icons/SkipForward.vue";
import MusicPlayerVolume from "./MusicPlayerVolume.vue";
import { ref, watch, onMounted } from "vue";
let isHover = ref(false);
let isTrackTimeCurrent = ref(null);
let isTrackTimeTotal = ref(null);
let seeker = ref(null);
let seekerContainer = ref(null);
let range = ref(0);
onMounted(() => {
    if (audio.value) {
        setTimeout(() => {
            timeupdate();
            loadmetadata();
        }, 300);
    }

    if (this.store.value) {
        seeker.value.addEventListener("change", function () {
            const time = audio.value.duration * (seeker.value.value / 100);
            audio.value.currentTime = time;
        });

        seeker.value.addEventListener("mousedown", function () {
            audio.value.pause();
            isPlaying.value = false;
        });

        seeker.value.addEventListener("mouseup", function () {
            audio.value.play();
            isPlaying.value = true;
        });

        seekerContainer.value.addEventListener("click", function (e) {
            const clickPosition =
                (e.pageX - seekerContainer.value.offsetLeft) /
                seekerContainer.value.offsetWidth;
            const time = audio.value.duration * clickPosition;
            audio.value.currentTime = time;
            seeker.value.value =
                (100 / audio.value.duration) * audio.value.currentTime;
        });
    }
});

export default {
    name: "AudioPlayer",
    components: {
        Play,
        Pause,
        SkipBackward,
        SkipForward,
        MusicPlayerVolume,
    },
    data() {
        return {
            currentTime: "",
            duration: "",
            endDuration: "",
            index: 0,
            podcast: ref(null),
            player: ref(new Audio()),
        };
    },

    methods: {
        close() {
            this.$store.commit("clearPodcast");
        },

        loadAudio() {
            if (JSON.parse(localStorage.getItem("podcast")) !== null) {
                this.podcast = this.$store.state.currentPodcast;
                this.player.src = this.podcast.url;
                this.player.pause();
            } else {
                this.podcast = this.$store.state.currentPodcast;
                this.player.src = this.podcast.url;
                setTimeout(() => {
                    this.player.play();
                }, 200);
            }
        },

        playOrPauseAudio() {
            if (
                typeof this.podcast.url != "undefined" ||
                this.podcast.url != null
            ) {
                if (this.player.paused) {
                    this.$store.commit("setPlay");
                    this.player.play();
                } else {
                    this.$store.commit("clearPlay");
                    this.player.pause();
                }
            } else {
                alert("This audio is null");
            }
        },
        playOrPauseThisAudio(podcast) {
            if (
                !this.player ||
                !this.player.src ||
                this.$store.state.currentPodcast.id !== this.podcast.id
            ) {
                this.loadAudio(podcast);
                return;
            }

            this.playOrPauseAudio();
        },
        timeupdate() {
            this.player.value.addEventListener("timeupdate", function () {
                var minutes = Math.floor(this.player.value.currentTime / 60);
                var seconds = Math.floor(
                    this.player.value.currentTime - minutes * 60
                );
                isTrackTimeCurrent.value =
                    minutes + ":" + seconds.toString().padStart(2, "0");
                const value =
                    (100 / this.player.value.duration) *
                    this.player.value.currentTime;
                range.value = value;
                seeker.value.value = value;
            });
        },

        loadmetadata() {
            this.player.value.addEventListener("loadedmetadata", function () {
                const duration = this.player.value.duration;
                const minutes = Math.floor(duration / 60);
                const seconds = Math.floor(duration % 60);
                isTrackTimeTotal.value =
                    minutes + ":" + seconds.toString().padStart(2, "0");
            });
        },
    },

    mounted() {
        if (this.player.value) {
            setTimeout(() => {
                this.timeupdate();
                this.loadmetadata();
            }, 300);
        }

        if (this.podcast.value) {
            seeker.value.addEventListener("change", function () {
                const time =
                    this.player.value.duration * (seeker.value.value / 100);
                this.player.value.currentTime = time;
            });

            seeker.value.addEventListener("mousedown", function () {
                this.player.value.pause();
                isPlaying.value = false;
            });

            seeker.value.addEventListener("mouseup", function () {
                this.player.value.play();
                isPlaying.value = true;
            });

            seekerContainer.value.addEventListener("click", function (e) {
                const clickPosition =
                    (e.pageX - seekerContainer.value.offsetLeft) /
                    seekerContainer.value.offsetWidth;
                const time = this.player.value.duration * clickPosition;
                this.player.value.currentTime = time;
                seeker.value.value =
                    (100 / this.player.value.duration) *
                    this.player.value.currentTime;
            });
        }
    },

    created() {
        // this.podcast = this.$store.state.currentPodcast;
        // this.player.src = this.podcast.url;
        // this.player.play();
        // this.current = this.podcast;
        // this.currentTime = this.current.currentTime;
        // this.duration = this.current.duration;
        // this.player.play();
        this.loadAudio();
    },
};
</script>
