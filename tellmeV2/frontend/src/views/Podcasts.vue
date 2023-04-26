<template>
    <div>
        <!-- Navbar -->
        <NavBar />
        <!-- End Navbar -->

        <!--  Podcasts  Section -->
        <PodcastsGrid title="Podcasts" :podcasts="podcasts"> </PodcastsGrid>
        <!-- End  Podcasts  Section -->
        <div class="my-16"></div>
        <AudioPlayer />
    </div>
</template>

<script>
import NavBar from "../components/NavBar.vue";
import MainLayout from "../components/MainLayout.vue";
import PodcastCard from "../components/PodcastCard.vue";
import axios from "axios";
import PodcastsGrid from "../components/PodcastsGrid.vue";
import AudioPlayer from "../components/AudioPlayer.vue";
import { ref } from "vue";
export default {
    components: {
        MainLayout,
        NavBar,
        PodcastCard,
        PodcastsGrid,
        AudioPlayer,
    },

    data() {
        return {
            podcasts: [],
        };
    },

    methods: {
        getPodcasts() {
            axios
                .get("http://127.0.0.1:8000/api/v1/podcasts")
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
    },
    mounted() {
        this.getPodcasts();
    },
};
</script>

<style></style>
