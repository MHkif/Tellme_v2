<template>
    <section class="p-8 overflow-x-hidden">
        <div>
            <div class="flex gap-5 items-center w-full relative h-full">
                <img
                    class="h-36 w-32 md:h-48 md:w-44 rounded object"
                    src="../assets/cover.jpg"
                />

                <div class="w-full flex flex-col self-start gap-3">
                    <div
                        class="text-gray-900 text-xl w-full hover:underline cursor-pointer font-bosemiboldld md:text-3xl"
                    >
                        {{ podcast.title }}
                    </div>

                    <div class="text-gray-600 text-[13px] flex gap-4">
                        <div class="flex">PLaylist</div>
                        <div class="flex">
                            <div class="circle mt-2 mr-2" />
                            <span class="">2023</span>
                        </div>
                        <div class="flex">
                            <div class="circle mt-2 mr-2" />
                            <span class="">01:23 min</span>
                        </div>
                    </div>

                    <div
                        class=" absolute flex gap-4 items-center justify-start bottom-0 mb-1.5"
                    >
                        <!-- <button
                            class="p-1 rounded-full bg-black"
                            @click="playFunc()"
                        >
                            <Play fillColor="#181818" :size="5" />
                            <Pause fillColor="#181818" :size="25" />
                        </button> -->
                        <button
                        v-if="this.$store.state.isPlaying"
                            id="pause"
                            class=" rounded-full flex text-white bg-orange-600 disabled:text-gray-600 mr-6"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                class="fill-current w-6 h-6 md:w-8 md:h-8 m-auto"
                            >
                                <path
                                    d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"
                                ></path>
                                <path d="M13 9h2v6h-2zM9 9h2v6H9z"></path>
                            </svg>
                           
                        </button>
                        <!-- @click="play(this.podcast)" -->
                        <!-- v-else -->
                        <button
                            id="play"
                            v-else
                            class="rounded-full flex text-white bg-orange-600 disabled:text-gray-600 mr-6"
                        >
                            <svg
                                class="fill-current w-6 h-6 md:w-8 md:h-8 m-auto"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21ZM12 23C18.0751 23 23 18.0751 23 12C23 5.92487 18.0751 1 12 1C5.92487 1 1 5.92487 1 12C1 18.0751 5.92487 23 12 23Z"
                                    fill="currentColor"
                                />
                                <path
                                    d="M16 12L10 16.3301V7.66987L16 12Z"
                                    fill="currentColor"
                                />
                            </svg>
                        </button>
                      
                    </div>
                </div>
            </div>

            <div class="mt-6"></div>
            <div class="flex items-center justify-between px-5 pt-2">
                <div>
                    <ClockTimeThreeOutline fillColor="#FFFFFF" :size="18" />
                </div>
            </div>
            <div class="border-b border-gray-300 mt-2"></div>
        </div>

        <section class="flex flex-col gap-8 h-full w-full py-8 md:flex-row">
            <div class="w-full md:w-[80%] flex flex-col gap-6">
                <h3 class="text-md font-medium">About this Podcast</h3>
                <p class="text-md text-gray-700">
                    {{ podcast.description }}
                </p>
            </div>

            <div class="flex flex-col gap-4 w-full md:w-auto h-full rounded">
                <router-link
                    to="/profile"
                    aria-label="profile"
                    class="flex items-center gap-4"
                >
                    <div class="flex w-full items-center space-x-4">
                        <div class="flex items-center justify-center">
                            <img
                                class="w-10 h-10 rounded-full border-2 border-orange-600"
                                src="../assets/italo.jpg"
                                alt=""
                            />
                        </div>

                        <span class="font-medium text-gray-99">
                            {{ this.$store.state.user.first_name }}
                            {{ this.$store.state.user.last_name }}</span
                        >
                    </div>
                </router-link>
                <div class="flex flex-col gap-2 w-full">
                    <h3 class="font-medium text-sm">About the speaker</h3>
                    <p class="text-gray-600">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </p>
                </div>
            </div>
        </section>
        
    </section>
</template>

<script>
import axios from "axios";
import PodacstRow from "../components/PodcastRow.vue";
import Play from "vue-material-design-icons/Play.vue";
import Pause from "vue-material-design-icons/Pause.vue";
import DotsHorizontal from "vue-material-design-icons/DotsHorizontal.vue";
import Heart from "vue-material-design-icons/Heart.vue";
import ClockTimeThreeOutline from "vue-material-design-icons/ClockTimeThreeOutline.vue";
import MusicPlayer from "../components/MusicPlayer.vue";

export default {
    props: ["id"],
    components: {
        PodacstRow,
    },
    data() {
        return {
            currentTime: "",
            podcast: "",
            duration: "",
            endDuration: "",
            player: new Audio(),
            isPlaying: false,
        };
    },
    methods: {
        getPodcast() {
            let config = {
                method: "get",
                url: `http://127.0.0.1:8000/api/v1/podcasts/${this.$route.query.id}`,
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${this.$store.state.token}`,
                },
            };
            axios
                .request(config)
                .then((response) => {
                    console.log("Response Podcast : ", response.data.data);
                    if (response.data) {
                        this.podcast = response.data.data;
                    }
                })
                .catch((error) => {
                    console.log("Error Podcast :", error.response);
                });
        },
        play() {
            this.audio.play();
            this.isPlaying = true;
        },
        pause() {
            this.audio.pause();
            this.isPlaying = false;
        },
    },
    mounted() {
        this.audio = document.querySelector("#audio");
        this.getPodcast();
    },
};
</script>

<style scope>
.circle {
    width: 4px;
    height: 4px;
    background-color: rgb(189, 189, 189);
    border-radius: 100%;
}
</style>
