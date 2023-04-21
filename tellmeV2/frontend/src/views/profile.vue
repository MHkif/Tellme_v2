<template>
    <div>
        <!-- Navbar -->
        <NavBar />
        <!-- End Navbar -->

        <!-- Cover Section -->
        <CoverProfile :user="user" />
        <!-- End Cover Section -->

        <!-- About Me Section -->
        <section class="w-full flex flex-col gap-6 p-8 md:flex-row">
            <!-- Experiences & About me -->
            <div class="w-full flex flex-col gap-6 md:w-[60%]">
                <AboutMe></AboutMe>
            </div>

            <!-- Location, website , email ... -->
            <div class="w-full flex flex-col gap-6 md:w-[40%]">
                <div class="w-full p-4 rounded-md bg-gray-100">
                    <h3 class="text-black font-medium">Location</h3>
                    <div class="py-2">
                        <h3 class="text-gray-700 font-semiBold">
                            Casablanca, Morocco .
                        </h3>
                    </div>
                </div>
                <div class="w-full p-4 rounded-md bg-gray-100">
                    <h3 class="text-black font-medium">Website</h3>
                    <div class="py-2">
                        <h3 class="text-gray-700 font-semiBold">
                            www.frankdeveone.dev
                        </h3>
                    </div>
                </div>
                <div class="w-full p-4 rounded-md bg-gray-100">
                    <h3 class="text-black font-medium">Email</h3>
                    <div class="py-2">
                        <h3 class="text-gray-700 font-semiBold">
                            frank@gmail.com
                        </h3>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Me Section -->

        <!--  Playlist Section -->
        <ListScroll v-if="playlists.length" title="Your Playlists">
            <PlayListCard />
            <PlayListCard />
            <PlayListCard />
        </ListScroll>
        <section
            v-else
            class="w-full flex items-center justify-center flex-col gap-4 p-8"
        >
            <h3 class="font-bold text-center text-xl text-gray-800">
                No Playlists in your channel, Try to create one .
            </h3>
            <Button
                @click="this.modelOpen = true"
                class="flex justify-center rounded bg-gray-900 px-4 py-2 text-md font-semibold text-orange-600 border border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
            >
                Create PlayList
            </Button>
        </section>
        <!-- End  Playlist Section -->

             <!--  Podcasts  Section -->
        <PodcastsGrid
            v-if="podcasts.length"
            title="Your Podcasts"
            :podcasts="podcasts"
            @click="this.$emit('playPodcast', podcast)"
        >
        </PodcastsGrid>
        <!-- End  Podcasts  Section -->
        <section
            v-else
            class="w-full flex items-center justify-center flex-col gap-4 p-8"
        >
            <h3 class="font-bold text-center text-xl text-gray-800">
                No Podcasts in your channel, Try to upload one .
            </h3>
            <Button
                @click="this.modelOpen = true"
                class="flex justify-center rounded bg-gray-900 px-4 py-2 text-md font-semibold text-orange-600 border border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
            >
                Create Podcast
            </Button>
        </section>
        <div class="my-16"></div>
    </div>
</template>

<script>
import NavBar from "../components/NavBar.vue";
import SideBar from "../components/SideBar.vue";
import CoverProfile from "../components/CoverProfile.vue";
import PodcastCard from "../components/PodcastCard.vue";
import PodcastsGrid from "../components/PodcastsGrid.vue";
import PlayListCard from "../components/PlayListCard.vue";
import ListScroll from "../components/ListScroll.vue";
import MainLayout from "../components/MainLayout.vue";
import AboutMe from "../components/AboutMe.vue";
import axios from "axios";
export default {
    components: {
        MainLayout,
        NavBar,
        SideBar,
        CoverProfile,
        PodcastCard,
        PodcastsGrid,
        PlayListCard,
        ListScroll,
        AboutMe,
    },
    data() {
        return {
            user: {},
            loading: true,
            podcasts: [],
            categories: [],
            playlists: [],
            podcast: this.$store.state.podcasts,
            modelOpen: false,
        };
    },
    methods: {
        myPodcasts() {
            let config = {
                method: "post",
                maxBodyLength: Infinity,
                url: "http://127.0.0.1:8000/api/v1/mypodcasts",
                data: { user_id: this.$store.state.id },
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${this.$store.state.token}`,
                },
            };
            axios
                .request(config)

                .then((response) => {
                    console.log("Response My Podcasts : ", response);
                    if (response.data) {
                        this.podcasts = response.data.data;
                    }
                })
                .catch((error) => {
                    console.log("Error My Podcasts:", error.response);
                });
        },

        getCategories() {
            axios
                .get("")
                .then((response) => {
                    console.log("Response Categories : ", response);
                    if (response.data) {
                        this.categories = response.data.data;
                    }
                })
                .catch((error) => {
                    console.log("Error Categories :", error.response);
                });
        },

        getPlayList() {
            axios
                .post(
                    "http://127.0.0.1:8000/api/v1/myPlayLists",
                    this.$store.state.id
                )
                .then((response) => {
                    console.log("Response My PlayLists : ", response);
                    if (response.data) {
                        this.playlists = response.data.data;
                    }
                })
                .catch((error) => {
                    console.log("Error My PlayLists:", error.response);
                });
        },
    },
    mounted() {
        this.user = this.$store.state.user;
        this.myPodcasts();
        this.getCategories();
        this.getPlayList();
    },
};
</script>

<style></style>
