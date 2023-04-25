<template>
    <div>
        <!-- Navbar -->
        <NavBar />
        <!-- End Navbar -->

        <Hero></Hero>

        <!--  Podcasts Section -->
        <ListScroll v-show="podcasts.length" title="Latests Podcasts">
            <SnapPodcast
                v-for="podcast in podcasts"
                :key="podcast.id"
                :podcast="podcast"
            />
            <SnapPodcast
                v-for="podcast in podcasts"
                :key="podcast.id"
                :podcast="podcast"
            />
        </ListScroll>
        <!-- End  Podcasts Section -->

        <!-- Playlist Section -->
        <!-- <ListScroll
        v-if="playlists.length"
        title="Popular Playlists">
            <PlayListCard
                v-for="playlist in playlists"
                :key="playlist.id"
                :playlist="playlist"
            />
        </ListScroll>
        <section
            v-else
            class="w-full flex items-center justify-center flex-col gap-4 p-8"
        >
            <h3 class="font-bold text-center text-xl text-gray-800">
                No Playlists Has been found, Try to create one .
            </h3>
            <Button
                @click="this.modelOpen = true"
                class="flex justify-center rounded bg-gray-900 px-4 py-2 text-md font-semibold text-orange-600 border border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
            >
                Create PlayList
            </Button>
        </section> -->
        <!-- End  Playlist Section -->

        <!--  Podcasts  Section -->
        <PodcastsGrid
            title="Most Populat Podcasts"
            :podcasts="podcasts"
            @click="this.$emit('playPodcast', podcast)"
        >
        </PodcastsGrid>
        <!-- End  Podcasts  Section -->
        <div class="my-16"></div>
        <AudioPlayer />
    </div>
</template>

<script>
import axios from "axios";
import MainLayout from "../components/MainLayout.vue";
import NavBar from "../components/NavBar.vue";
import Hero from "../components/Hero.vue";
import PodcastCard from "../components/PodcastCard.vue";
import PodcastsGrid from "../components/PodcastsGrid.vue";
import PlayListCard from "../components/PlayListCard.vue";
import ListScroll from "../components/ListScroll.vue";
import SnapPodcast from "../components/SnapPodcast.vue";
import Swal from "sweetalert2";
import AudioPlayer from "../components/AudioPlayer.vue";

export default {
    components: {
        MainLayout,
        NavBar,
        PodcastCard,
        PodcastsGrid,
        PlayListCard,
        ListScroll,
        SnapPodcast,
        AudioPlayer,
        Hero,
    },
    data() {
        return {
            loading: false,
            podcasts: [],
            podcast: this.$store.state.podcasts,
            playlists: [],
        };
    },
    methods: {
        getPodcasts() {
            let config = {
                method: "get",
                maxBodyLength: Infinity,
                url: "http://127.0.0.1:8000/api/v1/podcasts",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${this.$store.state.token}`,
                },
            };
            axios
                .request(config)
                .then((response) => {
                    console.log("Response Data : ", response);
                    if (response.data) {
                        this.podcasts = response.data.data;
                    }
                })
                .catch((error) => {
                    console.log("Error :", error.response);
                });
        },
        getPlayLists() {
            let config = {
                method: "get",
                maxBodyLength: Infinity,
                url: "http://127.0.0.1:8000/api/v1/playlists",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${this.$store.state.token}`,
                },
            };
            axios
                .request(config)

                .then((response) => {
                    console.log("Response  PlayLists : ", response);
                    if (response.data) {
                        this.playlists = response.data;
                    }
                })
                .catch((error) => {
                    console.log("Error  PlayLists:", error.response);
                });
        },
    },
    mounted() {
        this.getPodcasts();
        this.getPlayLists();
        // if (this.$store.state.token !== "") {
        //   axios
        //     .post("http://127.0.0.1:8000/api/v1/checkToken", {
        //       token: this.$store.state.token,
        //     })
        //     .then((res) => {
        //       if (res.data.status == "Expired") {
        //         // this.$store.commit("setToken", res.data.token);
        //         Swal.fire({
        //           title: "Your session has expired",
        //           text: "Please log in again to continue using the app .",
        //           confirmButtonText: "Login",
        //         }).then((result) => {
        //           /* Read more about isConfirmed, isDenied below */
        //           if (result.isConfirmed) {
        //             this.$router.push("/login");
        //           } else if (result.isDenied) {
        //             Swal.fire("Changes are not saved", "", "info");
        //           }
        //         });
        //       }
        //       this.loading = false;
        //     })
        //     .catch((err) => {
        //       this.loading = false;
        //       //   this.$store.commit("clearToken");
        //       this.$router.push("/login");
        //     });
        // } else {
        //   this.loading = false;
        //   this.$router.push("/login");
        // }
    },
};
</script>

<style></style>
