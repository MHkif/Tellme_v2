<template>
    <aside
        class="fixed left-0 top-0 z-40 sidebar min-h-screen w-[3.35rem] overflow-hidden hover:w-56 hover:bg-white hover:shadow-lg"
        style="background-color: #252525"
    >
        <div class="flex h-screen flex-col justify-between pb-4">
            <div>
                <!-- Profile -->
                <li class="min-w-max ">
                    <router-link
                        to="/profile"
                        aria-label="profile"
                        active-class="text-orange-600 "
                            class="group relative flex items-center  space-x-4 p-1.5 text-orange-50"
>
                        <div class="flex w-full items-center  space-x-4">
                            <div class="flex items-center justify-center">
                                <img

                                    class="w-10 h-10  rounded-full border-2 border-orange-600"
                                    src="../assets/italo.jpg"
                                    alt=""
                                />
                            </div>

                            <span
                                class="font-medium hover:text-orange-600"
                            >
                                {{ admin.first_name }} {{ admin.last_name }}</span
                            >
                        </div>
                    </router-link>
                </li>

                <ul class="mt-5 space-y-1 tracking-wide text-orange-50">
                    <li class="min-w-max ">
                        <router-link
                            to="/home"
                            aria-label="home"
                            active-class="text-orange-600"
                            class="group relative flex items-center space-x-4 p-1"
>
                            
                                <div
                                class="group flex items-center  justify-center rounded p-2"
                               >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        active-class="text-orange-600"
                                    
                                    class="w-6 h-6  group-hover:text-orange-600"
                                 >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                                        />
                                    </svg>
                                </div>
                                <span  class="flex items-center group-hover:text-orange-600 font-medium"
                               
                                    >Home</span
                                >
                            
                        </router-link>
                    </li>

                   <navSide
                   title="Podcasts"
                   route="/podcastPanel"
                   />
                   
                    <li class="min-w-max">
                        <a
                            @click="logout"
                            class="group flex items-center space-x-4 p-1 text-white"
                        >
                            <div
                                class="flex items-center justify-center rounded p-2"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 text-orange-50 group-hover:text-orange-600"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"
                                    />
                                </svg>
                            </div>
                            <span class="group-hover:text-orange-600"
                                >Log Out</span
                            >
                        </a>
                    </li>
                </ul>
            </div>

            
        </div>
    </aside>
</template>

<script>
import axios from "axios";
import navSide from "./nav-side.vue";

export default {
    name: "AdminSideBar",
    components:{
        navSide
    },
    data() {
        return {
            admin: {},
         
        };
    },
    methods: {
        logout() {
            let config = {
                method: "post",
                maxBodyLength: Infinity,
                url: "http://127.0.0.1:8000/api/v1/checkToken",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${this.$store.state.token}`,
                },
            };
            axios
                .request(config)
                .then((res) => {
                    this.$store.commit("clearToken");
                    this.$router.push("/login");
                })
                .catch((err) => console.log("Errors : ", err));
        },
    },
    mounted() {
        this.admin = this.$store.state.user;

        // console.log("User : ", this.$store.state.user);
    },
};
</script>

<style scoped>
.sidebar {
    transition: all 0.4s ease-in-out;
}
</style>
