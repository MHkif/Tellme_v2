<template>
    <div>
        <!-- Navbar -->
        <NavBar />
        <!-- End Navbar -->
        <div class="flex w-full p-8 justify-between items-center">
            <h3 class="font-bold text-xl">Speakers</h3>
        </div>
    </div>
</template>

<script>
import NavBar from "../components/NavBar.vue";
import MainLayout from "../components/MainLayout.vue";
export default {
    name: "Speakers",
    components: {
        MainLayout,
        NavBar,
    },
};
</script>

<style></style>
