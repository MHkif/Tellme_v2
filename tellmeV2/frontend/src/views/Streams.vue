<template>
    <div>
        <!-- Navbar -->
        <NavBar />
        <!-- End Navbar -->
        <div  
        v-if="streams.length"
        class="flex w-full p-8 justify-between items-center">
            <h3 class="font-bold text-xl">Streams</h3>
            <router-link
                  to="/streamRoom"
                    class="flex justify-center rounded bg-gray-900 px-4 py-2 text-md font-semibold text-white hover:text-orange-600 hover:border hover:border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
                >
                    Launch a Stream
                </router-link>
        </div>
        <section
            v-else
            class="w-full h-[calc(100vh-6rem)] flex items-center justify-center flex-col gap-4 p-8"
        >
            <h3 class="font-bold text-center text-xl text-gray-800">
                No Streams Has been launched yet, Try to launch one .
            </h3>
            <router-link
                  to="/streamRoom"
                    class="flex justify-center rounded bg-gray-900 px-4 py-2 text-md font-semibold text-white hover:text-orange-600 border hover:border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
                >
                    Launch a Stream
                </router-link>
        </section>
      
    </div>
</template>

<script >
import NavBar from "../components/NavBar.vue";
import MainLayout from "../components/MainLayout.vue";
export default {
    components: {
    MainLayout, NavBar
},
data(){
    return {
        streams:[]
    }
}
}
</script>

<style></style>
