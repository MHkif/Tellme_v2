<template>
      <section class="min-h-screen bg-gray-50">
  
        <!-- Side Bar -->
        <AdminSideBar />
        <!-- End Side Bar -->

        <!-- Content -->
        <main class="w-[calc(100%-3.35rem)] ml-auto flex flex-col">
            <NavBar/>
            <div class="p-8 w-full">
                <router-view></router-view>
            </div>
        </main>
        <!-- End Content -->
    </section>
</template>

<script>
import AdminSideBar from "./AdminSideBar.vue";
import NavBar from "../components/NavBar.vue";

export default {
    name: "AdminLayout",
    components: {
        AdminSideBar,
        NavBar
    },
};
</script>

<style scoped>
/* Only the scroll bar */
::-webkit-scrollbar {
    width: 0.5rem;
    height: 0.5rem;
}
::-webkit-scrollbar-thumb {
    background: #ff4400;
}
::-webkit-scrollbar-thumb:hover {
    background: rgba(0, 0, 0, 0.3);
}
</style>
