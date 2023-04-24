<template>
    <section>
        <!-- Header -->
        <section
            class="relative h-44 w-full  bg-cover bg-center bg-no-repeat"
            style="background-color: #252525"
        >
            <!-- Cover -->
            <div class="absolute left-8 top-20 flex flex-col gap-10">
                <div class="w-60 h-60 bg-gray-800 rounded overflow-hidden">
                    <img
                        class="w-full h-full"
                        src="https://res.cloudinary.com/dr2ly0dd5/image/upload/v1681684167/Covers/chaqeypxnx27qdfjryzy.jpg"
                        alt=""
                    />
                </div>
            </div>
            <!-- End Cover -->
            <!-- Player -->

            <section
                class="flex flex-col gap-4 items-center justify-start ml-80 w-auto absolute bottom-4 justify-center"
            >
                <audio
                    controls
                    id="audio"
                    class="hidden"
                    src="https://res.cloudinary.com/dr2ly0dd5/video/upload/v1681684148/Audios/wbnnrzv2gl7evaxjnqc2.mp3"
                ></audio>
                <h3 class="font-medium text-md">
                    <!-- Are you following your dreams? - 6 Minute English -->
                    {{ podcast.title }}
                </h3>
                <div class="flex w-full items-center justify-start">
                    <button
                        v-if="isPlaying"
                        @click="pause"
                        id="pause"
                        class="rounded-full flex text-white disabled:text-gray-600 mr-6"
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

                    <button
                        v-else
                        id="play"
                        @click="play"
                        class="rounded-full flex text-white disabled:text-gray-600 mr-6"
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
                    <div class="flex items-center">
                        <span
                            id="currentStart"
                            class="text-xs text-white font-light mx-2"
                            >00:00</span
                        >
                        <input
                            type="range"
                            min="0"
                            max="100"
                            value="0"
                            ref="progressBar"
                            id="progressBar"
                            class="w-full h-0.5 bg-gray-400 rounded-lg appearance-none cursor-pointer"
                        />
                        <span
                            id="currentEnd"
                            class="text-xs text-white font-light mx-2"
                            >00:00</span
                        >
                    </div>
                </div>
            </section>

            <!-- player -->
        </section>
        <!-- End Header -->

        <section class="flex gap-8 h-screen w-auto ml-64 p-12">
            <div class="w-[80%] flex flex-col gap-6">
                <h3 class="text-md font-medium">About this Podcast</h3>
                <p class="text-md text-gray-700">
                    {{ podcast.description }}
                </p>
            </div>

            <div class="flex flex-col gap-4 w-auto h-full rounded">
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
export default {
    props: ["id"],
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

<style></style>
