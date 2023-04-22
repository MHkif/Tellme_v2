<template>
    <section >
        <!-- Navbar -->
        <NavBar />
        <!-- End Navbar -->
        <div
            v-if="videos.length">
            <div class="flex w-full p-8 justify-between items-center">
                <h3 class="font-bold text-xl">Discover</h3>
                <router-link
                    to="/shortvideos/create"
                    class="flex justify-center rounded bg-gray-900 px-4 py-2 text-md font-semibold text-white hover:text-orange-600 border border-white hover:border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
                >
                    Make a Video
                </router-link>
            </div>
            <div
        
                class="px-8 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
            >
                <ShortVideoCard />
                <ShortVideoCard />
                <ShortVideoCard />
                <ShortVideoCard />
            </div>
        
        </div>
        <section
            v-else
            class="w-full h-[calc(100vh-8rem)] flex items-center justify-center flex-col gap-4 p-8"
        >
            <h3 class="font-bold text-center text-xl text-gray-800">
                No Short Videos Has been found, Try to make one .
            </h3>
            <router-link
                    to="/shortvideos/create"
                    class="flex justify-center rounded bg-gray-900 px-4 py-2 text-md font-semibold text-white hover:text-orange-600 border border-white hover:border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
                >
                    Make a Video
                </router-link>
        </section>
    </section>
</template>

<script>
import NavBar from "../components/NavBar.vue";
import MainLayout from "../components/MainLayout.vue";
import ShortVideoCard from "../components/ShortVideoCard.vue";
export default {
    components: {
        MainLayout,
        NavBar,
        ShortVideoCard,
    },
    data() {
        return {
            isRecording: false,
            videos: []
        };
    },
};
</script>

<style></style>
