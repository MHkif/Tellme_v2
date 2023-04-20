<template>
    <div>
        <!-- Navbar -->
        <NavBar />
        <!-- End Navbar -->
        <div class="flex w-full p-8 justify-between items-center">
            <h3 class="font-bold text-xl">Settings</h3>
        </div>
    </div>
</template>

<script>
import NavBar from "../components/NavBar.vue";
import MainLayout from "../components/MainLayout.vue";
export default {
    name: "Settings",
    components: {
        MainLayout,
        NavBar,
    },
};
</script>

<style></style>
